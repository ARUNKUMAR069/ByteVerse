-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2025 at 10:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `byteverse`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_type` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`log_id`, `user_id`, `activity_type`, `description`, `ip_address`, `created_at`) VALUES
(1, 1, 'login', 'Admin login successful', '127.0.0.1', '2025-05-16 07:34:36'),
(2, 1, 'approve_registration', 'Approved registration ID: 1', '127.0.0.1', '2025-05-16 07:34:36'),
(3, 1, 'sponsor_approval', 'Approved sponsor ID: 1', '127.0.0.1', '2025-05-16 07:34:36'),
(4, 1, 'read_message', 'Read message ID: 2', '127.0.0.1', '2025-05-16 07:34:36'),
(5, 1, 'bulk_mark_read', 'Marked 1 messages as read', '::1', '2025-05-16 07:37:21'),
(6, 1, 'approve_registration', 'Approved registration ID: 3', '::1', '2025-05-16 07:43:23'),
(7, 1, 'bulk_approve', 'Approved 3 registrations', '::1', '2025-05-16 07:45:12'),
(8, 1, 'bulk_mark_read', 'Marked 1 messages as read', '::1', '2025-05-16 07:46:07'),
(9, 1, 'create_sponsor', 'Created new sponsor with ID: 4', '::1', '2025-05-16 08:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_fullname` varchar(100) NOT NULL,
  `admin_role` enum('admin','manager','editor') NOT NULL DEFAULT 'editor',
  `admin_status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_id`, `admin_username`, `admin_password`, `admin_email`, `admin_fullname`, `admin_role`, `admin_status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$.JydqNEFoxLSj5tmd02dGO4GJO5DvaCgmjyYcyqB915lu.fo2/sjG', 'admin@byteverse.org', 'System Administrator', 'admin', 'active', NULL, '2025-05-16 13:06:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `message_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`message_id`, `name`, `email`, `phone`, `message`, `is_read`, `created_at`) VALUES
(1, 'John Doe', 'john@example.com', '+1234567890', 'Hello, I\'m interested in sponsoring your event. Please send me more details.', 1, '2025-05-16 07:34:36'),
(2, 'Alice Smith', 'alice@example.com', '+9876543210', 'When does the registration close? I want to register my team.', 1, '2025-05-16 07:34:36'),
(3, 'Bob Johnson', 'bob@example.com', '+5554443333', 'Is there any accommodation provided for participants from other cities?', 1, '2025-05-16 07:34:36');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `team_name`, `team_size`, `institution`, `challenge_track`, `name`, `email`, `phone`, `role`, `project_title`, `project_description`, `technologies`, `payment_status`, `payment_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Binary Beasts', 4, 'Tech University', 'ai_ml', 'John Doe', 'john@example.com', '+1234567890', 'fullstack', 'AI Health Assistant', 'An AI-powered health assistant that helps users track their health metrics.', '[\"python\",\"react\",\"ai_ml\"]', 'completed', NULL, 'active', '2025-05-16 07:34:36', NULL),
(2, 'Cyber Sharks', 3, 'Code Academy', 'blockchain', 'Jane Smith', 'jane@example.com', '+0987654321', 'backend', 'Blockchain Voting System', 'A secure voting system built on blockchain technology.', '[\"blockchain\",\"node\",\"react\"]', 'completed', NULL, 'active', '2025-05-16 07:34:36', NULL),
(3, 'Pixel Pioneers', 5, 'Digital Arts Institute', 'ar_vr', 'Mike Johnson', 'mike@example.com', '+1122334455', 'ui_ux', 'AR Campus Navigator', 'An augmented reality app to help students navigate campus.', '[\"unity\",\"ar_vr\",\"flutter\"]', 'pending', NULL, 'active', '2025-05-16 07:34:36', '2025-05-16 07:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `sponsor_id` int(11) NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`sponsor_id`, `name`, `company`, `logo`, `website`, `tier`, `contribution`, `email`, `phone`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Alex Turner', 'TechCorp', 'techcorp-logo.png', 'https://techcorp.com', 'alpha_partner', 100000.00, 'alex@techcorp.com', '+1234567890', 'Leading tech company specializing in AI solutions', 'active', '2025-05-16 07:34:36', NULL),
(2, 'Maya Patel', 'Innovate Inc.', 'innovate-logo.png', 'https://innovateinc.com', 'hype_sponsor', 50000.00, 'maya@innovateinc.com', '+0987654321', 'Innovation-focused company supporting young talent', 'active', '2025-05-16 07:34:36', NULL),
(3, 'Carlos Rodriguez', 'NextGen Systems', 'nextgen-logo.png', 'https://nextgensys.com', 'boost_sponsor', 30000.00, 'carlos@nextgensys.com', '+1122334455', 'Next generation computing systems and software', 'pending', '2025-05-16 07:34:36', NULL),
(4, 'dfefref', 'dwygdy', 'dwygdy-1747383117.jpg', 'https://madhavarora1213.github.io/CodSoft-Task3/', 'hype_sponsor', 20000.00, 'aroradiksha341@gmail.com', '8707773540', 'fefefefe', 'active', '2025-05-16 08:11:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `team_size` int(11) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `challenge_track` varchar(50) NOT NULL,
  `registration_status` enum('pending','active','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `is_leader` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `project_title` varchar(255) NOT NULL,
  `project_description` text NOT NULL,
  `technologies` text NOT NULL,
  `terms_agreed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `payment_id` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed','refunded') NOT NULL DEFAULT 'pending',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_username` (`admin_username`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`sponsor_id`),
  ADD INDEX `idx_sponsors_status` (`status`),
  ADD INDEX `idx_sponsors_tier` (`tier`),
  ADD INDEX `idx_sponsors_created` (`created_at`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_name` (`team_name`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_team` (`email`,`team_id`),
  ADD KEY `team_members_ibfk_1` (`team_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_id` (`team_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_id` (`payment_id`),
  ADD UNIQUE KEY `team_id` (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `sponsor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `team_members_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Migration queries to populate new tables from existing data
--

-- Insert teams data from registrations
INSERT INTO `teams` (`id`, `team_name`, `team_size`, `institution`, `challenge_track`, `registration_status`, `created_at`, `updated_at`)
SELECT `id`, `team_name`, `team_size`, `institution`, `challenge_track`, `status`, `created_at`, `updated_at`
FROM `registrations`;

-- Insert team leaders
INSERT INTO `team_members` (`team_id`, `full_name`, `email`, `phone`, `role`, `is_leader`)
SELECT `id`, `name`, `email`, `phone`, `role`, 1
FROM `registrations`;

-- Insert project data
INSERT INTO `projects` (`team_id`, `project_title`, `project_description`, `technologies`, `terms_agreed`)
SELECT `id`, `project_title`, `project_description`, `technologies`, 1
FROM `registrations`;

-- Insert payment data
INSERT INTO `payments` (`team_id`, `payment_id`, `amount`, `payment_status`, `payment_date`)
SELECT `id`, COALESCE(`payment_id`, CONCAT('REG', `id`)), 500.00, 
CASE `payment_status` 
  WHEN 'pending' THEN 'pending'
  WHEN 'completed' THEN 'completed'
  WHEN 'failed' THEN 'failed'
  ELSE 'pending'
END, 
`created_at`
FROM `registrations`;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;