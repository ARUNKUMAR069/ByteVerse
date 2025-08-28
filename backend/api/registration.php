<?php
define('SECURE_ACCESS', true);
require_once('index.php');

// Debug information - log the request details
error_log('Registration API accessed - Method: ' . $_SERVER['REQUEST_METHOD'] . ', Content-Type: ' . (isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : 'not set'));
error_log('POST data: ' . print_r($_POST, true));

// Allow only POST requests - with better detection
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $originalMethod = isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']) ? $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] : '';
    if ($originalMethod === 'POST') {
        error_log('Accepting forwarded POST request');
    } else {
        error_log('Invalid method: ' . $_SERVER['REQUEST_METHOD']);
        sendResponse(false, 'Invalid request method');
        exit;
    }
}

// ---------- Sanitization & Validation helpers ----------
function clean_text($s, $maxLen = 200) {
    $s = is_null($s) ? '' : (string)$s;
    $s = trim($s);
    $s = strip_tags($s);
    $s = preg_replace('/\s+/u', ' ', $s);
    if (function_exists('mb_substr')) $s = mb_substr($s, 0, $maxLen);
    else $s = substr($s, 0, $maxLen);
    return $s;
}
function clean_email($s) {
    $s = clean_text($s, 254);
    $s = filter_var($s, FILTER_SANITIZE_EMAIL);
    return $s;
}
function valid_email($s) {
    return (bool)filter_var($s, FILTER_VALIDATE_EMAIL);
}
function clean_phone10($s) {
    $s = preg_replace('/\D+/', '', (string)$s);
    return $s;
}
function valid_phone10($s) {
    return preg_match('/^\d{10}$/', $s) === 1;
}
function require_in($value, $allowed) {
    return in_array($value, $allowed, true);
}

// Get step number and session ID
$step = filter_input(INPUT_POST, 'step', FILTER_SANITIZE_NUMBER_INT);
$session_id = filter_input(INPUT_POST, 'session_id', FILTER_SANITIZE_STRING);
$team_id = filter_input(INPUT_POST, 'team_id', FILTER_SANITIZE_NUMBER_INT);

// If no session_id provided, create one
if (empty($session_id) && $step == 1) {
    $session_id = bin2hex(random_bytes(16));
}

try {
    $conn = getDbConnection();
    if (!$conn) {
        throw new Exception("Database connection failed");
    }

    switch ($step) {
        case 1: saveTeamInfo($conn, $session_id); break;
        case 2: saveTeamMembers($conn, $session_id); break;
        case 3: saveProjectDetails($conn, $session_id); break;
        case 4: finalizeRegistration($conn, $session_id); break;
        default: sendResponse(false, 'Invalid step');
    }

} catch (Exception $e) {
    sendResponse(false, 'An error occurred: ' . $e->getMessage());
}

// Step 1: Save Team Information (strict)
function saveTeamInfo($conn, $session_id) {
    $team_name = clean_text($_POST['team_name'] ?? '', 60);
    $team_size = (int)($_POST['team_size'] ?? 0);
    $institution = clean_text($_POST['institution'] ?? '', 120);
    $challenge_track = clean_text($_POST['challenge_track'] ?? '', 40);

    if ($team_name === '' || $team_size === 0 || $institution === '' || $challenge_track === '') {
        sendResponse(false, 'Please fill in all required fields');
    }

    if (!preg_match('/^[\p{L}\p{N}\s\-_]{3,20}$/u', $team_name)) {
        sendResponse(false, 'Team name must be 3–20 characters (letters, numbers, spaces, - or _).');
    }

    if ($team_size < 3 || $team_size > 5) {
        sendResponse(false, 'Team size must be between 3 and 5 members.');
    }

    $allowedTracks = ['agriculture','cyber_security','iot_xr','healthcare','open_innovation'];
    if (!require_in($challenge_track, $allowedTracks)) {
        sendResponse(false, 'Invalid challenge track.');
    }

    $stmt = $conn->prepare("SELECT id FROM registration_temp WHERE session_id = :session_id");
    $stmt->bindParam(':session_id', $session_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $stmt = $conn->prepare("UPDATE registration_temp SET 
            team_name = :team_name,
            team_size = :team_size,
            institution = :institution,
            challenge_track = :challenge_track,
            updated_at = NOW()
            WHERE session_id = :session_id");
    } else {
        $stmt = $conn->prepare("INSERT INTO registration_temp (
            session_id, team_name, team_size, institution, challenge_track, created_at)
            VALUES (:session_id, :team_name, :team_size, :institution, :challenge_track, NOW())");
    }

    $stmt->bindParam(':session_id', $session_id);
    $stmt->bindParam(':team_name', $team_name);
    $stmt->bindParam(':team_size', $team_size, PDO::PARAM_INT);
    $stmt->bindParam(':institution', $institution);
    $stmt->bindParam(':challenge_track', $challenge_track);
    $stmt->execute();

    sendResponse(true, 'Team information saved', ['session_id' => $session_id]);
}

// Step 2: Save Team Members (all 1..team_size required; 10-digit phones)
function saveTeamMembers($conn, $session_id) {
    $leader_name = clean_text($_POST['leader_name'] ?? '', 80);
    $leader_email = clean_email($_POST['leader_email'] ?? '');
    $leader_phone = clean_phone10($_POST['leader_phone'] ?? '');
    $leader_role = clean_text($_POST['leader_role'] ?? '', 40);

    if ($leader_name === '' || !valid_email($leader_email) || !valid_phone10($leader_phone) || $leader_role === '') {
        sendResponse(false, 'Please provide valid team leader details (name, email, 10-digit phone, role).');
    }

    $conn->beginTransaction();
    try {
        $stmt = $conn->prepare("SELECT id, team_size FROM registration_temp WHERE session_id = :session_id");
        $stmt->bindParam(':session_id', $session_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            sendResponse(false, 'Invalid session. Please start from the beginning.');
        }

        $team_size = (int)$row['team_size'];
        if ($team_size < 3 || $team_size > 5) {
            sendResponse(false, 'Invalid team size for this session.');
        }

        $team_members = [];
        $team_members[] = [
            'name' => $leader_name,
            'email' => $leader_email,
            'phone' => $leader_phone,
            'role' => $leader_role,
            'is_leader' => true
        ];

        for ($i = 2; $i <= $team_size; $i++) {
            $member_name  = clean_text($_POST["member{$i}_name"]  ?? '', 80);
            $member_email = clean_email($_POST["member{$i}_email"] ?? '');
            $member_phone = clean_phone10($_POST["member{$i}_phone"] ?? '');
            $member_role  = clean_text($_POST["member{$i}_role"]  ?? '', 40);

            if ($member_name === '' || !valid_email($member_email) || !valid_phone10($member_phone) || $member_role === '') {
                sendResponse(false, "Please fill valid details for Member {$i} (name, email, 10-digit phone, role).");
            }

            $team_members[] = [
                'name' => $member_name,
                'email' => $member_email,
                'phone' => $member_phone,
                'role' => $member_role,
                'is_leader' => false
            ];
        }

        $members_json = json_encode($team_members, JSON_UNESCAPED_UNICODE);
        $stmt = $conn->prepare("UPDATE registration_temp SET 
            team_members = :team_members,
            updated_at = NOW()
            WHERE session_id = :session_id");
        $stmt->bindParam(':session_id', $session_id);
        $stmt->bindParam(':team_members', $members_json);
        $stmt->execute();

        $conn->commit();
        sendResponse(true, 'Team members saved', ['session_id' => $session_id]);

    } catch (Exception $e) {
        $conn->rollBack();
        throw $e;
    }
}

// Step 3: Save Project Details (sanitize + whitelist)
function saveProjectDetails($conn, $session_id) {
    $project_title = clean_text($_POST['project_title'] ?? '', 120);
    $project_description = clean_text($_POST['project_description'] ?? '', 1000);

    $terms_agree = isset($_POST['terms_agree']) ? 1 : 0;
    $technologies = isset($_POST['technologies']) && is_array($_POST['technologies']) ? $_POST['technologies'] : [];

    if (empty($technologies)) {
        sendResponse(false, 'Please select at least one technology');
    }
    if (!$terms_agree) {
        sendResponse(false, 'You must agree to the terms and conditions');
    }

    $allowedTech = ['react','node','python','firebase','flutter','ai_ml','blockchain','ar_vr','other'];
    $technologies = array_values(array_intersect($technologies, $allowedTech));
    if (empty($technologies)) {
        sendResponse(false, 'Invalid technologies selection.');
    }

    $stmt = $conn->prepare("SELECT id FROM registration_temp WHERE session_id = :session_id");
    $stmt->bindParam(':session_id', $session_id);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        sendResponse(false, 'Invalid session. Please start from the beginning.');
    }

    $technologies_json = json_encode($technologies, JSON_UNESCAPED_UNICODE);

    $stmt = $conn->prepare("UPDATE registration_temp SET 
        project_title = :project_title,
        project_description = :project_description,
        technologies = :technologies,
        terms_agreed = :terms_agreed,
        updated_at = NOW()
        WHERE session_id = :session_id");

    $stmt->bindParam(':session_id', $session_id);
    $stmt->bindParam(':project_title', $project_title);
    $stmt->bindParam(':project_description', $project_description);
    $stmt->bindParam(':technologies', $technologies_json);
    $stmt->bindParam(':terms_agreed', $terms_agree, PDO::PARAM_INT);
    $stmt->execute();

    sendResponse(true, 'Project details saved', ['session_id' => $session_id]);
}

// Step 4: Complete Registration (no payment)
function finalizeRegistration($conn, $session_id) {
    $conn->beginTransaction();

    try {
        $stmt = $conn->prepare("SELECT * FROM registration_temp WHERE session_id = :session_id");
        $stmt->bindParam(':session_id', $session_id);
        $stmt->execute();

        $registration = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$registration) {
            sendResponse(false, 'Invalid session. Please start from the beginning.');
        }

        // Create team as confirmed (no payment needed)
        $stmt = $conn->prepare("INSERT INTO teams 
            (team_name, team_size, institution, challenge_track, registration_status, created_at, updated_at) 
            VALUES 
            (:team_name, :team_size, :institution, :challenge_track, 'confirmed', NOW(), NOW())");

        $stmt->bindParam(':team_name', $registration['team_name']);
        $stmt->bindParam(':team_size', $registration['team_size']);
        $stmt->bindParam(':institution', $registration['institution']);
        $stmt->bindParam(':challenge_track', $registration['challenge_track']);
        $stmt->execute();

        $team_id = $conn->lastInsertId();

        // Members
        $team_members = json_decode($registration['team_members'], true);
        $leader = null;

        if (is_array($team_members)) {
            foreach ($team_members as $member) {
                if (!empty($member['is_leader'])) {
                    $leader = $member;
                }
                $stmt = $conn->prepare("INSERT INTO team_members 
                    (team_id, full_name, email, phone, role, is_leader) 
                    VALUES 
                    (:team_id, :full_name, :email, :phone, :role, :is_leader)");

                $is_leader = !empty($member['is_leader']) ? 1 : 0;
                $stmt->bindParam(':team_id', $team_id);
                $stmt->bindParam(':full_name', $member['name']);
                $stmt->bindParam(':email', $member['email']);
                $stmt->bindParam(':phone', $member['phone']);
                $stmt->bindParam(':role', $member['role']);
                $stmt->bindParam(':is_leader', $is_leader);
                $stmt->execute();
            }
        }

        // Project
        $stmt = $conn->prepare("INSERT INTO projects 
            (team_id, project_title, project_description, technologies, terms_agreed) 
            VALUES 
            (:team_id, :project_title, :project_description, :technologies, :terms_agreed)");

        $stmt->bindParam(':team_id', $team_id);
        $stmt->bindParam(':project_title', $registration['project_title']);
        $stmt->bindParam(':project_description', $registration['project_description']);
        $stmt->bindParam(':technologies', $registration['technologies']);
        $stmt->bindParam(':terms_agreed', $registration['terms_agreed']);
        $stmt->execute();

        // Backward compatibility record
        if ($leader) {
            $stmt = $conn->prepare("INSERT INTO registrations 
                (team_name, team_size, institution, challenge_track, 
                 name, email, phone, role, project_title, project_description, technologies, 
                 payment_status, status, created_at) 
                 VALUES 
                (:team_name, :team_size, :institution, :challenge_track, 
                 :name, :email, :phone, :role, :project_title, :project_description, :technologies, 
                 'not_required', 'confirmed', NOW())");

            $stmt->bindParam(':team_name', $registration['team_name']);
            $stmt->bindParam(':team_size', $registration['team_size']);
            $stmt->bindParam(':institution', $registration['institution']);
            $stmt->bindParam(':challenge_track', $registration['challenge_track']);
            $stmt->bindParam(':name', $leader['name']);
            $stmt->bindParam(':email', $leader['email']);
            $stmt->bindParam(':phone', $leader['phone']);
            $stmt->bindParam(':role', $leader['role']);
            $stmt->bindParam(':project_title', $registration['project_title']);
            $stmt->bindParam(':project_description', $registration['project_description']);
            $stmt->bindParam(':technologies', $registration['technologies']);
            $stmt->execute();
        }

        // Registration code
        $registration_code = 'BV-' . strtoupper(substr(preg_replace('/\s+/', '', $registration['team_name']), 0, 3)) . '-' . $team_id;

        $stmt = $conn->prepare("UPDATE teams SET registration_code = :registration_code WHERE id = :team_id");
        $stmt->bindParam(':registration_code', $registration_code);
        $stmt->bindParam(':team_id', $team_id);
        $stmt->execute();

        // Cleanup temp
        $stmt = $conn->prepare("DELETE FROM registration_temp WHERE session_id = :session_id");
        $stmt->bindParam(':session_id', $session_id);
        $stmt->execute();

        // Send confirmation email (simulated)
        if (!empty($leader['email'])) {
            sendRegistrationEmail($leader['email'], $leader['name'], $registration['team_name'], $team_id, $registration_code);
        }

        $conn->commit();
        sendResponse(true, 'Registration completed successfully!', [
            'team_id' => $team_id,
            'registration_code' => $registration_code
        ]);

    } catch (Exception $e) {
        $conn->rollBack();
        throw $e;
    }
}

// Registration confirmation email (no payment mention)
function sendRegistrationEmail($email, $name, $team_name, $team_id, $registration_code) {
    $subject = "ByteVerse Hackathon – Registration Confirmed";
    $message = "
    <html>
    <head><title>ByteVerse Registration Confirmation</title>
    <style>body { font-family: Arial, sans-serif; }</style></head>
    <body>
        <h1>Welcome, $name!</h1>
        <p>Your team <strong>$team_name</strong> is <strong>successfully registered</strong> for the ByteVerse Hackathon.</p>
        <p>Your registration code is: <strong>$registration_code</strong></p>
        <div style='background-color:#e6ffe6;padding:15px;border-left:4px solid #4CAF50;margin:20px 0;'>
            <h2>You're All Set ✅</h2>
            <p>No payment is required. Watch your inbox for schedule, check-in details, and updates.</p>
        </div>
        <h3>Next Steps</h3>
        <ol>
            <li>Mark the event dates on your calendar</li>
            <li>Join our community Discord for announcements</li>
            <li>Start brainstorming and prepping with your team</li>
        </ol>
        <p>If you have any questions, reply to this email.</p>
        <p>— The ByteVerse Team</p>
    </body>
    </html>";
    // Log instead of send
    error_log("Registration email sent (simulated) to: $email for team: $team_name with code: $registration_code");
}
