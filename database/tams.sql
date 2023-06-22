-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2021 at 09:07 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tams`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_complainant`
--

CREATE TABLE `admission_complainant` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `complainant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admission_respondent`
--

CREATE TABLE `admission_respondent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `respondent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(100) NOT NULL,
  `user_id` bigint(100) UNSIGNED NOT NULL,
  `submit_date` datetime NOT NULL,
  `application_type` varchar(200) NOT NULL,
  `qualification` varchar(200) DEFAULT NULL,
  `status` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `submit_date`, `application_type`, `qualification`, `status`, `created_at`, `updated_at`) VALUES
(1, 24, '2021-08-11 19:35:22', 'Petition', 'Law School', 'Not Comleted', '2021-08-11 16:35:22', '2021-08-11 16:35:22'),
(2, 27, '2021-08-18 18:42:39', 'Petition', 'Law School', 'Not Comleted', '2021-08-18 15:42:39', '2021-08-18 15:42:39');

-- --------------------------------------------------------

--
-- Table structure for table `application_moves`
--

CREATE TABLE `application_moves` (
  `id` bigint(100) NOT NULL,
  `user_id` bigint(100) UNSIGNED DEFAULT NULL,
  `appl_progress` int(1) NOT NULL DEFAULT 0,
  `finish` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application_moves`
--

INSERT INTO `application_moves` (`id`, `user_id`, `appl_progress`, `finish`, `created_at`, `updated_at`) VALUES
(1, 24, 95, 0, '2021-08-11 10:48:38', '2021-08-11 10:48:38'),
(2, 27, 90, 0, '2021-08-18 15:40:43', '2021-08-18 15:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `attachment_moves`
--

CREATE TABLE `attachment_moves` (
  `id` bigint(100) NOT NULL,
  `user_id` bigint(100) UNSIGNED NOT NULL,
  `profile_picture` varchar(220) DEFAULT NULL,
  `petition` varchar(200) DEFAULT NULL,
  `csee` varchar(200) DEFAULT NULL,
  `necta` varchar(200) DEFAULT NULL,
  `acsee` varchar(220) DEFAULT NULL,
  `nacte` varchar(200) DEFAULT NULL,
  `llb_cert` varchar(200) DEFAULT NULL,
  `llb_trans` varchar(200) DEFAULT NULL,
  `tcu` varchar(200) DEFAULT NULL,
  `lst_cert` varchar(200) DEFAULT NULL,
  `lst_results` varchar(200) DEFAULT NULL,
  `pupilage` varchar(200) DEFAULT NULL,
  `intenship` varchar(200) DEFAULT NULL,
  `emp_later` varchar(200) DEFAULT NULL,
  `birth_cert` varchar(200) DEFAULT NULL,
  `char_cert` varchar(200) DEFAULT NULL,
  `deedpoll` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attachment_moves`
--

INSERT INTO `attachment_moves` (`id`, `user_id`, `profile_picture`, `petition`, `csee`, `necta`, `acsee`, `nacte`, `llb_cert`, `llb_trans`, `tcu`, `lst_cert`, `lst_results`, `pupilage`, `intenship`, `emp_later`, `birth_cert`, `char_cert`, `deedpoll`, `created_at`, `updated_at`) VALUES
(1, 24, 'profile_pict_1628778312.PNG', 'Othman_resume_1628778335.pdf', 'BARUA MSAJILI MKUU_1628780860.pdf', NULL, 'Bill And   Payment  Information   PostingAPIv4.0_1628948275.pdf', NULL, 'Bill And   Payment  Information   PostingAPIv4.0_1628948705.pdf', 'TRANSFER VACANCIES_1628948842.pdf', NULL, 'TANGAZO LA KAZI ZA MKATABA JULAI 2021_1628949050.pdf', 'DataTables - Frest - Bootstrap HTML admin template_1628949085.pdf', NULL, NULL, 'sw1620828120-TANGAZO LA KUITWA KWENYE USAILI - MEI 2021_1628952778.pdf', 'case_proceedings_1628952491.pdf', 'New Doc 2020-01-08 12.41.02_1_1628952594.pdf', NULL, '2021-08-12 14:25:12', '2021-08-12 14:25:12'),
(2, 27, 'bio_1618122358-Kabudi_1629301448.jpg', 'transferSlip_1629301493.pdf', 'court_decision (1)_1629301574.pdf', NULL, 'New Doc 2020-01-08 12.41.02_1_1629301586.pdf', NULL, 'sw1620828120-TANGAZO LA KUITWA KWENYE USAILI - MEI 2021_1629301604.pdf', 'DICT_0001_1629301617.pdf', NULL, 'Data Tables_1629301637.pdf', 'case_proceedings (2)_1629301651.pdf', NULL, NULL, 'TANGAZO LA KAZI ZA MKATABA JULAI 2021_1629301550.pdf', 'barua to DICT & DRM_1629301515.pdf', 'TRANSFER VACANCIES_1629301534.pdf', NULL, '2021-08-18 15:44:08', '2021-08-18 15:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `code`, `region_id`, `created_at`, `updated_at`) VALUES
(1, 'Kaliua', 'KUA', 4, '2021-05-04 06:55:45', '2021-05-04 07:05:26'),
(2, 'Ilala', 'ILL', 5, '2021-05-06 17:39:17', '2021-05-06 17:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(220) NOT NULL,
  `user_id` bigint(220) UNSIGNED DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `file` varchar(220) NOT NULL,
  `upload_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `author` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `user_id`, `name`, `file`, `upload_date`, `status`, `author`, `created_at`, `updated_at`) VALUES
(1, 24, 'Profile Picuture', 'profile_pict_1628778312.PNG', '2021-08-12 17:25:12', 0, '1', '2021-08-12 14:25:12', '2021-08-12 14:25:12'),
(2, 24, 'Petition for Admission and Enrollment', 'Othman_resume_1628778335.pdf', '2021-08-12 17:25:35', 0, '1', '2021-08-12 14:25:35', '2021-08-12 14:25:35'),
(3, 24, 'Certificate of Secondary Education (CSEE)', 'BARUA MSAJILI MKUU_1628780860.pdf', '2021-08-12 18:07:40', 0, '1', '2021-08-12 15:07:40', '2021-08-12 15:07:40'),
(4, 24, 'Advanced Certificate of Secondary Education', 'Bill And   Payment  Information   PostingAPIv4.0_1628948275.pdf', '2021-08-14 16:37:55', 0, '1', '2021-08-14 13:37:56', '2021-08-14 13:37:56'),
(5, 24, 'LLB Certificate', 'Bill And   Payment  Information   PostingAPIv4.0_1628948705.pdf', '2021-08-14 16:45:05', 0, '1', '2021-08-14 13:45:05', '2021-08-14 13:45:05'),
(6, 24, 'LLB Transcript', 'TRANSFER VACANCIES_1628948842.pdf', '2021-08-14 16:47:22', 0, '1', '2021-08-14 13:47:23', '2021-08-14 13:47:23'),
(7, 24, 'Post Graduate Diploma in Legal Practice from LST', 'TANGAZO LA KAZI ZA MKATABA JULAI 2021_1628949050.pdf', '2021-08-14 16:50:50', 0, '1', '2021-08-14 13:50:50', '2021-08-14 13:50:50'),
(8, 24, 'Final Result Post Graduate Diploma in Legal Practice from LST', 'DataTables - Frest - Bootstrap HTML admin template_1628949085.pdf', '2021-08-14 16:51:25', 0, '1', '2021-08-14 13:51:25', '2021-08-14 13:51:25'),
(9, 24, 'Birth Certificate', 'case_proceedings_1628952491.pdf', '2021-08-14 17:48:11', 0, '1', '2021-08-14 14:48:11', '2021-08-14 14:48:11'),
(10, 24, 'Certificate of Good Character', 'New Doc 2020-01-08 12.41.02_1_1628952594.pdf', '2021-08-14 17:49:54', 0, '1', '2021-08-14 14:49:54', '2021-08-14 14:49:54'),
(11, 24, 'Employer Letter', 'sw1620828120-TANGAZO LA KUITWA KWENYE USAILI - MEI 2021_1628952719.pdf', '2021-08-14 17:51:59', 0, '1', '2021-08-14 14:51:59', '2021-08-14 14:51:59'),
(12, 24, 'Employer Letter', 'sw1620828120-TANGAZO LA KUITWA KWENYE USAILI - MEI 2021_1628952778.pdf', '2021-08-14 17:52:58', 0, '1', '2021-08-14 14:52:58', '2021-08-14 14:52:58'),
(13, 27, 'Profile Picuture', 'bio_1618122358-Kabudi_1629301448.jpg', '2021-08-18 18:44:08', 0, '2', '2021-08-18 15:44:08', '2021-08-18 15:44:08'),
(14, 27, 'Petition for Admission and Enrollment', 'transferSlip_1629301493.pdf', '2021-08-18 18:44:53', 0, '2', '2021-08-18 15:44:53', '2021-08-18 15:44:53'),
(15, 27, 'Birth Certificate', 'barua to DICT & DRM_1629301515.pdf', '2021-08-18 18:45:15', 0, '2', '2021-08-18 15:45:15', '2021-08-18 15:45:15'),
(16, 27, 'Certificate of Good Character', 'TRANSFER VACANCIES_1629301534.pdf', '2021-08-18 18:45:34', 0, '2', '2021-08-18 15:45:34', '2021-08-18 15:45:34'),
(17, 27, 'Employer Letter', 'TANGAZO LA KAZI ZA MKATABA JULAI 2021_1629301550.pdf', '2021-08-18 18:45:50', 0, '2', '2021-08-18 15:45:50', '2021-08-18 15:45:50'),
(18, 27, 'Certificate of Secondary Education (CSEE)', 'court_decision (1)_1629301574.pdf', '2021-08-18 18:46:14', 0, '2', '2021-08-18 15:46:14', '2021-08-18 15:46:14'),
(19, 27, 'Advanced Certificate of Secondary Education', 'New Doc 2020-01-08 12.41.02_1_1629301586.pdf', '2021-08-18 18:46:26', 0, '2', '2021-08-18 15:46:26', '2021-08-18 15:46:26'),
(20, 27, 'LLB Certificate', 'sw1620828120-TANGAZO LA KUITWA KWENYE USAILI - MEI 2021_1629301604.pdf', '2021-08-18 18:46:44', 0, '2', '2021-08-18 15:46:44', '2021-08-18 15:46:44'),
(21, 27, 'LLB Transcript', 'DICT_0001_1629301617.pdf', '2021-08-18 18:46:57', 0, '2', '2021-08-18 15:46:57', '2021-08-18 15:46:57'),
(22, 27, 'Post Graduate Diploma in Legal Practice from LST', 'Data Tables_1629301637.pdf', '2021-08-18 18:47:17', 0, '2', '2021-08-18 15:47:17', '2021-08-18 15:47:17'),
(23, 27, 'Final Result Post Graduate Diploma in Legal Practice from LST', 'case_proceedings (2)_1629301651.pdf', '2021-08-18 18:47:31', 0, '2', '2021-08-18 15:47:31', '2021-08-18 15:47:31');

-- --------------------------------------------------------

--
-- Table structure for table `firms`
--

CREATE TABLE `firms` (
  `id` bigint(200) NOT NULL,
  `members` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `tin` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_by` int(100) NOT NULL,
  `status` varchar(200) DEFAULT NULL,
  `taxpayer_name` varchar(200) NOT NULL,
  `model` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `firms`
--

INSERT INTO `firms` (`id`, `members`, `name`, `tin`, `type`, `created_by`, `status`, `taxpayer_name`, `model`, `created_at`, `updated_at`) VALUES
(1, 1, 'A7 CONSULTANT', '1184738474', 'Law Firm', 24, NULL, 'A7 CONSULTANT', NULL, '2021-08-28 14:22:20', '2021-08-28 14:22:20');

-- --------------------------------------------------------

--
-- Table structure for table `firm_addresses`
--

CREATE TABLE `firm_addresses` (
  `id` bigint(100) NOT NULL,
  `firm_id` bigint(100) UNSIGNED NOT NULL,
  `address` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `ward` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `postcode` bigint(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `firm_addresses`
--

INSERT INTO `firm_addresses` (`id`, `firm_id`, `address`, `region`, `district`, `ward`, `street`, `postcode`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 'KIGAMBONI', 'Dar es Salaam', 'Kigamboni', 'Tungi', 'Panama', 110098, 'HQ', '2021-08-28 17:22:20', '2021-08-28 14:22:20');

-- --------------------------------------------------------

--
-- Table structure for table `firm_memberships`
--

CREATE TABLE `firm_memberships` (
  `id` bigint(100) NOT NULL,
  `user_id` bigint(100) NOT NULL,
  `firm_id` bigint(100) NOT NULL,
  `date_requested` date NOT NULL,
  `date_joined` date DEFAULT NULL,
  `date_left` date DEFAULT NULL,
  `branch_code` int(100) DEFAULT NULL,
  `disputed` int(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `firm_memberships`
--

INSERT INTO `firm_memberships` (`id`, `user_id`, `firm_id`, `date_requested`, `date_joined`, `date_left`, `branch_code`, `disputed`, `created_at`, `updated_at`) VALUES
(1, 24, 1, '2021-08-28', '2021-08-28', NULL, NULL, NULL, '2021-08-28 14:22:20', '2021-08-28 14:22:20');

-- --------------------------------------------------------

--
-- Table structure for table `llb_colleges`
--

CREATE TABLE `llb_colleges` (
  `id` bigint(100) NOT NULL,
  `user_id` bigint(100) UNSIGNED NOT NULL,
  `name` varchar(220) NOT NULL,
  `complete_year` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `llb_colleges`
--

INSERT INTO `llb_colleges` (`id`, `user_id`, `name`, `complete_year`, `created_at`, `updated_at`) VALUES
(1, 24, 'TUMAINI UNIVERSITY MAKUMIRA', '2019', '2021-08-17 19:20:17', '2021-08-17 19:20:17'),
(2, 24, 'TUMAINI UNIVERSITY MAKUMIRA', '2019', '2021-08-17 19:24:28', '2021-08-17 19:24:28'),
(3, 24, 'TUMAINI UNIVERSITY MAKUMIRA', '2019', '2021-08-17 19:25:37', '2021-08-17 19:25:37'),
(4, 27, 'MZUMBE UNIVERSITY', '2019', '2021-08-18 15:48:36', '2021-08-18 15:48:36');

-- --------------------------------------------------------

--
-- Table structure for table `lst_colleges`
--

CREATE TABLE `lst_colleges` (
  `id` bigint(100) NOT NULL,
  `user_id` bigint(100) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `reg_number` varchar(200) NOT NULL,
  `complete_year` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lst_colleges`
--

INSERT INTO `lst_colleges` (`id`, `user_id`, `name`, `reg_number`, `complete_year`, `created_at`, `updated_at`) VALUES
(1, 24, 'LAW SCHOOL OF TANZANIA', 'LST/2019/30/572', '2019', '2021-08-17 19:27:43', '2021-08-17 19:27:43'),
(2, 27, 'LAW SCHOOL OF TANZANIA', 'LST/2019/24/308', '2019', '2021-08-18 15:49:53', '2021-08-18 15:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_23_143955_create_permission_tables', 2),
(5, '2021_03_25_124849_create_court_levels_table', 2),
(6, '2021_03_26_081732_create_zones_table', 2),
(7, '2021_03_26_081909_create_regions_table', 2),
(8, '2021_03_26_081923_create_districts_table', 2),
(9, '2021_03_27_163148_create_courts_table', 2),
(10, '2021_03_27_222539_create_court_rooms_table', 2),
(11, '2021_03_28_134318_create_case_registers_table', 2),
(12, '2021_03_28_134330_create_case_types_table', 2),
(13, '2021_03_28_134338_create_case_subtypes_table', 2),
(14, '2021_03_28_163719_create_mode_determinations_table', 2),
(15, '2021_03_28_174249_create_proceeding_outcomes_table', 2),
(16, '2021_03_28_214209_create_case_stages_table', 2),
(17, '2021_03_28_230033_create_case_outcomes_table', 2),
(18, '2021_03_29_001825_create_natures_table', 2),
(19, '2021_03_29_085849_create_charges_table', 2),
(20, '2021_03_29_220453_create_officer_groups_table', 2),
(21, '2021_03_29_225430_create_officer_positions_table', 2),
(22, '2021_03_29_225610_create_seniorities_table', 2),
(23, '2021_03_30_141706_create_officers_table', 2),
(24, '2021_04_01_130814_create_court_submissions_table', 2),
(25, '2021_04_01_171955_create_criminals_table', 2),
(26, '2021_04_12_145654_create_criminal_nature_table', 2),
(27, '2021_04_13_140656_create_charge_criminal_table', 2),
(28, '2021_04_15_105610_create_complainants_table', 2),
(29, '2021_04_15_105636_create_respondents_table', 2),
(30, '2021_04_15_111230_create_complainant_criminal_table', 2),
(31, '2021_04_15_111248_create_criminal_respondent_table', 2),
(32, '2021_04_15_135623_create_victims_table', 2),
(33, '2021_04_15_140110_create_criminal_victim_table', 2),
(34, '2021_04_16_144852_create_profiles_table', 2),
(35, '2021_04_18_010117_create_firms_table', 2),
(36, '2021_04_18_010155_create_advocates_table', 2),
(37, '2021_04_18_010209_create_attorneys_table', 2),
(38, '2021_04_19_221618_create_admissions_table', 2),
(39, '2021_04_19_225130_create_admission_nature_table', 2),
(40, '2021_04_19_225143_create_admission_charge_table', 2),
(41, '2021_04_19_231533_create_admission_complainant_table', 2),
(42, '2021_04_19_231553_create_admission_respondent_table', 2),
(43, '2021_04_19_232951_create_admission_victim_table', 2),
(44, '2021_04_21_013151_create_documents_table', 2),
(45, '2021_04_21_212216_create_user_verifications_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(6, 'App\\User', 14),
(6, 'App\\User', 15),
(6, 'App\\User', 16),
(6, 'App\\User', 17),
(6, 'App\\User', 18),
(6, 'App\\User', 19),
(6, 'App\\User', 20),
(6, 'App\\User', 21),
(6, 'App\\User', 22),
(6, 'App\\User', 23),
(6, 'App\\User', 24),
(6, 'App\\User', 25),
(6, 'App\\User', 26),
(6, 'App\\User', 27);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view statistical dashboard', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(2, 'add statistical dashboard', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(3, 'edit statistical dashboard', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(4, 'delete statistical dashboard', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(5, 'view analytical dashboard', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(6, 'add analytical dashboard', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(7, 'edit analytical dashboard', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(8, 'delete analytical dashboard', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(9, 'view civil cases', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(10, 'add civil cases', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(11, 'edit civil cases', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(12, 'delete civil cases', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(13, 'view criminal cases', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(14, 'add criminal cases', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(15, 'edit criminal cases', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(16, 'delete criminal cases', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(17, 'view case assignment', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(18, 'add case assignment', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(19, 'edit case assignment', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(20, 'delete case assignment', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(21, 'view my statistics', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(22, 'add my statistics', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(23, 'edit my statistics', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(24, 'delete my statistics', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(25, 'view case decision', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(26, 'add case decision', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(27, 'edit case decision', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(28, 'delete case decision', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(29, 'view case admission', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(30, 'add case admission', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(31, 'edit case admission', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(32, 'delete case admission', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(33, 'view document admission', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(34, 'add document admission', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(35, 'edit document admission', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(36, 'delete document admission', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(37, 'view case registration', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(38, 'add case registration', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(39, 'edit case registration', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(40, 'delete case registration', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(41, 'view document registration', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(42, 'add document registration', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(43, 'edit document registration', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(44, 'delete document registration', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(45, 'view reconciliation', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(46, 'add reconciliation', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(47, 'edit reconciliation', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(48, 'delete reconciliation', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(49, 'view bills management', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(50, 'add bills management', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(51, 'edit bills management', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(52, 'delete bills management', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(53, 'view customer billing', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(54, 'add customer billing', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(55, 'edit customer billing', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(56, 'delete customer billing', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(57, 'view billing request', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(58, 'add billing request', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(59, 'edit billing request', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(60, 'delete billing request', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(61, 'view collection center', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(62, 'add collection center', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(63, 'edit collection center', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(64, 'delete collection center', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(65, 'view bills report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(66, 'add bills report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(67, 'edit bills report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(68, 'delete bills report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(69, 'view reconciliation report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(70, 'add reconciliation report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(71, 'edit reconciliation report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(72, 'delete reconciliation report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(73, 'view revenue estimate', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(74, 'add revenue estimate', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(75, 'edit revenue estimate', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(76, 'delete revenue estimate', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(77, 'view efiling', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(78, 'add efiling', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(79, 'edit efiling', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(80, 'delete efiling', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(81, 'view officer group', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(82, 'add officer group', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(83, 'edit officer group', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(84, 'delete officer group', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(85, 'view officer position', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(86, 'add officer position', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(87, 'edit officer position', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(88, 'delete officer position', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(89, 'view seniority', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(90, 'add seniority', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(91, 'edit seniority', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(92, 'delete seniority', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(93, 'view judges', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(94, 'add judges', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(95, 'edit judges', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(96, 'delete judges', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(97, 'view registrars', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(98, 'add registrars', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(99, 'edit registrars', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(100, 'delete registrars', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(101, 'view magistrates', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(102, 'add magistrates', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(103, 'edit magistrates', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(104, 'delete magistrates', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(105, 'view attorney', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(106, 'add attorney', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(107, 'edit attorney', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(108, 'delete attorney', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(109, 'view advocates', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(110, 'add advocates', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(111, 'edit advocates', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(112, 'delete advocates', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(113, 'view register report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(114, 'add register report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(115, 'edit register report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(116, 'delete register report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(117, 'view statistical report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(118, 'add statistical report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(119, 'edit statistical report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(120, 'delete statistical report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(121, 'view cause list', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(122, 'add cause list', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(123, 'edit cause list', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(124, 'delete cause list', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(125, 'view forms report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(126, 'add forms report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(127, 'edit forms report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(128, 'delete forms report', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(129, 'view zones', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(130, 'add zones', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(131, 'edit zones', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(132, 'delete zones', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(133, 'view regions', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(134, 'add regions', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(135, 'edit regions', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(136, 'delete regions', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(137, 'view districts', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(138, 'add districts', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(139, 'edit districts', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(140, 'delete districts', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(141, 'view levels', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(142, 'add levels', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(143, 'edit levels', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(144, 'delete levels', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(145, 'view courts', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(146, 'add courts', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(147, 'edit courts', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(148, 'delete courts', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(149, 'view rooms', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(150, 'add rooms', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(151, 'edit rooms', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(152, 'delete rooms', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(153, 'view submissions', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(154, 'add submissions', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(155, 'edit submissions', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(156, 'delete submissions', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(157, 'view case types', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(158, 'add case types', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(159, 'edit case types', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(160, 'delete case types', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(161, 'view case subtypes', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(162, 'add case subtypes', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(163, 'edit case subtypes', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(164, 'delete case subtypes', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(165, 'view registries', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(166, 'add registries', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(167, 'edit registries', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(168, 'delete registries', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(169, 'view stages', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(170, 'add stages', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(171, 'edit stages', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(172, 'delete stages', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(173, 'view outcomes', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(174, 'add outcomes', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(175, 'edit outcomes', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(176, 'delete outcomes', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(177, 'view nature', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(178, 'add nature', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(179, 'edit nature', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(180, 'delete nature', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(181, 'view charges', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(182, 'add charges', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(183, 'edit charges', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(184, 'delete charges', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(185, 'view proceedings outcome', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(186, 'add proceedings outcome', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(187, 'edit proceedings outcome', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(188, 'delete proceedings outcome', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(189, 'view mode determination', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(190, 'add mode determination', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(191, 'edit mode determination', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(192, 'delete mode determination', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(193, 'view court forms', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(194, 'add court forms', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(195, 'edit court forms', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(196, 'delete court forms', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(197, 'view roles', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(198, 'add roles', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(199, 'edit roles', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(200, 'delete roles', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(201, 'view permissions', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(202, 'add permissions', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(203, 'edit permissions', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(204, 'delete permissions', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(205, 'view users', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(206, 'add users', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(207, 'edit users', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(208, 'delete users', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(209, 'view audit logs', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(210, 'add audit logs', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(211, 'edit audit logs', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31'),
(212, 'delete audit logs', 'web', '2021-05-02 08:35:31', '2021-05-02 08:35:31');

-- --------------------------------------------------------

--
-- Table structure for table `petition_forms`
--

CREATE TABLE `petition_forms` (
  `id` bigint(100) NOT NULL,
  `user_id` bigint(100) UNSIGNED DEFAULT NULL,
  `personal_detail` tinyint(1) NOT NULL DEFAULT 0,
  `qualification` tinyint(1) NOT NULL DEFAULT 0,
  `attachment` tinyint(1) NOT NULL DEFAULT 0,
  `llb` tinyint(1) NOT NULL DEFAULT 0,
  `experience` int(100) NOT NULL DEFAULT 0,
  `firm` int(10) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petition_forms`
--

INSERT INTO `petition_forms` (`id`, `user_id`, `personal_detail`, `qualification`, `attachment`, `llb`, `experience`, `firm`, `created_at`, `updated_at`) VALUES
(1, 24, 1, 1, 1, 1, 1, 1, '2021-08-11 10:48:38', '2021-08-11 10:48:38'),
(2, 27, 1, 1, 1, 1, 1, 0, '2021-08-18 15:40:43', '2021-08-18 15:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `salutation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second_salutation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `nationality` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `salutation`, `second_salutation`, `fullname`, `gender`, `dob`, `nationality`, `id_type`, `id_number`, `picture`, `user_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'JUMA ATHUMANI KANYEGEZI', 'Male', '1994-06-11', 'TZ', 'National Identity Card', '1985011130002903398', 'profile_pict_1628778312.PNG', 24, '2021-08-11 10:48:38', '2021-08-11 10:48:38'),
(2, NULL, NULL, 'SAMWELI MSONGE', 'Male', '1990-05-18', 'TZ', 'National Identity Card', '19900518200001120', 'bio_1618122358-Kabudi_1629301448.jpg', 27, '2021-08-18 15:40:43', '2021-08-18 15:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `id` bigint(100) NOT NULL,
  `user_id` bigint(100) UNSIGNED NOT NULL,
  `o_level` varchar(200) NOT NULL,
  `a_level` varchar(200) NOT NULL,
  `llb` varchar(200) NOT NULL,
  `lst` varchar(200) NOT NULL,
  `names_validation` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `user_id`, `o_level`, `a_level`, `llb`, `lst`, `names_validation`, `created_at`, `updated_at`) VALUES
(1, 24, 'Tanzania', 'Tanzania', 'Tanzania', 'Yes', 'As Appeared in Academic Certificates', '2021-08-11 16:35:22', '2021-08-11 16:35:22'),
(2, 27, 'Tanzania', 'Tanzania', 'Tanzania', 'Yes', 'As Appeared in Academic Certificates', '2021-08-18 15:42:39', '2021-08-18 15:42:39');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zone_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `code`, `zone_id`, `created_at`, `updated_at`) VALUES
(1, 'Arusha', 'ARS', 1, '2021-05-03 22:20:55', '2021-05-03 22:20:55'),
(2, 'Manyara', 'MNY', 1, '2021-05-03 22:22:30', '2021-05-03 22:22:30'),
(4, 'Tabora', 'TBR', 5, '2021-05-04 06:38:07', '2021-05-04 06:38:07'),
(5, 'Dar es Salaam', 'DSM', 6, '2021-05-06 17:35:15', '2021-05-06 17:35:15');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', '2021-04-26 12:18:19', '2021-04-26 12:18:19'),
(2, 'admin', 'web', '2021-04-26 12:18:19', '2021-04-26 12:18:19'),
(3, 'judge', 'web', '2021-04-26 12:18:19', '2021-04-26 12:18:19'),
(5, 'magistrate', 'web', '2021-04-26 12:18:19', '2021-04-26 12:18:19'),
(6, 'advocate', 'web', '2021-04-26 12:18:19', '2021-04-26 12:18:19'),
(7, 'attorney', 'web', '2021-04-26 12:18:19', '2021-04-26 12:18:19'),
(8, 'litigant', 'web', '2021-04-26 12:18:19', '2021-04-26 12:18:19'),
(9, 'court-clerk', 'web', '2021-04-26 12:18:19', '2021-04-26 12:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(11, 1),
(12, 1),
(12, 9),
(13, 1),
(13, 9),
(14, 1),
(14, 9),
(15, 1),
(15, 9),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(158, 1),
(159, 1),
(160, 1),
(161, 1),
(162, 1),
(163, 1),
(164, 1),
(165, 1),
(166, 1),
(167, 1),
(168, 1),
(169, 1),
(170, 1),
(171, 1),
(172, 1),
(173, 1),
(174, 1),
(175, 1),
(176, 1),
(177, 1),
(178, 1),
(179, 1),
(180, 1),
(181, 1),
(182, 1),
(183, 1),
(184, 1),
(185, 1),
(186, 1),
(187, 1),
(188, 1),
(189, 1),
(190, 1),
(191, 1),
(192, 1),
(193, 1),
(194, 1),
(195, 1),
(196, 1),
(197, 1),
(197, 2),
(198, 1),
(198, 2),
(199, 1),
(199, 2),
(200, 1),
(200, 2),
(201, 1),
(202, 1),
(203, 1),
(204, 1),
(205, 1),
(205, 2),
(206, 1),
(206, 2),
(207, 1),
(207, 2),
(208, 1),
(208, 2),
(209, 1),
(210, 1),
(211, 1),
(212, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activated',
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `petitioner` tinyint(10) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `mobile`, `email_verified_at`, `password`, `status`, `verified`, `petitioner`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@email.com', NULL, NULL, '$2y$10$ZpvnFtiKt4CSpTtQUgjIYOsNb4ofXKwXD7uZHoL1SvOJi0kP9qHqi', 'activated', 1, 0, NULL, '2021-04-26 12:18:19', '2021-04-26 12:18:19'),
(2, NULL, 'athuju@hotmail.com', NULL, NULL, '$2y$10$7uItMBPzDnzvZNlZrh69AeAWL0KsshZeqwGLPZ7sOfW/V1BoIURzK', 'activated', 0, 0, NULL, '2021-06-09 10:41:41', '2021-06-09 10:41:41'),
(3, NULL, 'admin@mocla.com', NULL, NULL, '$2y$10$7g01tH0wgViOgc5m0xRVP./GV6.24SkBYAxN780bvX1QjRQMht.2W', 'activated', 0, 0, NULL, '2021-06-09 15:00:49', '2021-06-09 15:00:49'),
(4, NULL, 'admin@tams.com', NULL, NULL, '$2y$10$Zdwzi7ywhwykCHuEtfJJpOPxJ13x5D0JT6UdGZKpVHeNa8YLStRSK', 'activated', 0, 0, NULL, '2021-06-09 15:11:23', '2021-06-09 15:11:23'),
(5, NULL, 'admin@tamz.com', NULL, NULL, '$2y$10$Rf1GYJERYbecYIWrc5LhTuNn4CW1ex2L3l4DSNvMvoX9IkxWDsrcC', 'activated', 1, 0, NULL, '2021-06-09 15:14:35', '2021-06-09 15:15:34'),
(6, 'advocate', 'adv@adv.com', NULL, NULL, '$2y$10$v5Wr0zBh92N0yo5i/yoK4.59btsfSQmcGMOoyfgLXHRj4dgZpfAbK', 'activated', 0, 0, NULL, '2021-06-10 13:49:22', '2021-06-10 13:49:22'),
(7, 'petitioner', 'petitioner@adv.com', NULL, NULL, '$2y$10$8Oqu8l44mC7S0wTyw3aFyuO06cXjTiqow/e7hKohyLz5r3HXxHl2q', 'activated', 0, 0, NULL, '2021-06-10 13:50:56', '2021-06-10 13:50:56'),
(8, 'new', 'new@email.com', NULL, NULL, '$2y$10$PlPxwJ5qWucq9uu3oYrzU.OhsyMFjJwDN2GMFfoaGLjBv4JeJIhDK', 'activated', 0, 0, NULL, '2021-06-10 13:54:44', '2021-06-10 13:54:44'),
(9, 'test', 'test@email.com', NULL, NULL, '$2y$10$nzQlFaFLuev58T8HswyGwOBYWjhoSre6KeTmuprS4.sP1pZmofmR.', 'activated', 0, 0, NULL, '2021-06-10 14:09:04', '2021-06-10 14:09:04'),
(10, 'testuser', 'user@email.com', NULL, NULL, '$2y$10$5s01Z/t4U3h.pvZTPlDCyegW9SAyrZEY0aEXUs9PVhwNPBjrvdA5C', 'activated', 0, 0, NULL, '2021-06-10 14:17:32', '2021-06-10 14:17:32'),
(11, NULL, 'testuser@adv.com', NULL, NULL, '$2y$10$.XKC4CPsHSlKsLPhDnueQOyEIStL9s6mqqpgkgOm.vYfKqVMgftpi', 'activated', 0, 0, NULL, '2021-06-10 14:49:06', '2021-06-10 14:49:06'),
(12, 'daxloopy', 'loopydax@gmail.com', NULL, NULL, '$2y$10$VBaoD7RlC.QUeQoBB64SNOabpFg66Uzeuh6Ukw97KdZtau9Qs/yTK', 'activated', 0, 0, NULL, '2021-06-10 15:19:28', '2021-06-10 15:19:28'),
(13, 'user', 'a@a.com', NULL, NULL, '$2y$10$hmXzL.UeEMV3ZRqXduCm5.8Grtj/FTQKdDar24FYTqlm4kv60ZQPW', 'activated', 0, 0, NULL, '2021-06-10 15:21:28', '2021-06-10 15:21:28'),
(14, 'JUMA ATHUMANI KANYEGEZI', 'loopydax3@gmail.com', NULL, NULL, '$2y$10$sAeuFPLtBP/5wKucDkuX1eyuqwQ7S76H19G4mbrVYQfI/9WOrblJe', 'activated', 1, 1, NULL, '2021-06-11 14:06:50', '2021-06-11 14:16:28'),
(15, 'Jamila Athumani', 'jamila@gmail.com', NULL, NULL, '$2y$10$.bsfN2beTwb7Sg.dJnQ5aOGrWb9Sgh2CmVCqI6QkVCklZPx4o1PrG', 'activated', 0, 1, NULL, '2021-06-11 15:33:15', '2021-06-11 15:33:15'),
(16, 'Alice Julius', 'alice@gmail.com', NULL, NULL, '$2y$10$oKgJlaws7rUlU2nWL/SyFeJDrNgQAornuQtoa3dVjQho6HSPOFQH2', 'activated', 0, 1, NULL, '2021-06-11 21:49:46', '2021-06-11 21:49:46'),
(17, 'Said Juma', 'said@email.com', NULL, NULL, '$2y$10$6cO4P4ntQyJUZrKxw7zdiuWEsEAFU4S4y.wMToFtPqV7eyixScJ3G', 'activated', 0, 1, NULL, '2021-06-11 21:55:36', '2021-06-11 21:55:36'),
(18, 'Sadala Mushi', 'mushi@gmail.com', NULL, NULL, '$2y$10$LhauW3b4isa0G0mt5IVyJuegDVVBrd9KHBu7EeEa4ROsunTmm/DN2', 'activated', 0, 1, NULL, '2021-06-11 22:04:49', '2021-06-11 22:04:49'),
(19, 'Site Tami', 'tami@email.com', '0678159437', NULL, '$2y$10$5MKG40K8pF8j5.rV2Eb28OURfm6O9CBywsk0N92yAKf3442TGSDQm', 'activated', 1, 1, NULL, '2021-06-12 09:20:05', '2021-06-12 09:22:58'),
(20, 'Test Petitioner', 'valid@email.com', '0678159438', NULL, '$2y$10$9ZFBrJQkL4Acpyxno.DfpONwXrM5cJAnoJh5mLRe9atCd.gnl5aJG', 'activated', 0, 1, NULL, '2021-07-07 12:39:21', '2021-07-07 12:39:21'),
(21, 'JUMA ATHUMANI KANYEGEZI', 'validy@email.com', '0678159439', '0007-07-21 03:43:21', '$2y$10$sIjF0131CwqiPgWiYCyoRuK0vbsSUJhhuIw0sAd5u5POjv4yNnnwW', 'activated', 1, 1, NULL, '2021-07-07 12:41:13', '2021-07-07 12:43:21'),
(22, 'STANLEY ULOMI', 'user@tams.com', '0778541252', '0021-07-07 03:49:23', '$2y$10$rOWZmg7PhCQku7panDb0Jeyya4brl0lBjwxcJhaRSNEDDEK/wOCwy', 'activated', 1, 1, NULL, '2021-07-07 12:49:00', '2021-07-07 12:49:23'),
(23, 'AMINA MATULILE', 'amimatu@gmail.com', '0718360822', '0021-07-07 06:13:58', '$2y$10$UvfUZrafZr1rYagjge2uHeZWzImB4QhZVNDqsNoaEo3spPGx3oclq', 'activated', 1, 1, NULL, '2021-07-07 15:13:06', '2021-07-07 15:13:59'),
(24, 'JUMA ATHUMANI KANYEGEZI', 'myvoda@phone.com', '0757721815', '0021-08-11 12:59:44', '$2y$10$cTF4oDtKWdDpXEDVwECWxeMiV8wx5U070QTdKYz2M5PvDF02iIhWu', 'activated', 1, 1, NULL, '2021-08-11 09:59:13', '2021-08-11 09:59:44'),
(25, 'FULL NAME', 'myvodacomnumber@phone.com', '0757721819', NULL, '$2y$10$3hwiB9Kc2p3Vawe/uA37iePo3lAGD8GdgqHPnsyK.GVwQF6kQIj2C', 'activated', 0, 1, NULL, '2021-08-11 10:04:18', '2021-08-11 10:04:18'),
(26, 'SAMPLE PETITIONER', 'myvodacomnumber1@phone.com', '0757721810', NULL, '$2y$10$Dptud2W4S7YuP1Qz7CJzaub6BAgD7DsLKiip6GrlRJQJA77/p696a', 'activated', 0, 1, NULL, '2021-08-11 10:10:20', '2021-08-11 10:10:20'),
(27, 'SAMWELI MSONGE', 'samsonge@gmail.com', '0627673036', '0021-08-18 06:36:10', '$2y$10$u4G8sJHtRhekZOwAUTqbT.X5Yz044aOjm0o4d.Ut46hgWlrQT/VDK', 'activated', 1, 1, NULL, '2021-08-18 15:34:45', '2021-08-18 15:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `verify_users`
--

CREATE TABLE `verify_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verify_users`
--

INSERT INTO `verify_users` (`id`, `user_id`, `token`, `created_at`, `updated_at`) VALUES
(1, 5, '2745840d45de8689d5d4273c4c29f1cad656b06d', '2021-06-09 15:14:35', '2021-06-09 18:14:35'),
(2, 11, '78c65d36b3b227dc0835fe89d768388f62164aff', '2021-06-10 14:49:07', '2021-06-10 17:49:07'),
(3, 12, '7e02dd0853766f58c61ff1dc743d4e161e97e15f', '2021-06-10 15:19:29', '2021-06-10 18:19:29'),
(4, 13, 'cf96b7dd90462397769fc7bb4431dcb782a64c88', '2021-06-10 15:21:28', '2021-06-10 18:21:28'),
(5, 14, '7d49bb7b7d7937eb6b59a0c3b7f269a0ddc66a83', '2021-06-11 14:06:51', '2021-06-11 17:06:51'),
(6, 15, 'd8875cf1a80ade7eb7411f7a66e2e09255745300', '2021-06-11 15:33:15', '2021-06-11 18:33:15'),
(7, 16, '5bb25976d4ef7db9b79cb1315a3b9a004c8e2434', '2021-06-11 21:49:46', '2021-06-12 00:49:46'),
(8, 17, '59889221a14c372825c3058610237a80b7fa2b68', '2021-06-11 21:55:36', '2021-06-12 00:55:36'),
(9, 18, '5383efa9cba20c1647fd27414dbf02d789096cf7', '2021-06-11 22:04:49', '2021-06-12 01:04:49'),
(10, 19, '02c0cc564a87641ac46e87e754e502da5e6b7346', '2021-06-12 09:20:07', '2021-06-12 12:20:07'),
(11, 20, 'df7cf353e760829038ccc00a463fcfd027c91458', '2021-07-07 12:39:22', '2021-07-07 15:39:22'),
(12, 21, '8a99c5048768bf09d8d44196b2d603674789c623', '2021-07-07 12:41:13', '2021-07-07 15:41:13'),
(13, 22, '1c9fd2f1f1ccaa7127ad3f17009b2c7f9ef7f5ca', '2021-07-07 12:49:00', '2021-07-07 15:49:00'),
(14, 23, '4f2d04b9ce8126e68c4d052a64672f541d41e897', '2021-07-07 15:13:06', '2021-07-07 18:13:06'),
(15, 24, 'eb161d0554d8b378388f61f4cfafeae5e7af6320', '2021-08-11 09:59:14', '2021-08-11 12:59:14'),
(16, 27, '555343512c3438f3eccfd74e6805149edbf797dd', '2021-08-18 15:34:45', '2021-08-18 18:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `work_experiences`
--

CREATE TABLE `work_experiences` (
  `id` bigint(100) NOT NULL,
  `user_id` bigint(100) UNSIGNED NOT NULL,
  `organisation` varchar(220) NOT NULL,
  `title` varchar(200) NOT NULL,
  `start_year` varchar(200) NOT NULL,
  `end_year` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_experiences`
--

INSERT INTO `work_experiences` (`id`, `user_id`, `organisation`, `title`, `start_year`, `end_year`, `created_at`, `updated_at`) VALUES
(1, 24, 'F.S KINABO AND COMPANY ADVOCATES', 'LEGAL OFFICER', '2019', '2021', '2021-08-17 19:35:29', '2021-08-17 19:35:29'),
(2, 27, 'EMMA ADVOCATE', 'LAW OFFICER', '2019', '2021', '2021-08-18 15:50:37', '2021-08-18 15:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`id`, `name`, `location_id`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Arusha Zone', 1, 'ARS', '2021-05-03 18:55:05', '2021-05-03 18:55:05'),
(2, 'Bukoba Zone', 1, 'BKA', '2021-05-03 19:55:52', '2021-05-03 20:58:14'),
(4, 'Mtwara Zone', 1, 'MTR', '2021-05-03 22:58:10', '2021-05-03 22:58:10'),
(5, 'Tabora Zone', 1, 'TBR', '2021-05-04 06:36:13', '2021-05-04 06:37:02'),
(6, 'Dar es Salaam Zone', 1, 'DSM', '2021-05-06 17:31:43', '2021-05-06 17:31:43'),
(7, 'Mwanza Zone', 1, 'MZA', '2021-05-06 23:24:16', '2021-05-06 23:24:16'),
(8, 'Mbeya Zone', 1, 'MBY', '2021-05-06 23:24:36', '2021-05-06 23:24:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_complainant`
--
ALTER TABLE `admission_complainant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admission_complainant_admission_id_foreign` (`admission_id`),
  ADD KEY `admission_complainant_complainant_id_foreign` (`complainant_id`);

--
-- Indexes for table `admission_respondent`
--
ALTER TABLE `admission_respondent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admission_respondent_admission_id_foreign` (`admission_id`),
  ADD KEY `admission_respondent_respondent_id_foreign` (`respondent_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_moves`
--
ALTER TABLE `application_moves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachment_moves`
--
ALTER TABLE `attachment_moves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `districts_name_unique` (`name`),
  ADD KEY `districts_region_id_foreign` (`region_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firms`
--
ALTER TABLE `firms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firm_addresses`
--
ALTER TABLE `firm_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firm_memberships`
--
ALTER TABLE `firm_memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `llb_colleges`
--
ALTER TABLE `llb_colleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lst_colleges`
--
ALTER TABLE `lst_colleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petition_forms`
--
ALTER TABLE `petition_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regions_name_unique` (`name`),
  ADD KEY `regions_zone_id_foreign` (`zone_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `verify_users`
--
ALTER TABLE `verify_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_verifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `work_experiences`
--
ALTER TABLE `work_experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `zones_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission_complainant`
--
ALTER TABLE `admission_complainant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admission_respondent`
--
ALTER TABLE `admission_respondent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `application_moves`
--
ALTER TABLE `application_moves`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attachment_moves`
--
ALTER TABLE `attachment_moves`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(220) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `firms`
--
ALTER TABLE `firms`
  MODIFY `id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `firm_addresses`
--
ALTER TABLE `firm_addresses`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `firm_memberships`
--
ALTER TABLE `firm_memberships`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `llb_colleges`
--
ALTER TABLE `llb_colleges`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lst_colleges`
--
ALTER TABLE `lst_colleges`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `petition_forms`
--
ALTER TABLE `petition_forms`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `verify_users`
--
ALTER TABLE `verify_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `work_experiences`
--
ALTER TABLE `work_experiences`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admission_complainant`
--
ALTER TABLE `admission_complainant`
  ADD CONSTRAINT `admission_complainant_admission_id_foreign` FOREIGN KEY (`admission_id`) REFERENCES `admissions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admission_complainant_complainant_id_foreign` FOREIGN KEY (`complainant_id`) REFERENCES `complainants` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `admission_respondent`
--
ALTER TABLE `admission_respondent`
  ADD CONSTRAINT `admission_respondent_admission_id_foreign` FOREIGN KEY (`admission_id`) REFERENCES `admissions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admission_respondent_respondent_id_foreign` FOREIGN KEY (`respondent_id`) REFERENCES `respondents` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_zone_id_foreign` FOREIGN KEY (`zone_id`) REFERENCES `zones` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `verify_users`
--
ALTER TABLE `verify_users`
  ADD CONSTRAINT `user_verifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
