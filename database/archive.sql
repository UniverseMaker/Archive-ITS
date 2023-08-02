-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 23-08-02 10:39
-- 서버 버전: 10.3.35-MariaDB-log
-- PHP 버전: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `superblaze`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_accesscontrol`
--

CREATE TABLE `archive_accesscontrol` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` text NOT NULL,
  `target` text NOT NULL,
  `object` text NOT NULL,
  `read` text NOT NULL,
  `write` text NOT NULL,
  `execute` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `archive_accesscontrol`
--

INSERT INTO `archive_accesscontrol` (`id`, `type`, `target`, `object`, `read`, `write`, `execute`) VALUES
(1, 'page', '/archive/project/project_list.php', '', '', '', ''),
(2, 'page', '/archive/project/project_write.php', '', '10', '10', '10'),
(3, 'page', '/archive/project/issue_list.php', '', '', '', ''),
(4, 'page', '/archive/project/issue_write.php', '', '10', '10', '10'),
(5, 'page', '/archive/document/space_list.php', '', '', '', ''),
(6, 'page', '/archive/document/space_write.php', '', '10', '10', '10'),
(7, 'page', '/archive/document/document_list.php', '', '', '', ''),
(8, 'page', '/archive/document/document_write.php', '', '10', '10', '10'),
(9, 'page', '/archive/document/space_write_submit.php', '', '', '', ''),
(10, 'page', '/archive/project/issue_view.php', '', '', '', ''),
(11, 'page', '/archive/document/document_view.php', '', '', '', ''),
(12, 'page', '/archive/project/issue_write_submit.php', '', '', '', ''),
(13, 'page', '/archive/project/issue_comment_write_submit.php', '', '', '', ''),
(14, 'page', '/archive/sms/smsbypass.php', '', '10', '10', '10'),
(15, 'page', '/archive/project/openview_management.php', '', '', '', ''),
(16, 'page', '/archive/project/openview_management_submit.php', '', '', '', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_account`
--

CREATE TABLE `archive_account` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `keypair_password` text NOT NULL,
  `keypair_puk` text NOT NULL,
  `keypair_prk` text NOT NULL,
  `security_level` text NOT NULL,
  `token` text NOT NULL,
  `profile` text NOT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_lastlogin` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `archive_account`
--

INSERT INTO `archive_account` (`id`, `username`, `password`, `keypair_password`, `keypair_puk`, `keypair_prk`, `security_level`, `token`, `profile`, `date_create`, `date_lastlogin`) VALUES
(1, 'admin', 'admin', 'admin', '-----BEGIN PUBLIC KEY-----\nMIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEApoqf42VgzOn3Bq41sECI\nlwH+HgLH0YT10xDurNH1LfO4qzJxhZVFLX+xOQEBYaaJpL6S3HTi+96DZRmW7O3y\n2iTWX/rX+u9PvYXh50thT5sDBLjzfdoIxWn1SKn3TXw0WIY8wALnLuMKpbSnUFRR\nuNwjlEnROqtH6QqOqAlaIVg5g/+r+yUPuH75Es/RDLp67A7I2l9Yc6l22DWLaTAP\njuIrGCRttrOTSunzL/YTt/HZyhzUAI5L97/2mJaUUYf7P80z220ScQSnTLiUijfS\nkMH04pWD+BfFBNoFBvvAhiZGuzrOOPUfE4dUMhKlbMKC2FfGncUL4ir5uzlIbkRq\nuwMdA+ruM16+qgkeDFy+0RjT1GG0JaET87fwsUvnZQS5UsV8gF1Tn1LcRyg6nSx+\njN41asFblmApXrIzR9L3Ns1rwAOHYDTmhUv/ioZTwoRDCB9u4tRkKC8zXvfPqW8f\nYKOA+9iB7lkVB/bhrfBslkp5M1Hot2zCIovgaUhB6osx7P+PzxLKESmo7qMdir6m\nsGU/HiYXg+rFvpaoqFtAhtkrGyMjbjHZv+4uDmyF0jeJ3v8TXX7vVQXhSaeBaVEp\n3THc/SjZ72ZxKMdLJdWQIWakQ3lnCQgcgvJmd7ViI893zctW5k10RyHuIKAhQXXW\nkX+hyOQKGEvYg6InEiaxW2MCAwEAAQ==\n-----END PUBLIC KEY-----\n', '-----BEGIN ENCRYPTED PRIVATE KEY-----\n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\nVSg=\n-----END ENCRYPTED PRIVATE KEY-----\n', '10', '1phqs8adrstrph8s8227ln8mm8', '{\"nickname\":\"박대승\",\"avatar\":\"img/avatar/useravatar16.svg\",\"job\":\"Scientist\",\"phone\":\"\",\"address\":\"\",\"introduction\":\"\"}', '2018-02-15 00:00:00', '2023-08-02 09:56:26');

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_customer`
--

CREATE TABLE `archive_customer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company` text NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `archive_customer`
--

INSERT INTO `archive_customer` (`id`, `company`, `name`, `phone`, `address`) VALUES
(1, 'SELEOS', '박대승', '01012341234', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_document`
--

CREATE TABLE `archive_document` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_space` bigint(20) NOT NULL,
  `id_owner` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `contents` text NOT NULL,
  `priority` text NOT NULL,
  `security_level` text NOT NULL,
  `status` text NOT NULL,
  `tag` text NOT NULL,
  `variable` text NOT NULL,
  `date_create` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `archive_document`
--

INSERT INTO `archive_document` (`id`, `id_space`, `id_owner`, `name`, `contents`, `priority`, `security_level`, `status`, `tag`, `variable`, `date_create`, `date_modify`) VALUES
(1, 2, 1, 'System+Development+Phase+1+Complete', '%3Cp%3ESystem+Development+Phase+1+Complete%3C%2Fp%3E%0D%0A', 'document_priority_medium', '', 'document_status_in_write', '', '{\"prograss\":0,\"duedate\":\"\"}', '2018-02-22 21:58:51', '2018-02-24 00:57:08');

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_encryption_key`
--

CREATE TABLE `archive_encryption_key` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_owner` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `data` text NOT NULL,
  `date_create` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_global_config`
--

CREATE TABLE `archive_global_config` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `data` text NOT NULL,
  `priority` int(11) NOT NULL,
  `options` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `archive_global_config`
--

INSERT INTO `archive_global_config` (`id`, `code`, `name`, `data`, `priority`, `options`) VALUES
(1, 'profile', 'FULL NAME', 'nickname', 0, ''),
(2, 'profile', 'AVATAR', 'avatar', 0, ''),
(3, 'profile', 'JOB', 'job', 0, ''),
(4, 'profile', 'PHONE NUMBER', 'phone', 0, ''),
(5, 'profile', 'ADDRESS', 'address', 0, ''),
(6, 'profile', 'INTRODUCTION', 'introduction', 0, '');

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_issue`
--

CREATE TABLE `archive_issue` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_project` bigint(20) NOT NULL,
  `id_owner` bigint(20) NOT NULL,
  `id_manager` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `contents` text NOT NULL,
  `type` text NOT NULL,
  `priority` text NOT NULL,
  `security_level` text NOT NULL,
  `status` text NOT NULL,
  `tag` text NOT NULL,
  `variable` text NOT NULL,
  `date_create` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `archive_issue`
--

INSERT INTO `archive_issue` (`id`, `id_project`, `id_owner`, `id_manager`, `name`, `contents`, `type`, `priority`, `security_level`, `status`, `tag`, `variable`, `date_create`, `date_modify`) VALUES
(1, 1, 1, 1, 'Daily+Process+Application', 'Daily+Process+Application', 'issue_type_task', 'issue_priority_medium', '', 'issue_status_assign', '', '{\"prograss\":0,\"duedate\":\"\"}', '2018-02-16 07:44:40', '2018-02-16 07:44:40'),
(3, 3, 1, 1, 'Emerald+Talk+Android+Application+Modify+Server+Connection', 'Emerald+Talk+Android+Application+Modify+Server+Connection', 'issue_type_task', 'issue_priority_medium', '', 'issue_status_assign', '', '{\"prograss\":0,\"duedate\":\"\"}', '2018-02-16 09:16:49', '2023-08-02 10:15:16'),
(4, 3, 1, 1, 'Mini%27s+Lottery+Android+Application+Remake', 'Mini%27s+Lottery+Android+Application+Remake', 'issue_type_task', 'issue_priority_medium', '', 'issue_status_assign', '', '{\"prograss\":0,\"duedate\":\"\"}', '2018-02-16 09:17:49', '2018-02-16 09:17:49'),
(5, 3, 1, 1, 'Sleep+Diary', 'Sleep+Diary', 'issue_type_task', 'issue_priority_medium', '', 'issue_status_assign', '', '{\"prograss\":0,\"duedate\":\"\"}', '2018-02-16 09:19:18', '2018-02-16 09:19:18'),
(13, 1, 1, 1, 'Project+Management+System+Development', '%3Cp%3EProject+Management+System+%28PMS%29+with+Issue+Tracking+System+%28ITS%29+Development%3C%2Fp%3E%0D%0A', 'issue_type_task', 'issue_priority_high', '', 'issue_status_in_progress', '', '{\"prograss\":14,\"duedate\":\"\",\"timespent\":20,\"observer\":1}', '2018-02-18 22:08:24', '2018-11-21 21:06:40');

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_issue_activity`
--

CREATE TABLE `archive_issue_activity` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_issue` bigint(20) NOT NULL,
  `id_owner` bigint(20) NOT NULL,
  `type` text NOT NULL,
  `contents` text NOT NULL,
  `date_create` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `archive_issue_activity`
--

INSERT INTO `archive_issue_activity` (`id`, `id_issue`, `id_owner`, `type`, `contents`, `date_create`, `date_modify`) VALUES
(11, 13, 1, 'comment', '%3Cp%3EDatabase+Design%3C%2Fp%3E%0D%0A', '2018-02-18 22:10:17', '2018-02-18 22:10:17'),
(12, 13, 1, 'comment', '%3Cp%3EComplete%3Cbr+%2F%3EUI+Design+Phase+1%3C%2Fp%3E', '2018-02-20 17:14:41', '2018-02-20 17:14:41'),
(13, 13, 1, 'comment', '%3Cp%3ERequire%3Cbr+%2F%3EProject+Write+%26amp%3B+Modify+Page+Design%3Cbr+%2F%3EIssue+Write+%26amp%3B+Modify+Page+Design%3Cbr+%2F%3EIssue+detail+Comment+Design+Improvement%3Cbr+%2F%3EDocument+Management+System%3C%2Fp%3E', '2018-02-20 17:16:13', '2018-02-20 17:16:13'),
(15, 13, 1, 'comment', '%3Cp%3ERequire%3Cbr+%2F%3EOpen+Access+System%3Cbr+%2F%3EKey-Pair+Management+System%3C%2Fp%3E', '2018-03-23 13:05:12', '2018-03-23 13:05:12'),
(16, 13, 1, 'comment', '%ED%94%84%EB%A1%9C%EC%A0%9D%ED%8A%B8+%EB%8B%B4%EB%8B%B9%EC%9E%90%EA%B0%80+%EB%B0%95%EB%8C%80%EC%8A%B9%281%29%EB%8B%98%EC%9D%84+Observer%28%EA%B4%80%EC%B8%A1%EC%9E%90%29%EB%A1%9C+%EB%93%B1%EB%A1%9D%ED%95%98%EC%85%A8%EC%8A%B5%EB%8B%88%EB%8B%A4.', '2018-11-21 21:06:40', '2018-11-21 21:06:40');

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_log`
--

CREATE TABLE `archive_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` text NOT NULL,
  `data` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_openview`
--

CREATE TABLE `archive_openview` (
  `id` bigint(20) NOT NULL,
  `projectid` text NOT NULL,
  `issueid` text NOT NULL,
  `token` text NOT NULL,
  `password` text NOT NULL,
  `valid` text NOT NULL,
  `variable` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `archive_openview`
--

INSERT INTO `archive_openview` (`id`, `projectid`, `issueid`, `token`, `password`, `valid`, `variable`) VALUES
(0, '1', '13', 'AB1234', '1234', '20200226 235959', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_project`
--

CREATE TABLE `archive_project` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_owner` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `contents` text NOT NULL,
  `security_level` text NOT NULL,
  `status` text NOT NULL,
  `tag` text NOT NULL,
  `date_create` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `archive_project`
--

INSERT INTO `archive_project` (`id`, `id_owner`, `name`, `contents`, `security_level`, `status`, `tag`, `date_create`, `date_modify`) VALUES
(1, 1, 'General+Project', '%3Cp%3EGeneral+Project%3C%2Fp%3E%0D%0A', 'security_level_5', 'project_status_initiate', '', '2018-02-16 06:51:26', '2018-02-24 00:05:12'),
(2, 1, 'Temporary+Contract', 'Temporary+Contract', 'security_level_0', 'project_status_open', '', '2018-02-16 06:53:27', '2018-02-16 06:53:27'),
(3, 1, 'Mobile+Project', 'Mobile+Project', 'security_level_4', 'project_status_open', '', '2018-02-16 06:54:07', '2018-02-16 06:54:07'),
(4, 1, 'Academic+Research', 'Academic+Research', 'security_level_10', 'project_status_open', '', '2018-02-16 06:54:33', '2018-02-16 06:54:33');

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_sms`
--

CREATE TABLE `archive_sms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `data` text NOT NULL,
  `status` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_space`
--

CREATE TABLE `archive_space` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_owner` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `contents` text NOT NULL,
  `security_level` text NOT NULL,
  `status` text NOT NULL,
  `tag` text NOT NULL,
  `date_create` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `archive_space`
--

INSERT INTO `archive_space` (`id`, `id_owner`, `name`, `contents`, `security_level`, `status`, `tag`, `date_create`, `date_modify`) VALUES
(2, 1, 'Diary', '%3Cp%3EDiary%3C%2Fp%3E%0D%0A', 'security_level_6', 'space_status_open', '', '2018-02-24 06:43:37', '2018-02-24 06:43:37'),
(3, 1, 'Academic+Research', '%3Cp%3EAcademic+Research%3C%2Fp%3E%0D%0A', 'security_level_10', 'space_status_open', '', '2018-02-24 06:44:04', '2018-02-24 06:44:04'),
(6, 1, 'Language', '%3Cp%3ELanguage%3C%2Fp%3E%0D%0A', 'security_level_3', 'space_status_open', '', '2018-03-02 18:16:11', '2018-03-02 18:16:11'),
(7, 1, 'WIKI', '%3Cp%3EOpen+Wiki+Service%3C%2Fp%3E%0D%0A', 'security_level_0', 'space_status_open', '', '2018-11-17 01:19:12', '2018-11-17 01:19:12');

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_status`
--

CREATE TABLE `archive_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` text NOT NULL,
  `category` text NOT NULL,
  `name` text NOT NULL,
  `data` text NOT NULL,
  `priority` int(11) NOT NULL,
  `options` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `archive_status`
--

INSERT INTO `archive_status` (`id`, `code`, `category`, `name`, `data`, `priority`, `options`) VALUES
(1, 'security_level_0', 'security_level', 'Unclassified', '0', 0, '{\"color_class\":\"\"}'),
(2, 'security_level_1', 'security_level', 'Unclassified', '1', 0, '{\"color_class\":\"\"}'),
(3, 'security_level_2', 'security_level', 'Restricted', '2', 0, '{\"color_class\":\"info\"}'),
(4, 'security_level_3', 'security_level', 'Restricted', '3', 0, '{\"color_class\":\"info\"}'),
(5, 'security_level_4', 'security_level', 'Restricted', '4', 0, '{\"color_class\":\"info\"}'),
(6, 'security_level_5', 'security_level', 'Confidential', '5', 0, '{\"color_class\":\"warning\"}'),
(7, 'security_level_6', 'security_level', 'Confidential', '6', 0, '{\"color_class\":\"warning\"}'),
(8, 'security_level_7', 'security_level', 'Confidential', '7', 0, '{\"color_class\":\"warning\"}'),
(9, 'security_level_8', 'security_level', 'Secret', '8', 0, '{\"color_class\":\"danger\"}'),
(10, 'security_level_9', 'security_level', 'Secret', '9', 0, '{\"color_class\":\"danger\"}'),
(11, 'security_level_10', 'security_level', 'Top Secret', '10', 0, '{\"color_class\":\"danger\"}'),
(12, 'issue_type_epic', 'issue_type', 'Epic', '0', 0, '{\"color_class\":\"\"}'),
(13, 'issue_type_story', 'issue_type', 'Story', '0', 0, '{\"color_class\":\"\"}'),
(14, 'issue_type_task', 'issue_type', 'Task', '0', 0, '{\"color_class\":\"\"}'),
(15, 'issue_type_bug', 'issue_type', 'Bug', '0', 0, '{\"color_class\":\"\"}'),
(16, 'issue_type_improvement', 'issue_type', 'Improvement', '0', 0, '{\"color_class\":\"\"}'),
(17, 'issue_type_new_feature', 'issue_type', 'New Feature', '0', 0, '{\"color_class\":\"\"}'),
(18, 'issue_status_assign', 'issue_status', 'Assign', '0', 0, '{\"color_class\":\"\"}'),
(19, 'issue_status_to_do', 'issue_status', 'To Do', '0', 0, '{\"color_class\":\"\"}'),
(20, 'issue_status_in_progress', 'issue_status', 'In Progress', '0', 0, '{\"color_class\":\"primary\"}'),
(21, 'issue_status_in_review', 'issue_status', 'In Review', '0', 0, '{\"color_class\":\"info\"}'),
(22, 'issue_status_done', 'issue_status', 'Done', '0', 0, '{\"color_class\":\"success\"}'),
(23, 'project_status_open', 'project_status', 'Open', '0', 0, '{\"color_class\":\"\"}'),
(24, 'project_status_initiate', 'project_status', 'Initiate', '0', 0, '{\"color_class\":\"primary\"}'),
(25, 'project_status_plan', 'project_status', 'Plan', '0', 0, '{\"color_class\":\"primary\"}'),
(26, 'project_status_execute', 'project_status', 'Execute', '0', 0, '{\"color_class\":\"info\"}'),
(27, 'project_status_monitor', 'project_status', 'Monitor', '0', 0, '{\"color_class\":\"success\"}'),
(28, 'project_status_close', 'project_status', 'Close', '0', 0, '{\"color_class\":\"\"}'),
(29, 'issue_priority_lowest', 'issue_priority', 'Lowest', '0', 0, '{\"color_class\":\"info\"}'),
(30, 'issue_priority_low', 'issue_priority', 'Low', '0', 0, '{\"color_class\":\"info\"}'),
(31, 'issue_priority_medium', 'issue_priority', 'Medium', '0', 0, '{\"color_class\":\"warning\"}'),
(32, 'issue_priority_high', 'issue_priority', 'High', '0', 0, '{\"color_class\":\"danger\"}'),
(33, 'issue_priority_highest', 'issue_priority', 'Highest', '0', 0, '{\"color_class\":\"danger\"}'),
(34, 'issue_priority_urgent', 'issue_priority', 'Urgent', '0', 0, '{\"color_class\":\"danger\"}'),
(35, 'issue_status_cancel', 'issue_status', 'Cancel', '0', 0, '{\"color_class\":\"warning\"}'),
(36, 'issue_status_reject', 'issue_status', 'Reject', '0', 0, '{\"color_class\":\"danger\"}'),
(37, 'issue_status_fail', 'issue_status', 'Fail', '0', 0, '{\"color_class\":\"danger\"}'),
(38, 'project_status_cancel', 'project_status', 'Cancel', '0', 0, '{\"color_class\":\"warning\"}'),
(39, 'project_status_reject', 'project_status', 'Reject', '0', 0, '{\"color_class\":\"danger\"}'),
(40, 'project_status_fail', 'project_status', 'Fail', '0', 0, '{\"color_class\":\"danger\"}'),
(41, 'space_status_open', 'space_status', 'Open', '0', 0, '{\"color_class\":\"info\"}'),
(42, 'space_status_close', 'space_status', 'Close', '0', 0, '{\"color_class\":\"\"}'),
(43, 'document_priority_lowest', 'document_priority', 'Lowest', '0', 0, '{\"color_class\":\"info\"}'),
(44, 'document_priority_low', 'document_priority', 'Low', '0', 0, '{\"color_class\":\"info\"}'),
(45, 'document_priority_medium', 'document_priority', 'Medium', '0', 0, '{\"color_class\":\"warning\"}'),
(46, 'document_priority_high', 'document_priority', 'High', '0', 0, '{\"color_class\":\"danger\"}'),
(47, 'document_priority_highest', 'document_priority', 'Highest', '0', 0, '{\"color_class\":\"danger\"}'),
(48, 'document_priority_urgent', 'document_priority', 'Urgent', '0', 0, '{\"color_class\":\"danger\"}'),
(49, 'document_status_assign', 'document_status', 'Assign', '0', 0, '{\"color_class\":\"\"}'),
(50, 'document_status_in_write', 'document_status', 'In Write', '0', 0, '{\"color_class\":\"info\"}'),
(51, 'document_status_in_review', 'document_status', 'In Review', '0', 0, '{\"color_class\":\"info\"}'),
(52, 'document_status_complete', 'document_status', 'Complete', '0', 0, '{\"color_class\":\"success\"}'),
(53, 'document_status_reject', 'document_status', 'Reject', '0', 0, '{\"color_class\":\"danger\"}'),
(54, 'document_status_fail', 'document_status', 'Fail', '0', 0, '{\"color_class\":\"danger\"}');

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_template`
--

CREATE TABLE `archive_template` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `archive_translation`
--

CREATE TABLE `archive_translation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namespace` text NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `archive_translation`
--

INSERT INTO `archive_translation` (`id`, `namespace`, `data`) VALUES
(1, 'issue_timespent', '프로젝트 개발에 %s을 소요했습니다. 현재까지 총 %s을 소요했습니다.'),
(2, 'issue_timeexpect', '프로젝트 개발에 필요한 시간을 %s으로 예측했습니다.'),
(3, 'issue_duedate', '프로젝트 완성까지 목표일을 %s로 설정했습니다.'),
(4, 'issue_prograss', '작업 진척도가 %d%%로 변경되었습니다.'),
(5, 'issue_observer', '프로젝트 담당자가 %s님을 Observer(관측자)로 등록하셨습니다.'),
(6, 'system_invite', '%s님이 %s님을 프로젝트 관측자로 등록하셨습니다\\r\\n프로젝트 페이지: %s\\r\\n비밀번호: %s');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `archive_account`
--
ALTER TABLE `archive_account`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `archive_customer`
--
ALTER TABLE `archive_customer`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `archive_document`
--
ALTER TABLE `archive_document`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `archive_issue`
--
ALTER TABLE `archive_issue`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `archive_issue_activity`
--
ALTER TABLE `archive_issue_activity`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `archive_project`
--
ALTER TABLE `archive_project`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `archive_space`
--
ALTER TABLE `archive_space`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
