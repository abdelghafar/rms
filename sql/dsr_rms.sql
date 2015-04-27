-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2015 at 10:26 AM
-- Server version: 5.5.42-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dsr_rms`
--
CREATE DATABASE IF NOT EXISTS `dsr_rms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dsr_rms`;

-- --------------------------------------------------------

--
-- Table structure for table `acceptance`
--

CREATE TABLE IF NOT EXISTS `acceptance` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL,
  `context` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `budget_items`
--

CREATE TABLE IF NOT EXISTS `budget_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_alias` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isSys` tinyint(1) DEFAULT NULL,
  `warning_max_val` decimal(10,3) NOT NULL,
  `warning_max_percent` decimal(2,2) NOT NULL,
  `error_max_val` decimal(10,3) NOT NULL,
  `error_max_percent` decimal(2,2) NOT NULL,
  `parent_item_id` int(10) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `council_board`
--

CREATE TABLE IF NOT EXISTS `council_board` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `center_id` int(10) NOT NULL,
  `person_id` varchar(10) NOT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `doc_categories`
--

CREATE TABLE IF NOT EXISTS `doc_categories` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(512) NOT NULL,
  `notes` varchar(512) NOT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `duration`
--

CREATE TABLE IF NOT EXISTS `duration` (
  `seq_id` int(10) NOT NULL AUTO_INCREMENT,
  `duration_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration_title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration_month` int(10) DEFAULT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `duration_units`
--

CREATE TABLE IF NOT EXISTS `duration_units` (
  `seq_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(255) NOT NULL,
  `convert_factor` float NOT NULL DEFAULT '1',
  `upper_unit_id` int(11) NOT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `goals_outcomes`
--

CREATE TABLE IF NOT EXISTS `goals_outcomes` (
  `seq_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `goal_id` int(11) NOT NULL,
  `outcome_id` int(11) NOT NULL,
  `obj_id` bigint(20) NOT NULL,
  PRIMARY KEY (`seq_id`),
  UNIQUE KEY `goal_id` (`goal_id`,`outcome_id`,`obj_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

-- --------------------------------------------------------

--
-- Table structure for table `messaging`
--

CREATE TABLE IF NOT EXISTS `messaging` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1024) NOT NULL,
  `content` text NOT NULL,
  `url` varchar(1024) NOT NULL,
  `src` int(11) NOT NULL,
  `dest` int(11) NOT NULL,
  `submit_date` datetime NOT NULL,
  `isRead` tinyint(1) NOT NULL,
  `read_date` datetime DEFAULT NULL,
  `research_id` int(11) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

-- --------------------------------------------------------

--
-- Table structure for table `oracle_data`
--

CREATE TABLE IF NOT EXISTS `oracle_data` (
  `SEQ_ID` int(11) NOT NULL AUTO_INCREMENT,
  `FORM_DESC` varchar(1024) DEFAULT NULL,
  `SITE_FACULTY_NAME` varchar(1024) DEFAULT NULL,
  `FACULTY_NAME` varchar(1024) DEFAULT NULL,
  `DEPT_NAME` varchar(1024) DEFAULT NULL,
  `EMPLOYEE_ID` int(11) DEFAULT NULL,
  `EMPLOYEE_NAME` varchar(1024) DEFAULT NULL,
  `NATIONAL_ID` varchar(20) DEFAULT NULL,
  `NATIONALITY_DESC` varchar(1024) DEFAULT NULL,
  `GENDER_DESC` varchar(4) DEFAULT NULL,
  `EMPLOYEE_STATUS` varchar(1024) DEFAULT NULL,
  `RANK_DATE` varchar(10) DEFAULT NULL,
  `RANK_DESC` varchar(1024) DEFAULT NULL,
  `EMPLOYEE_CERTIFICATE` varchar(1024) DEFAULT NULL,
  `MOBILE_NO` varchar(12) DEFAULT NULL,
  `EMAIL` varchar(61) DEFAULT NULL,
  `CAT_ID` tinyint(4) NOT NULL,
  `SYN_STAMP` datetime NOT NULL,
  PRIMARY KEY (`SEQ_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
  `Person_id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName_ar` varchar(100) NOT NULL,
  `FirstName_en` varchar(100) NOT NULL,
  `FatherName_ar` varchar(100) NOT NULL,
  `FatherName_en` varchar(100) NOT NULL,
  `GrandName_ar` varchar(100) NOT NULL,
  `GrandName_en` varchar(100) NOT NULL,
  `FamilyName_ar` varchar(100) NOT NULL,
  `FamilyName_en` varchar(100) NOT NULL,
  `Gender` tinyint(1) NOT NULL,
  `Nationality` varchar(100) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `CountryOfBirth` varchar(100) NOT NULL,
  `Position` varchar(100) NOT NULL,
  `Major_Field` varchar(200) NOT NULL,
  `Speical_Field` varchar(200) NOT NULL,
  `university` varchar(200) NOT NULL,
  `College` varchar(200) NOT NULL,
  `Dept` varchar(200) NOT NULL,
  `empCode` varchar(7) NOT NULL,
  `EqamaCode` varchar(10) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Mobile` varchar(12) NOT NULL,
  `Fax` varchar(12) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `POX` varchar(7) NOT NULL,
  `Postal_Code` varchar(5) NOT NULL,
  `IBAN` varchar(128) NOT NULL,
  `SWIFT` varchar(128) NOT NULL,
  `ResumeUrl` varchar(255) NOT NULL,
  `name_ar` varchar(1024) NOT NULL,
  `name_en` varchar(1024) NOT NULL,
  `rank_date` varchar(10) NOT NULL,
  `EMPLOYEE_CERTIFICATE` varchar(100) NOT NULL,
  `EMPLOYEE_STATUS_CODE` int(2) NOT NULL,
  `EMPLOYEE_STATUS` varchar(100) NOT NULL,
  `CAT_CODE` int(2) NOT NULL,
  PRIMARY KEY (`Person_id`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5065 ;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
  `program_id` int(10) NOT NULL AUTO_INCREMENT,
  `program_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `program_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`program_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `program_goals`
--

CREATE TABLE IF NOT EXISTS `program_goals` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `goal_title` varchar(1024) NOT NULL,
  `program_id` int(11) NOT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_budget`
--

CREATE TABLE IF NOT EXISTS `project_budget` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `research_stuff_id` int(11) DEFAULT '0',
  `amount` decimal(10,3) DEFAULT '0.000',
  `duration` int(11) DEFAULT '0',
  `dunit_id` int(11) DEFAULT '0',
  `compensation` float DEFAULT '0',
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=141 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_objectivies`
--

CREATE TABLE IF NOT EXISTS `project_objectivies` (
  `seq_id` int(10) NOT NULL AUTO_INCREMENT,
  `obj_title` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `obj_desc` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=60 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_outcome`
--

CREATE TABLE IF NOT EXISTS `project_outcome` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `outcome_title` text COLLATE utf8_unicode_ci,
  `outcome_desc` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_phases`
--

CREATE TABLE IF NOT EXISTS `project_phases` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `phase_name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phase_desc` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_plan`
--

CREATE TABLE IF NOT EXISTS `project_plan` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `phase_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` float NOT NULL,
  `project_id` int(11) NOT NULL,
  `phase_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_schedule`
--

CREATE TABLE IF NOT EXISTS `project_schedule` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` float NOT NULL,
  `project_id` int(11) NOT NULL,
  `schedule_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phase_id` int(11) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL DEFAULT '0000-00-00',
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_tasks`
--

CREATE TABLE IF NOT EXISTS `project_tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `task_name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `task_desc` text COLLATE utf8_unicode_ci,
  `objective_id` int(11) DEFAULT NULL,
  `phase_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=88 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_types`
--

CREATE TABLE IF NOT EXISTS `project_types` (
  `seq_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_en` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `type_desc` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `isVisible` tinyint(1) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `rcenter_reviewers`
--

CREATE TABLE IF NOT EXISTS `rcenter_reviewers` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `reseacher_centers`
--

CREATE TABLE IF NOT EXISTS `reseacher_centers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `center_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `center_code` varchar(3) NOT NULL,
  `user_name` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `center_code` (`center_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `reseach_status`
--

CREATE TABLE IF NOT EXISTS `reseach_status` (
  `Status_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Status_name` varchar(100) NOT NULL,
  `Phase_id` int(2) NOT NULL,
  PRIMARY KEY (`Status_Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `reseach_track`
--

CREATE TABLE IF NOT EXISTS `reseach_track` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `research_id` int(11) NOT NULL,
  `Status_Id` int(11) NOT NULL,
  `track_date` date NOT NULL,
  `notes` varchar(500) NOT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

-- --------------------------------------------------------

--
-- Table structure for table `researches`
--

CREATE TABLE IF NOT EXISTS `researches` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `title_ar` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(500) NOT NULL,
  `proposed_duration` int(2) NOT NULL,
  `major_field` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `special_field` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `research_code` varchar(9) NOT NULL,
  `Approve_session_no` varchar(50) NOT NULL,
  `Approve_date` date NOT NULL,
  `url` varchar(500) NOT NULL,
  `abstract_ar_url` varchar(500) NOT NULL,
  `abstract_en_url` varchar(500) NOT NULL,
  `introduction_url` varchar(500) NOT NULL,
  `literature_review_url` varchar(500) NOT NULL,
  `status_id` int(2) NOT NULL,
  `status_date` date NOT NULL,
  `center_id` int(2) NOT NULL,
  `research_year` int(4) NOT NULL,
  `RequiresUpdate` tinyint(1) NOT NULL,
  `LastUpdate` datetime NOT NULL,
  `budget` decimal(10,2) NOT NULL,
  `isLocked` tinyint(1) NOT NULL,
  `lockFrom` datetime NOT NULL,
  `lockUntill` datetime NOT NULL,
  `Withdraw` tinyint(1) NOT NULL,
  `withdrawDate` date NOT NULL,
  `program` varchar(512) NOT NULL,
  `round` int(2) NOT NULL,
  `research_method_url` varchar(500) NOT NULL,
  `objective_tasks_url` varchar(500) NOT NULL,
  `objective_approach_url` varchar(512) NOT NULL,
  `working_plan_url` varchar(128) NOT NULL,
  `value_to_kingdom_url` varchar(128) NOT NULL,
  `budget_url` varchar(128) NOT NULL,
  `outcome_objective_url` varchar(128) NOT NULL,
  `refs_url` varchar(128) NOT NULL,
  `introduction_text` text NOT NULL,
  `abstract_ar_text` text NOT NULL,
  `abstract_en_text` text NOT NULL,
  `literature_review_text` text NOT NULL,
  `value_to_kingdom_text` text NOT NULL,
  `type_id` smallint(6) NOT NULL,
  `keywords` varchar(128) NOT NULL,
  `isDraft` tinyint(1) NOT NULL DEFAULT '1',
  `draft_completed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`seq_id`),
  FULLTEXT KEY `title_ar` (`title_ar`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `research_docs`
--

CREATE TABLE IF NOT EXISTS `research_docs` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `research_id` int(11) NOT NULL,
  `doc_cat_id` int(11) NOT NULL,
  `doc_url` varchar(512) NOT NULL,
  `size` float NOT NULL,
  `hash` varchar(255) NOT NULL,
  `notes` varchar(1024) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `research_invitation`
--

CREATE TABLE IF NOT EXISTS `research_invitation` (
  `seq_id` int(10) NOT NULL AUTO_INCREMENT,
  `research_id` int(10) NOT NULL,
  `person_id` int(10) NOT NULL,
  `accept` tinyint(1) NOT NULL,
  `submit_stamp` datetime NOT NULL,
  `reply_stamp` datetime NOT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `research_review`
--

CREATE TABLE IF NOT EXISTS `research_review` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `reviewer_person_id` int(11) NOT NULL,
  `research_id` int(11) NOT NULL,
  `submission_date` date NOT NULL,
  `responce_Status_id` int(11) NOT NULL,
  `responce_date` date DEFAULT NULL,
  `attachment_url` varchar(512) NOT NULL,
  `notes` text NOT NULL,
  `Phase_id` int(2) NOT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `research_stuff`
--

CREATE TABLE IF NOT EXISTS `research_stuff` (
  `seq_no` int(11) NOT NULL AUTO_INCREMENT,
  `research_id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `role_id` int(10) NOT NULL,
  `agreement_url` varchar(512) NOT NULL,
  `resume_url` varchar(512) NOT NULL,
  `type` enum('personal_based','role_based') NOT NULL DEFAULT 'personal_based',
  PRIMARY KEY (`seq_no`),
  UNIQUE KEY `research_id_2` (`research_id`,`role_id`),
  UNIQUE KEY `research_id` (`research_id`,`person_id`,`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `research_update_request`
--

CREATE TABLE IF NOT EXISTS `research_update_request` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `research_id` int(11) NOT NULL,
  `title` varchar(1052) NOT NULL,
  `msg` text NOT NULL,
  `url` varchar(512) NOT NULL,
  `request_date` datetime NOT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `review_phase`
--

CREATE TABLE IF NOT EXISTS `review_phase` (
  `Phase_id` int(2) NOT NULL AUTO_INCREMENT,
  `Phase_Title` varchar(255) NOT NULL,
  PRIMARY KEY (`Phase_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setting_value` text COLLATE utf8_unicode_ci,
  `IsSys` bit(1) DEFAULT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `stuff_roles`
--

CREATE TABLE IF NOT EXISTS `stuff_roles` (
  `seq_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `role_name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_desc` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `parent_role_id` int(10) NOT NULL,
  `value` int(10) NOT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `stuff_tasks`
--

CREATE TABLE IF NOT EXISTS `stuff_tasks` (
  `seq_id` int(10) NOT NULL AUTO_INCREMENT,
  `task_id` int(10) NOT NULL,
  `research_stuff_id` int(10) NOT NULL,
  `start_month` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `unit_id` smallint(6) NOT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=90 ;

-- --------------------------------------------------------

--
-- Table structure for table `subtracks`
--

CREATE TABLE IF NOT EXISTS `subtracks` (
  `seq_id` int(10) NOT NULL AUTO_INCREMENT,
  `subTrack_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `track_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=630 ;

-- --------------------------------------------------------

--
-- Table structure for table `sys_groups`
--

CREATE TABLE IF NOT EXISTS `sys_groups` (
  `Group_id` int(11) NOT NULL AUTO_INCREMENT,
  `Group_name` varchar(500) NOT NULL,
  PRIMARY KEY (`Group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `technologies`
--

CREATE TABLE IF NOT EXISTS `technologies` (
  `seq_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tech_desc` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `isVisible` tinyint(1) NOT NULL DEFAULT '1',
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE IF NOT EXISTS `tracks` (
  `track_id` int(10) NOT NULL AUTO_INCREMENT,
  `track_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tech_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`track_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=71 ;

-- --------------------------------------------------------

--
-- Table structure for table `understanding`
--

CREATE TABLE IF NOT EXISTS `understanding` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(10) NOT NULL,
  `context` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`seq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `uqu_workplaces`
--

CREATE TABLE IF NOT EXISTS `uqu_workplaces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `person_id` int(11) NOT NULL,
  `rule` varchar(20) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `Sys_GroupId` int(2) NOT NULL,
  `FromDate` date NOT NULL,
  `ThruDate` date NOT NULL,
  `isTemp` tinyint(1) NOT NULL DEFAULT '0',
  `alias_name` varchar(1024) NOT NULL,
  `Last_Access` datetime NOT NULL,
  `creation_date` date NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
