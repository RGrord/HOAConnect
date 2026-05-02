-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2025 at 06:00 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
  `renter` varchar(100) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `no_of_participants` int(11) NOT NULL,
  `purpose` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court`
--

INSERT INTO `court` (`id`, `renter`, `contact_no`, `amount`, `date_start`, `date_end`, `no_of_participants`, `purpose`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Magni anim tempor re', '09567524752', 55, '1979-10-28 00:00:00', '1994-01-20 00:00:00', 57, 'Porro quisquam eum q', 0, '2025-11-23', '0000-00-00'),
(2, 'Harum sit incidunt 1', '09999999999', 24, '1975-08-26 00:28:00', '1999-07-17 01:22:00', 47, 'Eligendi consequatur', 0, '2025-11-25', '0000-00-00');

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

--
-- Dumping data for table `fee_assignments`
--

INSERT INTO `fee_assignments` (`id`, `user_id`, `fee_type_id`, `amount`, `due_date`, `status`, `date_created`, `date_updated`) VALUES
(1, '20254014', 6, 420, '2025-12-01', 0, '2025-11-27', '0000-00-00');

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
  `created_by` varchar(100) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee_type`
--

INSERT INTO `fee_type` (`id`, `fee_name`, `description`, `amount`, `effectivity_date`, `status`, `created_by`, `date_created`, `date_updated`) VALUES
(6, 'Hayes Ford', 'Minus iure nihil eaq', 420, '1997-02-02', 1, '202540617', '2025-11-27', '0000-00-00'),
(7, 'Dale Dennis', 'Neque aliquam eum fu', 63, '2018-04-21', 1, '202540617', '2025-11-27', '0000-00-00');

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
(29, '20257506', '996', 'Neque dolores corpor', 'Doloremque enim aute', 'Sit officia tempora', 'Dolor numquam dolor', 'Mabuhay Village'),
(36, '20254014', '567', 'Totam voluptas obcae', 'Ut dolores quis eum', 'Amet consectetur c', 'Consequatur Nobis l', 'Mabuhay Village 2000');

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
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
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
(7, 0, 'In sunt dicta quasi  edited  123', 'Libero quaerat inven edited  1231231232131', 0x313736333931383031365f302e706e67, '', '2025-11-24', '2025-11-24'),
(8, 0, 'm,athew edited 1231234132412341234', 'Incididunt perferendmsduasdsadhasyd  edited 123123412341234123412341234', 0x313736333931383437325f302e6a7067, 0x313736333931383437325f48454d502d38302d32303235303431362d504d502d313333303036202d207369676e65642e706466, '2025-11-24', '2025-11-24');

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
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remittance`
--

CREATE TABLE `remittance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `particular` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `transaction_type` varchar(100) NOT NULL,
  `secretary_name` varchar(110) NOT NULL,
  `is_approved` int(11) NOT NULL,
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
(1, 0, 1, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stall_renter`
--

CREATE TABLE `stall_renter` (
  `id` int(11) NOT NULL,
  `renter_name` varchar(100) NOT NULL,
  `contact_no` int(11) DEFAULT NULL,
  `stall_id` int(11) NOT NULL,
  `rental_duration` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `contract` blob NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
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
  `contact_no` int(11) DEFAULT NULL,
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
  `reset_token` varchar(100) NOT NULL,
  `reset_token_expire` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `user_id`, `email_address`, `password`, `is_first_time`, `reset_token`, `reset_token_expire`, `status`, `date_created`, `date_updated`) VALUES
(39, 3, '202540617', 'verovalut@yopmail.com', '$2y$10$SUATxGYafsYqwfoKFbdL0eNBiD6xL.S/Hy3WmAq8CY94lxN3Pd5EG', 0, '', '2025-11-21 19:50:15', 0, '2025-11-05', '2025-11-05'),
(75, 6, '20257506', 'tapozone@yopmail.com', '$2y$10$Oezg7REVUdZo1YvPi0l1buWPc4SBcPbW/Ig01fh2kRDRz0oLzqJDW', 0, '', NULL, 1, '2025-11-27', '0000-00-00'),
(82, 6, '20254014', 'fumawu@mailinator.com', '$2y$10$WLbW86vxe4Yr9b7GvSPfVeHyT9XmGzxse9Lr64zmy4Y2rPZzZ/YcS', 0, '', NULL, 1, '2025-11-27', '0000-00-00');

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
(25, '20257506', 'Evangeline', 'Preston Grant', 'Erickson', 'A nemo magna porro v', '09565555555', '2022-03-11', 'Filipino', 'Single'),
(32, '20254014', 'Calista', 'Drake Haney', 'Sutton', 'Ea ut pariatur Nisi', '09565555555', '2024-05-29', 'Filipino', 'Single');

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
-- Indexes for table `fee_assignments`
--
ALTER TABLE `fee_assignments`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `stall_renter_fees`
--
ALTER TABLE `stall_renter_fees`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `court`
--
ALTER TABLE `court`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fee_assignments`
--
ALTER TABLE `fee_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fee_type`
--
ALTER TABLE `fee_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `financial_summary`
--
ALTER TABLE `financial_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hoa_info`
--
ALTER TABLE `hoa_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `homeowner_fees`
--
ALTER TABLE `homeowner_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `liquidation_expenses_details`
--
ALTER TABLE `liquidation_expenses_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `liquidation_of_expenses`
--
ALTER TABLE `liquidation_of_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `news_feed`
--
ALTER TABLE `news_feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `resolution`
--
ALTER TABLE `resolution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stalls`
--
ALTER TABLE `stalls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stall_renter_fees`
--
ALTER TABLE `stall_renter_fees`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
