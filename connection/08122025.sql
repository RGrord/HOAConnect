-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2025 at 12:34 PM
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
-- Database: `hoa_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `release_date` date DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL,
  `reference_number` varchar(150) DEFAULT NULL,
  `acknowledgement_receipt` longblob DEFAULT NULL,
  `purpose` varchar(255) NOT NULL,
  `approval_notes` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `has_release` tinyint(1) DEFAULT 0,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `court`
--

CREATE TABLE `court` (
  `id` int(11) NOT NULL,
  `renter_name` varchar(100) NOT NULL,
  `contact_no` int(11) DEFAULT NULL,
  `purpose` text NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `no_of_participants` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `court_fees`
--

CREATE TABLE `court_fees` (
  `id` int(11) NOT NULL,
  `court_id` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_remitted` tinyint(4) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_assignments`
--

CREATE TABLE `fee_assignments` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `fee_type_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_type`
--

CREATE TABLE `fee_type` (
  `id` int(11) NOT NULL,
  `fee_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `effectivity_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `is_recurring` tinyint(4) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee_type`
--

INSERT INTO `fee_type` (`id`, `fee_name`, `description`, `amount`, `effectivity_date`, `status`, `is_recurring`, `created_by`, `date_created`, `date_updated`) VALUES
(6, 'Hayes Ford', 'Minus iure nihil eaq', 420, '1997-02-02', 1, 1, '202540617', '2025-11-27', '0000-00-00'),
(7, 'Dale Dennis', 'Neque aliquam eum fu', 63, '2018-04-21', 1, 1, '202540617', '2025-11-27', '0000-00-00'),
(8, 'Vera Beard', 'Odit ut velit minim', 82, '2000-05-20', 3, 1, '202540617', '2025-11-28', '0000-00-00'),
(9, 'Cyrus Kidd', 'Quisquam eos autem v', 49, '1990-07-30', 1, 1, '202540617', '2025-11-29', '0000-00-00'),
(10, 'Cole Crosby', 'Libero sit eos nos', 93, '2014-06-17', 1, 2, '202540617', '2025-11-29', '0000-00-00'),
(11, 'Skyler Gordon', 'Proident est itaque', 1, '2007-06-03', 1, 1, '202540617', '2025-12-07', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `financial_summary`
--

CREATE TABLE `financial_summary` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `file` longblob DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `has_validated` int(11) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoa_info`
--

CREATE TABLE `hoa_info` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `hoa_number` varchar(100) NOT NULL,
  `home_address` varchar(100) NOT NULL,
  `lot` varchar(100) NOT NULL,
  `block` varchar(100) NOT NULL,
  `phase` varchar(100) NOT NULL,
  `village` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoa_info`
--

INSERT INTO `hoa_info` (`id`, `user_id`, `hoa_number`, `home_address`, `lot`, `block`, `phase`, `village`) VALUES
(1, '202540617', '02', 'Excepturi pariatur0', '310', '653', '145', 'Juliet Holland'),
(47, '20252095', '8', 'Amet sapiente disti', 'Est esse provident', 'Duis ut quia excepte', 'Unde deserunt ut quo', 'Mabuhay Homes 2000'),
(49, '20253015', '968', 'Molestiae et autem r', 'Enim amet dolorem v', 'Perspiciatis porro', 'Sit quaerat quia vel', 'Mabuhay Homes 2000'),
(50, '20257378', '117', 'Deleniti expedita no', 'Ad et est minima ips', 'Sint et iure in pers', 'Doloremque eius sint', 'Mabuhay Homes 2000'),
(51, '20253351', '700', 'Facere odio nihil ex', 'Numquam voluptatibus', 'Ad assumenda in est', 'Nostrud at error tot', 'Mabuhay Homes 2000');

-- --------------------------------------------------------

--
-- Table structure for table `homeowner_fees`
--

CREATE TABLE `homeowner_fees` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `amount_paid` decimal(10,0) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `attachment` blob NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `is_remitted` tinyint(4) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `liquidation_expenses_details`
--

CREATE TABLE `liquidation_expenses_details` (
  `id` int(11) NOT NULL,
  `liquidation_id` int(11) NOT NULL,
  `particular` varchar(100) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `total_expenses` int(11) NOT NULL,
  `remaning_budget` int(11) NOT NULL,
  `audit_result` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `liquidation_of_expenses`
--

CREATE TABLE `liquidation_of_expenses` (
  `id` int(11) NOT NULL,
  `project_resolution_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `total_expenses` decimal(10,2) DEFAULT 0.00,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_feed`
--

CREATE TABLE `news_feed` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `post_images` blob NOT NULL,
  `project_file` blob NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_feed`
--

INSERT INTO `news_feed` (`id`, `created_by`, `post_title`, `description`, `post_images`, `project_file`, `date_created`, `date_updated`) VALUES
(8, 0, 'm,athew edited 1231234132412341234', 'Incididunt perferendmsduasdsadhasyd  edited 123123412341234123412341234', 0x313736333931383437325f302e6a7067, 0x313736333931383437325f48454d502d38302d32303235303431362d504d502d313333303036202d207369676e65642e706466, '2025-11-24', '2025-11-24'),
(16, 0, 'Voluptatem Rerum do', '123123', 0x313736353131303132375f7172636f64652d30314b41413532585332443338394d31415639453543414334432e706e67, 0x313736353131303132375f636f6e74726163742e706466, '2025-12-07', '2025-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `fee_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_verification`
--

CREATE TABLE `payment_verification` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `payment_for` varchar(100) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `status` int(11) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remittance`
--

CREATE TABLE `remittance` (
  `id` int(11) NOT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `particular` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `transaction_type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resolution`
--

CREATE TABLE `resolution` (
  `id` int(11) NOT NULL,
  `project_resolution_title` varchar(255) NOT NULL,
  `resolution_summary` text NOT NULL,
  `estimated_budget` int(11) DEFAULT 0,
  `target_start_date` date NOT NULL,
  `target_end_date` date NOT NULL,
  `proposed_by` int(11) NOT NULL,
  `project_proposal_document` longblob DEFAULT NULL,
  `upload_signed_resolution` longblob DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `has_financial_summary` tinyint(1) DEFAULT 0,
  `is_budget_released` tinyint(4) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'President'),
(2, 'Secretary'),
(3, 'Admin'),
(4, 'Treasurer'),
(5, 'Auditor'),
(6, 'Home Owner'),
(7, 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `stalls`
--

CREATE TABLE `stalls` (
  `id` int(11) NOT NULL,
  `stall_no` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `date_created` date DEFAULT NULL,
  `date_updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stalls`
--

INSERT INTO `stalls` (`id`, `stall_no`, `status`, `remarks`, `date_created`, `date_updated`) VALUES
(1, 0, 1, '', NULL, NULL),
(2, 12, 1, 'Veritatis voluptas e', '2025-11-28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stall_renter`
--

CREATE TABLE `stall_renter` (
  `id` int(11) NOT NULL,
  `renter_name` varchar(100) NOT NULL,
  `contact_no` varchar(11) DEFAULT NULL,
  `stall_id` int(11) NOT NULL,
  `rental_duration` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `contract` blob DEFAULT NULL,
  `status` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stall_renter_fees`
--

CREATE TABLE `stall_renter_fees` (
  `id` int(11) NOT NULL,
  `stall_renter_id` int(11) NOT NULL,
  `amount_paid` decimal(10,0) NOT NULL,
  `attachment` blob NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `is_remitted` tinyint(4) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `toda`
--

CREATE TABLE `toda` (
  `id` int(11) NOT NULL,
  `toda_name` varchar(100) NOT NULL,
  `no_of_tricycles` int(11) NOT NULL,
  `representative` varchar(100) NOT NULL,
  `contact_no` varchar(100) DEFAULT NULL,
  `fee_amount` decimal(10,0) NOT NULL,
  `status` int(11) NOT NULL,
  `contract` blob NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `toda_fees`
--

CREATE TABLE `toda_fees` (
  `id` int(11) NOT NULL,
  `toda_id` int(11) NOT NULL,
  `amount_paid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `is_remitted` tinyint(4) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `particulars` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `transaction_type` varchar(100) NOT NULL,
  `name_of_payer` varchar(150) NOT NULL,
  `name_of_receiver` varchar(150) NOT NULL,
  `payment_method` varchar(150) NOT NULL,
  `reference_number` varchar(150) NOT NULL,
  `acknowledgement_receipt` tinyblob NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_first_time` tinyint(4) NOT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_token_expire` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `user_id`, `email_address`, `password`, `is_first_time`, `reset_token`, `reset_token_expire`, `status`, `date_created`, `date_updated`) VALUES
(39, 3, '202540617', 'verovalut@yopmail.com', '$2y$10$SUATxGYafsYqwfoKFbdL0eNBiD6xL.S/Hy3WmAq8CY94lxN3Pd5EG', 0, '', '2025-11-21 19:50:15', 1, '2025-11-05', '2025-11-05'),
(95, 1, '20252095', 'hoa.president@yopmail.com', '$2y$10$6HJXPkNmDY6P/s/uKgaYSOdi6nzWnkdV0fGo1S/PQsVv43qvRBcGi', 0, NULL, NULL, 1, '2025-12-07', '0000-00-00'),
(97, 2, '20253015', 'hoa.secretary@yopmail.com', '$2y$10$Z0frgDW0/r6sQ6rhr3ZYue255H2RMYLduMnO84eu8e9KqMS/PTZN6', 0, NULL, NULL, 1, '2025-12-07', '0000-00-00'),
(98, 4, '20257378', 'hoa.treasurer@yopmail.com', '$2y$10$B/fQj8XbTMNjBF3RvIfW.eFOEIIcA7QXXR3jbsxm0BVYbsH3N.G9G', 0, NULL, NULL, 1, '2025-12-07', '0000-00-00'),
(99, 5, '20253351', 'hoa.auditor@yopmail.com', '$2y$10$2ZTZma5Bg5Gm7qKo8h6lEOwA9nt1b4rAaN378lUmT7SXknYHYdcJe', 0, NULL, NULL, 1, '2025-12-07', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `suffix` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `civil_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `first_name`, `middle_name`, `last_name`, `suffix`, `phone_number`, `date_of_birth`, `citizenship`, `civil_status`) VALUES
(1, '202540617', 'Mechelle', 'Vielka Farrell', 'Palmerioz', 'Veronica Wheeler', '+639917385959', '2025-11-18', 'Deserunt tempora rep', 'Widowed'),
(43, '20252095', 'Martina', 'Sawyer Jefferson', 'Fletcher', 'Ea iure saepe aut et', '09567521753', '2019-08-17', 'Filipino', 'Single'),
(45, '20253015', 'Noel', 'Kibo Scott', 'Leblanc', 'Omnis qui quia volup', '09565555555', '1984-06-18', 'Filipino', 'Single'),
(46, '20257378', 'Dora', 'Zephania Bates', 'Ball', 'Ut magna consectetur', '09565555555', '1980-08-23', 'Filipino', 'Single'),
(47, '20253351', 'Megan', 'Malcolm Myers', 'Mccall', 'Velit iure ipsam pro', '09112223212', '1990-10-28', 'Filipino', 'Single');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `court`
--
ALTER TABLE `court`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `court_fees`
--
ALTER TABLE `court_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `court_id` (`court_id`);

--
-- Indexes for table `fee_assignments`
--
ALTER TABLE `fee_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `fee_type`
--
ALTER TABLE `fee_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `financial_summary`
--
ALTER TABLE `financial_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoa_info`
--
ALTER TABLE `hoa_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `homeowner_fees`
--
ALTER TABLE `homeowner_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `liquidation_expenses_details`
--
ALTER TABLE `liquidation_expenses_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liquidation_of_expenses`
--
ALTER TABLE `liquidation_of_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_feed`
--
ALTER TABLE `news_feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_id` (`fee_id`);

--
-- Indexes for table `payment_verification`
--
ALTER TABLE `payment_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remittance`
--
ALTER TABLE `remittance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `resolution`
--
ALTER TABLE `resolution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stalls`
--
ALTER TABLE `stalls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stall_renter`
--
ALTER TABLE `stall_renter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stall_renter_fees`
--
ALTER TABLE `stall_renter_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stall_renter_id` (`stall_renter_id`);

--
-- Indexes for table `toda`
--
ALTER TABLE `toda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toda_fees`
--
ALTER TABLE `toda_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `toda_id` (`toda_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `court`
--
ALTER TABLE `court`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `court_fees`
--
ALTER TABLE `court_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_assignments`
--
ALTER TABLE `fee_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_type`
--
ALTER TABLE `fee_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `financial_summary`
--
ALTER TABLE `financial_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoa_info`
--
ALTER TABLE `hoa_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `homeowner_fees`
--
ALTER TABLE `homeowner_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `liquidation_expenses_details`
--
ALTER TABLE `liquidation_expenses_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `liquidation_of_expenses`
--
ALTER TABLE `liquidation_of_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_feed`
--
ALTER TABLE `news_feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_verification`
--
ALTER TABLE `payment_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `remittance`
--
ALTER TABLE `remittance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resolution`
--
ALTER TABLE `resolution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stalls`
--
ALTER TABLE `stalls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stall_renter`
--
ALTER TABLE `stall_renter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stall_renter_fees`
--
ALTER TABLE `stall_renter_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `toda`
--
ALTER TABLE `toda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `toda_fees`
--
ALTER TABLE `toda_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hoa_info`
--
ALTER TABLE `hoa_info`
  ADD CONSTRAINT `hoa_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
