-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net

-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eum_up`
--

-- --------------------------------------------------------

--
-- Table structure for table `eum_app_config`
--

CREATE TABLE IF NOT EXISTS `eum_app_config` (
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eum_app_config`
--

INSERT INTO `eum_app_config` (`key`, `value`) VALUES
('address', 'EUM\nUSA'),
('app_logo', 'logo.png'),
('company', 'EUM'),
('currency_symbol', '0'),
('email', 'ergo7care@gmail.com'),
('facebook_appid', ''),
('facebook_login', '1'),
('facebook_secret', ''),
('fax', ''),
('google_appid', ''),
('google_login', '1'),
('google_secret', ''),
('language', 'english'),
('pagination_limit', '20'),
('phone', '9999999'),
('reg_mail_send', '0'),
('timezone', '0'),
('twitter_appid', ''),
('twitter_login', '1'),
('twitter_secret', ''),
('website', 'http://www.eob.com');

-- --------------------------------------------------------

--
-- Table structure for table `eum_cicookies`
--

CREATE TABLE IF NOT EXISTS `eum_cicookies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cookie_id` varchar(255) DEFAULT NULL,
  `netid` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `orig_page_requested` varchar(120) DEFAULT NULL,
  `php_session_id` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `eum_cicookies`
--

INSERT INTO `eum_cicookies` (`id`, `cookie_id`, `netid`, `ip_address`, `user_agent`, `orig_page_requested`, `php_session_id`, `created_at`, `updated_at`) VALUES
(2, '57c7d48126caf8.54730601', '118', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', 'da7b56e0c002c909d412674012e6d74e2bba2f13', '2016-09-01 09:10:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `eum_ci_sessions`
--

CREATE TABLE IF NOT EXISTS `eum_ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eum_country_list`
--

CREATE TABLE IF NOT EXISTS `eum_country_list` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(255) NOT NULL,
  `country_name` varchar(260) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=250 ;

--
-- Dumping data for table `eum_country_list`
--

INSERT INTO `eum_country_list` (`c_id`, `country_code`, `country_name`) VALUES
(1, 'Afghanistan', 'AF'),
(2, 'Åland Islands', 'AX'),
(3, 'Albania', 'AL'),
(4, 'Algeria', 'DZ'),
(5, 'American Samoa', 'AS'),
(6, 'Andorra', 'AD'),
(7, 'Angola', 'AO'),
(8, 'Anguilla', 'AI'),
(9, 'Antarctica', 'AQ'),
(10, 'Antigua and Barbuda', 'AG'),
(11, 'Argentina', 'AR'),
(12, 'Armenia', 'AM'),
(13, 'Aruba', 'AW'),
(14, 'Australia', 'AU'),
(15, 'Austria', 'AT'),
(16, 'Azerbaijan', 'AZ'),
(17, 'Bahamas', 'BS'),
(18, 'Bahrain', 'BH'),
(19, 'Bangladesh', 'BD'),
(20, 'Barbados', 'BB'),
(21, 'Belarus', 'BY'),
(22, 'Belgium', 'BE'),
(23, 'Belize', 'BZ'),
(24, 'Benin', 'BJ'),
(25, 'Bermuda', 'BM'),
(26, 'Bhutan', 'BT'),
(27, 'Bolivia', 'BO'),
(28, 'Bonaire', 'BQ'),
(29, 'Bosnia and Herzegovina', 'BA'),
(30, 'Botswana', 'BW'),
(31, 'Bouvet Island', 'BV'),
(32, 'Brazil', 'BR'),
(33, 'British Indian Ocean Territory', 'IO'),
(34, 'Brunei Darussalam', 'BN'),
(35, 'Bulgaria', 'BG'),
(36, 'Burkina Faso', 'BF'),
(37, 'Burundi', 'BI'),
(38, 'Cambodia', 'KH'),
(39, 'Cameroon', 'CM'),
(40, 'Canada', 'CA'),
(41, 'Cape Verde', 'CV'),
(42, 'Cayman Islands', 'KY'),
(43, 'Central African Republic', 'CF'),
(44, 'Chad', 'TD'),
(45, 'Chile', 'CL'),
(46, 'China', 'CN'),
(47, 'Christmas Island', 'CX'),
(48, 'Cocos Islands', 'CC'),
(49, 'Colombia', 'CO'),
(50, 'Comoros', 'KM'),
(51, 'Congo', 'CG'),
(52, 'Congo', 'CD'),
(53, 'Cook Islands', 'CK'),
(54, 'Costa Rica', 'CR'),
(55, 'Côte d Ivoire', 'CI'),
(56, 'Croatia', 'HR'),
(57, 'Cuba', 'CU'),
(58, 'Curaçao', 'CW'),
(59, 'Cyprus', 'CY'),
(60, 'Czech Republic', 'CZ'),
(61, 'Denmark', 'DK'),
(62, 'Djibouti', 'DJ'),
(63, 'Dominica', 'DM'),
(64, 'Dominican Republic', 'DO'),
(65, 'Ecuador', 'EC'),
(66, 'Egypt', 'EG'),
(67, 'El Salvador', 'SV'),
(68, 'Equatorial Guinea', 'GQ'),
(69, 'Eritrea', 'ER'),
(70, 'Estonia', 'EE'),
(71, 'Ethiopia', 'ET'),
(72, 'Falkland Islands', 'FK'),
(73, 'Faroe Islands', 'FO'),
(74, 'Fiji', 'FJ'),
(75, 'Finland', 'FI'),
(76, 'France', 'FR'),
(77, 'French Guiana', 'GF'),
(78, 'French Polynesia', 'PF'),
(79, 'French Southern Territories', 'TF'),
(80, 'Gabon', 'GA'),
(81, 'Gambia', 'GM'),
(82, 'Georgia', 'GE'),
(83, 'Germany', 'DE'),
(84, 'Ghana', 'GH'),
(85, 'Gibraltar', 'GI'),
(86, 'Greece', 'GR'),
(87, 'Greenland', 'GL'),
(88, 'Grenada', 'GD'),
(89, 'Guadeloupe', 'GP'),
(90, 'Guam', 'GU'),
(91, 'Guatemala', 'GT'),
(92, 'Guernsey', 'GG'),
(93, 'Guinea', 'GN'),
(94, 'Guinea-Bissau', 'GW'),
(95, 'Guyana', 'GY'),
(96, 'Haiti', 'HT'),
(97, 'Heard Island and McDonald Islands', 'HM'),
(98, 'Holy See', 'VA'),
(99, 'Honduras', 'HN'),
(100, 'Hong Kong', 'HK'),
(101, 'Hungary', 'HU'),
(102, 'Iceland', 'IS'),
(103, 'India', 'IN'),
(104, 'Indonesia', 'ID'),
(105, 'Iran', 'IR'),
(106, 'Iraq', 'IQ'),
(107, 'Ireland', 'IE'),
(108, 'Isle of Man', 'IM'),
(109, 'Israel', 'IL'),
(110, 'Italy', 'IT'),
(111, 'Jamaica', 'JM'),
(112, 'Japan', 'JP'),
(113, 'Jersey', 'JE'),
(114, 'Jordan', 'JO'),
(115, 'Kazakhstan', 'KZ'),
(116, 'Kenya', 'KE'),
(117, 'Kiribati', 'KI'),
(118, 'Korea', 'KP'),
(119, 'Korea', 'KR'),
(120, 'Kuwait', 'KW'),
(121, 'Kyrgyzstan', 'KG'),
(122, 'Lao Peoples Democratic Republic', 'LA'),
(123, 'Latvia', 'LV'),
(124, 'Lebanon', 'LB'),
(125, 'Lesotho', 'LS'),
(126, 'Liberia', 'LR'),
(127, 'Libya', 'LY'),
(128, 'Liechtenstein', 'LI'),
(129, 'Lithuania', 'LT'),
(130, 'Luxembourg', 'LU'),
(131, 'Macao', 'MO'),
(132, 'Macedonia', 'MK'),
(133, 'Madagascar', 'MG'),
(134, 'Malawi', 'MW'),
(135, 'Malaysia', 'MY'),
(136, 'Maldives', 'MV'),
(137, 'Mali', 'ML'),
(138, 'Malta', 'MT'),
(139, 'Marshall Islands', 'MH'),
(140, 'Martinique', 'MQ'),
(141, 'Mauritania', 'MR'),
(142, 'Mauritius', 'MU'),
(143, 'Mayotte', 'YT'),
(144, 'Mexico', 'MX'),
(145, 'Micronesia', 'FM'),
(146, 'Moldova', 'MD'),
(147, 'Monaco', 'MC'),
(148, 'Mongolia', 'MN'),
(149, 'Montenegro', 'ME'),
(150, 'Montserrat', 'MS'),
(151, 'Morocco', 'MA'),
(152, 'Mozambique', 'MZ'),
(153, 'Myanmar', 'MM'),
(154, 'Namibia', 'NA'),
(155, 'Nauru', 'NR'),
(156, 'Nepal', 'NP'),
(157, 'Netherlands', 'NL'),
(158, 'New Caledonia', 'NC'),
(159, 'New Zealand', 'NZ'),
(160, 'Nicaragua', 'NI'),
(161, 'Niger', 'NE'),
(162, 'Nigeria', 'NG'),
(163, 'Niue', 'NU'),
(164, 'Norfolk Island', 'NF'),
(165, 'Northern Mariana Islands', 'MP'),
(166, 'Norway', 'NO'),
(167, 'Oman', 'OM'),
(168, 'Pakistan', 'PK'),
(169, 'Palau', 'PW'),
(170, 'Palestine', 'PS'),
(171, 'Panama', 'PA'),
(172, 'Papua New Guinea', 'PG'),
(173, 'Paraguay', 'PY'),
(174, 'Peru', 'PE'),
(175, 'Philippines', 'PH'),
(176, 'Pitcairn', 'PN'),
(177, 'Poland', 'PL'),
(178, 'Portugal', 'PT'),
(179, 'Puerto Rico', 'PR'),
(180, 'Qatar', 'QA'),
(181, 'Réunion', 'RE'),
(182, 'Romania', 'RO'),
(183, 'Russian Federation', 'RU'),
(184, 'Rwanda', 'RW'),
(185, 'Saint Barthélemy', 'BL'),
(186, 'Saint Helena', 'SH'),
(187, 'Saint Kitts and Nevis', 'KN'),
(188, 'Saint Lucia', 'LC'),
(189, 'Saint Martin', 'MF'),
(190, 'Saint Pierre and Miquelon', 'PM'),
(191, 'Saint Vincent and the Grenadines', 'VC'),
(192, 'Samoa', 'WS'),
(193, 'San Marino', 'SM'),
(194, 'Sao Tome and Principe', 'ST'),
(195, 'Saudi Arabia', 'SA'),
(196, 'Senegal', 'SN'),
(197, 'Serbia', 'RS'),
(198, 'Seychelles', 'SC'),
(199, 'Sierra Leone', 'SL'),
(200, 'Singapore', 'SG'),
(201, 'Sint Maarten Dutch part', 'SX'),
(202, 'Slovakia', 'SK'),
(203, 'Slovenia', 'SI'),
(204, 'Solomon Islands', 'SB'),
(205, 'Somalia', 'SO'),
(206, 'South Africa', 'ZA'),
(207, 'South Georgia and the South Sandwich Islands', 'GS'),
(208, 'South Sudan', 'SS'),
(209, 'Spain', 'ES'),
(210, 'Sri Lanka', 'LK'),
(211, 'Sudan', 'SD'),
(212, 'Suriname', 'SR'),
(213, 'Svalbard and Jan Mayen', 'SJ'),
(214, 'Swaziland', 'SZ'),
(215, 'Sweden', 'SE'),
(216, 'Switzerland', 'CH'),
(217, 'Syrian Arab Republic', 'SY'),
(218, 'Taiwan', 'TW'),
(219, 'Tajikistan', 'TJ'),
(220, 'Tanzania', 'TZ'),
(221, 'Thailand', 'TH'),
(222, 'Timor-Leste', 'TL'),
(223, 'Togo', 'TG'),
(224, 'Tokelau', 'TK'),
(225, 'Tonga', 'TO'),
(226, 'Trinidad and Tobago', 'TT'),
(227, 'Tunisia', 'TN'),
(228, 'Turkey', 'TR'),
(229, 'Turkmenistan', 'TM'),
(230, 'Turks and Caicos Islands', 'TC'),
(231, 'Tuvalu', 'TV'),
(232, 'Uganda', 'UG'),
(233, 'Ukraine', 'UA'),
(234, 'United Arab Emirates', 'AE'),
(235, 'United Kingdom', 'GB'),
(236, 'United States', 'US'),
(237, 'United States Minor Outlying Islands', 'UM'),
(238, 'Uruguay', 'UY'),
(239, 'Uzbekistan', 'UZ'),
(240, 'Vanuatu', 'VU'),
(241, 'Venezuela', 'VE'),
(242, 'Viet Nam', 'VN'),
(243, 'Virgin Islands', 'VG'),
(244, 'Virgin Islands', 'VI'),
(245, 'Wallis and Futuna', 'WF'),
(246, 'Western Sahara', 'EH'),
(247, 'Yemen', 'YE'),
(248, 'Zambia', 'ZM'),
(249, 'Zimbabwe', 'ZW');

-- --------------------------------------------------------

--
-- Table structure for table `eum_main_modules`
--

CREATE TABLE IF NOT EXISTS `eum_main_modules` (
  `name_lang_key` varchar(255) NOT NULL,
  `desc_lang_key` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `main_module_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`main_module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `eum_main_modules`
--

INSERT INTO `eum_main_modules` (`name_lang_key`, `desc_lang_key`, `sort`, `main_module_id`) VALUES
('main_module_users', 'main_module_users_desc', 10, 1),
('main_module_config', 'main_module_config_desc', 20, 2),
('main_module_reports', 'main_module_reports_desc', 30, 3),
('main_module_dashboard', 'main_module_dashboard_desc', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `eum_modules`
--

CREATE TABLE IF NOT EXISTS `eum_modules` (
  `name_lang_key` varchar(255) NOT NULL,
  `desc_lang_key` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL,
  `module_id` varchar(255) NOT NULL,
  `main_module_id` int(11) NOT NULL,
  `editable` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `desc_lang_key` (`desc_lang_key`),
  UNIQUE KEY `name_lang_key` (`name_lang_key`),
  KEY `main_module_id` (`main_module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eum_modules`
--

INSERT INTO `eum_modules` (`name_lang_key`, `desc_lang_key`, `sort`, `module_id`, `main_module_id`, `editable`) VALUES
('module_config', 'module_config_desc', 10, 'config', 2, 0),
('module_dashboards', 'module_dashboards_desc', 20, 'dashboards', 4, 0),
('module_profiles', 'module_profiles_desc', 20, 'profiles', 1, 0),
('module_trashes', 'module_trashes_desc', 30, 'trashes', 1, 0),
('module_users', 'module_users_desc', 20, 'users', 1, 0),
('module_roles', 'module_roles_desc', 20, 'roles', 1, 0),
('module_user_reports', 'module_user_reports_desc', 10, 'user_reports', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `eum_permissions`
--

CREATE TABLE IF NOT EXISTS `eum_permissions` (
  `module_id` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`module_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eum_permissions`
--

INSERT INTO `eum_permissions` (`module_id`, `user_id`) VALUES
('config', 1),
('dashboards', 1),
('profiles', 1),
('trashes', 1),
('users', 1),
('roles', 1),
('user_reports', 1);

-- --------------------------------------------------------

--
-- Table structure for table `eum_userinfo`
--

CREATE TABLE IF NOT EXISTS `eum_userinfo` (
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `profile_image` varchar(260) DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `marital_status` varchar(260) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `country_name` varchar(260) DEFAULT NULL,
  `comments` text,
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `social_provider` varchar(260) DEFAULT NULL,
  `social_identifier` varchar(260) DEFAULT NULL,
  `social_profileURL` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=141 ;

--
-- Dumping data for table `eum_userinfo`
--

INSERT INTO `eum_userinfo` (`first_name`, `last_name`, `profile_image`, `register_date`, `dob`, `marital_status`, `phone_number`, `email`, `address`, `city`, `state`, `country_code`, `country_name`, `comments`, `user_id`, `social_provider`, `social_identifier`, `social_profileURL`) VALUES
('Admin1', 'Admin2', '1.png', '2016-01-01', '1990-12-25', 'Single', '12345678910', 'ergo7care@gmail.com', 'New', 'NWS', 'LAS', 'SS', 'SS', 'New No comments', 1, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `eum_users`
--

CREATE TABLE IF NOT EXISTS `eum_users` (
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email_verification_code` text NOT NULL,
  `forgot_password` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `user_level` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eum_users`
--

INSERT INTO `eum_users` (`username`, `password`, `email_verification_code`, `forgot_password`, `user_id`, `deleted`, `active`, `user_level`) VALUES
('admin', '$2a$08$8TScSp0Zdmllv988ugeLNeGIleAO5Hovs8KAn5rKVxqy6WH55a6mu', '', 0, 1, 0, 0, 1);


--
-- Binyas Table Edites
--

CREATE TABLE IF NOT EXISTS `eum_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
INSERT INTO `eum_roles` (`role_id`, `role_name`) VALUES
(1,'Admin');
 
 
CREATE TABLE IF NOT EXISTS `eum_role_permissions` (
  `module_id` varchar(255) NOT NULL,
  `role_id` int(10) NOT NULL,
  PRIMARY KEY (`module_id`,`role_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
INSERT INTO `eum_role_permissions` (`module_id`, `role_id`) VALUES
('config', 1),
('dashboards', 1),
('profiles', 1),
('trashes', 1),
('users', 1),
('roles', 1),
('user_reports', 1);
 
 
CREATE TABLE IF NOT EXISTS `eum_user_roles` (
  `role_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
INSERT INTO `eum_user_roles` (`role_id`, `user_id`) VALUES
(1, 1);




--
-- Constraints for dumped tables
--

--
-- Constraints for table `eum_modules`
--
ALTER TABLE `eum_modules`
  ADD CONSTRAINT `eum_modules_ibfk_1` FOREIGN KEY (`main_module_id`) REFERENCES `eum_main_modules` (`main_module_id`),
  ADD CONSTRAINT `eum_modules_ibfk_2` FOREIGN KEY (`main_module_id`) REFERENCES `eum_main_modules` (`main_module_id`);

--
-- Constraints for table `eum_users`
--
ALTER TABLE `eum_users`
  ADD CONSTRAINT `eum_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `eum_userinfo` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
