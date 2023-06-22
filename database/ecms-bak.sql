-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2021 at 02:47 PM
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
-- Database: `ecms-bak`
--

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filing_date` date NOT NULL,
  `case_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_summary` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `prayers` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `case_subtype_id` bigint(20) UNSIGNED DEFAULT NULL,
  `court_submission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `court_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admission_charge`
--

CREATE TABLE `admission_charge` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `charge_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `admission_nature`
--

CREATE TABLE `admission_nature` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nature_id` bigint(20) UNSIGNED DEFAULT NULL,
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
-- Table structure for table `admission_victim`
--

CREATE TABLE `admission_victim` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `victim_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advocates`
--

CREATE TABLE `advocates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roll_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `firm_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attorneys`
--

CREATE TABLE `attorneys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `firm_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `case_outcomes`
--

CREATE TABLE `case_outcomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_register_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mode_determination_id` bigint(20) UNSIGNED DEFAULT NULL,
  `proceeding_outcome_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `case_registers`
--

CREATE TABLE `case_registers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `case_stages`
--

CREATE TABLE `case_stages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_register_id` bigint(20) UNSIGNED DEFAULT NULL,
  `proceeding_outcome_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `case_subtypes`
--

CREATE TABLE `case_subtypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_register_id` bigint(20) UNSIGNED DEFAULT NULL,
  `case_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `case_types`
--

CREATE TABLE `case_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_register_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_register_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `charge_criminal`
--

CREATE TABLE `charge_criminal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `criminal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `charge_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complainants`
--

CREATE TABLE `complainants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NIN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appeared_as` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complainant_criminal`
--

CREATE TABLE `complainant_criminal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `criminal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `complainant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courts`
--

CREATE TABLE `courts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_sp_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `court_level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `zone_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `court_levels`
--

CREATE TABLE `court_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `court_rooms`
--

CREATE TABLE `court_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `court_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `court_submissions`
--

CREATE TABLE `court_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_register_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `criminals`
--

CREATE TABLE `criminals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filing_date` date NOT NULL,
  `case_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_ref_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prayers` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `case_subtype_id` bigint(20) UNSIGNED DEFAULT NULL,
  `court_submission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `court_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `criminal_nature`
--

CREATE TABLE `criminal_nature` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `criminal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nature_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `criminal_respondent`
--

CREATE TABLE `criminal_respondent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `criminal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `respondent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `criminal_victim`
--

CREATE TABLE `criminal_victim` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `criminal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `victim_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `firms`
--

CREATE TABLE `firms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2021_03_23_143955_create_permission_tables', 1),
(5, '2021_03_25_124849_create_court_levels_table', 1),
(6, '2021_03_26_081732_create_zones_table', 1),
(7, '2021_03_26_081909_create_regions_table', 1),
(8, '2021_03_26_081923_create_districts_table', 1),
(9, '2021_03_27_163148_create_courts_table', 1),
(10, '2021_03_27_222539_create_court_rooms_table', 1),
(11, '2021_03_28_134318_create_case_registers_table', 1),
(12, '2021_03_28_134330_create_case_types_table', 1),
(13, '2021_03_28_134338_create_case_subtypes_table', 1),
(14, '2021_03_28_163719_create_mode_determinations_table', 1),
(15, '2021_03_28_174249_create_proceeding_outcomes_table', 1),
(16, '2021_03_28_214209_create_case_stages_table', 1),
(17, '2021_03_28_230033_create_case_outcomes_table', 1),
(18, '2021_03_29_001825_create_natures_table', 1),
(19, '2021_03_29_085849_create_charges_table', 1),
(20, '2021_03_29_220453_create_officer_groups_table', 1),
(21, '2021_03_29_225430_create_officer_positions_table', 1),
(22, '2021_03_29_225610_create_seniorities_table', 1),
(23, '2021_03_30_141706_create_officers_table', 1),
(24, '2021_04_01_130814_create_court_submissions_table', 1),
(25, '2021_04_01_171955_create_criminals_table', 1),
(26, '2021_04_12_145654_create_criminal_nature_table', 1),
(27, '2021_04_13_140656_create_charge_criminal_table', 1),
(28, '2021_04_15_105610_create_complainants_table', 1),
(29, '2021_04_15_105636_create_respondents_table', 1),
(30, '2021_04_15_111230_create_complainant_criminal_table', 1),
(31, '2021_04_15_111248_create_criminal_respondent_table', 1),
(32, '2021_04_15_135623_create_victims_table', 1),
(33, '2021_04_15_140110_create_criminal_victim_table', 1),
(34, '2021_04_16_144852_create_profiles_table', 1),
(35, '2021_04_18_010117_create_firms_table', 1),
(36, '2021_04_18_010155_create_advocates_table', 1),
(37, '2021_04_18_010209_create_attorneys_table', 1),
(38, '2021_04_19_221618_create_admissions_table', 1),
(39, '2021_04_19_225130_create_admission_nature_table', 1),
(40, '2021_04_19_225143_create_admission_charge_table', 1),
(41, '2021_04_19_231533_create_admission_complainant_table', 1),
(42, '2021_04_19_231553_create_admission_respondent_table', 1),
(43, '2021_04_19_232951_create_admission_victim_table', 1),
(44, '2021_04_21_013151_create_documents_table', 1),
(45, '2021_04_21_212216_create_user_verifications_table', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `mode_determinations`
--

CREATE TABLE `mode_determinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_register_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `natures`
--

CREATE TABLE `natures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_register_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `officer_group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `officer_position_id` bigint(20) UNSIGNED DEFAULT NULL,
  `seniority_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `officer_groups`
--

CREATE TABLE `officer_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `officer_positions`
--

CREATE TABLE `officer_positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `officer_group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'view roles', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(2, 'add roles', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(3, 'edit roles', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(4, 'delete roles', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(5, 'view permissions', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(6, 'view users', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(7, 'add users', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(8, 'edit users', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(9, 'delete users', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(10, 'view profile', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(11, 'edit profile', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(12, 'view criminal cases', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(13, 'add criminal cases', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(14, 'edit criminal cases', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(15, 'delete criminal cases', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(16, 'view court levels', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(17, 'add court levels', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(18, 'edit court levels', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(19, 'delete court levels', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(20, 'view locations', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(21, 'add locations', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(22, 'edit locations', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(23, 'delete locations', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(24, 'view courts', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(25, 'add courts', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(26, 'edit courts', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(27, 'delete courts', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(28, 'view court rooms', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(29, 'add court rooms', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(30, 'edit court rooms', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(31, 'delete court rooms', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(32, 'view court registry', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(33, 'add court registry', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(34, 'edit court registry', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(35, 'delete court registry', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(36, 'view case types', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(37, 'add case types', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(38, 'edit case types', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(39, 'delete case types', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(40, 'view case subtypes', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(41, 'add case subtypes', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(42, 'edit case subtypes', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(43, 'delete case subtypes', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(44, 'view case stages', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(45, 'add case stages', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(46, 'edit case stages', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(47, 'delete case stages', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(48, 'view case outcomes', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(49, 'add case outcomes', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(50, 'edit case outcomes', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(51, 'delete case outcomes', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(52, 'view nature of cases', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(53, 'add nature of cases', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(54, 'edit nature of cases', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(55, 'delete nature of cases', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(56, 'view charges', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(57, 'add charges', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(58, 'edit charges', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(59, 'delete charges', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(60, 'view court fees', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(61, 'add court fees', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(62, 'edit court fees', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(63, 'delete court fees', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(64, 'view proceeding outcomes', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(65, 'add proceeding outcomes', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(66, 'edit proceeding outcomes', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(67, 'delete proceeding outcomes', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(68, 'view mode of determinations', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(69, 'add mode of determinations', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(70, 'edit mode of determinations', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(71, 'delete mode of determinations', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39');

-- --------------------------------------------------------

--
-- Table structure for table `proceeding_outcomes`
--

CREATE TABLE `proceeding_outcomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salutation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second_salutation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `court_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `respondents`
--

CREATE TABLE `respondents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NIN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appeared_as` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'super-admin', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(2, 'admin', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(3, 'judge', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(4, 'registrar', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(5, 'magistrate', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(6, 'advocate', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(7, 'attorney', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(8, 'litigant', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39'),
(9, 'court-clerk', 'api', '2021-04-26 10:27:39', '2021-04-26 10:27:39');

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
(71, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seniorities`
--

CREATE TABLE `seniorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `officer_position_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activated',
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `status`, `verified`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@email.com', NULL, '$2y$10$lQ5M2ra/TmvNH6rOvA9gD.vIgjkFpo7n80zh9HsopfuRAl3NpcdJO', 'activated', 0, NULL, '2021-04-26 10:27:40', '2021-04-26 10:27:40'),
(2, NULL, 'email@email.com', NULL, '$2y$10$/9rmafTNFXLivkuhX5TN0uiIRk/EzqRSbZWk4x2mvC4oW4gWWpgga', 'activated', 0, NULL, '2021-04-26 10:29:33', '2021-04-26 10:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_verifications`
--

CREATE TABLE `user_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `victims`
--

CREATE TABLE `victims` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NIN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admissions_reference_unique` (`reference`),
  ADD KEY `admissions_case_subtype_id_foreign` (`case_subtype_id`),
  ADD KEY `admissions_court_submission_id_foreign` (`court_submission_id`),
  ADD KEY `admissions_court_id_foreign` (`court_id`),
  ADD KEY `admissions_district_id_foreign` (`district_id`),
  ADD KEY `admissions_profile_id_foreign` (`profile_id`),
  ADD KEY `admissions_id_index` (`id`);

--
-- Indexes for table `admission_charge`
--
ALTER TABLE `admission_charge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admission_charge_admission_id_foreign` (`admission_id`),
  ADD KEY `admission_charge_charge_id_foreign` (`charge_id`),
  ADD KEY `admission_charge_id_index` (`id`);

--
-- Indexes for table `admission_complainant`
--
ALTER TABLE `admission_complainant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admission_complainant_admission_id_foreign` (`admission_id`),
  ADD KEY `admission_complainant_complainant_id_foreign` (`complainant_id`);

--
-- Indexes for table `admission_nature`
--
ALTER TABLE `admission_nature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admission_nature_admission_id_foreign` (`admission_id`),
  ADD KEY `admission_nature_nature_id_foreign` (`nature_id`),
  ADD KEY `admission_nature_id_index` (`id`);

--
-- Indexes for table `admission_respondent`
--
ALTER TABLE `admission_respondent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admission_respondent_admission_id_foreign` (`admission_id`),
  ADD KEY `admission_respondent_respondent_id_foreign` (`respondent_id`);

--
-- Indexes for table `admission_victim`
--
ALTER TABLE `admission_victim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admission_victim_admission_id_foreign` (`admission_id`),
  ADD KEY `admission_victim_victim_id_foreign` (`victim_id`);

--
-- Indexes for table `advocates`
--
ALTER TABLE `advocates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `advocates_roll_number_unique` (`roll_number`),
  ADD UNIQUE KEY `advocates_email_unique` (`email`),
  ADD KEY `advocates_firm_id_foreign` (`firm_id`);

--
-- Indexes for table `attorneys`
--
ALTER TABLE `attorneys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attorneys_nin_unique` (`nin`),
  ADD UNIQUE KEY `attorneys_email_unique` (`email`),
  ADD KEY `attorneys_firm_id_foreign` (`firm_id`);

--
-- Indexes for table `case_outcomes`
--
ALTER TABLE `case_outcomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_outcomes_case_register_id_foreign` (`case_register_id`),
  ADD KEY `case_outcomes_mode_determination_id_foreign` (`mode_determination_id`),
  ADD KEY `case_outcomes_proceeding_outcome_id_foreign` (`proceeding_outcome_id`);

--
-- Indexes for table `case_registers`
--
ALTER TABLE `case_registers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `case_registers_name_unique` (`name`);

--
-- Indexes for table `case_stages`
--
ALTER TABLE `case_stages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_stages_case_register_id_foreign` (`case_register_id`),
  ADD KEY `case_stages_proceeding_outcome_id_foreign` (`proceeding_outcome_id`);

--
-- Indexes for table `case_subtypes`
--
ALTER TABLE `case_subtypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `case_subtypes_name_unique` (`name`),
  ADD KEY `case_subtypes_case_register_id_foreign` (`case_register_id`),
  ADD KEY `case_subtypes_case_type_id_foreign` (`case_type_id`);

--
-- Indexes for table `case_types`
--
ALTER TABLE `case_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `case_types_name_unique` (`name`),
  ADD KEY `case_types_case_register_id_foreign` (`case_register_id`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `charges_name_unique` (`name`),
  ADD KEY `charges_case_register_id_foreign` (`case_register_id`);

--
-- Indexes for table `charge_criminal`
--
ALTER TABLE `charge_criminal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `charge_criminal_criminal_id_foreign` (`criminal_id`),
  ADD KEY `charge_criminal_charge_id_foreign` (`charge_id`),
  ADD KEY `charge_criminal_id_index` (`id`);

--
-- Indexes for table `complainants`
--
ALTER TABLE `complainants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `complainants_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `complainants_nin_unique` (`NIN`),
  ADD UNIQUE KEY `complainants_email_unique` (`email`);

--
-- Indexes for table `complainant_criminal`
--
ALTER TABLE `complainant_criminal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complainant_criminal_criminal_id_foreign` (`criminal_id`),
  ADD KEY `complainant_criminal_complainant_id_foreign` (`complainant_id`);

--
-- Indexes for table `courts`
--
ALTER TABLE `courts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courts_name_unique` (`name`),
  ADD KEY `courts_court_level_id_foreign` (`court_level_id`),
  ADD KEY `courts_zone_id_foreign` (`zone_id`),
  ADD KEY `courts_district_id_foreign` (`district_id`);

--
-- Indexes for table `court_levels`
--
ALTER TABLE `court_levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `court_levels_name_unique` (`name`);

--
-- Indexes for table `court_rooms`
--
ALTER TABLE `court_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `court_rooms_court_id_foreign` (`court_id`);

--
-- Indexes for table `court_submissions`
--
ALTER TABLE `court_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `court_submissions_case_register_id_foreign` (`case_register_id`);

--
-- Indexes for table `criminals`
--
ALTER TABLE `criminals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `criminals_case_ref_number_unique` (`case_ref_number`),
  ADD KEY `criminals_case_subtype_id_foreign` (`case_subtype_id`),
  ADD KEY `criminals_court_submission_id_foreign` (`court_submission_id`),
  ADD KEY `criminals_court_id_foreign` (`court_id`),
  ADD KEY `criminals_district_id_foreign` (`district_id`),
  ADD KEY `criminals_id_index` (`id`);

--
-- Indexes for table `criminal_nature`
--
ALTER TABLE `criminal_nature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `criminal_nature_criminal_id_foreign` (`criminal_id`),
  ADD KEY `criminal_nature_nature_id_foreign` (`nature_id`),
  ADD KEY `criminal_nature_id_index` (`id`);

--
-- Indexes for table `criminal_respondent`
--
ALTER TABLE `criminal_respondent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `criminal_respondent_criminal_id_foreign` (`criminal_id`),
  ADD KEY `criminal_respondent_respondent_id_foreign` (`respondent_id`);

--
-- Indexes for table `criminal_victim`
--
ALTER TABLE `criminal_victim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `criminal_victim_criminal_id_foreign` (`criminal_id`),
  ADD KEY `criminal_victim_victim_id_foreign` (`victim_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documents_name_unique` (`name`),
  ADD KEY `documents_admission_id_foreign` (`admission_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firms`
--
ALTER TABLE `firms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `firms_email_unique` (`email`),
  ADD KEY `firms_district_id_foreign` (`district_id`);

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
-- Indexes for table `mode_determinations`
--
ALTER TABLE `mode_determinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mode_determinations_case_register_id_foreign` (`case_register_id`);

--
-- Indexes for table `natures`
--
ALTER TABLE `natures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `natures_case_register_id_foreign` (`case_register_id`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `officers_user_id_unique` (`user_id`),
  ADD KEY `officers_officer_group_id_foreign` (`officer_group_id`),
  ADD KEY `officers_officer_position_id_foreign` (`officer_position_id`),
  ADD KEY `officers_seniority_id_foreign` (`seniority_id`);

--
-- Indexes for table `officer_groups`
--
ALTER TABLE `officer_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `officer_groups_name_unique` (`name`);

--
-- Indexes for table `officer_positions`
--
ALTER TABLE `officer_positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `officer_positions_name_unique` (`name`),
  ADD KEY `officer_positions_officer_group_id_foreign` (`officer_group_id`);

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
-- Indexes for table `proceeding_outcomes`
--
ALTER TABLE `proceeding_outcomes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proceeding_outcomes_name_unique` (`name`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regions_name_unique` (`name`),
  ADD KEY `regions_zone_id_foreign` (`zone_id`);

--
-- Indexes for table `respondents`
--
ALTER TABLE `respondents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `respondents_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `respondents_nin_unique` (`NIN`),
  ADD UNIQUE KEY `respondents_email_unique` (`email`);

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
-- Indexes for table `seniorities`
--
ALTER TABLE `seniorities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seniorities_name_unique` (`name`),
  ADD KEY `seniorities_officer_position_id_foreign` (`officer_position_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_verifications`
--
ALTER TABLE `user_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_verifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `victims`
--
ALTER TABLE `victims`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `victims_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `victims_nin_unique` (`NIN`);

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
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admission_charge`
--
ALTER TABLE `admission_charge`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admission_complainant`
--
ALTER TABLE `admission_complainant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admission_nature`
--
ALTER TABLE `admission_nature`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admission_respondent`
--
ALTER TABLE `admission_respondent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admission_victim`
--
ALTER TABLE `admission_victim`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advocates`
--
ALTER TABLE `advocates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attorneys`
--
ALTER TABLE `attorneys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `case_outcomes`
--
ALTER TABLE `case_outcomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `case_registers`
--
ALTER TABLE `case_registers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `case_stages`
--
ALTER TABLE `case_stages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `case_subtypes`
--
ALTER TABLE `case_subtypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `case_types`
--
ALTER TABLE `case_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `charge_criminal`
--
ALTER TABLE `charge_criminal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complainants`
--
ALTER TABLE `complainants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complainant_criminal`
--
ALTER TABLE `complainant_criminal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courts`
--
ALTER TABLE `courts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `court_levels`
--
ALTER TABLE `court_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `court_rooms`
--
ALTER TABLE `court_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `court_submissions`
--
ALTER TABLE `court_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `criminals`
--
ALTER TABLE `criminals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `criminal_nature`
--
ALTER TABLE `criminal_nature`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `criminal_respondent`
--
ALTER TABLE `criminal_respondent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `criminal_victim`
--
ALTER TABLE `criminal_victim`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `firms`
--
ALTER TABLE `firms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `mode_determinations`
--
ALTER TABLE `mode_determinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `natures`
--
ALTER TABLE `natures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `officer_groups`
--
ALTER TABLE `officer_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `officer_positions`
--
ALTER TABLE `officer_positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `proceeding_outcomes`
--
ALTER TABLE `proceeding_outcomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `respondents`
--
ALTER TABLE `respondents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `seniorities`
--
ALTER TABLE `seniorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_verifications`
--
ALTER TABLE `user_verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `victims`
--
ALTER TABLE `victims`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admissions`
--
ALTER TABLE `admissions`
  ADD CONSTRAINT `admissions_case_subtype_id_foreign` FOREIGN KEY (`case_subtype_id`) REFERENCES `case_subtypes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admissions_court_id_foreign` FOREIGN KEY (`court_id`) REFERENCES `courts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admissions_court_submission_id_foreign` FOREIGN KEY (`court_submission_id`) REFERENCES `court_submissions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admissions_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admissions_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `admission_charge`
--
ALTER TABLE `admission_charge`
  ADD CONSTRAINT `admission_charge_admission_id_foreign` FOREIGN KEY (`admission_id`) REFERENCES `admissions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admission_charge_charge_id_foreign` FOREIGN KEY (`charge_id`) REFERENCES `charges` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `admission_complainant`
--
ALTER TABLE `admission_complainant`
  ADD CONSTRAINT `admission_complainant_admission_id_foreign` FOREIGN KEY (`admission_id`) REFERENCES `admissions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admission_complainant_complainant_id_foreign` FOREIGN KEY (`complainant_id`) REFERENCES `complainants` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `admission_nature`
--
ALTER TABLE `admission_nature`
  ADD CONSTRAINT `admission_nature_admission_id_foreign` FOREIGN KEY (`admission_id`) REFERENCES `admissions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admission_nature_nature_id_foreign` FOREIGN KEY (`nature_id`) REFERENCES `natures` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `admission_respondent`
--
ALTER TABLE `admission_respondent`
  ADD CONSTRAINT `admission_respondent_admission_id_foreign` FOREIGN KEY (`admission_id`) REFERENCES `admissions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admission_respondent_respondent_id_foreign` FOREIGN KEY (`respondent_id`) REFERENCES `respondents` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `admission_victim`
--
ALTER TABLE `admission_victim`
  ADD CONSTRAINT `admission_victim_admission_id_foreign` FOREIGN KEY (`admission_id`) REFERENCES `admissions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admission_victim_victim_id_foreign` FOREIGN KEY (`victim_id`) REFERENCES `victims` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `advocates`
--
ALTER TABLE `advocates`
  ADD CONSTRAINT `advocates_firm_id_foreign` FOREIGN KEY (`firm_id`) REFERENCES `firms` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `attorneys`
--
ALTER TABLE `attorneys`
  ADD CONSTRAINT `attorneys_firm_id_foreign` FOREIGN KEY (`firm_id`) REFERENCES `firms` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `case_outcomes`
--
ALTER TABLE `case_outcomes`
  ADD CONSTRAINT `case_outcomes_case_register_id_foreign` FOREIGN KEY (`case_register_id`) REFERENCES `case_registers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `case_outcomes_mode_determination_id_foreign` FOREIGN KEY (`mode_determination_id`) REFERENCES `mode_determinations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `case_outcomes_proceeding_outcome_id_foreign` FOREIGN KEY (`proceeding_outcome_id`) REFERENCES `proceeding_outcomes` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `case_stages`
--
ALTER TABLE `case_stages`
  ADD CONSTRAINT `case_stages_case_register_id_foreign` FOREIGN KEY (`case_register_id`) REFERENCES `case_registers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `case_stages_proceeding_outcome_id_foreign` FOREIGN KEY (`proceeding_outcome_id`) REFERENCES `proceeding_outcomes` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `case_subtypes`
--
ALTER TABLE `case_subtypes`
  ADD CONSTRAINT `case_subtypes_case_register_id_foreign` FOREIGN KEY (`case_register_id`) REFERENCES `case_registers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `case_subtypes_case_type_id_foreign` FOREIGN KEY (`case_type_id`) REFERENCES `case_types` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `case_types`
--
ALTER TABLE `case_types`
  ADD CONSTRAINT `case_types_case_register_id_foreign` FOREIGN KEY (`case_register_id`) REFERENCES `case_registers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `charges`
--
ALTER TABLE `charges`
  ADD CONSTRAINT `charges_case_register_id_foreign` FOREIGN KEY (`case_register_id`) REFERENCES `case_registers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `charge_criminal`
--
ALTER TABLE `charge_criminal`
  ADD CONSTRAINT `charge_criminal_charge_id_foreign` FOREIGN KEY (`charge_id`) REFERENCES `charges` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `charge_criminal_criminal_id_foreign` FOREIGN KEY (`criminal_id`) REFERENCES `criminals` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `complainant_criminal`
--
ALTER TABLE `complainant_criminal`
  ADD CONSTRAINT `complainant_criminal_complainant_id_foreign` FOREIGN KEY (`complainant_id`) REFERENCES `complainants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `complainant_criminal_criminal_id_foreign` FOREIGN KEY (`criminal_id`) REFERENCES `criminals` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `courts`
--
ALTER TABLE `courts`
  ADD CONSTRAINT `courts_court_level_id_foreign` FOREIGN KEY (`court_level_id`) REFERENCES `court_levels` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `courts_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `courts_zone_id_foreign` FOREIGN KEY (`zone_id`) REFERENCES `zones` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `court_rooms`
--
ALTER TABLE `court_rooms`
  ADD CONSTRAINT `court_rooms_court_id_foreign` FOREIGN KEY (`court_id`) REFERENCES `courts` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `court_submissions`
--
ALTER TABLE `court_submissions`
  ADD CONSTRAINT `court_submissions_case_register_id_foreign` FOREIGN KEY (`case_register_id`) REFERENCES `case_registers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `criminals`
--
ALTER TABLE `criminals`
  ADD CONSTRAINT `criminals_case_subtype_id_foreign` FOREIGN KEY (`case_subtype_id`) REFERENCES `case_subtypes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `criminals_court_id_foreign` FOREIGN KEY (`court_id`) REFERENCES `courts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `criminals_court_submission_id_foreign` FOREIGN KEY (`court_submission_id`) REFERENCES `court_submissions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `criminals_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `criminal_nature`
--
ALTER TABLE `criminal_nature`
  ADD CONSTRAINT `criminal_nature_criminal_id_foreign` FOREIGN KEY (`criminal_id`) REFERENCES `criminals` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `criminal_nature_nature_id_foreign` FOREIGN KEY (`nature_id`) REFERENCES `natures` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `criminal_respondent`
--
ALTER TABLE `criminal_respondent`
  ADD CONSTRAINT `criminal_respondent_criminal_id_foreign` FOREIGN KEY (`criminal_id`) REFERENCES `criminals` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `criminal_respondent_respondent_id_foreign` FOREIGN KEY (`respondent_id`) REFERENCES `respondents` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `criminal_victim`
--
ALTER TABLE `criminal_victim`
  ADD CONSTRAINT `criminal_victim_criminal_id_foreign` FOREIGN KEY (`criminal_id`) REFERENCES `criminals` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `criminal_victim_victim_id_foreign` FOREIGN KEY (`victim_id`) REFERENCES `victims` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_admission_id_foreign` FOREIGN KEY (`admission_id`) REFERENCES `admissions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `firms`
--
ALTER TABLE `firms`
  ADD CONSTRAINT `firms_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE SET NULL;

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
-- Constraints for table `mode_determinations`
--
ALTER TABLE `mode_determinations`
  ADD CONSTRAINT `mode_determinations_case_register_id_foreign` FOREIGN KEY (`case_register_id`) REFERENCES `case_registers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `natures`
--
ALTER TABLE `natures`
  ADD CONSTRAINT `natures_case_register_id_foreign` FOREIGN KEY (`case_register_id`) REFERENCES `case_registers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `officers`
--
ALTER TABLE `officers`
  ADD CONSTRAINT `officers_officer_group_id_foreign` FOREIGN KEY (`officer_group_id`) REFERENCES `officer_groups` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `officers_officer_position_id_foreign` FOREIGN KEY (`officer_position_id`) REFERENCES `officer_positions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `officers_seniority_id_foreign` FOREIGN KEY (`seniority_id`) REFERENCES `seniorities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `officers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `officer_positions`
--
ALTER TABLE `officer_positions`
  ADD CONSTRAINT `officer_positions_officer_group_id_foreign` FOREIGN KEY (`officer_group_id`) REFERENCES `officer_groups` (`id`) ON DELETE SET NULL;

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
-- Constraints for table `seniorities`
--
ALTER TABLE `seniorities`
  ADD CONSTRAINT `seniorities_officer_position_id_foreign` FOREIGN KEY (`officer_position_id`) REFERENCES `officer_positions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_verifications`
--
ALTER TABLE `user_verifications`
  ADD CONSTRAINT `user_verifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
