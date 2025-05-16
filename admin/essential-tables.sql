-- ByteVerse Essential Database Tables
-- Created based on contact.php, sponsor.php, registrations.php, and activity-logs.php

-- Contact Messages Table (based on contact.php)
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Registration/Team Table (based on registration.php)
CREATE TABLE IF NOT EXISTS `registrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(100) NOT NULL,
  `team_size` int(11) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `challenge_track` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `project_title` varchar(255) NOT NULL,
  `project_description` text NOT NULL,
  `technologies` text NOT NULL,
  `payment_status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `payment_id` varchar(100) DEFAULT NULL,
  `status` enum('pending','active','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sponsors Table (based on sponsor.php)
CREATE TABLE IF NOT EXISTS `sponsors` (
  `sponsor_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `tier` varchar(50) NOT NULL,
  `contribution` decimal(10,2) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive','pending') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`sponsor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Activity Logs Table (based on activity-logs.php)
CREATE TABLE IF NOT EXISTS `activity_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `activity_type` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert some sample data for testing

-- Sample contact messages
INSERT INTO `contact_messages` (`name`, `email`, `phone`, `message`, `is_read`) VALUES
('John Doe', 'john@example.com', '+1234567890', 'Hello, I\'m interested in sponsoring your event. Please send me more details.', 0),
('Alice Smith', 'alice@example.com', '+9876543210', 'When does the registration close? I want to register my team.', 1),
('Bob Johnson', 'bob@example.com', '+5554443333', 'Is there any accommodation provided for participants from other cities?', 0);

-- Sample registrations
INSERT INTO `registrations` (`team_name`, `team_size`, `institution`, `challenge_track`, `name`, `email`, `phone`, `role`, 
                           `project_title`, `project_description`, `technologies`, `payment_status`, `status`) VALUES
('Binary Beasts', 4, 'Tech University', 'ai_ml', 'John Doe', 'john@example.com', '+1234567890', 'fullstack', 
 'AI Health Assistant', 'An AI-powered health assistant that helps users track their health metrics.', 
 '[\"python\",\"react\",\"ai_ml\"]', 'completed', 'active'),
 
('Cyber Sharks', 3, 'Code Academy', 'blockchain', 'Jane Smith', 'jane@example.com', '+0987654321', 'backend', 
 'Blockchain Voting System', 'A secure voting system built on blockchain technology.', 
 '[\"blockchain\",\"node\",\"react\"]', 'completed', 'active'),
 
('Pixel Pioneers', 5, 'Digital Arts Institute', 'ar_vr', 'Mike Johnson', 'mike@example.com', '+1122334455', 'ui_ux', 
 'AR Campus Navigator', 'An augmented reality app to help students navigate campus.', 
 '[\"unity\",\"ar_vr\",\"flutter\"]', 'pending', 'pending');

-- Sample sponsors
INSERT INTO `sponsors` (`name`, `company`, `logo`, `website`, `tier`, `contribution`, `email`, `phone`, 
                       `description`, `status`) VALUES
('Alex Turner', 'TechCorp', 'techcorp-logo.png', 'https://techcorp.com', 'alpha_partner', 100000.00, 
 'alex@techcorp.com', '+1234567890', 'Leading tech company specializing in AI solutions', 'active'),
 
('Maya Patel', 'Innovate Inc.', 'innovate-logo.png', 'https://innovateinc.com', 'hype_sponsor', 50000.00, 
 'maya@innovateinc.com', '+0987654321', 'Innovation-focused company supporting young talent', 'active'),
 
('Carlos Rodriguez', 'NextGen Systems', 'nextgen-logo.png', 'https://nextgensys.com', 'boost_sponsor', 30000.00, 
 'carlos@nextgensys.com', '+1122334455', 'Next generation computing systems and software', 'pending');

-- Sample activity logs (assuming admin_id 1 exists)
INSERT INTO `activity_logs` (`user_id`, `activity_type`, `description`, `ip_address`) VALUES
(1, 'login', 'Admin login successful', '127.0.0.1'),
(1, 'approve_registration', 'Approved registration ID: 1', '127.0.0.1'),
(1, 'sponsor_approval', 'Approved sponsor ID: 1', '127.0.0.1'),
(1, 'read_message', 'Read message ID: 2', '127.0.0.1');
