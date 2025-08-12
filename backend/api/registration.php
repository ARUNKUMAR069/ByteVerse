<?php
define('SECURE_ACCESS', true);
require_once('index.php');

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, 'Invalid request method');
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

    // Handle data based on step (NO payment steps)
    switch ($step) {
        case 1: // Team Information
            saveTeamInfo($conn, $session_id);
            break;

        case 2: // Team Members
            saveTeamMembers($conn, $session_id);
            break;

        case 3: // Project Details
            saveProjectDetails($conn, $session_id);
            break;

        case 4: // Complete Registration (no payment)
            finalizeRegistration($conn, $session_id);
            break;

        default:
            sendResponse(false, 'Invalid step');
    }

} catch (Exception $e) {
    sendResponse(false, 'An error occurred: ' . $e->getMessage());
}

// Step 1: Save Team Information
function saveTeamInfo($conn, $session_id) {
    $team_name = filter_input(INPUT_POST, 'team_name', FILTER_SANITIZE_STRING);
    $team_size = filter_input(INPUT_POST, 'team_size', FILTER_SANITIZE_NUMBER_INT);
    $institution = filter_input(INPUT_POST, 'institution', FILTER_SANITIZE_STRING);
    $challenge_track = filter_input(INPUT_POST, 'challenge_track', FILTER_SANITIZE_STRING);

    // Validate required fields
    if (empty($team_name) || empty($team_size) || empty($institution) || empty($challenge_track)) {
        sendResponse(false, 'Please fill in all required fields');
    }

    // Check if temporary registration exists
    $stmt = $conn->prepare("SELECT id FROM registration_temp WHERE session_id = :session_id");
    $stmt->bindParam(':session_id', $session_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Update existing record
        $stmt = $conn->prepare("UPDATE registration_temp SET 
                               team_name = :team_name,
                               team_size = :team_size,
                               institution = :institution,
                               challenge_track = :challenge_track,
                               updated_at = NOW()
                               WHERE session_id = :session_id");
    } else {
        // Create new temporary record
        $stmt = $conn->prepare("INSERT INTO registration_temp (
                               session_id, team_name, team_size, institution, challenge_track, created_at)
                               VALUES (:session_id, :team_name, :team_size, :institution, :challenge_track, NOW())");
    }

    $stmt->bindParam(':session_id', $session_id);
    $stmt->bindParam(':team_name', $team_name);
    $stmt->bindParam(':team_size', $team_size);
    $stmt->bindParam(':institution', $institution);
    $stmt->bindParam(':challenge_track', $challenge_track);
    $stmt->execute();

    sendResponse(true, 'Team information saved', ['session_id' => $session_id]);
}

// Step 2: Save Team Members
function saveTeamMembers($conn, $session_id) {
    $leader_name = filter_input(INPUT_POST, 'leader_name', FILTER_SANITIZE_STRING);
    $leader_email = filter_input(INPUT_POST, 'leader_email', FILTER_SANITIZE_EMAIL);
    $leader_phone = filter_input(INPUT_POST, 'leader_phone', FILTER_SANITIZE_STRING);
    $leader_role = filter_input(INPUT_POST, 'leader_role', FILTER_SANITIZE_STRING);

    if (empty($leader_name) || empty($leader_email) || empty($leader_phone) || empty($leader_role)) {
        sendResponse(false, 'Please fill in all team leader details');
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

        // Build members
        $team_members = [];
        $team_members[] = [
            'name' => $leader_name,
            'email' => $leader_email,
            'phone' => $leader_phone,
            'role' => $leader_role,
            'is_leader' => true
        ];

        for ($i = 2; $i <= $team_size; $i++) {
            $member_name = filter_input(INPUT_POST, "member{$i}_name", FILTER_SANITIZE_STRING);
            $member_email = filter_input(INPUT_POST, "member{$i}_email", FILTER_SANITIZE_EMAIL);
            $member_phone = filter_input(INPUT_POST, "member{$i}_phone", FILTER_SANITIZE_STRING);
            $member_role = filter_input(INPUT_POST, "member{$i}_role", FILTER_SANITIZE_STRING);

            if (!empty($member_name) && !empty($member_email)) {
                $team_members[] = [
                    'name' => $member_name,
                    'email' => $member_email,
                    'phone' => $member_phone,
                    'role' => $member_role,
                    'is_leader' => false
                ];
            }
        }

        $members_json = json_encode($team_members);
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

// Step 3: Save Project Details
function saveProjectDetails($conn, $session_id) {
    $project_title = filter_input(INPUT_POST, 'project_title', FILTER_SANITIZE_STRING);
    $project_description = filter_input(INPUT_POST, 'project_description', FILTER_SANITIZE_STRING);
    $terms_agree = isset($_POST['terms_agree']) ? 1 : 0;

    $technologies = [];
    if (isset($_POST['technologies']) && is_array($_POST['technologies'])) {
        $technologies = $_POST['technologies'];
    }

    if (empty($project_title) || empty($project_description) || empty($technologies) || !$terms_agree) {
        sendResponse(false, 'Please fill in all required fields and agree to terms');
    }

    $stmt = $conn->prepare("SELECT id FROM registration_temp WHERE session_id = :session_id");
    $stmt->bindParam(':session_id', $session_id);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        sendResponse(false, 'Invalid session. Please start from the beginning.');
    }

    $technologies_json = json_encode($technologies);
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
    $stmt->bindParam(':terms_agreed', $terms_agree);
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

        // Send confirmation email (no payment text)
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
    <head>
        <title>ByteVerse Registration Confirmation</title>
        <style>body { font-family: Arial, sans-serif; }</style>
    </head>
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
    </html>
    ";

    // TODO: Send using your mailer; for now just log:
    error_log("Registration email sent (simulated) to: $email for team: $team_name with code: $registration_code");
}
?>
