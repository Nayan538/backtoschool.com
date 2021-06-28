-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2020 at 12:10 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems_rdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ems_admins`
--

CREATE TABLE `ems_admins` (
  `id` int(11) NOT NULL COMMENT 'ADMINS ID',
  `admin_id` varchar(32) NOT NULL,
  `admin_name` varchar(128) NOT NULL,
  `admin_email` varchar(64) NOT NULL,
  `admin_password` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `admin_phone_no` varchar(32) NOT NULL,
  `admin_type` enum('Root Administrator','Academic Administrator','Accounts Administrator','Users & System Administrator','Sales & Marketing Administrator') NOT NULL,
  `admin_status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `admin_image` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_admins`
--

INSERT INTO `ems_admins` (`id`, `admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_phone_no`, `admin_type`, `admin_status`, `admin_image`, `created_at`, `updated_at`) VALUES
(1, 'EMS#490-AD', 'Nirjhor Anjum Sir', 'nirjhor@adnsl.net', '6bf984e5ac5495f4bf891a740d9bd02184eec7d7', '01955778822', 'Root Administrator', 'Active', 'ADMIN2020JulSunIMAGE222nirjhoranjumsir.png', '2020-07-26 04:05:26', NULL),
(2, 'EMS#948-AD', 'Md. Abdullah Al Mamun', 'md.aamroni@hotmail.com', '76742e98b788b5d69ca1f5afd691e8bb653f1ae4', '01316440504', 'Root Administrator', 'Active', 'ADMIN2020JulSunIMAGE325aamroni.png', '2020-07-26 04:06:06', NULL),
(3, 'EMS#109-AD', 'Academic Moderator', 'admin.academic@gmail.com', '6bf984e5ac5495f4bf891a740d9bd02184eec7d7', '01316440504', 'Academic Administrator', 'Inactive', 'ADMIN2020JulSunIMAGE815avatar.png', '2020-07-26 04:08:35', '2020-07-26 04:09:34'),
(4, 'EMS#482-AD', 'Accounts Moderator', 'admin.accounts@gmail.com', '6bf984e5ac5495f4bf891a740d9bd02184eec7d7', '01316440504', 'Accounts Administrator', 'Inactive', 'ADMIN2020JulSunIMAGE965avatar.png', '2020-07-26 04:09:22', NULL),
(5, 'EMS#804-AD', 'User System Moderator', 'admin.usersystem@gmail.com', '6bf984e5ac5495f4bf891a740d9bd02184eec7d7', '01316440504', 'Users & System Administrator', 'Inactive', 'ADMIN2020JulSunIMAGE901avatar.png', '2020-07-26 04:10:41', NULL),
(6, 'EMS#389-AD', 'Marketing Moderator', 'admin.marketing@gmail.com', '6bf984e5ac5495f4bf891a740d9bd02184eec7d7', '01316440504', 'Sales & Marketing Administrator', 'Inactive', 'ADMIN2020JulSunIMAGE830avatar.png', '2020-07-26 04:11:36', '2020-07-26 04:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `ems_admission_fees`
--

CREATE TABLE `ems_admission_fees` (
  `id` int(11) NOT NULL COMMENT 'ADMISSION FEES',
  `student_id` int(11) NOT NULL,
  `admission_fees` double NOT NULL,
  `application_form_fees` double NOT NULL,
  `id_card_fees` double NOT NULL,
  `library_fees` double NOT NULL,
  `other_fees` double NOT NULL,
  `total_fees_amount` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_admission_fees`
--

INSERT INTO `ems_admission_fees` (`id`, `student_id`, `admission_fees`, `application_form_fees`, `id_card_fees`, `library_fees`, `other_fees`, `total_fees_amount`, `created_at`, `updated_at`) VALUES
(1, 6, 1850, 350, 120, 240, 300, 2860, '2020-07-29 06:45:25', NULL),
(2, 8, 1850, 350, 120, 240, 300, 2860, '2020-07-29 07:03:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_blogs`
--

CREATE TABLE `ems_blogs` (
  `id` int(11) NOT NULL COMMENT 'BLOG ID',
  `blog_title` varchar(512) NOT NULL,
  `blog_details` text NOT NULL,
  `blog_image` text NOT NULL,
  `blog_tags` varchar(512) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_blogs`
--

INSERT INTO `ems_blogs` (`id`, `blog_title`, `blog_details`, `blog_image`, `blog_tags`, `created_at`, `updated_at`) VALUES
(10, 'Lorem ipsum dolor sit amet, consectetur', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Accumsan in nisl nisi scelerisque eu ultrices vitae auctor. Viverra nam libero justo laoreet ...<br></p>', 'BLOG_20200801_IMAGES_7302gallary(1).jpg', 'lorem,ipsum', '2020-08-01 00:03:36', NULL),
(11, 'Lorem ipsum dolor sit amet, consectetur', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Accumsan in nisl nisi scelerisque eu ultrices vitae auctor. Viverra nam libero justo<br></p>', 'BLOG_20200801_IMAGES_6099gallary(4).jpg', 'lorem,ipsum', '2020-08-01 00:04:19', NULL),
(12, 'Lorem ipsum dolor sit amet, consectetur', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Accumsan in nisl nisi scelerisque eu ultrices vitae auctor. Viverra nam libero justo laoreet<br></p>', 'BLOG_20200801_IMAGES_2207gallary(1).png', 'lorem,ipsum', '2020-08-01 00:04:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_classes`
--

CREATE TABLE `ems_classes` (
  `id` int(11) NOT NULL COMMENT 'CLASSES ID',
  `class_name` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_classes`
--

INSERT INTO `ems_classes` (`id`, `class_name`, `created_at`, `updated_at`) VALUES
(1, 'Class Nursery', '2020-07-14 21:01:55', NULL),
(2, 'Class One', '2020-07-14 21:02:00', NULL),
(3, 'Class Two', '2020-07-14 21:02:06', NULL),
(4, 'Class Three', '2020-07-14 21:02:12', NULL),
(5, 'Class Four', '2020-07-14 21:02:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_class_routine`
--

CREATE TABLE `ems_class_routine` (
  `id` int(11) NOT NULL COMMENT 'CLASS ROUTINE ID',
  `day_name` enum('Friday','Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday') NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_class_routine`
--

INSERT INTO `ems_class_routine` (`id`, `day_name`, `class_id`, `subject_id`, `shift_id`, `teacher_id`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(6, 'Monday', 1, 1, 1, 6, '07:30:00', '08:00:00', '2020-07-27 07:50:09', NULL),
(7, 'Monday', 1, 2, 1, 3, '08:00:00', '08:30:00', '2020-07-27 07:50:47', NULL),
(8, 'Tuesday', 2, 3, 1, 7, '07:30:00', '08:00:00', '2020-07-27 08:10:52', NULL),
(9, 'Wednesday', 2, 4, 1, 4, '08:00:00', '08:30:00', '2020-07-27 08:12:03', NULL),
(10, 'Thursday', 2, 2, 1, 1, '08:30:00', '09:00:00', '2020-07-27 08:13:22', NULL),
(11, 'Saturday', 1, 3, 1, 7, '08:30:00', '09:00:00', '2020-07-27 08:14:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_contact_config`
--

CREATE TABLE `ems_contact_config` (
  `id` int(11) NOT NULL COMMENT 'CONTACT CONFIG ID',
  `image` text NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `designation` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `fax` varchar(32) DEFAULT NULL,
  `phone` varchar(32) NOT NULL,
  `telephone` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_contact_config`
--

INSERT INTO `ems_contact_config` (`id`, `image`, `full_name`, `designation`, `email`, `fax`, `phone`, `telephone`, `created_at`, `updated_at`) VALUES
(2, 'CONTACT_20200725_PERSON_668avatar(1).png', 'Md. Abdullah Al Mamun Roni', 'Full Stack Web Developer', 'md.aamroni@yahoo.com', '9130496', '01316440504', '8110081', '2020-07-25 09:29:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_create_payments`
--

CREATE TABLE `ems_create_payments` (
  `id` int(11) NOT NULL COMMENT 'CREATE PAYMENT ID',
  `payment_id` varchar(128) NOT NULL,
  `payee_name` varchar(128) NOT NULL,
  `payee_org` varchar(256) NOT NULL,
  `payee_email` varchar(64) NOT NULL,
  `payee_phone` varchar(13) NOT NULL,
  `payee_address` varchar(256) NOT NULL,
  `bank_name` varchar(256) DEFAULT NULL,
  `bank_account_no` varchar(256) DEFAULT NULL,
  `bank_swift_code` varchar(128) DEFAULT NULL,
  `branch_name` varchar(256) DEFAULT NULL,
  `bank_address` varchar(256) DEFAULT NULL,
  `tax_total` double DEFAULT NULL,
  `payment_subtotal` double NOT NULL,
  `payment_grandtotal` double NOT NULL,
  `others_info` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_create_payments`
--

INSERT INTO `ems_create_payments` (`id`, `payment_id`, `payee_name`, `payee_org`, `payee_email`, `payee_phone`, `payee_address`, `bank_name`, `bank_account_no`, `bank_swift_code`, `branch_name`, `bank_address`, `tax_total`, `payment_subtotal`, `payment_grandtotal`, `others_info`, `created_at`, `updated_at`) VALUES
(56, 'EMSP-1239', 'Jhon Doe', 'Oil Company Ltd.', 'info@oil.org', '01645770422', 'Dhaka Bangladesh', 'Dhaka Bank Ltd.', '589 635 7458', 'DB854#1', 'Dhaka', 'Dhaka Bangladesh', 7.5, 3690, 3966.75, '<ol><li>Lorem ipsum</li><li>Dollar sit amet</li></ol>', '2020-07-08 23:50:26', '2020-07-08 23:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `ems_crendential`
--

CREATE TABLE `ems_crendential` (
  `id` int(11) NOT NULL COMMENT 'CREDENTIAL ID',
  `credential_keyword` varchar(256) NOT NULL,
  `credential_password` varchar(256) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_crendential`
--

INSERT INTO `ems_crendential` (`id`, `credential_keyword`, `credential_password`, `created_at`, `updated_at`) VALUES
(1, 'bismillah786', 'f59e804887d5d84dc7a26d6ff08d268166700702', '2020-07-13 02:40:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_departments`
--

CREATE TABLE `ems_departments` (
  `id` int(11) NOT NULL COMMENT 'DEPARTMENT ID',
  `department_name` varchar(256) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_departments`
--

INSERT INTO `ems_departments` (`id`, `department_name`, `created_at`, `updated_at`) VALUES
(1, 'Bangla Dept.', '2020-07-23 02:11:54', NULL),
(2, 'Arabic Dept.', '2020-07-23 02:12:02', NULL),
(3, 'English Dept', '2020-07-23 02:12:09', NULL),
(4, 'Mathematics Dept.', '2020-07-23 02:12:18', NULL),
(5, 'Science Dept.', '2020-07-23 02:12:32', NULL),
(6, 'Geography Dept.', '2020-07-23 02:12:59', NULL),
(7, 'Sociology Dept.', '2020-07-23 02:13:14', NULL),
(8, 'Sports Dept.', '2020-07-23 02:13:21', NULL),
(9, 'Accounts Dept.', '2020-07-23 02:13:32', NULL),
(10, 'HR & Admin Dept.', '2020-07-23 02:13:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_designations`
--

CREATE TABLE `ems_designations` (
  `id` int(11) NOT NULL COMMENT 'DESIGNATION ID',
  `department_id` int(11) NOT NULL,
  `designation_name` varchar(256) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_designations`
--

INSERT INTO `ems_designations` (`id`, `department_id`, `designation_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bangla Teacher', '2020-07-23 02:14:18', NULL),
(2, 3, 'English Teacher', '2020-07-23 02:14:27', NULL),
(3, 4, 'Mathematics Teacher', '2020-07-23 02:14:45', NULL),
(4, 3, 'Sr. English Teacher', '2020-07-23 02:14:56', NULL),
(5, 5, 'Science Teacher', '2020-07-23 02:15:08', NULL),
(6, 2, 'Arabic Teacher', '2020-07-23 02:15:32', NULL),
(7, 9, 'Accounts Officer', '2020-07-23 02:15:40', NULL),
(8, 9, 'Commercial Officer', '2020-07-23 02:15:48', NULL),
(9, 10, 'Admin Officer', '2020-07-23 02:15:58', NULL),
(10, 8, 'Sports Teacher', '2020-07-23 02:16:11', NULL),
(11, 7, 'Social Science Teacher', '2020-07-23 02:16:26', NULL),
(12, 4, 'Sr. Mathematics Teacher', '2020-07-23 02:16:46', NULL),
(13, 6, 'Geography Teacher', '2020-07-23 02:16:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_employees`
--

CREATE TABLE `ems_employees` (
  `id` int(11) NOT NULL COMMENT 'EMPLOYEES ID',
  `employee_id` varchar(128) NOT NULL,
  `employee_image` text NOT NULL,
  `employee_first_name` varchar(64) NOT NULL,
  `employee_last_name` varchar(64) NOT NULL,
  `employee_email` varchar(64) NOT NULL,
  `employee_phone_no` varchar(11) NOT NULL,
  `employee_dept_id` int(11) NOT NULL,
  `employee_desg_id` int(11) NOT NULL,
  `employee_join_date` date NOT NULL,
  `employee_religion` enum('Islam','Hindu','Christian','Others') NOT NULL,
  `academic_institute` varchar(256) NOT NULL,
  `academic_subject_in` varchar(128) NOT NULL,
  `academic_certification` varchar(256) NOT NULL,
  `academic_pass_year` varchar(4) NOT NULL,
  `academic_result` varchar(4) NOT NULL,
  `employee_address` varchar(256) NOT NULL,
  `employee_birth_date` date NOT NULL,
  `employee_gender` enum('Male','Female','Others') NOT NULL,
  `employee_nid` varchar(32) NOT NULL,
  `employee_emg_contact` varchar(11) NOT NULL,
  `employee_password` varchar(256) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_employees`
--

INSERT INTO `ems_employees` (`id`, `employee_id`, `employee_image`, `employee_first_name`, `employee_last_name`, `employee_email`, `employee_phone_no`, `employee_dept_id`, `employee_desg_id`, `employee_join_date`, `employee_religion`, `academic_institute`, `academic_subject_in`, `academic_certification`, `academic_pass_year`, `academic_result`, `employee_address`, `employee_birth_date`, `employee_gender`, `employee_nid`, `employee_emg_contact`, `employee_password`, `created_at`, `updated_at`) VALUES
(9, 'EM-#9011', 'EMPLOYEE20200717_IMAGE_411jobayer.png', 'Jobayer', 'Doe', 'jhondoe@gmail.com', '01316770422', 9, 7, '1970-01-01', 'Islam', 'Dhaka University', 'Finance', 'Bachelor in Business Administration', '2016', '3.52', 'Dhaka-1206, Bangladesh', '1970-01-01', 'Male', '742 585 6935', '01645770422', '6367c48dd193d56ea7b0baad25b19455e529f5ee', '2020-07-17 20:06:10', '2020-07-29 17:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `ems_events`
--

CREATE TABLE `ems_events` (
  `id` int(11) NOT NULL COMMENT 'EVENTS ID',
  `title` varchar(256) NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_events`
--

INSERT INTO `ems_events` (`id`, `title`, `start_event`, `end_event`) VALUES
(3, 'Weekend Festival', '2020-07-10 10:00:00', '2020-07-10 13:00:00'),
(5, 'Important Meeting', '2020-07-14 00:00:00', '2020-07-16 00:00:00'),
(7, 'Hello world', '2020-07-05 11:30:00', '2020-07-08 08:30:00'),
(11, 'Eid Ul Azha', '2020-07-29 00:00:00', '2020-08-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ems_exam_grades`
--

CREATE TABLE `ems_exam_grades` (
  `id` int(11) NOT NULL COMMENT 'EXAM GRADE ID',
  `grade_name` enum('A+','A','A-','B+','B','B-','C+','C','D','F') NOT NULL,
  `grade_point` enum('4.00','3.75','3.50','3.25','3.00','2.75','2.50','2.25','2.00','0.00') NOT NULL,
  `marks_from` int(11) NOT NULL,
  `marks_upto` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_exam_grades`
--

INSERT INTO `ems_exam_grades` (`id`, `grade_name`, `grade_point`, `marks_from`, `marks_upto`, `created_at`, `updated_at`) VALUES
(1, 'A+', '4.00', 80, 100, '2020-07-26 09:50:24', NULL),
(2, 'A', '3.75', 75, 79, '2020-07-26 09:51:26', NULL),
(6, 'A-', '3.50', 70, 74, '2020-07-27 07:40:20', NULL),
(7, 'B+', '3.25', 65, 69, '2020-07-27 07:40:31', NULL),
(8, 'B', '3.00', 60, 64, '2020-07-27 07:40:43', NULL),
(9, 'B-', '2.75', 55, 59, '2020-07-27 07:40:55', NULL),
(10, 'C+', '2.50', 50, 54, '2020-07-27 07:41:21', NULL),
(11, 'C', '2.25', 45, 49, '2020-07-27 07:41:31', NULL),
(16, 'D', '2.00', 40, 44, '2020-07-31 01:07:05', NULL),
(17, 'F', '0.00', 33, 39, '2020-07-31 01:08:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_exam_marksheet`
--

CREATE TABLE `ems_exam_marksheet` (
  `id` int(11) NOT NULL COMMENT 'EXAM MARK SHEET ID',
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `exam_year` varchar(4) NOT NULL,
  `total_marks` varchar(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_exam_marksheet`
--

INSERT INTO `ems_exam_marksheet` (`id`, `student_id`, `class_id`, `shift_id`, `semester_id`, `exam_year`, `total_marks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2020', '425', '2020-07-27 07:38:34', NULL),
(2, 6, 1, 1, 1, '2020', '361', '2020-07-27 21:58:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_exam_marks_subjects`
--

CREATE TABLE `ems_exam_marks_subjects` (
  `id` int(11) NOT NULL COMMENT 'EXAM SUBJECT MARKS ID',
  `marks_sheet_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject_marks` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_exam_marks_subjects`
--

INSERT INTO `ems_exam_marks_subjects` (`id`, `marks_sheet_id`, `subject_id`, `subject_marks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 65, '2020-07-27 07:38:34', NULL),
(2, 1, 2, 74, '2020-07-27 07:38:34', NULL),
(3, 1, 3, 69, '2020-07-27 07:38:34', NULL),
(4, 1, 4, 78, '2020-07-27 07:38:34', NULL),
(5, 1, 5, 67, '2020-07-27 07:38:34', NULL),
(6, 1, 6, 72, '2020-07-27 07:38:34', NULL),
(7, 2, 1, 54, '2020-07-27 21:58:56', NULL),
(8, 2, 2, 49, '2020-07-27 21:58:57', NULL),
(9, 2, 3, 67, '2020-07-27 21:58:57', NULL),
(10, 2, 4, 73, '2020-07-27 21:58:57', NULL),
(11, 2, 5, 56, '2020-07-27 21:58:57', NULL),
(12, 2, 6, 62, '2020-07-27 21:58:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_exam_schedule`
--

CREATE TABLE `ems_exam_schedule` (
  `id` int(11) NOT NULL COMMENT 'EXAM SCHEDULE ID',
  `class_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `start_date_time` datetime NOT NULL,
  `end_date_time` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_exam_schedule`
--

INSERT INTO `ems_exam_schedule` (`id`, `class_id`, `shift_id`, `semester_id`, `subject_id`, `teacher_id`, `start_date_time`, `end_date_time`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 6, '2020-07-27 07:30:00', '2020-07-27 09:30:00', '2020-07-26 22:47:35', NULL),
(2, 2, 1, 1, 2, 3, '2020-07-27 07:30:00', '2020-07-27 07:30:00', '2020-07-26 22:48:30', NULL),
(3, 3, 1, 1, 4, 4, '2020-07-27 07:30:00', '2020-07-27 07:30:00', '2020-07-26 22:49:02', NULL),
(4, 4, 2, 1, 3, 7, '2020-07-26 09:45:00', '2020-07-26 12:15:00', '2020-07-26 22:50:30', NULL),
(5, 5, 2, 1, 2, 1, '2020-07-27 09:45:00', '2020-07-27 12:15:00', '2020-07-26 22:51:19', NULL),
(6, 5, 2, 1, 3, 7, '2020-07-30 09:30:00', '2020-07-30 12:00:00', '2020-07-30 23:04:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_galleries`
--

CREATE TABLE `ems_galleries` (
  `id` int(11) NOT NULL COMMENT 'GALLARY IMAGE ID',
  `galleries_image` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_galleries`
--

INSERT INTO `ems_galleries` (`id`, `galleries_image`, `created_at`, `updated_at`) VALUES
(76, 'GALLARY_20200731_IMAGE_634_gallary(4).png', '2020-07-31 23:59:50', NULL),
(77, 'GALLARY_20200731_IMAGE_565_gallary(3).jpg', '2020-07-31 23:59:50', NULL),
(79, 'GALLARY_20200731_IMAGE_134_gallary(1).jpg', '2020-07-31 23:59:50', NULL),
(81, 'GALLARY_20200801_IMAGE_733_gallary(5).jpeg', '2020-08-01 00:00:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_icons`
--

CREATE TABLE `ems_icons` (
  `id` int(11) NOT NULL COMMENT 'ICONS ID',
  `app_favicon` text DEFAULT NULL,
  `app_logo` text DEFAULT NULL,
  `invoice_logo` text DEFAULT NULL,
  `org_logo` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_icons`
--

INSERT INTO `ems_icons` (`id`, `app_favicon`, `app_logo`, `invoice_logo`, `org_logo`, `created_at`, `updated_at`) VALUES
(1, 'APP_FAVICON20200725_CONFIG_547favicon.png', 'APP_LOGO20200725_CONFIG_231logo.png', 'INVOICE_LOGO20200725_CONFIG_653logo(1).png', 'ORG_LOGO20200725_CONFIG_680logo(3).png', '2020-07-25 00:31:28', '2020-07-25 12:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `ems_leave_config`
--

CREATE TABLE `ems_leave_config` (
  `id` int(11) NOT NULL COMMENT 'LEAVE CONFIG ID',
  `type` enum('Annual Leave','Casual Leave','Earned Leave','Festival Holidays','Medical Leave','Maternity Leave','Paternity Leave','Study Leave') NOT NULL,
  `days` int(2) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_leave_config`
--

INSERT INTO `ems_leave_config` (`id`, `type`, `days`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Annual Leave', 20, 'Inactive', '2020-07-26 07:35:14', NULL),
(2, 'Casual Leave', 10, 'Active', '2020-07-26 08:04:53', NULL),
(3, 'Earned Leave', 33, 'Inactive', '2020-07-26 08:05:11', NULL),
(4, 'Medical Leave', 10, 'Inactive', '2020-07-26 08:05:25', NULL),
(5, 'Maternity Leave', 90, 'Active', '2020-07-26 08:05:47', NULL),
(6, 'Paternity Leave', 10, 'Active', '2020-07-26 08:05:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_libraries`
--

CREATE TABLE `ems_libraries` (
  `id` int(11) NOT NULL COMMENT 'LIBRARIES ID',
  `book_name` varchar(128) NOT NULL,
  `book_id` varchar(64) NOT NULL,
  `author_name` varchar(128) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `published` varchar(4) NOT NULL,
  `book_status` enum('Available','Sold Out') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_libraries`
--

INSERT INTO `ems_libraries` (`id`, `book_name`, `book_id`, `author_name`, `class_id`, `subject_id`, `published`, `book_status`, `created_at`, `updated_at`) VALUES
(1, 'The Jungle Book', 'TJB-5234', 'Rudyard Kipling', 3, 2, '2018', 'Available', '2020-07-15 08:06:44', NULL),
(2, 'Zoo Adventure', 'ZA-9321', 'Rabid Reza', 2, 2, '2020', 'Available', '2020-07-15 08:07:37', NULL),
(3, 'Children Islamic Stories', 'CIS-4422', 'ToonToon Books', 4, 4, '2019', 'Available', '2020-07-15 08:08:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_monthly_fees`
--

CREATE TABLE `ems_monthly_fees` (
  `id` int(11) NOT NULL COMMENT 'MONTHLY FEES ID',
  `student_id` int(11) NOT NULL,
  `month_name` enum('January','February','March','April','May','June','July','August','September','October','November','December') NOT NULL,
  `date` date NOT NULL,
  `tution_fees` double NOT NULL,
  `exam_fees` double DEFAULT NULL,
  `fines_deduction` double DEFAULT NULL,
  `total_amount` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_monthly_fees`
--

INSERT INTO `ems_monthly_fees` (`id`, `student_id`, `month_name`, `date`, `tution_fees`, `exam_fees`, `fines_deduction`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 12, 'July', '2020-07-29', 250, 0, 0, 250, '2020-07-29 10:14:04', NULL),
(2, 1, 'January', '2020-01-29', 250, 0, 0, 250, '2020-07-29 10:53:10', NULL),
(3, 2, 'February', '2020-02-29', 250, 0, 0, 250, '2020-07-29 10:53:23', NULL),
(4, 1, 'February', '2020-02-29', 250, 0, 0, 250, '2020-07-29 10:59:30', NULL),
(5, 2, 'January', '2020-01-29', 250, 0, 0, 250, '2020-07-29 11:03:27', NULL),
(6, 6, 'April', '2020-04-29', 250, 0, 0, 250, '2020-07-29 11:18:35', NULL),
(7, 9, 'March', '2020-03-29', 250, 0, 0, 250, '2020-07-29 11:21:15', NULL),
(8, 1, 'March', '2020-03-29', 250, 0, 0, 250, '2020-07-29 11:40:16', NULL),
(9, 6, 'January', '2020-01-29', 250, 0, 0, 250, '2020-07-29 12:24:48', NULL),
(10, 2, 'March', '2020-03-29', 250, 0, 100, 350, '2020-07-29 12:28:33', NULL),
(11, 3, 'February', '2020-02-29', 250, 0, 0, 250, '2020-07-29 19:26:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_notices`
--

CREATE TABLE `ems_notices` (
  `id` int(11) NOT NULL COMMENT 'NOTICE ID',
  `author_name` varchar(64) NOT NULL,
  `type` enum('General Notice','Important Notice','Class Notice','Examination Notice','Employee Notice') NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(512) NOT NULL,
  `note` varchar(256) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_notices`
--

INSERT INTO `ems_notices` (`id`, `author_name`, `type`, `title`, `description`, `note`, `created_at`, `updated_at`) VALUES
(23, 'Jobayer Tuser', 'General Notice', 'General Notice', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', 'Contact: info@oldschool.org', '2020-07-11 23:19:48', NULL),
(24, 'Al Mamun Roni', 'Important Notice', 'Important Notice', '<p>Accumsan in nisl nisi scelerisque eu ultrices vitae auctor. Viverra nam libero justo laoreet sit. In iaculis nunc sed augue lacus viverra vitae.<br></p>', 'Contact: info@oldschool.org', '2020-07-11 23:20:25', NULL),
(25, 'Jhon Doe', 'Class Notice', 'Class Notice', '<p>Tempor orci dapibus ultrices in iaculis nunc sed augue. Risus nullam eget felis eget nunc lobortis.<br></p>', 'Contact: info@oldschool.org', '2020-07-11 23:21:09', NULL),
(26, 'Md. Kabir Khan', 'Examination Notice', 'Examination Notice', '<p>Quam pellentesque nec nam aliquam sem et tortor consequat id. Viverra ipsum nunc aliquet bibendum enim facilisis gravida neque convallis.&nbsp;<br></p>', 'Contact: info@oldschool.org', '2020-07-11 23:22:39', NULL),
(29, 'Hello Author', 'General Notice', 'Test Purpose', '<p>Hi there</p>', '', '2020-07-13 04:51:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_org_config`
--

CREATE TABLE `ems_org_config` (
  `id` int(11) NOT NULL COMMENT 'ORG CONFIG ID',
  `organization_name` varchar(128) NOT NULL,
  `website_url` varchar(128) NOT NULL,
  `currency` enum('BDT','USD','EURO') NOT NULL,
  `timezone` int(11) NOT NULL,
  `org_address` varchar(256) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_org_config`
--

INSERT INTO `ems_org_config` (`id`, `organization_name`, `website_url`, `currency`, `timezone`, `org_address`, `created_at`, `updated_at`) VALUES
(1, 'Back to School', 'https://www.backtoschool.com', 'BDT', 60, 'Sector-10, Uttara-1230, Dhaka', '2020-07-25 09:23:13', '2020-07-25 09:24:16');

-- --------------------------------------------------------

--
-- Table structure for table `ems_parents`
--

CREATE TABLE `ems_parents` (
  `id` int(11) NOT NULL COMMENT 'PARENTS ID',
  `student_id` int(11) NOT NULL,
  `parents_image` text NOT NULL,
  `father_name` varchar(64) NOT NULL,
  `father_nid_card_no` varchar(32) NOT NULL,
  `father_phone_no` varchar(13) NOT NULL,
  `father_email` varchar(32) DEFAULT NULL,
  `mother_name` varchar(64) NOT NULL,
  `mother_nid_card_no` varchar(32) NOT NULL,
  `mother_phone_no` varchar(13) NOT NULL,
  `mother_occupation` enum('Housewife','Service','Business','Others') NOT NULL,
  `parents_occupation` varchar(64) NOT NULL,
  `parents_org_name` varchar(128) NOT NULL,
  `parents_org_address` varchar(128) NOT NULL,
  `parents_org_contact_number` varchar(13) NOT NULL,
  `permanent_address` varchar(128) NOT NULL,
  `permanent_post_office` varchar(32) NOT NULL,
  `permanent_police_station` varchar(32) NOT NULL,
  `permanent_district` varchar(32) NOT NULL,
  `permanent_country` varchar(32) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_parents`
--

INSERT INTO `ems_parents` (`id`, `student_id`, `parents_image`, `father_name`, `father_nid_card_no`, `father_phone_no`, `father_email`, `mother_name`, `mother_nid_card_no`, `mother_phone_no`, `mother_occupation`, `parents_occupation`, `parents_org_name`, `parents_org_address`, `parents_org_contact_number`, `permanent_address`, `permanent_post_office`, `permanent_police_station`, `permanent_district`, `permanent_country`, `created_at`, `updated_at`) VALUES
(1, 1, 'IMAGE_202007260112181922parents.png', 'Afjal Hossain', '214 356 7895', '01645770422', 'afjal.hossain@gmail.com', 'Farhana Akhter', '852 145 9856', '01645770422', 'Housewife', 'Private Service', 'XYZ International Comapny Ltd.', 'Uttara-1230, Dhaka', '01645770422', 'Sector-6, House-35, Block-A', ' Uttara-1230', ' Uttara', 'Dhaka', 'Bangladesh', '2020-07-26 01:12:18', NULL),
(2, 2, 'IMAGE_202007260119239798parents.png', 'Zahed Malik', '685 124 6523', '01645770422', '', 'Zerin Ahsan Malik', '324 546 4571', '01645770422', 'Service', 'Business', 'ABC Enterprise Ltd.', 'Khilkhet, Dhaka', '01645770422', 'House-241/A', 'Dinajpur-5200', 'Dinajpur', 'Dinajpur', 'Bangladesh', '2020-07-26 01:19:24', '2020-07-26 01:20:05'),
(3, 3, 'IMAGE_202007260132321441parents.png', 'Saleh Mahmud', '745 651 2456', '01645770422', 'saleh.mahmud@gmail.com', 'Rehena Khanam', '654 547 4587', '01645770422', 'Housewife', 'Private Service', 'ABC Company Ltd.', 'Motijheel Commercial Area, Dhaka-1209', '01645770422', 'Shaheb Bazar', 'Shaheb Bazar-6000', 'Rajshahi', 'Rajshahi', 'Bangladesh', '2020-07-26 01:32:32', NULL),
(4, 4, 'IMAGE_202007260141317419parents.png', 'Robin D\'costa', '321 654 7545', '01645770422', 'robin@yahoo.com', 'Selina D\'costa', '258 623 1455', '01645770422', 'Service', 'Private Service', 'XYZ International Company Ltd.', '16, Dilkusha C/A, Dhaka-1000', '01645770422', 'Holding-42/B', 'Chanchra-7402', 'Jessore Sadar', 'Jessore', 'Bangladesh', '2020-07-26 01:41:31', NULL),
(5, 5, 'IMAGE_202007260222397546parents.png', 'Ajit Kumar Roy', '652 325 6487', '01645770422', '', 'Taposi Roy', '784 541 6523', '01645770422', 'Housewife', 'Govt. Service', 'Govt. Roads & Highway Dept.', 'Motijheel-1207, Dhaka', '01645770422', '72/B Chowdhury Para', 'Malibagh-1360', 'Malibagh', 'Dhaka', 'Bangladesh', '2020-07-26 02:22:39', NULL),
(6, 6, 'IMAGE_202007260227047551parents.png', 'Jabed Hasan', '953 456 1245', '01645770422', 'jabed.hasan@gmail.com', 'Raihana Begum', '654 546 2145', '01645770422', 'Housewife', 'Business', 'XYZ Enterprise Ltd.', 'Fakirapool, Motijheel-1000, Dhaka', '01645770422', 'House-65/B,  Fakirapool', 'Motijheel-1000', 'Motijheel', 'Dhaka', 'Bangladesh', '2020-07-26 02:27:04', NULL),
(7, 7, 'IMAGE_202007260232222992parents.png', 'Biswash Mondol', '325 654 5421', '01645770422', '', 'Tuli Mondol', '745 124 6545', '01645770422', 'Housewife', 'Commercial Officer', 'Bank Asia Ltd.', 'Panthapath-1206, Dhaka', '01645770422', 'House-45, Block-D, Nikunja-2', 'Khilkhet-1245', 'Khilkhet', 'Dhaka', 'Bangladesh', '2020-07-26 02:32:22', NULL),
(8, 8, 'IMAGE_202007260239187626parents.png', 'Ehsan Hasan', '784 451 6545', '01645770422', 'ehsan.hasan@gmail.com', 'Fahima Akter', '965 325 6584', '01645770422', 'Housewife', 'Private Service', 'XYZ Company Ltd.', 'Motijheel C/A, Dhaka', '01645770422', 'House-7/1, Rankin Street', 'Wari-1260', 'Wari', 'Dhaka', 'Bangladesh', '2020-07-26 02:39:18', '2020-07-26 02:43:03'),
(9, 9, 'IMAGE_202007260242364305parents.png', 'Akhil Ganguly', '784 451 6545', '01645770422', 'akhilganguly@gmail.com', 'Shuvoshree Ganguly', '965 325 6584', '01645770422', 'Housewife', 'Private Service', 'XYZ Company Ltd.', 'Motijheel C/A, Dhaka', '01645770422', 'House-20, Main Road', 'Banashree-1350', 'Banashree', 'Dhaka', 'Bangladesh', '2020-07-26 02:42:36', '2020-07-26 02:43:52'),
(10, 10, 'IMAGE_202007260246538246parents.png', 'Abdul Muhit', '856 985 4575', '01645770422', 'muhit.abdul@gmail.com', 'Maheera Begum', '457 454 9565', '01645770422', 'Housewife', 'Banker', 'Dhaka Bank Ltd.', 'Motijheel C/A, Dhaka', '01645770422', '87 Siddeshwari Circular Road', 'Malibagh-1294', 'Malibagh', 'Dhaka', 'Bangladesh', '2020-07-26 02:46:53', NULL),
(11, 11, 'IMAGE_202007260251025901parents.png', 'Abu Zafar', '897 456 7895', '01645770422', 'abuzafar@gmail.com', 'Sharmin Rina', '356 945 7856', '01645770422', 'Housewife', 'Business', 'ABC Buying House', 'House-12, Mohakhali DOHS', '01645770422', 'Lane #25, New DOHS', 'Mohakhali-1206', 'Mohakhali', 'Dhaka', 'Bangladesh', '2020-07-26 02:51:03', NULL),
(12, 12, 'IMAGE_202007260253437872parents.png', 'Shariar Islam', '758 454 7884', '01645770422', 'shariar.islam@gmail.com', 'Parvin Akhter', '165 784 5469', '01645770422', 'Housewife', 'Business', 'ABC Buying House', 'House-12, Mohakhali DOHS', '01645770422', 'Lane #25, New DOHS', 'Mohakhali-1206', 'Mohakhali', 'Dhaka', 'Bangladesh', '2020-07-26 02:53:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_payments_details`
--

CREATE TABLE `ems_payments_details` (
  `id` int(11) NOT NULL COMMENT 'PAYMENT DETAILS ID',
  `payments_id` int(11) NOT NULL,
  `item_name` varchar(256) NOT NULL,
  `item_description` varchar(512) NOT NULL,
  `item_cost` double NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_amount` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_payments_details`
--

INSERT INTO `ems_payments_details` (`id`, `payments_id`, `item_name`, `item_description`, `item_cost`, `item_qty`, `item_amount`, `created_at`, `updated_at`) VALUES
(74, 56, 'Xaomi Note 8', 'Camera Phone', 1250, 2, 2500, '2020-07-08 23:50:26', NULL),
(75, 56, 'Realme Pro', 'Smart Phone ', 1190, 1, 1190, '2020-07-08 23:50:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_semesters`
--

CREATE TABLE `ems_semesters` (
  `id` int(11) NOT NULL COMMENT 'SEMESTER ID',
  `semester_name` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_semesters`
--

INSERT INTO `ems_semesters` (`id`, `semester_name`, `created_at`, `updated_at`) VALUES
(1, '1st Semester', '2020-07-14 20:53:07', NULL),
(2, '2nd Semester', '2020-07-14 20:53:16', NULL),
(3, '3rd Semester', '2020-07-14 20:53:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_shifts`
--

CREATE TABLE `ems_shifts` (
  `id` int(11) NOT NULL COMMENT 'SHIFT ID',
  `shift_name` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_shifts`
--

INSERT INTO `ems_shifts` (`id`, `shift_name`, `created_at`, `updated_at`) VALUES
(1, 'Morning Shift', '2020-07-14 19:34:43', NULL),
(2, 'Day Shift', '2020-07-14 19:34:51', NULL),
(3, 'Evening Shift', '2020-07-14 19:34:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_students`
--

CREATE TABLE `ems_students` (
  `id` int(11) NOT NULL COMMENT 'STUDENT ID',
  `class_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `student_id` varchar(32) NOT NULL,
  `student_image` text NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `roll_number` int(11) NOT NULL,
  `admission_date` date NOT NULL,
  `birth_certificate_no` varchar(64) NOT NULL,
  `blood_group` enum('A positive (A+)','A negative (A-)','B positive (B+)','B negative (B-)','O positive (O+)','O negative (O-)','AB positive (AB+)','AB negative (AB-)') NOT NULL,
  `phone_no` varchar(13) NOT NULL,
  `religion` enum('Islam','Hindu','Christian','Others') NOT NULL,
  `address` varchar(256) NOT NULL,
  `student_password` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_students`
--

INSERT INTO `ems_students` (`id`, `class_id`, `shift_id`, `student_id`, `student_image`, `first_name`, `last_name`, `birth_date`, `gender`, `roll_number`, `admission_date`, `birth_certificate_no`, `blood_group`, `phone_no`, `religion`, `address`, `student_password`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'ST-ID#30795', 'IMAGE_202007260112185242student.png', 'Md. Fahim', 'Munnaf', '2015-06-16', 'Male', 1, '2020-07-19', '2015365456789', 'B positive (B+)', '01645770422', 'Islam', 'Sector-6, Uttara-1230, Dhaka', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '2020-07-26 01:12:18', NULL),
(2, 1, 1, 'ST-ID#85807', 'IMAGE_202007260119235574student.png', 'Zubair Hossain', 'Rasel', '2016-06-13', 'Male', 2, '2020-07-22', '2016789564123', 'O positive (O+)', '01645770422', 'Islam', 'Nikunja-2, Khilkhet, Dhaka', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '2020-07-26 01:19:23', '2020-07-26 01:20:05'),
(3, 1, 1, 'ST-ID#81404', 'IMAGE_202007260132325824student.png', 'Sabrina', 'Yasmin', '2016-02-12', 'Female', 3, '2020-07-21', '2016845631245', 'O positive (O+)', '01645770422', 'Islam', 'Sector-7, Uttara-1230, Dhaka', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '2020-07-26 01:32:32', NULL),
(4, 1, 1, 'ST-ID#67679', 'IMAGE_202007260141318039student.png', 'Richard D\'costa', 'Hira', '2016-09-22', 'Male', 4, '2020-07-21', '201654765945', 'A negative (A-)', '01645770422', 'Christian', '16, Dilkusha C/A, Dhaka-1000', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '2020-07-26 01:41:31', NULL),
(5, 1, 1, 'ST-ID#49599', 'IMAGE_202007260222395104student.png', 'Sourov', 'Roy', '2015-12-03', 'Male', 5, '2020-07-19', '2015956324125', 'B negative (B-)', '01645770422', 'Hindu', 'Sector-2, Uttara-1230, Dhaka', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '2020-07-26 02:22:39', NULL),
(6, 1, 1, 'ST-ID#32877', 'IMAGE_202007260227043390student.png', 'Jannatul', 'Ayesha', '2016-11-15', 'Female', 6, '2020-07-20', '2016456789523', 'AB positive (AB+)', '01645770422', 'Islam', 'Fakirapool, Motijheel-1000, Dhaka', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '2020-07-26 02:27:04', NULL),
(7, 1, 1, 'ST-ID#48998', 'IMAGE_202007260232225646student.png', 'Anupama Mondol', 'Anu', '2015-06-16', 'Female', 7, '2020-07-24', '2015655895632', 'A positive (A+)', '01645770422', 'Hindu', 'Nikunja-2, Khilkhet, Dhaka', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '2020-07-26 02:32:22', NULL),
(8, 2, 1, 'ST-ID#71540', 'IMAGE_202007260239186132student.png', 'Md. Farhan', 'Akter', '2016-07-18', 'Male', 1, '2020-07-14', '2016745659326', 'A negative (A-)', '01645770422', 'Islam', 'House-7/1, Rankin Street, Wari-1260, Dhaka', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '2020-07-26 02:39:18', '2020-07-26 02:43:03'),
(9, 2, 1, 'ST-ID#97874', 'IMAGE_202007260242361255student.png', 'Anshuman ', 'Ganguly', '2016-06-18', 'Male', 2, '2020-07-14', '2016352659328', 'B positive (B+)', '01645770422', 'Hindu', 'House-20, Main Road, Banashree-1350, Dhaka', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '2020-07-26 02:42:36', '2020-07-26 02:43:52'),
(10, 2, 1, 'ST-ID#44673', 'IMAGE_202007260246538034student.png', 'Zovan', 'Ahmed', '2016-09-13', 'Male', 3, '2020-07-14', '2016852359456', 'O positive (O+)', '01645770422', 'Islam', '87 Siddeshwari Circular Road, Malibagh, Dhaka', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '2020-07-26 02:46:53', NULL),
(11, 2, 1, 'ST-ID#67928', 'IMAGE_202007260251027571student.png', 'Raihanul Islam', 'Raihan', '2015-08-18', 'Male', 4, '2020-07-14', '2016852359456', 'O positive (O+)', '01645770422', 'Islam', 'Lane #25, New DOHS, Mohakhali-1206, Dhaka', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '2020-07-26 02:51:02', NULL),
(12, 2, 1, 'ST-ID#23252', 'IMAGE_202007260253434828student.png', 'Sadia Jahan', 'Shova', '2015-06-09', 'Female', 5, '2020-07-14', '2015655658451', 'B positive (B+)', '01645770422', 'Islam', 'Lane #25, New DOHS, Mohakhali-1206, Dhaka', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '2020-07-26 02:53:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_student_attendance`
--

CREATE TABLE `ems_student_attendance` (
  `id` int(11) NOT NULL COMMENT 'STUDENT ATTENDANCE ID',
  `date` datetime NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_student_attendance`
--

INSERT INTO `ems_student_attendance` (`id`, `date`, `teacher_id`, `class_id`, `shift_id`, `created_at`, `updated_at`) VALUES
(1, '2020-07-28 21:40:28', 1, 1, 1, '2020-07-28 21:40:28', NULL),
(2, '2020-07-29 02:20:09', 4, 2, 1, '2020-07-29 02:20:09', NULL),
(3, '2020-07-31 02:08:27', 3, 1, 1, '2020-07-31 02:08:27', NULL),
(4, '2020-07-31 02:19:27', 8, 2, 1, '2020-07-31 02:19:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_student_attendance_status`
--

CREATE TABLE `ems_student_attendance_status` (
  `id` int(11) NOT NULL COMMENT 'ATTENDANCE STATUS ID',
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` varchar(7) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_student_attendance_status`
--

INSERT INTO `ems_student_attendance_status` (`id`, `attendance_id`, `student_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'present', '2020-07-28 21:40:29', NULL),
(2, 1, 2, 'present', '2020-07-28 21:40:29', NULL),
(3, 1, 3, 'present', '2020-07-28 21:40:29', NULL),
(4, 1, 4, 'absent', '2020-07-28 21:40:29', NULL),
(5, 1, 5, 'present', '2020-07-28 21:40:29', NULL),
(6, 1, 6, 'absent', '2020-07-28 21:40:29', NULL),
(7, 1, 7, 'present', '2020-07-28 21:40:29', NULL),
(8, 2, 8, 'present', '2020-07-29 02:20:09', NULL),
(9, 2, 9, 'present', '2020-07-29 02:20:10', NULL),
(10, 2, 10, 'absent', '2020-07-29 02:20:10', NULL),
(11, 2, 11, 'present', '2020-07-29 02:20:10', NULL),
(12, 2, 12, 'present', '2020-07-29 02:20:10', NULL),
(13, 3, 1, 'present', '2020-07-31 02:08:27', NULL),
(14, 3, 2, 'present', '2020-07-31 02:08:27', NULL),
(15, 3, 3, 'present', '2020-07-31 02:08:27', NULL),
(16, 3, 4, 'present', '2020-07-31 02:08:27', NULL),
(17, 3, 5, 'present', '2020-07-31 02:08:27', NULL),
(18, 3, 6, 'present', '2020-07-31 02:08:27', NULL),
(19, 3, 7, 'present', '2020-07-31 02:08:27', NULL),
(20, 4, 8, 'present', '2020-07-31 02:19:27', NULL),
(21, 4, 9, 'absent', '2020-07-31 02:19:27', NULL),
(22, 4, 10, 'present', '2020-07-31 02:19:27', NULL),
(23, 4, 11, 'present', '2020-07-31 02:19:27', NULL),
(24, 4, 12, 'present', '2020-07-31 02:19:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_subjects`
--

CREATE TABLE `ems_subjects` (
  `id` int(11) NOT NULL COMMENT 'SUBJECT ID',
  `subject_name` varchar(128) NOT NULL,
  `subject_code` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_subjects`
--

INSERT INTO `ems_subjects` (`id`, `subject_name`, `subject_code`, `created_at`, `updated_at`) VALUES
(1, 'BANGLA', '101', '2020-07-14 19:39:51', NULL),
(2, 'ENGLISH', '107', '2020-07-14 19:40:05', NULL),
(3, 'MATHEMATICS', '109', '2020-07-14 19:40:24', NULL),
(4, 'RELIGION (ISLAM)', '111', '2020-07-14 19:40:53', NULL),
(5, 'COMPUTER STUDIES', '131', '2020-07-14 19:42:17', NULL),
(6, 'SCIENCE', '145', '2020-07-15 03:11:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_teachers`
--

CREATE TABLE `ems_teachers` (
  `id` int(11) NOT NULL COMMENT 'TEACHER ID',
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `teacher_id` varchar(32) NOT NULL,
  `teacher_image` text NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email_address` varchar(64) NOT NULL,
  `phone_no` varchar(13) NOT NULL,
  `join_date` date NOT NULL,
  `religion` enum('Islam','Hindu','Christian','Others') NOT NULL,
  `nid_card_no` varchar(32) NOT NULL,
  `country` varchar(64) NOT NULL,
  `teacher_password` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `present_address` varchar(256) NOT NULL,
  `facebook_url` varchar(128) NOT NULL,
  `linkedin_url` varchar(128) NOT NULL,
  `youtube_url` varchar(128) NOT NULL,
  `twitter_url` varchar(128) NOT NULL,
  `contact_name` varchar(128) NOT NULL,
  `contact_relation` enum('Parents','Spouse','Family Member','Relative') NOT NULL,
  `contact_address` varchar(256) NOT NULL,
  `contact_number` varchar(13) NOT NULL,
  `graduate_institution_name` varchar(128) DEFAULT NULL,
  `graduate_subject_in` varchar(32) DEFAULT NULL,
  `graduate_year_in` varchar(4) DEFAULT NULL,
  `graduate_certification_in` varchar(128) DEFAULT NULL,
  `graduate_result` varchar(4) DEFAULT NULL,
  `undergraduate_institution_name` varchar(128) NOT NULL,
  `undergraduate_subject_in` varchar(32) NOT NULL,
  `undergraduate_year_in` varchar(4) NOT NULL,
  `undergraduate_certification_in` varchar(128) NOT NULL,
  `undergraduate_result` varchar(4) NOT NULL,
  `hsc_institution_name` varchar(128) NOT NULL,
  `hsc_group_in` enum('Science','Humanities','Business Studies') NOT NULL,
  `hsc_year_in` varchar(4) NOT NULL,
  `hsc_certification_in` varchar(128) NOT NULL,
  `hsc_result` varchar(4) NOT NULL,
  `organization_f` varchar(128) DEFAULT NULL,
  `workshop_on_f` varchar(128) DEFAULT NULL,
  `certification_on_f` varchar(128) DEFAULT NULL,
  `in_year_f` varchar(4) DEFAULT NULL,
  `organization_s` varchar(128) DEFAULT NULL,
  `workshop_on_s` varchar(128) DEFAULT NULL,
  `certification_on_s` varchar(128) DEFAULT NULL,
  `in_year_s` varchar(4) DEFAULT NULL,
  `exp_org_name` varchar(128) DEFAULT NULL,
  `exp_org_location` varchar(256) DEFAULT NULL,
  `exp_job_position` varchar(64) DEFAULT NULL,
  `exp_in_year` varchar(4) DEFAULT NULL,
  `about_teacher` varchar(512) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_teachers`
--

INSERT INTO `ems_teachers` (`id`, `department_id`, `designation_id`, `teacher_id`, `teacher_image`, `first_name`, `last_name`, `email_address`, `phone_no`, `join_date`, `religion`, `nid_card_no`, `country`, `teacher_password`, `birth_date`, `gender`, `present_address`, `facebook_url`, `linkedin_url`, `youtube_url`, `twitter_url`, `contact_name`, `contact_relation`, `contact_address`, `contact_number`, `graduate_institution_name`, `graduate_subject_in`, `graduate_year_in`, `graduate_certification_in`, `graduate_result`, `undergraduate_institution_name`, `undergraduate_subject_in`, `undergraduate_year_in`, `undergraduate_certification_in`, `undergraduate_result`, `hsc_institution_name`, `hsc_group_in`, `hsc_year_in`, `hsc_certification_in`, `hsc_result`, `organization_f`, `workshop_on_f`, `certification_on_f`, `in_year_f`, `organization_s`, `workshop_on_s`, `certification_on_s`, `in_year_s`, `exp_org_name`, `exp_org_location`, `exp_job_position`, `exp_in_year`, `about_teacher`, `created_at`, `updated_at`) VALUES
(1, 3, 4, 'T-ID# 1794', 'IMAGE_202007230257361854teacher.png', 'Md. Kabir', 'Khan', 'kabirkhan@gmail.com', '01645770422', '1970-01-01', 'Islam', '870 155 0140', 'Bangladesh', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '1970-01-01', 'Male', '207/2, West Dhanmondi-1209, Dhaka', 'https://www.facebook.com/kabirkhan', 'https://www.linkedin.com/kabirkhan', 'https://www.youtube.com/kabirkhan', 'https://www.twitter.com/kabirkhan', 'Md. Kamal Uddin', 'Parents', '207/2, West Dhanmondi-1209, Dhaka', '01645770422', 'BRAC University', 'English', '2019', 'M.A in English', '3.12', 'BRAC University', 'English', '2017', 'B.A (Hon\'s) in English', '3.29', 'A. K. HIGH SCHOOL AND COLLEGE', 'Humanities', '2013', 'Higher Secondary School Certificate', '4.89', 'PeopleNTech', 'Computer Fundamental and Office Management', 'Advanced in Computer Fundamental and Office Management', '2016', 'Saifurs Spoken English', 'Spoken English', 'Certification on Spoken English', '2014', 'ABC Kindergarten School', 'Nikunja-2, Khilkhet, Dhaka', 'English Teacher', '2019', '  I am a talented, ambitious and hardworking and experience in teaching profession.  ', '2020-07-23 02:57:36', '2020-07-23 02:58:58'),
(2, 8, 10, 'T-ID# 1035', 'IMAGE_202007230306218768teacher.png', 'Rashedul', 'Islam', 'rashed.islam@gmail.com', '01645770422', '2020-07-14', 'Islam', '346 586 9565', 'Bangladesh', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '1998-07-07', 'Male', 'Askarabad, Chittagong-4100, Chittagong', 'https://www.facebook.com/rashed.islam', 'https://www.linkedin.com/rashed.islam', 'https://www.youtube.com/rashed.islam', 'https://www.twitter.com/rashed.islam', 'Md. Abdur Rahim', 'Parents', 'Askarabad, Chittagong-4100, Chittagong', '01645770422', '', '', '', '', '', 'National University of Bangladesh', 'Public Health', '2018', 'B.A in Public Health', '3.21', 'ALI AHMED HIGH SCHOOL AND COLLEGE', 'Humanities', '2014', 'Higher Secondary School Certificate', '3.89', 'PeopleNTech', 'Computer Fundamental and Office Management', 'Advanced in Computer Fundamental and Office Management', '2018', '', '', '', '', 'ABC Kindergarten School', 'Banani, Gulshan-2, Dhaka', 'Sports Teacher', '2019', 'I am adept at handling multiple tasks on a daily basis competently and at working well under pressure.', '2020-07-23 03:06:21', NULL),
(3, 3, 2, 'T-ID# 8499', 'IMAGE_202007230313207617teacher.png', 'Farhana Binte', 'Maisha', 'farhana.maisha@gmail.com', '01645770422', '1970-01-01', 'Islam', '652 256 1278', 'Bangladesh', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '1970-01-01', 'Female', '234/3, Kachukhet, Cantonment-1206, Dhaka', 'https://www.facebook.com/maisha', '', '', '', 'Md. Yashin Arafat', 'Spouse', '234/3, Kachukhet, Cantonment-1206, Dhaka', '01645770422', 'East West University of Bangladesh', 'English', '2019', 'M.A in English', '3.16', 'East West University of Bangladesh', 'English', '2017', 'B.A (Hon\'s) in English', '3.45', 'ANOWARA BEGUM MUSLIM GIRLS SCHOOL & COLLEGE', 'Science', '2013', 'Higher Secondary School Certificate', '5.00', 'PeopleNTech', 'Computer Fundamental and Office Management', 'Advanced in Computer Fundamental and Office Management', '2017', '', '', '', '', '', '', '', '', ' I am a talented, ambitious and hardworking and experience in teaching profession. ', '2020-07-23 03:13:20', '2020-07-23 03:42:34'),
(4, 2, 6, 'T-ID# 1293', 'IMAGE_202007230320224604teacher.png', 'Sumaiya Nusrat', 'Azmi', 'azmi.sumaiya@gmail.com', '01645770422', '1970-01-01', 'Islam', '852 154 7454', 'Bangladesh', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '1970-01-01', 'Female', 'New Eskaton, Moghbazar-1217, Dhaka', 'https://www.facebook.com/azmi.sumaiya', 'https://www.linkedin.com/azmi.sumaiya', '', '', 'Shabuddin Ahmed', 'Parents', 'New Eskaton, Moghbazar-1217, Dhaka', '01645770422', '', '', '', '', '', 'Asian university for women', 'Arabic Culture', '2019', 'B.A (Hon\'s) in Arabic Culture and Language', '3.46', 'Bangabandhu College, Dhaka', 'Science', '2015', 'Higher Secondary School Certificate', '4.59', 'Creative IT Institute Ltd.', 'Computer Fundamental and Office Management', 'Advanced in Computer Fundamental and Office Management', '2018', '', '', '', '', 'Educare Kindergarten School', 'Sector-6, Uttara-1230, Dhaka', 'Arabic Teacher', '2020', '   I am adept at handling multiple tasks on a daily basis competently and at working well under pressure.   ', '2020-07-23 03:20:22', '2020-07-23 03:34:53'),
(6, 1, 1, 'T-ID# 3911', 'IMAGE_202007230341544885teacher.png', 'Ayesha', 'Hasan', 'ayesha.hasan@gmail.com', '01645770422', '2020-07-15', 'Islam', '745 124 6454', 'Bangladesh', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '1998-04-07', 'Female', 'Zafrabad, Mohammadpur-1207, Dhaka', 'https://www.facebook.com/ayesha.hasan', '', '', 'https://www.twitter.com/ayesha.hasan', 'Md. Hasan Al Mahmud', 'Parents', 'Zafrabad, Mohammadpur-1207, Dhaka', '01645770422', '', '', '', '', '', 'National University of Bangladesh', 'Bangla', '2018', 'B.A (Hon\'s) in Bangla', '3.16', 'Ideal College, Dhanmondi', 'Science', '2014', 'Higher Secondary School Certificate', '4.56', 'PeopleNTech Ltd.', 'Computer Fundamental and Office Management', 'Advanced in Computer Fundamental and Office Management', '2017', '', '', '', '', 'XYZ Kindergarten School', 'Banani, Gulshan-2, Dhaka', 'Bangla Teacher', '2019', 'I am adept at handling multiple tasks on a daily basis competently and at working well under pressure.', '2020-07-23 03:41:54', NULL),
(7, 4, 12, 'T-ID# 1073', 'IMAGE_202007230348508132teacher.png', 'Abdullah Al', 'Rashid', 'rashid.abdullah@yahoo.com', '01645770422', '2020-07-08', 'Islam', '456 452 4754', 'Bangladesh', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '1996-08-21', 'Male', 'Dhaka Cantonment-1206, Dhaka', 'https://www.facebook.com/rashid.abdullah', 'https://www.linkedin.com/rashid.abdullah', 'https://www.youtube.com/rashid.abdullah', 'https://www.twitter.com/rashid.abdullah', 'Md. Abdul Aziz', 'Family Member', 'Dhaka Cantonment-1206, Dhaka', '01645770422', 'Canadian University of Bangladesh', 'Mathematics', '2018', 'M.A in Mathematics', '3.12', 'Canadian University of Bangladesh', 'Mathematics', '2016', 'B.A (Hon\'s) in Mathematics', '3.15', 'Kabi Nazrul Govt. College, Dhaka', 'Science', '2012', 'Higher Secondary School Certificate', '5.00', 'BITM', 'Computer Fundamental and Office Management', 'Advanced in Computer Fundamental and Office Management', '2016', '', '', '', '', 'XYZ Kindergarten School', 'Banani, Gulshan-2, Dhaka', 'Mathematics Teacher', '2019', 'I am adept at handling multiple tasks on a daily basis competently and at working well under pressure.', '2020-07-23 03:48:50', NULL),
(8, 7, 11, 'T-ID# 6929', 'IMAGE_202007230412118843teacher.png', 'Sadia Naznin', 'Orpa', 'orpa.naznin@yahoo.com', '01645770422', '1970-01-01', 'Islam', '565 124 5644', 'Bangladesh', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '1970-01-01', 'Female', 'Sector-10, Uttara-1230, Dhaka', 'https://www.facebook.com/orpa.naznin', '', '', 'https://www.twitter.com/orpa.naznin', 'Sazzad Hossain', 'Parents', 'Sector-10, Uttara-1230, Dhaka', '01645770422', 'National University of Bangladesh', 'Sociology', '2019', 'M.A in Sociology', '2.98', 'National University of Bangladesh', 'Sociology', '2017', 'B.A (Hon\'s) in Sociology', '3.15', 'Holy Child School & College', 'Humanities', '2013', ' Higher Secondary School Certificate', '4.56', 'BITM', 'Computer Fundamental and Office Management', 'Advanced in Computer Fundamental and Office Management', '2018', '', '', '', '', 'Educare Kindergarten School', 'Sector-6, Uttara-1230, Dhaka', 'Social Science Teacher', '2020', ' I am a talented, ambitious and hardworking and experience in teaching profession. ', '2020-07-23 04:12:11', '2020-07-23 12:51:54'),
(9, 6, 13, 'T-ID# 1516', 'IMAGE_202007230417308695teacher.png', 'Zubayer Al', 'Mahmud', 'zubayer.mahmud@gmail.com', '01645770422', '2020-07-21', 'Islam', '325 654 7542', 'Bangladesh', '23cb7851165d68dc52c181c0838de3ff83f75b0b', '1997-10-14', 'Male', 'Savar-1340, Dhaka', 'https://www.facebook.com/zubayer.mahmud', 'https://www.linkedin.com/zubayer.mahmud', '', 'https://www.twitter.com/zubayer.mahmud', 'Zabed Ahsan', 'Relative', 'Savar-1340, Dhaka', '01645770422', 'National University of Bangladesh', 'Geography', '2018', 'M.A in Geography', '2.89', 'National University of Bangladesh', 'Geography', '2016', 'B.A (Hon\'s) in Geography', '3.35', 'Notre Dame College', 'Science', '2012', 'Higher Secondary School Certificate', '4.79', 'PeopleNTech Ltd.', 'Computer Fundamental and Office Management', 'Advanced in Computer Fundamental and Office Management', '2017', '', '', '', '', 'XYZ Kindergarten School', 'Banani, Gulshan-2, Dhaka', 'Geography Teacher', '2018', 'Furthermore, I am adept at handling multiple tasks on a daily basis competently and at working well under pressure.', '2020-07-23 04:17:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ems_timezone`
--

CREATE TABLE `ems_timezone` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `details` varchar(256) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ems_timezone`
--

INSERT INTO `ems_timezone` (`id`, `name`, `details`, `created_at`, `updated_at`) VALUES
(1, 'Etc/GMT+12', '(GMT-12:00) International Date Line West', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Pacific/Midway', '(GMT-11:00) Midway Island, Samoa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Pacific/Honolulu', '(GMT-10:00) Hawaii', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'US/Alaska', '(GMT-09:00) Alaska', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'America/Los_Angeles', '(GMT-08:00) Pacific Time (US & Canada)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'America/Tijuana', '(GMT-08:00) Tijuana, Baja California', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'US/Arizona', '(GMT-07:00) Arizona', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'America/Chihuahua', '(GMT-07:00) Chihuahua, La Paz, Mazatlan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'US/Mountain', '(GMT-07:00) Mountain Time (US & Canada)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'America/Managua', '(GMT-06:00) Central America', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'US/Central', '(GMT-06:00) Central Time (US & Canada)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'America/Mexico_City', '(GMT-06:00) Guadalajara, Mexico City, Monterrey', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Canada/Saskatchewan', '(GMT-06:00) Saskatchewan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'America/Bogota', '(GMT-05:00) Bogota, Lima, Quito, Rio Branco', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'US/Eastern', '(GMT-05:00) Eastern Time (US & Canada)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'US/East-Indiana', '(GMT-05:00) Indiana (East)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Canada/Atlantic', '(GMT-04:00) Atlantic Time (Canada)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'America/Caracas', '(GMT-04:00) Caracas, La Paz', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'America/Manaus', '(GMT-04:00) Manaus', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'America/Santiago', '(GMT-04:00) Santiago', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Canada/Newfoundland', '(GMT-03:30) Newfoundland', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'America/Sao_Paulo', '(GMT-03:00) Brasilia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'America/Argentina/Buenos_Aires', '(GMT-03:00) Buenos Aires, Georgetown', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'America/Godthab', '(GMT-03:00) Greenland', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'America/Montevideo', '(GMT-03:00) Montevideo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'America/Noronha', '(GMT-02:00) Mid-Atlantic', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Atlantic/Cape_Verde', '(GMT-01:00) Cape Verde Is.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Atlantic/Azores', '(GMT-01:00) Azores', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Africa/Casablanca', '(GMT+00:00) Casablanca, Monrovia, Reykjavik', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Etc/Greenwich', '(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Europe/Amsterdam', '(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Europe/Belgrade', '(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'Europe/Brussels', '(GMT+01:00) Brussels, Copenhagen, Madrid, Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Europe/Sarajevo', '(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Africa/Lagos', '(GMT+01:00) West Central Africa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Asia/Amman', '(GMT+02:00) Amman', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Europe/Athens', '(GMT+02:00) Athens, Bucharest, Istanbul', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Asia/Beirut', '(GMT+02:00) Beirut', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Africa/Cairo', '(GMT+02:00) Cairo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Africa/Harare', '(GMT+02:00) Harare, Pretoria', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Europe/Helsinki', '(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Asia/Jerusalem', '(GMT+02:00) Jerusalem', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Europe/Minsk', '(GMT+02:00) Minsk', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'Africa/Windhoek', '(GMT+02:00) Windhoek', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Asia/Kuwait', '(GMT+03:00) Kuwait, Riyadh, Baghdad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Europe/Moscow', '(GMT+03:00) Moscow, St. Petersburg, Volgograd', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Africa/Nairobi', '(GMT+03:00) Nairobi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Asia/Tbilisi', '(GMT+03:00) Tbilisi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Asia/Tehran', '(GMT+03:30) Tehran', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Asia/Muscat', '(GMT+04:00) Abu Dhabi, Muscat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Asia/Baku', '(GMT+04:00) Baku', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Asia/Yerevan', '(GMT+04:00) Yerevan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Asia/Kabul', '(GMT+04:30) Kabul', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Asia/Yekaterinburg', '(GMT+05:00) Yekaterinburg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Asia/Karachi', '(GMT+05:00) Islamabad, Karachi, Tashkent', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Asia/Calcutta', '(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Asia/Calcutta', '(GMT+05:30) Sri Jayawardenapura', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Asia/Katmandu', '(GMT+05:45) Kathmandu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Asia/Almaty', '(GMT+06:00) Almaty, Novosibirsk', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'Asia/Dhaka', '(GMT+06:00) Astana, Dhaka', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'Asia/Rangoon', '(GMT+06:30) Yangon (Rangoon)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Asia/Bangkok', '(GMT+07:00) Bangkok, Hanoi, Jakarta', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'Asia/Krasnoyarsk', '(GMT+07:00) Krasnoyarsk', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Asia/Hong_Kong', '(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'Asia/Kuala_Lumpur', '(GMT+08:00) Kuala Lumpur, Singapore', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'Asia/Irkutsk', '(GMT+08:00) Irkutsk, Ulaan Bataar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'Australia/Perth', '(GMT+08:00) Perth', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Asia/Taipei', '(GMT+08:00) Taipei', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'Asia/Tokyo', '(GMT+09:00) Osaka, Sapporo, Tokyo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Asia/Seoul', '(GMT+09:00) Seoul', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'Asia/Yakutsk', '(GMT+09:00) Yakutsk', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'Australia/Adelaide', '(GMT+09:30) Adelaide', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'Australia/Darwin', '(GMT+09:30) Darwin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'Australia/Brisbane', '(GMT+10:00) Brisbane', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'Australia/Canberra', '(GMT+10:00) Canberra, Melbourne, Sydney', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'Australia/Hobart', '(GMT+10:00) Hobart', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'Pacific/Guam', '(GMT+10:00) Guam, Port Moresby', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'Asia/Vladivostok', '(GMT+10:00) Vladivostok', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'Asia/Magadan', '(GMT+11:00) Magadan, Solomon Is., New Caledonia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'Pacific/Auckland', '(GMT+12:00) Auckland, Wellington', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'Pacific/Fiji', '(GMT+12:00) Fiji, Kamchatka, Marshall Is', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'Pacific/Tongatapu', '(GMT+13:00) Nuku\'alofa', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `php_mail_setting`
--

CREATE TABLE `php_mail_setting` (
  `id` int(11) NOT NULL,
  `ems_php_mail_from` varchar(128) NOT NULL,
  `ems_php_mail_name` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='PHP Mail Configuration';

--
-- Dumping data for table `php_mail_setting`
--

INSERT INTO `php_mail_setting` (`id`, `ems_php_mail_from`, `ems_php_mail_name`, `created_at`, `updated_at`) VALUES
(1, 'info@backtoschool.com', 'Md. Abdullah Al Mamun Roni', '2020-06-17 17:12:25', '2020-07-25 11:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `salary_setting`
--

CREATE TABLE `salary_setting` (
  `id` int(11) NOT NULL COMMENT 'SALARY ID',
  `ems_da` double DEFAULT NULL,
  `ems_hra` double DEFAULT NULL,
  `ems_pf_ees_share` double DEFAULT NULL,
  `ems_pf_org_share` double DEFAULT NULL,
  `ems_esi_ees_share` double DEFAULT NULL,
  `ems_esi_org_share` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Base Configuration of Salary';

--
-- Dumping data for table `salary_setting`
--

INSERT INTO `salary_setting` (`id`, `ems_da`, `ems_hra`, `ems_pf_ees_share`, `ems_pf_org_share`, `ems_esi_ees_share`, `ems_esi_org_share`, `created_at`, `updated_at`) VALUES
(1, 10, 10, 10, 10, 10, 10, '2020-06-17 14:32:14', '2020-06-22 21:44:15');

-- --------------------------------------------------------

--
-- Table structure for table `smtp_setting`
--

CREATE TABLE `smtp_setting` (
  `id` int(11) NOT NULL COMMENT 'SMTP ID',
  `ems_smtp_host` varchar(128) NOT NULL,
  `ems_smtp_user` varchar(128) NOT NULL,
  `ems_smtp_pass` varchar(128) NOT NULL,
  `ems_smtp_port` varchar(32) NOT NULL,
  `ems_smtp_auth_domain` varchar(256) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='SMTP Mail Configuration';

--
-- Dumping data for table `smtp_setting`
--

INSERT INTO `smtp_setting` (`id`, `ems_smtp_host`, `ems_smtp_user`, `ems_smtp_pass`, `ems_smtp_port`, `ems_smtp_auth_domain`, `created_at`, `updated_at`) VALUES
(1, 'smtp.google.com', 'noreplay@backtoschool.com', 'abc12345', '465', 'SSL', '2020-06-17 16:39:52', '2020-07-25 11:02:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ems_admins`
--
ALTER TABLE `ems_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_admission_fees`
--
ALTER TABLE `ems_admission_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `ems_blogs`
--
ALTER TABLE `ems_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_classes`
--
ALTER TABLE `ems_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_class_routine`
--
ALTER TABLE `ems_class_routine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `shift_id` (`shift_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `ems_contact_config`
--
ALTER TABLE `ems_contact_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_create_payments`
--
ALTER TABLE `ems_create_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_crendential`
--
ALTER TABLE `ems_crendential`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_departments`
--
ALTER TABLE `ems_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_designations`
--
ALTER TABLE `ems_designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `ems_employees`
--
ALTER TABLE `ems_employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_desg_id` (`employee_desg_id`),
  ADD KEY `employee_dept_id` (`employee_dept_id`);

--
-- Indexes for table `ems_events`
--
ALTER TABLE `ems_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_exam_grades`
--
ALTER TABLE `ems_exam_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_exam_marksheet`
--
ALTER TABLE `ems_exam_marksheet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `shift_id` (`shift_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `ems_exam_marks_subjects`
--
ALTER TABLE `ems_exam_marks_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marks_sheet_id` (`marks_sheet_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `ems_exam_schedule`
--
ALTER TABLE `ems_exam_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `shift_id` (`shift_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `ems_galleries`
--
ALTER TABLE `ems_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_icons`
--
ALTER TABLE `ems_icons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_leave_config`
--
ALTER TABLE `ems_leave_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_libraries`
--
ALTER TABLE `ems_libraries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `ems_monthly_fees`
--
ALTER TABLE `ems_monthly_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `ems_notices`
--
ALTER TABLE `ems_notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_org_config`
--
ALTER TABLE `ems_org_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timezone` (`timezone`);

--
-- Indexes for table `ems_parents`
--
ALTER TABLE `ems_parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_payments_details`
--
ALTER TABLE `ems_payments_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_id` (`payments_id`);

--
-- Indexes for table `ems_semesters`
--
ALTER TABLE `ems_semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_shifts`
--
ALTER TABLE `ems_shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_students`
--
ALTER TABLE `ems_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shift_id` (`shift_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `ems_student_attendance`
--
ALTER TABLE `ems_student_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `shift_id` (`shift_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `ems_student_attendance_status`
--
ALTER TABLE `ems_student_attendance_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `attendance_id` (`attendance_id`);

--
-- Indexes for table `ems_subjects`
--
ALTER TABLE `ems_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_teachers`
--
ALTER TABLE `ems_teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `designation_id` (`designation_id`);

--
-- Indexes for table `ems_timezone`
--
ALTER TABLE `ems_timezone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `php_mail_setting`
--
ALTER TABLE `php_mail_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_setting`
--
ALTER TABLE `salary_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtp_setting`
--
ALTER TABLE `smtp_setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ems_admins`
--
ALTER TABLE `ems_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ADMINS ID', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ems_admission_fees`
--
ALTER TABLE `ems_admission_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ADMISSION FEES', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ems_blogs`
--
ALTER TABLE `ems_blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'BLOG ID', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ems_classes`
--
ALTER TABLE `ems_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CLASSES ID', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ems_class_routine`
--
ALTER TABLE `ems_class_routine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CLASS ROUTINE ID', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ems_contact_config`
--
ALTER TABLE `ems_contact_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CONTACT CONFIG ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ems_create_payments`
--
ALTER TABLE `ems_create_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CREATE PAYMENT ID', AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `ems_crendential`
--
ALTER TABLE `ems_crendential`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CREDENTIAL ID', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ems_departments`
--
ALTER TABLE `ems_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'DEPARTMENT ID', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ems_designations`
--
ALTER TABLE `ems_designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'DESIGNATION ID', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ems_employees`
--
ALTER TABLE `ems_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'EMPLOYEES ID', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ems_events`
--
ALTER TABLE `ems_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'EVENTS ID', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ems_exam_grades`
--
ALTER TABLE `ems_exam_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'EXAM GRADE ID', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ems_exam_marksheet`
--
ALTER TABLE `ems_exam_marksheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'EXAM MARK SHEET ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ems_exam_marks_subjects`
--
ALTER TABLE `ems_exam_marks_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'EXAM SUBJECT MARKS ID', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ems_exam_schedule`
--
ALTER TABLE `ems_exam_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'EXAM SCHEDULE ID', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ems_galleries`
--
ALTER TABLE `ems_galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'GALLARY IMAGE ID', AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `ems_icons`
--
ALTER TABLE `ems_icons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ICONS ID', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ems_leave_config`
--
ALTER TABLE `ems_leave_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'LEAVE CONFIG ID', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ems_libraries`
--
ALTER TABLE `ems_libraries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'LIBRARIES ID', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ems_monthly_fees`
--
ALTER TABLE `ems_monthly_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'MONTHLY FEES ID', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ems_notices`
--
ALTER TABLE `ems_notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'NOTICE ID', AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ems_org_config`
--
ALTER TABLE `ems_org_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ORG CONFIG ID', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ems_parents`
--
ALTER TABLE `ems_parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PARENTS ID', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ems_payments_details`
--
ALTER TABLE `ems_payments_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PAYMENT DETAILS ID', AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `ems_semesters`
--
ALTER TABLE `ems_semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SEMESTER ID', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ems_shifts`
--
ALTER TABLE `ems_shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SHIFT ID', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ems_students`
--
ALTER TABLE `ems_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'STUDENT ID', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ems_student_attendance`
--
ALTER TABLE `ems_student_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'STUDENT ATTENDANCE ID', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ems_student_attendance_status`
--
ALTER TABLE `ems_student_attendance_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ATTENDANCE STATUS ID', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ems_subjects`
--
ALTER TABLE `ems_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SUBJECT ID', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ems_teachers`
--
ALTER TABLE `ems_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'TEACHER ID', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ems_timezone`
--
ALTER TABLE `ems_timezone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `php_mail_setting`
--
ALTER TABLE `php_mail_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salary_setting`
--
ALTER TABLE `salary_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SALARY ID', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smtp_setting`
--
ALTER TABLE `smtp_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SMTP ID', AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ems_admission_fees`
--
ALTER TABLE `ems_admission_fees`
  ADD CONSTRAINT `ems_admission_fees_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `ems_students` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ems_class_routine`
--
ALTER TABLE `ems_class_routine`
  ADD CONSTRAINT `ems_class_routine_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `ems_classes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_class_routine_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `ems_subjects` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_class_routine_ibfk_3` FOREIGN KEY (`shift_id`) REFERENCES `ems_shifts` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_class_routine_ibfk_4` FOREIGN KEY (`teacher_id`) REFERENCES `ems_teachers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ems_designations`
--
ALTER TABLE `ems_designations`
  ADD CONSTRAINT `ems_designations_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `ems_departments` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ems_employees`
--
ALTER TABLE `ems_employees`
  ADD CONSTRAINT `ems_employees_ibfk_1` FOREIGN KEY (`employee_desg_id`) REFERENCES `ems_designations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_employees_ibfk_2` FOREIGN KEY (`employee_dept_id`) REFERENCES `ems_departments` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ems_exam_marksheet`
--
ALTER TABLE `ems_exam_marksheet`
  ADD CONSTRAINT `ems_exam_marksheet_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `ems_students` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_exam_marksheet_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `ems_classes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_exam_marksheet_ibfk_3` FOREIGN KEY (`shift_id`) REFERENCES `ems_shifts` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_exam_marksheet_ibfk_4` FOREIGN KEY (`semester_id`) REFERENCES `ems_semesters` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ems_exam_marks_subjects`
--
ALTER TABLE `ems_exam_marks_subjects`
  ADD CONSTRAINT `ems_exam_marks_subjects_ibfk_1` FOREIGN KEY (`marks_sheet_id`) REFERENCES `ems_exam_marksheet` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_exam_marks_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `ems_subjects` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ems_exam_schedule`
--
ALTER TABLE `ems_exam_schedule`
  ADD CONSTRAINT `ems_exam_schedule_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `ems_classes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_exam_schedule_ibfk_2` FOREIGN KEY (`shift_id`) REFERENCES `ems_shifts` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_exam_schedule_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `ems_semesters` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_exam_schedule_ibfk_4` FOREIGN KEY (`subject_id`) REFERENCES `ems_subjects` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_exam_schedule_ibfk_5` FOREIGN KEY (`teacher_id`) REFERENCES `ems_teachers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ems_libraries`
--
ALTER TABLE `ems_libraries`
  ADD CONSTRAINT `ems_libraries_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `ems_classes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_libraries_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `ems_subjects` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ems_monthly_fees`
--
ALTER TABLE `ems_monthly_fees`
  ADD CONSTRAINT `ems_monthly_fees_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `ems_students` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ems_org_config`
--
ALTER TABLE `ems_org_config`
  ADD CONSTRAINT `ems_org_config_ibfk_1` FOREIGN KEY (`timezone`) REFERENCES `ems_timezone` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ems_payments_details`
--
ALTER TABLE `ems_payments_details`
  ADD CONSTRAINT `ems_payments_details_ibfk_1` FOREIGN KEY (`payments_id`) REFERENCES `ems_create_payments` (`id`);

--
-- Constraints for table `ems_students`
--
ALTER TABLE `ems_students`
  ADD CONSTRAINT `ems_students_ibfk_1` FOREIGN KEY (`shift_id`) REFERENCES `ems_shifts` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_students_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `ems_classes` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ems_student_attendance`
--
ALTER TABLE `ems_student_attendance`
  ADD CONSTRAINT `ems_student_attendance_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `ems_classes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_student_attendance_ibfk_3` FOREIGN KEY (`shift_id`) REFERENCES `ems_shifts` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_student_attendance_ibfk_4` FOREIGN KEY (`teacher_id`) REFERENCES `ems_teachers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ems_student_attendance_status`
--
ALTER TABLE `ems_student_attendance_status`
  ADD CONSTRAINT `ems_student_attendance_status_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `ems_students` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_student_attendance_status_ibfk_2` FOREIGN KEY (`attendance_id`) REFERENCES `ems_student_attendance` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ems_teachers`
--
ALTER TABLE `ems_teachers`
  ADD CONSTRAINT `ems_teachers_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `ems_departments` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ems_teachers_ibfk_2` FOREIGN KEY (`designation_id`) REFERENCES `ems_designations` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
