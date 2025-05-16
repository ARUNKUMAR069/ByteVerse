<?php
/**
 * ByteVerse Database Setup
 * 
 * This script creates all necessary tables for the ByteVerse hackathon website and admin panel.
 * Run this script once to initialize the database structure.
 */

// Database credentials
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'byteverse';

// Connect to MySQL server
$conn = new mysqli($db_host, $db_user, $db_password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h1>ByteVerse Database Setup</h1>";
echo "<p>Running database initialization...</p>";

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
if ($conn->query($sql) === TRUE) {
    echo "<p>Database created successfully or already exists.</p>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($db_name);

// Read SQL script file
$sql_file = file_get_contents('database-setup.sql');

// Split SQL script into individual statements
$sql_statements = preg_split('/;\s*$/m', $sql_file);

// Execute each statement
$success_count = 0;
$total_statements = 0;

foreach ($sql_statements as $statement) {
    $statement = trim($statement);
    if (!empty($statement)) {
        $total_statements++;
        if ($conn->query($statement) === TRUE) {
            $success_count++;
        } else {
            echo "<p>Error executing SQL: " . $conn->error . "</p>";
            echo "<pre>" . htmlspecialchars($statement) . "</pre>";
        }
    }
}

echo "<p>Successfully executed $success_count out of $total_statements SQL statements.</p>";

// Insert sample data for testing
echo "<h2>Adding sample data for testing</h2>";

// Sample contact messages
$sample_messages = [
    ['John Doe', 'john@example.com', '+1234567890', 'Hello, I\'m interested in sponsoring your event. Please send me more details.', 0],
    ['Alice Smith', 'alice@example.com', '+9876543210', 'When does the registration close? I want to register my team.', 1],
    ['Bob Johnson', 'bob@example.com', '+5554443333', 'Is there any accommodation provided for participants from other cities?', 0]
];

$message_stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, message, is_read) VALUES (?, ?, ?, ?, ?)");

foreach ($sample_messages as $message) {
    $message_stmt->bind_param("ssssi", $message[0], $message[1], $message[2], $message[3], $message[4]);
    $message_stmt->execute();
}

echo "<p>Added sample contact messages.</p>";

// Sample registrations
$sample_registrations = [
    ['Tech Titans', 4, 'MIT University', 'ai_ml', 'Sarah Johnson', 'sarah@example.com', '+1122334455', 'fullstack', 
     'AI-Powered Health Assistant', 'An AI assistant that helps users track and manage their health metrics.', 
     '["python","react","tensorflow"]', 'completed', 'rzp_pay_123456', 'active'],
    ['Code Crusaders', 3, 'Tech Institute', 'blockchain', 'Michael Brown', 'michael@example.com', '+9988776655', 'backend', 
     'Secure Voting System', 'A blockchain-based voting system for transparent elections.', 
     '["solidity","node","react"]', 'completed', 'rzp_pay_789012', 'active'],
    ['Innovate Squad', 5, 'Design College', 'ar_vr', 'Emma Davis', 'emma@example.com', '+5566778899', 'ui_ux', 
     'Virtual Campus Tour', 'An AR/VR application for virtual campus tours.', 
     '["unity","ar_kit","blender"]', 'pending', NULL, 'pending']
];

$registration_stmt = $conn->prepare("INSERT INTO registrations (team_name, team_size, institution, challenge_track, name, email, phone, role, 
                                    project_title, project_description, technologies, payment_status, payment_id, status) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

foreach ($sample_registrations as $reg) {
    $technologies_json = json_encode(json_decode($reg[10]));
    $registration_stmt->bind_param("sissssssssssss", $reg[0], $reg[1], $reg[2], $reg[3], $reg[4], $reg[5], $reg[6], $reg[7], 
                                 $reg[8], $reg[9], $technologies_json, $reg[11], $reg[12], $reg[13]);
    $registration_stmt->execute();
}

echo "<p>Added sample registrations.</p>";

// Sample sponsors
$sample_sponsors = [
    ['Jane Wilson', 'TechCorp Inc.', 'techcorp-logo.png', 'https://techcorp.com', 'alpha_partner', 100000.00, 
     'jane@techcorp.com', '+1234567890', 'TechCorp is a leading technology company.', 'active'],
    ['Mark Stevens', 'Innovate Labs', 'innovate-logo.png', 'https://innovatelabs.co', 'hype_sponsor', 50000.00, 
     'mark@innovatelabs.co', '+9876543210', 'Innovate Labs focuses on cutting-edge research.', 'active'],
    ['Alex Johnson', 'DevWorks', 'devworks-logo.png', 'https://devworks.io', 'boost_sponsor', 30000.00, 
     'alex@devworks.io', '+1122334455', 'Supporting developers worldwide.', 'pending']
];

$sponsor_stmt = $conn->prepare("INSERT INTO sponsors (name, company, logo, website, tier, contribution, email, phone, description, status) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

foreach ($sample_sponsors as $sponsor) {
    $sponsor_stmt->bind_param("sssssdssss", $sponsor[0], $sponsor[1], $sponsor[2], $sponsor[3], $sponsor[4], $sponsor[5], 
                            $sponsor[6], $sponsor[7], $sponsor[8], $sponsor[9]);
    $sponsor_stmt->execute();
}

echo "<p>Added sample sponsors.</p>";

// Sample FAQs
$sample_faqs = [
    ['What is ByteVerse?', 'ByteVerse is a 48-hour hackathon where participants collaborate to build innovative projects.', 'general', 1],
    ['How many members can be in a team?', 'Teams can have 3-5 members.', 'registration', 2],
    ['Is there a registration fee?', 'Yes, there is a registration fee of ₹500 per team.', 'registration', 3],
    ['Will food be provided?', 'Yes, meals will be provided throughout the event.', 'logistics', 4],
    ['What should I bring?', 'Bring your laptop, charger, and any hardware you plan to use.', 'logistics', 5]
];

$faq_stmt = $conn->prepare("INSERT INTO faqs (question, answer, category, display_order) VALUES (?, ?, ?, ?)");

foreach ($sample_faqs as $faq) {
    $faq_stmt->bind_param("sssi", $faq[0], $faq[1], $faq[2], $faq[3]);
    $faq_stmt->execute();
}

echo "<p>Added sample FAQs.</p>";

// Sample activity logs
$sample_logs = [
    [1, 'login', 'Admin login successful', '127.0.0.1'],
    [1, 'approve_registration', 'Approved registration ID: 1', '127.0.0.1'],
    [1, 'sponsor_approval', 'Approved sponsor ID: 1', '127.0.0.1'],
    [1, 'read_message', 'Read message ID: 2', '127.0.0.1'],
    [1, 'settings_update', 'Updated general settings', '127.0.0.1']
];

$log_stmt = $conn->prepare("INSERT INTO activity_logs (user_id, activity_type, description, ip_address) VALUES (?, ?, ?, ?)");

foreach ($sample_logs as $log) {
    $log_stmt->bind_param("isss", $log[0], $log[1], $log[2], $log[3]);
    $log_stmt->execute();
}

echo "<p>Added sample activity logs.</p>";

// Close connection
$conn->close();

echo "<h2>Database setup complete!</h2>";
echo "<p>The ByteVerse database has been successfully set up with sample data.</p>";
echo "<p><a href='dashboard.php'>Go to Admin Dashboard</a></p>";
?>
