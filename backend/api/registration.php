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

    // Handle data based on step
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
        
        case 4: // Complete Registration (without payment)
            finalizeRegistration($conn, $session_id);
            break;
            
        case 5: // Process Payment
            processPayment($conn, $team_id);
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
    
    // Validate required fields
    if (empty($leader_name) || empty($leader_email) || empty($leader_phone) || empty($leader_role)) {
        sendResponse(false, 'Please fill in all team leader details');
    }
    
    // Start transaction
    $conn->beginTransaction();
    
    try {
        // Check if this step was previously saved
        $stmt = $conn->prepare("SELECT id FROM registration_temp WHERE session_id = :session_id");
        $stmt->bindParam(':session_id', $session_id);
        $stmt->execute();
        
        if ($stmt->rowCount() === 0) {
            sendResponse(false, 'Invalid session. Please start from the beginning.');
        }
        
        // Create team members array
        $team_members = [];
        $team_members[] = [
            'name' => $leader_name,
            'email' => $leader_email,
            'phone' => $leader_phone,
            'role' => $leader_role,
            'is_leader' => true
        ];
        
        // Get team size from step 1
        $stmt = $conn->prepare("SELECT team_size FROM registration_temp WHERE session_id = :session_id");
        $stmt->bindParam(':session_id', $session_id);
        $stmt->execute();
        $team_size = $stmt->fetchColumn();
        
        // Process additional members
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
        
        // Save to database
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
    
    // Get technologies
    $technologies = [];
    if (isset($_POST['technologies']) && is_array($_POST['technologies'])) {
        $technologies = $_POST['technologies'];
    }
    
    // Validate required fields
    if (empty($project_title) || empty($project_description) || empty($technologies) || !$terms_agree) {
        sendResponse(false, 'Please fill in all required fields and agree to terms');
    }
    
    try {
        // Check if this session exists
        $stmt = $conn->prepare("SELECT id FROM registration_temp WHERE session_id = :session_id");
        $stmt->bindParam(':session_id', $session_id);
        $stmt->execute();
        
        if ($stmt->rowCount() === 0) {
            sendResponse(false, 'Invalid session. Please start from the beginning.');
        }
        
        // Save project details
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
        
    } catch (Exception $e) {
        throw $e;
    }
}

// Step 4: Complete Registration (without payment verification)
function finalizeRegistration($conn, $session_id) {
    $conn->beginTransaction();
    
    try {
        // Get all registration data
        $stmt = $conn->prepare("SELECT * FROM registration_temp WHERE session_id = :session_id");
        $stmt->bindParam(':session_id', $session_id);
        $stmt->execute();
        
        $registration = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$registration) {
            sendResponse(false, 'Invalid session. Please start from the beginning.');
        }
        
        // Insert into teams table with 'pending_payment' status
        $stmt = $conn->prepare("INSERT INTO teams (team_name, team_size, institution, challenge_track, registration_status, created_at, updated_at) 
                               VALUES (:team_name, :team_size, :institution, :challenge_track, 'pending_payment', NOW(), NOW())");
        
        $stmt->bindParam(':team_name', $registration['team_name']);
        $stmt->bindParam(':team_size', $registration['team_size']);
        $stmt->bindParam(':institution', $registration['institution']);
        $stmt->bindParam(':challenge_track', $registration['challenge_track']);
        $stmt->execute();
        
        $team_id = $conn->lastInsertId();
        
        // Insert team members
        $team_members = json_decode($registration['team_members'], true);
        $leader = null;
        
        foreach ($team_members as $member) {
            if ($member['is_leader']) {
                $leader = $member;
            }
            
            $stmt = $conn->prepare("INSERT INTO team_members (team_id, full_name, email, phone, role, is_leader) 
                                   VALUES (:team_id, :full_name, :email, :phone, :role, :is_leader)");
            
            $is_leader = $member['is_leader'] ? 1 : 0;
            
            $stmt->bindParam(':team_id', $team_id);
            $stmt->bindParam(':full_name', $member['name']);
            $stmt->bindParam(':email', $member['email']);
            $stmt->bindParam(':phone', $member['phone']);
            $stmt->bindParam(':role', $member['role']);
            $stmt->bindParam(':is_leader', $is_leader);
            $stmt->execute();
        }
        
        // Insert project details
        $stmt = $conn->prepare("INSERT INTO projects (team_id, project_title, project_description, technologies, terms_agreed) 
                               VALUES (:team_id, :project_title, :project_description, :technologies, :terms_agreed)");
        
        $stmt->bindParam(':team_id', $team_id);
        $stmt->bindParam(':project_title', $registration['project_title']);
        $stmt->bindParam(':project_description', $registration['project_description']);
        $stmt->bindParam(':technologies', $registration['technologies']);
        $stmt->bindParam(':terms_agreed', $registration['terms_agreed']);
        $stmt->execute();
        
        // Create payment record with pending status
        $stmt = $conn->prepare("INSERT INTO payments (team_id, payment_status, amount, created_at) 
                               VALUES (:team_id, 'pending', 500.00, NOW())");
        
        $stmt->bindParam(':team_id', $team_id);
        $stmt->execute();
        
        // Also create a record in registrations table for backward compatibility
        if ($leader) {
            $stmt = $conn->prepare("INSERT INTO registrations (team_name, team_size, institution, challenge_track, 
                                   name, email, phone, role, project_title, project_description, technologies, 
                                   payment_status, status, created_at) 
                                   VALUES (:team_name, :team_size, :institution, :challenge_track, 
                                   :name, :email, :phone, :role, :project_title, :project_description, :technologies, 
                                   'pending', 'pending_payment', NOW())");
            
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
        
        // Generate a unique registration number
        $registration_code = 'BV-' . strtoupper(substr($registration['team_name'], 0, 3)) . '-' . $team_id;
        
        // Update the team with the registration code
        $stmt = $conn->prepare("UPDATE teams SET registration_code = :registration_code WHERE id = :team_id");
        $stmt->bindParam(':registration_code', $registration_code);
        $stmt->bindParam(':team_id', $team_id);
        $stmt->execute();
        
        // Delete temporary record
        $stmt = $conn->prepare("DELETE FROM registration_temp WHERE session_id = :session_id");
        $stmt->bindParam(':session_id', $session_id);
        $stmt->execute();
        
        // Send registration confirmation email with payment instructions
        sendRegistrationEmail($leader['email'], $leader['name'], $registration['team_name'], $team_id, $registration_code);
        
        $conn->commit();
        sendResponse(true, 'Registration completed successfully! Please proceed to payment to confirm your seat.', [
            'team_id' => $team_id,
            'registration_code' => $registration_code
        ]);
        
    } catch (Exception $e) {
        $conn->rollBack();
        throw $e;
    }
}

// Step 5: Process Payment
function processPayment($conn, $team_id) {
    $payment_id = filter_input(INPUT_POST, 'payment_id', FILTER_SANITIZE_STRING);
    $payment_method = filter_input(INPUT_POST, 'payment_method', FILTER_SANITIZE_STRING);
    
    if (empty($team_id) || empty($payment_id)) {
        sendResponse(false, 'Missing required payment information');
    }
    
    $conn->beginTransaction();
    
    try {
        // Check if team exists
        $stmt = $conn->prepare("SELECT t.*, tm.full_name, tm.email FROM teams t 
                              JOIN team_members tm ON t.id = tm.team_id 
                              WHERE t.id = :team_id AND tm.is_leader = 1");
        $stmt->bindParam(':team_id', $team_id);
        $stmt->execute();
        
        $team = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$team) {
            sendResponse(false, 'Invalid team ID');
        }
        
        // Update payment status in payments table
        $stmt = $conn->prepare("UPDATE payments SET 
                               payment_id = :payment_id,
                               payment_method = :payment_method,
                               payment_status = 'completed',
                               payment_date = NOW()
                               WHERE team_id = :team_id");
        
        $stmt->bindParam(':team_id', $team_id);
        $stmt->bindParam(':payment_id', $payment_id);
        $stmt->bindParam(':payment_method', $payment_method);
        $stmt->execute();
        
        // Update team registration status
        $stmt = $conn->prepare("UPDATE teams SET 
                              registration_status = 'confirmed',
                              updated_at = NOW()
                              WHERE id = :team_id");
        
        $stmt->bindParam(':team_id', $team_id);
        $stmt->execute();
        
        // Update registration status in the registrations table (for backward compatibility)
        $stmt = $conn->prepare("UPDATE registrations SET 
                              payment_status = 'completed',
                              status = 'confirmed'
                              WHERE team_name = :team_name AND name = :name");
        
        $stmt->bindParam(':team_name', $team['team_name']);
        $stmt->bindParam(':name', $team['full_name']);
        $stmt->execute();
        
        // Send payment confirmation email
        sendPaymentConfirmationEmail($team['email'], $team['full_name'], $team['team_name'], $team_id, $team['registration_code']);
        
        $conn->commit();
        sendResponse(true, 'Payment processed successfully! Your participation is now confirmed.', [
            'team_id' => $team_id,
            'registration_code' => $team['registration_code']
        ]);
        
    } catch (Exception $e) {
        $conn->rollBack();
        throw $e;
    }
}

// Function to send registration confirmation email
function sendRegistrationEmail($email, $name, $team_name, $team_id, $registration_code) {
    $subject = "ByteVerse Hackathon Registration Confirmation";
    
    $message = "
    <html>
    <head>
        <title>ByteVerse Registration Confirmation</title>
        <style>
            body { font-family: Arial, sans-serif; }
        </style>
    </head>
    <body>
        <h1>Congratulations, $name!</h1>
        <p>Your team <strong>$team_name</strong> has successfully registered for the ByteVerse Hackathon.</p>
        <p>Your registration code is: <strong>$registration_code</strong></p>
        
        <div style='background-color: #ffffcc; padding: 15px; border-left: 4px solid #ffcc00; margin: 20px 0;'>
            <h2>Important: Complete Your Registration</h2>
            <p>To confirm your seat, please complete the payment of ₹500 per team member. Your registration is <strong>not confirmed</strong> until payment is received.</p>
            <p>The registration fee includes:</p>
            <ul>
                <li>3 meals during the event</li>
                <li>Access to all workshops</li>
                <li>Participation in games and activities</li>
                <li>DJ night event entry</li>
                <li>Official event merchandise</li>
            </ul>
            
            <p><a href='https://yourdomain.com/payment?team_id=$team_id&code=$registration_code' style='background-color: #4CAF50; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;'>Make Payment Now</a></p>
        </div>
        
        <p>If you have any questions, please contact our support team at support@byteverse.com.</p>
        
        <p>We look forward to seeing your amazing project at ByteVerse Hackathon!</p>
        
        <p>Best regards,<br>The ByteVerse Team</p>
    </body>
    </html>
    ";
    
    // Send email logic here (using mail() or a proper email library)
    // For now, just logging that we would send the email
    error_log("Registration email would be sent to: $email for team: $team_name with code: $registration_code");
}

// Function to send payment confirmation email
function sendPaymentConfirmationEmail($email, $name, $team_name, $team_id, $registration_code) {
    $subject = "ByteVerse Hackathon Payment Confirmation";
    
    $message = "
    <html>
    <head>
        <title>ByteVerse Payment Confirmation</title>
        <style>
            body { font-family: Arial, sans-serif; }
        </style>
    </head>
    <body>
        <h1>Payment Confirmed, $name!</h1>
        <p>Great news! We've received your payment for team <strong>$team_name</strong>.</p>
        
        <div style='background-color: #e6ffe6; padding: 15px; border-left: 4px solid #4CAF50; margin: 20px 0;'>
            <h2>Registration Complete!</h2>
            <p>Your team's participation in ByteVerse Hackathon is now officially confirmed.</p>
            <p>Your registration code is: <strong>$registration_code</strong></p>
            <p>Please keep this code handy as you'll need it during check-in at the event.</p>
        </div>
        
        <h3>What's Included in Your Registration:</h3>
        <ul>
            <li>3 meals per day during the event</li>
            <li>Access to all technical workshops</li>
            <li>Participation in fun games and activities</li>
            <li>DJ night event entry</li>
            <li>Official event merchandise</li>
        </ul>
        
        <h3>Next Steps:</h3>
        <ol>
            <li>Mark your calendar for the event dates</li>
            <li>Join our Discord community: <a href='https://discord.gg/byteverse'>discord.gg/byteverse</a></li>
            <li>Start brainstorming project ideas with your team</li>
            <li>Check your email regularly for important updates</li>
        </ol>
        
        <p>If you have any questions, please contact our support team at support@byteverse.com.</p>
        
        <p>We can't wait to see your amazing project at ByteVerse Hackathon!</p>
        
        <p>Best regards,<br>The ByteVerse Team</p>
    </body>
    </html>
    ";
    
    // Send email logic here (using mail() or a proper email library)
    // For now, just logging that we would send the email
    error_log("Payment confirmation email would be sent to: $email for team: $team_name with code: $registration_code");
}
?>