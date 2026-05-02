-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2025 at 08:13 PM
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

--
-- Dumping data for table `court`
--

INSERT INTO `court` (`id`, `renter_name`, `contact_no`, `purpose`, `amount`, `start_date`, `end_date`, `no_of_participants`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Clementine Carver', 2147483647, 'Quas consectetur nu', 60, '2013-01-10 00:59:00', '2010-01-24 10:11:00', 98, 0, '2025-11-28', '2025-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `court_fees`
--

CREATE TABLE `court_fees` (
  `id` int(11) NOT NULL,
  `court_id` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `attachment` blob NOT NULL,
  `status` int(11) NOT NULL,
  `is_remitted` tinyint(4) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court_fees`
--

INSERT INTO `court_fees` (`id`, `court_id`, `amount_paid`, `attachment`, `status`, `is_remitted`, `date_created`, `date_updated`) VALUES
(1, 1, 60, 0x75706c6f6164732f6174746163686d656e74732f636f7572745f315f7061796d656e745f313736343239373239315f4d41544348494e472e706466, 1, 0, '2025-11-28', '0000-00-00'),
(2, 1, 60, 0x75706c6f6164732f6174746163686d656e74732f636f7572745f315f7061796d656e745f313736343239373331325f4d41544348494e472e706466, 1, 0, '2025-11-28', '0000-00-00'),
(3, 1, 60, 0x75706c6f6164732f6174746163686d656e74732f636f7572745f315f7061796d656e745f313736343239373333385f4d41544348494e472e706466, 1, 0, '2025-11-28', '0000-00-00'),
(4, 1, 60, 0x75706c6f6164732f6174746163686d656e74732f636f7572745f315f7061796d656e745f313736343239393935345f4d41544348494e472e706466, 1, 0, '2025-11-28', '0000-00-00');

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
(3, '20258632', 6, 420, '2025-12-01', 1, '2025-11-28', '0000-00-00'),
(4, '20258632', 7, 63, '2025-12-01', 1, '2025-11-28', '0000-00-00'),
(5, '20259017', 6, 420, '2025-12-01', 1, '2025-11-28', '0000-00-00'),
(6, '20259017', 7, 63, '2025-12-01', 1, '2025-11-28', '0000-00-00');

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
(7, 'Dale Dennis', 'Neque aliquam eum fu', 63, '2018-04-21', 1, '202540617', '2025-11-27', '0000-00-00'),
(8, 'Vera Beard', 'Odit ut velit minim', 82, '2000-05-20', 0, '202540617', '2025-11-28', '0000-00-00');

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

--
-- Dumping data for table `financial_summary`
--

INSERT INTO `financial_summary` (`id`, `project_id`, `file`, `created_by`, `has_validated`, `date_created`, `date_updated`) VALUES
(3, 23, 0x255044462d312e370a25e2e3cfd30a362030206f626a0a3c3c0a2f46696c746572202f466c6174654465636f64650a2f4c656e677468203133310a3e3e0a73747265616d0a789c01780087ffffffff40c4ff01579b03a9f408499436c2ffbde9ffd9f3ff2dc0ff60ccffcfdeeb00a6f4f8fdff67ceff004f9700adf9a8e2ff79d4ffaac1d994d5f9158fd5004c9600388d3eb7f60c438e00a2f302559a4278ad42c0fb97acccf5f9fc467baeb4e6ff93dcff83d7ffc8ecff4ab3e99db3d042a4dd003c8f32554c390a656e6473747265616d0a656e646f626a0a352030206f626a0a5b2f496e6465786564202f4465766963655247422033392036203020525d0a656e646f626a0a342030206f626a0a3c3c0a2f54797065202f584f626a6563740a2f53756274797065202f496d6167650a2f5769647468203232350a2f486569676874203232350a2f42697473506572436f6d706f6e656e7420380a2f436f6c6f7253706163652035203020520a2f46696c746572202f466c6174654465636f64650a2f4c656e677468203931360a3e3e0a73747265616d0a789ced9d6d5313411084572e68d0005108226ac0f7ffff0fbd5c5e3892d9bddda91c3b3de9e7ab55d43ed5ddcc7da0ca1008218410420821841042b299bd5352fbe199cc2ea73a9e6abf3c93cbf3371aa66f6b3f3c13e77e33fa899c83f8850be7f979f7e3fe44b83f1b707fd87eeefbe93c3ffac9f03ed880f7817ea671eec7fdc9f03ed8c0fbef17fac9707f36e07dc0f6f3fefde2dd8ffb93e17db001fb799a7edc9f0db83f6c3feffd74ff7d463f11de071bf03e9ca61fccfebce7c7fd89c0f493f9d1cf30dc1f787edefd9cefcffbf78b773fee4f86f7c106ece769fa717f36e0feb0fdbcf7d3fdf719fd44781f6cc0fb709a7e30fbf39e1ff72702d34fe647bf63bde5f83f729cfdcd2f74fc1841708cfdcda7ba9ff9f1f87aa3dc07a5dff9187e63eccf527e86fcc6c86f94ef33437edc5fe42d20fbf37e1fc24fe55b40fa1994bf6160f20bba0d8eb1bf91f2531922e5d7516808b43f95215c7ea1aca580f9151962fa85ec96c2fa656608f37da63444fcfdd263d010b79f1b060cc1f30b432dc5fa3e934919e2e7d711354cfadd7cf9a6f17bedfc3a2286c97ede7c681a856185fc42aca5e9fc5abfa601f1930d07fad974146658a59f6b0e0cb3fc0a0d2bfa1d6438b83f85614dbf7dc38cfd151bd6dadf8e9e61663fd740e4d7b1332cc82f3bc3eaf985e79616fa65191ac82f6c0d8bfd325a6ac32f742d2dda5f668666fc56ff6b52797e838616f6b765f92bf18f71bf644b2df92589f57320433bfd1c20ed1735c4f14bf43361e8c84f3474b2bfa8a1abfc04439cfc32fdf60cdde5b76788e397b5bf03431cbf82fc7a860ef7b705ccafa89fbb0c71faa9f05b19a2f8cd557ecdf5efda0fcf65f9b978812bbfdbbb3fb55f9e8dc2f0faf67e72f7bdf6c37399151baefc268e0dd77e7e0db77eada1cb1d3efbf9ccb0efe7d1f0a59f3fc37d3f6f86877ebe0c253f4f86b29f9f6b11f3f39261dc0f29c3b861c26f71f5b0f854fbe5b9c40ca37e8babb315131843798711bf8d1d96a194a1e8d736f3ac07724b05bf5e76f8191ef809762d0fa8867b7e7bcdc46fe90bbf841daa61cf4f6e26e80eb7d762e7976187b8c38ddf4033715bdaf9e56507d8d2d6b0f52bb3c3320c7fefb39bd907a7a5cbc7f2fcc00cbfea0c815aaa3344ba16ca0c815aea7e87da0c715aaadc2190e1cc7d4bfd5f0bee3006504bb9c308ee5bcaaf3643f8df21af05bea1ff96fabf16ca1df25a1862f918ff6b8414ff60fe5261f95e49ed87134208218410420821e415f80f2fd181e70a656e6473747265616d0a656e646f626a0a372030206f626a0a3c3c0a2f46696c746572202f466c6174654465636f64650a2f4c656e6774682033360a3e3e0a73747265616d0a789c2be432b53455300042086d6864ac67aa909ccba51f61a0e092cf15c80500750406d40a656e6473747265616d0a656e646f626a0a332030206f626a0a3c3c0a2f54797065202f506167650a2f4d65646961426f78205b30203020353935203834325d0a2f5265736f7572636573203c3c0a2f584f626a656374203c3c0a2f58302034203020520a3e3e0a3e3e0a2f436f6e74656e74732037203020520a2f506172656e742032203020520a3e3e0a656e646f626a0a322030206f626a0a3c3c0a2f54797065202f50616765730a2f4b696473205b33203020525d0a2f436f756e7420310a3e3e0a656e646f626a0a312030206f626a0a3c3c0a2f54797065202f436174616c6f670a2f50616765732032203020520a3e3e0a656e646f626a0a382030206f626a0a3c3c0a2f50726f64756365722028694c6f7665504446290a2f4d6f64446174652028443a32303235313132383138323135345a290a3e3e0a656e646f626a0a392030206f626a0a3c3c0a2f53697a652031300a2f526f6f742031203020520a2f496e666f2038203020520a2f4944205b3c42434130343631374443443542363338453733413741464242374139443142343e203c36334231463436354144433534453838343434323834353537374232434635313e5d0a2f54797065202f585265660a2f57205b31203220325d0a2f46696c746572202f466c6174654465636f64650a2f496e646578205b302031305d0a2f4c656e6774682034350a3e3e0a73747265616d0a789c636060f8ff9f912d958181914d0748b0ae06128c1c4082e11688e00789398064a78188bb0c0c00ae98060b0a656e6473747265616d0a656e646f626a0a7374617274787265660a313735370a2525454f460a, 202540617, 1, '2025-11-29 02:59:41', '2025-11-29 03:00:19');

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
(37, '20258632', '94', 'Cillum qui amet iru', 'Deleniti quos recusa', 'Sit nemo deleniti ac', 'Ea aliquam corporis', 'Mabuhay Village 2000'),
(38, '20259017', '660', 'Distinctio Dignissi', 'Itaque ipsum aliqua', 'Anim velit neque cul', 'Sed maxime delectus', 'Mabuhay Village 2000');

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
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homeowner_fees`
--

INSERT INTO `homeowner_fees` (`id`, `user_id`, `amount_paid`, `payment_method`, `ref_no`, `attachment`, `status`, `remarks`, `is_remitted`, `date_created`, `date_updated`) VALUES
(3, '20258632', 483, 'Bank Transfer', 'PV000003', '', 1, 'Remarks', 0, '2025-11-28', '0000-00-00'),
(4, '20259017', 483, 'Bank Transfer', 'PV000004', '', 1, '213123', 0, '2025-11-28', '0000-00-00');

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

--
-- Dumping data for table `liquidation_expenses_details`
--

INSERT INTO `liquidation_expenses_details` (`id`, `liquidation_id`, `particular`, `amount`, `receipt`, `total_expenses`, `remaning_budget`, `audit_result`, `remarks`, `date_created`, `date_updated`) VALUES
(44, 40, 'particular 1', 60000.00, '1764354413_images__1_.pdf', 3183458, 1816542, 'Underspent', 'Ut est non amet exe', '2025-11-29 02:26:53', '2025-11-29 02:26:53'),
(45, 40, 'particular 2', 3123312.00, '1764354413_images__1_.pdf', 3183458, 1816542, 'Underspent', 'Ut est non amet exe', '2025-11-29 02:26:53', '2025-11-29 02:26:53'),
(46, 40, 'particular 3', 123.00, '1764354413_images__1_.pdf', 3183458, 1816542, 'Underspent', 'Ut est non amet exe', '2025-11-29 02:26:53', '2025-11-29 02:26:53'),
(47, 40, 'particular 4', 23.00, '1764354413_images__1_.pdf', 3183458, 1816542, 'Underspent', 'Ut est non amet exe', '2025-11-29 02:26:53', '2025-11-29 02:26:53'),
(48, 41, 'Unde itaque ad ut vo', 123.00, '1764356277_images__1_.pdf', 403396, 53393, 'Underspent', 'Esse quisquam dolor', '2025-11-29 02:57:57', '2025-11-29 02:57:57'),
(49, 41, 'Fugit voluptas dese', 378442.00, '1764356277_images__1_.pdf', 403396, 53393, 'Underspent', 'Esse quisquam dolor', '2025-11-29 02:57:57', '2025-11-29 02:57:57'),
(50, 41, 'Odio a porro modi au', 123.00, '1764356277_images__1_.pdf', 403396, 53393, 'Underspent', 'Esse quisquam dolor', '2025-11-29 02:57:57', '2025-11-29 02:57:57'),
(51, 41, 'In eiusmod numquam a', 12313.00, '1764356277_images__1_.pdf', 403396, 53393, 'Underspent', 'Esse quisquam dolor', '2025-11-29 02:57:57', '2025-11-29 02:57:57'),
(52, 41, 'Sed ipsa magni est ', 12313.00, '1764356277_images__1_.pdf', 403396, 53393, 'Underspent', 'Esse quisquam dolor', '2025-11-29 02:57:57', '2025-11-29 02:57:57'),
(53, 41, 'Id fugit natus erro', 82.00, '1764356277_images__1_.pdf', 403396, 53393, 'Underspent', 'Esse quisquam dolor', '2025-11-29 02:57:57', '2025-11-29 02:57:57');

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

--
-- Dumping data for table `liquidation_of_expenses`
--

INSERT INTO `liquidation_of_expenses` (`id`, `project_resolution_id`, `status`, `total_expenses`, `date_created`, `date_updated`) VALUES
(40, 22, 2, 3183458.00, '2025-11-29 02:26:53', '2025-11-29 02:27:53'),
(41, 23, 2, 403396.00, '2025-11-29 02:57:57', '2025-11-29 02:58:50');

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

--
-- Dumping data for table `payment_verification`
--

INSERT INTO `payment_verification` (`id`, `user_id`, `payment_for`, `amount`, `status`, `date_created`, `date_updated`) VALUES
(2, '20254014', 'Monthly Fees', 483, 1, '2025-11-28', '2025-11-28'),
(3, '20258632', 'Monthly Fees', 483, 1, '2025-11-28', '2025-11-28'),
(4, '20259017', 'Monthly Fees', 483, 1, '2025-11-28', '2025-11-28');

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
  `is_approved` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `remittance`
--

INSERT INTO `remittance` (`id`, `user_id`, `particular`, `amount`, `date`, `transaction_type`, `is_approved`, `date_created`, `date_updated`) VALUES
(16, '202540617', 'Today\'s HOA Collected Fee', 1316, '2025-11-28', 'Credit', 0, '2025-11-28', '0000-00-00');

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
(2, 0, 0, 'Veritatis voluptas e', '2025-11-28', NULL);

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
  `contract` blob DEFAULT NULL,
  `status` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stall_renter`
--

INSERT INTO `stall_renter` (`id`, `renter_name`, `contact_no`, `stall_id`, `rental_duration`, `start_date`, `end_date`, `amount`, `contract`, `status`, `remarks`, `date_created`, `date_updated`) VALUES
(3, 'Declan Fisher', 2147483647, 1, '0', '0000-00-00', '2006-06-19', 96, NULL, 0, 'Reprehenderit quis', '2025-11-28', '0000-00-00'),
(4, 'Sloane Hoffman', 2147483647, 1, '0', '0000-00-00', '2021-12-24', 80, 0x2f686f615f73797374656d2f75706c6f6164732f636f6e7472616374732f313736343330373833335f4d41544348494e472e706466, 0, 'Dolor eos eu amet d', '2025-11-28', '0000-00-00'),
(5, 'Brianna Carney', 2147483647, 1, '0', '0000-00-00', '2012-08-17', 81, 0x2f686f615f73797374656d2f75706c6f6164732f636f6e7472616374732f313736343331353734355f4d41544348494e472e706466, 0, 'Voluptas officia tem', '2025-11-28', '0000-00-00'),
(6, 'Ira Stevens', 2147483647, 1, '0', '0000-00-00', '2010-08-20', 76, 0x2f686f615f73797374656d2f75706c6f6164732f636f6e7472616374732f313736343331363030385f4d41544348494e472e706466, 0, 'Nam qui amet magni', '2025-11-28', '0000-00-00');

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

--
-- Dumping data for table `stall_renter_fees`
--

INSERT INTO `stall_renter_fees` (`id`, `stall_renter_id`, `amount_paid`, `attachment`, `status`, `remarks`, `is_remitted`, `date_created`, `date_updated`) VALUES
(1, 4, 80, 0x75706c6f6164732f6174746163686d656e74732f7374616c6c5f345f7061796d656e745f313736343330383034395f4d41544348494e472e706466, 1, '', 0, '2025-11-28', '0000-00-00');

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

--
-- Dumping data for table `toda`
--

INSERT INTO `toda` (`id`, `toda_name`, `no_of_tricycles`, `representative`, `contact_no`, `fee_amount`, `status`, `contract`, `start_date`, `end_date`, `date_created`, `date_updated`) VALUES
(1, 'Yasir Howell', 73, 'Sint id in sunt dic', 99999999, 34, 0, 0x75706c6f6164732f636f6e7472616374732f313736343238383831335f4d41544348494e472e706466, '1986-10-08', '2012-03-12', '2025-11-28', '0000-00-00'),
(2, 'Karyn Berger', 14, 'Cupidatat consequatu', 2147483647, 58, 0, 0x75706c6f6164732f636f6e7472616374732f313736343239333336305f4d41544348494e472e706466, '1970-01-18', '1991-09-20', '2025-11-28', '0000-00-00');

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

--
-- Dumping data for table `toda_fees`
--

INSERT INTO `toda_fees` (`id`, `toda_id`, `amount_paid`, `status`, `due_date`, `is_remitted`, `date_created`, `date_updated`) VALUES
(1, 2, 30, 1, '1994-09-05', 0, '2025-11-28', '0000-00-00');

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
(83, 6, '20258632', 'vulagu@mailinator.com', '$2y$10$6r0HNVapko0Ufzyb0qzOXuo0BkjLuLEfIOj2kiCRVtPnTEQx/Zlt6', 0, '', NULL, 1, '2025-11-28', '0000-00-00'),
(84, 6, '20259017', 'xuxasuqa@mailinator.com', '$2y$10$YUex9MQYhvUhVz7V6ESesOZj62QRRyHWieoO8kNKcWwbup9ZBLHd6', 0, '', NULL, 1, '2025-11-28', '0000-00-00');

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
(33, '20258632', 'Raja', 'Adam Mcclure', 'Perkins', 'Non lorem impedit a', '09565555555', '1978-04-17', 'Filipino', 'Single'),
(34, '20259017', 'Carson', 'Ginger Oneal', 'Fletcher', 'Id in ut sequi odit', '09567521756', '1982-01-05', 'Filipino', 'Single');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `court_fees`
--
ALTER TABLE `court_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fee_assignments`
--
ALTER TABLE `fee_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fee_type`
--
ALTER TABLE `fee_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `financial_summary`
--
ALTER TABLE `financial_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hoa_info`
--
ALTER TABLE `hoa_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `homeowner_fees`
--
ALTER TABLE `homeowner_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `liquidation_expenses_details`
--
ALTER TABLE `liquidation_expenses_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `liquidation_of_expenses`
--
ALTER TABLE `liquidation_of_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `remittance`
--
ALTER TABLE `remittance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `resolution`
--
ALTER TABLE `resolution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stall_renter_fees`
--
ALTER TABLE `stall_renter_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `toda`
--
ALTER TABLE `toda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `toda_fees`
--
ALTER TABLE `toda_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
