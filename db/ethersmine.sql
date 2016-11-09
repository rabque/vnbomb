-- MySQL dump 10.13  Distrib 5.5.53, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ethersmine_web
-- ------------------------------------------------------
-- Server version	5.5.53-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article_category`
--

DROP TABLE IF EXISTS `article_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) unsigned DEFAULT NULL,
  `category_id` int(11) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_category`
--

LOCK TABLES `article_category` WRITE;
/*!40000 ALTER TABLE `article_category` DISABLE KEYS */;
INSERT INTO `article_category` VALUES (13,2,2,'2016-11-08 16:26:21','2016-11-08 16:26:21'),(12,1,3,'2016-11-08 16:25:32','2016-11-08 16:25:32'),(11,1,2,'2016-11-08 16:25:32','2016-11-08 16:25:32');
/*!40000 ALTER TABLE `article_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `cate_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '[]',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `slug` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `module_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `metaTitle` varchar(70) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `metaDes` varchar(160) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `metaKey` varchar(160) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'Terms of Use','[\"2\",\"3\"]','<p>Modification agreement</p>\r\n\r\n<p>By using this website, you agree to be bound by these Terms, which may be modified by BtcBomb. If you disagree with any part of these terms of service, you must stop using this website.</p>\r\n','',0,'terms-of-use',1,'Articles','Terms of Use','Terms of Use','Terms of Use',NULL,'2016-11-04 09:15:17','2016-11-08 08:25:32','<p>Modification agreement</p>\r\n\r\n<p>By using this website, you agree to be bound by these Terms, which may be modified by BtcBomb. If you disagree with any part of these terms of service, you must stop using this website.</p>\r\n\r\n<p>Although we will not ask for your personal information, the player acknowledges that it is their responsibility to ensure that they are of legal age to play at our casino. You are responsible to check with your own jurisdiction&rsquo;s laws to make sure it is legal to play at our bitcoin casino, and are also liable to pay any tax or other fee required by law in your jurisdiction, in case you win and withdraw money from the casino.</p>\r\n\r\n<p>Limitation of liability</p>\r\n\r\n<p>You acknowledge the risk of gambling with virtual currencies. As with any gambling activity, you may lose some or all bitcoins you deposit. Under no circumstances shall BtcBomb be liable for any of your losses.</p>\r\n\r\n<p>We are not responsible for any error, omission, interruption, deletion, defect, delay in operation or transmission, communications line failure, theft or destruction or unauthorized access to, or alteration of data or information and any direct or indirect loss which arises from these occurrences. We are not responsible for any problems or technical malfunction of any network or lines, Wi-Fi, Bluetooth, computers, systems, servers or providers, computer equipment, software or email on account of technical problems or traffic congestion on the internet or at any web site, mobile site or mobile application. We shall not be responsible or liable to you in the event of systems or communications errors, bugs or viruses relating to the Services and/or your account or which will result in damage to your hardware and/or software and/or data.</p>\r\n\r\n<p>Suspension and closure</p>\r\n\r\n<p>BtcBomb reserves the right to suspend or close your account if you:</p>\r\n\r\n<p>Impersonate BtcBomb staff or other users;<br />\r\nCause any spam activity;<br />\r\nUse inappropriate player names;<br />\r\nAbuse bug(s);<br />\r\nFair play</p>\r\n\r\n<p>We will never cheat and we expect the same fairness from you. Any attempt to manipulate the outcome of games is strictly prohibited and will result in possible termination of account and voiding of any winnings and/or account balance.</p>\r\n\r\n<p>We reserve the right to terminate any account that appears to abuse the casino or our terms and conditions. This includes abuses of the refer-a-friend or affiliate program by attempting to refer yourself or others multiple times.</p>\r\n\r\n<p>If there are any questions regarding to this agreement, feel free to contact the admin.</p>\r\n'),(2,'Help','[\"2\"]','<p>What is BtcBomb?</p>\r\n\r\n<p>BtcBomb is a game of chance played on a 5x5 minefield grid.</p>\r\n','',0,'help',1,'Articles','Help','Help','Help',NULL,'2016-11-04 19:04:13','2016-11-08 08:26:21','<p>What is BtcBomb?</p>\r\n\r\n<p>BtcBomb is a game of chance played on a 5x5 minefield grid.</p>\r\n\r\n<p>The object of the game is to oncover as many green tiles as you can without uncovering any red mines.</p>\r\n\r\n<p>You win an increasing reward for each green tile you uncover.</p>\r\n\r\n<p>Common Questions</p>\r\n\r\n<p>Q: What is the unit of my balance?<br />\r\nYour balance is shown in bits.</p>\r\n\r\n<p>1 bit = Ƀ0.000001<br />\r\nɃ1 = 1,000,000 bits.<br />\r\nQ: What is the minimum bet?<br />\r\nThe minimum bet is 30 bits per round (Ƀ0.00003)<br />\r\nQ: What is the maximum bet?<br />\r\nThe maximum bet is 1,000,000 bits per round (Ƀ1)<br />\r\nQ: What is the minimum withdrawal?<br />\r\n28 Bits, or Ƀ0.000028.<br />\r\nQ: Can I use a web wallet (Blockchain.info, Coinbase, BIPS, etc.) to play this game?<br />\r\nYes. Withdraws from your BtcBomb game can be made to any bitcoin address you specify, including addresses in web wallets.<br />\r\nQ: How long do withdraws take to send?<br />\r\nInstantly.<br />\r\nUse any Bitcoin wallet to send bitcoins to the deposit address shown on your player page.<br />\r\nYou aught to know:<br />\r\nYou cannot cash out until all deposit transactions have at least 3 confirmations. You can check the deposits and number of confirmations by clicking the blockchain.info icon next to your deposit address.<br />\r\nHow is BtcBomb Provably Fair?</p>\r\n\r\n<p>This game uses &ldquo;game hashes&rdquo; to prove itself. If you&#39;ve played provably fair games online before, BtcBomb method will be familiar to you.</p>\r\n\r\n<p>What are the game hashes?</p>\r\n\r\n<p>Game hashes are how BtcBomb proves that each game&#39;s mine tiles are chosen when the game is created and are not tampered with. Hashes thus prove to the player that the game is fair.</p>\r\n\r\n<p>When a new round is started, three of the twenty-five tiles are chosen as mines. The three tiles (represented as numbers from 1 to 25,) coupled with a random string generated by the server are hashed using SHA256. The result of the hash function is shown to you before you make your first tile choice.</p>\r\n\r\n<p>Validating the fairness</p>\r\n\r\n<p>After a game has been completed, the &quot;three-number+random string&quot; secret will be revealed. It is at this point you may validate that the SHA256 hash of the secret matches the hash that has been shown since the beginning of the round.</p>\r\n\r\n<p>Online SHA256 Lookup (unaffiliated)</p>\r\n');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backups`
--

DROP TABLE IF EXISTS `backups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `file_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `backup_size` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `backups_name_unique` (`name`),
  UNIQUE KEY `backups_file_name_unique` (`file_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backups`
--

LOCK TABLES `backups` WRITE;
/*!40000 ALTER TABLE `backups` DISABLE KEYS */;
/*!40000 ALTER TABLE `backups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '1',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `module_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `metaTitle` varchar(70) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `metaDes` text COLLATE utf8_unicode_ci NOT NULL,
  `metaKey` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,NULL,'2016-11-04 09:13:48','2016-11-04 09:13:48','All Category',1,0,1,'Articles','all-category','All Category','All Category','All Category'),(2,NULL,'2016-11-04 09:14:03','2016-11-04 09:14:03','About us',1,0,1,'Articles','about-us','About us','About us','About us'),(3,NULL,'2016-11-04 09:14:19','2016-11-04 09:14:19','News',1,0,1,'Articles','news','News','News','News'),(4,NULL,'2016-11-04 09:27:02','2016-11-04 09:27:02','Hot news',3,0,1,'Articles','hot-news','Hot news','Hot news','Hot news');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `contacts_fullname_unique` (`fullname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tags` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '[]',
  `color` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'SuperAdmin','[\"Super Admin\"]','#000',NULL,'2016-10-29 08:57:10','2016-10-29 09:18:37'),(2,'Administrator','[\"Administrator\"]','#000',NULL,'2016-10-29 09:19:12','2016-10-29 09:19:12'),(3,'Editor','[\"Editor\"]','#000',NULL,'2016-10-29 09:19:30','2016-10-29 09:19:30'),(4,'Author','[\"Author\"]','#000',NULL,'2016-10-29 09:21:07','2016-10-29 09:21:07'),(5,'Contributor','[\"Contributor\"]','#000',NULL,'2016-10-29 09:21:20','2016-10-29 09:21:20'),(6,'Subscriber','[\"Subscriber\"]','#000',NULL,'2016-10-29 09:21:33','2016-10-29 09:21:33');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `designation` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Male',
  `mobile` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `mobile2` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dept` int(10) unsigned NOT NULL DEFAULT '1',
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `about` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_birth` date NOT NULL DEFAULT '1990-01-01',
  `date_hire` date NOT NULL,
  `date_left` date NOT NULL DEFAULT '1990-01-01',
  `salary_cur` decimal(15,3) NOT NULL DEFAULT '0.000',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_email_unique` (`email`),
  KEY `employees_dept_foreign` (`dept`),
  CONSTRAINT `employees_dept_foreign` FOREIGN KEY (`dept`) REFERENCES `departments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'superadmin','Super Admin','Male','0979789664','0979789664','lyngochung.88@gmail.com',1,'Ha Noi','Cau Giay ','About user / biography','2016-10-29','2016-10-29','2016-10-29',0.000,NULL,'2016-10-29 08:57:53','2016-11-05 22:34:16'),(2,'Administrator','Administor','Male','9999999999','','admin@ethersmine.com',2,'','','','1990-01-01','1970-01-01','1990-01-01',0.000,NULL,'2016-10-29 09:26:54','2016-11-05 22:55:22');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `famenus`
--

DROP TABLE IF EXISTS `famenus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `famenus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'custom',
  `position` int(11) DEFAULT '1',
  `parent` int(10) unsigned NOT NULL DEFAULT '0',
  `hierarchy` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `famenus`
--

LOCK TABLES `famenus` WRITE;
/*!40000 ALTER TABLE `famenus` DISABLE KEYS */;
INSERT INTO `famenus` VALUES (1,NULL,'2016-11-04 21:11:45','2016-11-05 07:03:41','Help','help','custom',1,0,1),(8,NULL,'2016-11-05 06:21:25','2016-11-05 06:23:45','Help','help','custom',2,0,1),(9,NULL,'2016-11-05 06:22:01','2016-11-05 06:23:50','Terms of Use','terms-of-use','custom',2,0,2),(10,NULL,'2016-11-05 06:22:31','2016-11-05 06:23:50','Affiliate','affiliate','custom',2,0,3),(11,NULL,'2016-11-05 22:29:54','2016-11-05 22:29:54','Start Game','games','custom',1,0,0);
/*!40000 ALTER TABLE `famenus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `la_configs`
--

DROP TABLE IF EXISTS `la_configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `la_configs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `la_configs`
--

LOCK TABLES `la_configs` WRITE;
/*!40000 ALTER TABLE `la_configs` DISABLE KEYS */;
INSERT INTO `la_configs` VALUES (1,'sitename','','BssTech','2016-10-29 08:57:10','2016-10-29 08:59:49'),(2,'sitename_part1','','BSS','2016-10-29 08:57:10','2016-10-29 08:59:49'),(3,'sitename_part2','','Tech','2016-10-29 08:57:10','2016-10-29 08:59:49'),(4,'sitename_short','','BS','2016-10-29 08:57:10','2016-10-29 08:59:49'),(5,'site_description','','BSS Tech System','2016-10-29 08:57:10','2016-10-29 08:59:49'),(6,'sidebar_search','','1','2016-10-29 08:57:10','2016-10-29 08:59:49'),(7,'show_messages','','0','2016-10-29 08:57:10','2016-10-29 08:59:49'),(8,'show_notifications','','0','2016-10-29 08:57:10','2016-10-29 08:59:49'),(9,'show_tasks','','0','2016-10-29 08:57:10','2016-10-29 08:59:49'),(10,'show_rightsidebar','','0','2016-10-29 08:57:10','2016-10-29 08:59:49'),(11,'skin','','skin-blue','2016-10-29 08:57:10','2016-10-29 08:59:49'),(12,'layout','','fixed','2016-10-29 08:57:10','2016-10-29 08:59:49'),(13,'default_email','','lyngochung.88@gmail.com','2016-10-29 08:57:10','2016-10-29 08:59:49');
/*!40000 ALTER TABLE `la_configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `la_menus`
--

DROP TABLE IF EXISTS `la_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `la_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fa-cube',
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'module',
  `parent` int(10) unsigned NOT NULL DEFAULT '0',
  `hierarchy` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `la_menus`
--

LOCK TABLES `la_menus` WRITE;
/*!40000 ALTER TABLE `la_menus` DISABLE KEYS */;
INSERT INTO `la_menus` VALUES (1,'Team','#','fa-group','custom',0,4,'2016-10-29 08:57:09','2016-11-05 04:11:51'),(2,'Users','users','fa-group','module',1,1,'2016-10-29 08:57:10','2016-10-29 09:41:18'),(3,'Uploads','uploads','fa-files-o','module',12,1,'2016-10-29 08:57:10','2016-10-29 20:58:40'),(4,'Departments','departments','fa-tags','module',1,3,'2016-10-29 08:57:10','2016-10-29 09:41:18'),(5,'Employees','employees','fa-group','module',1,4,'2016-10-29 08:57:10','2016-10-29 09:41:18'),(6,'Roles','roles','fa-user-plus','module',1,6,'2016-10-29 08:57:10','2016-11-02 11:25:32'),(7,'Organizations','organizations','fa-university','module',1,2,'2016-10-29 08:57:10','2016-10-29 09:41:18'),(10,'Quản lý bài viết','#','fa-bars','custom',0,2,'2016-10-29 20:57:32','2016-11-05 04:11:50'),(12,'Quản lý Media','#','fa-image','custom',0,3,'2016-10-29 20:58:31','2016-11-05 04:11:50'),(13,'Categories','categories','fa fa-clone','module',10,1,'2016-10-29 21:09:39','2016-10-29 21:38:32'),(14,'Articles','articles','fa fa-newspaper-o','module',10,2,'2016-10-29 22:36:54','2016-10-30 10:30:42'),(15,'Contacts','contacts','fa fa-envelope-o','module',10,4,'2016-10-31 07:28:05','2016-11-05 06:00:52'),(16,'Cấu hình website','#','fa-cogs','custom',0,1,'2016-11-01 10:05:25','2016-11-05 04:11:50'),(25,'Permissions','permissions','fa-magic','module',1,5,'2016-11-02 11:25:23','2016-11-02 11:25:32'),(29,'Settings','settings','fa fa-cog','module',16,1,'2016-11-02 23:35:40','2016-11-02 23:39:49'),(30,'Socials','socials','fa fa-google-plus-square','module',16,2,'2016-11-02 23:39:07','2016-11-02 23:39:55'),(31,'FAMenus','famenus','fa-file-text-o','module',16,3,'2016-11-02 23:40:22','2016-11-02 23:40:31'),(32,'Sliders','sliders','fa fa-picture-o','module',12,2,'2016-11-03 00:02:11','2016-11-03 00:03:00'),(33,'Notes','notes','fa fa-building-o','module',10,3,'2016-11-05 04:09:50','2016-11-05 06:00:52');
/*!40000 ALTER TABLE `la_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `match`
--

DROP TABLE IF EXISTS `match`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `match` (
  `matchID` varchar(32) NOT NULL,
  `playerID` varchar(64) NOT NULL,
  `betAmount` int(64) NOT NULL DEFAULT '0',
  `numberOfMine` int(16) NOT NULL DEFAULT '1',
  `isPracticeMatch` tinyint(1) NOT NULL DEFAULT '0',
  `minePositions` varchar(64) NOT NULL COMMENT 'Store array of positions as strin. EG: "(1x1),(5x3),(2x9)"',
  `secrectString` varchar(256) NOT NULL,
  `hash` varchar(256) NOT NULL,
  `clickHistory` varchar(64) NOT NULL COMMENT 'Store array of positions as strin. EG: "(1x1),(5x3),(2x9)"',
  PRIMARY KEY (`matchID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `match`
--

LOCK TABLES `match` WRITE;
/*!40000 ALTER TABLE `match` DISABLE KEYS */;
/*!40000 ALTER TABLE `match` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (19,'2014_05_26_050000_create_modules_table',1),(20,'2014_05_26_055000_create_module_field_types_table',1),(21,'2014_05_26_060000_create_module_fields_table',1),(22,'2014_10_12_000000_create_users_table',1),(23,'2014_10_12_100000_create_password_resets_table',1),(24,'2014_12_01_000000_create_uploads_table',1),(25,'2016_05_26_064006_create_departments_table',1),(26,'2016_05_26_064007_create_employees_table',1),(27,'2016_05_26_064446_create_roles_table',1),(28,'2016_07_05_115343_create_role_user_table',1),(29,'2016_07_06_140637_create_organizations_table',1),(30,'2016_07_07_134058_create_backups_table',1),(31,'2016_07_07_134058_create_menus_table',1),(32,'2016_09_10_163337_create_permissions_table',1),(33,'2016_09_10_163520_create_permission_role_table',1),(34,'2016_09_22_105958_role_module_fields_table',1),(35,'2016_09_22_110008_role_module_table',1),(36,'2016_10_06_115413_create_la_configs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module_field_types`
--

DROP TABLE IF EXISTS `module_field_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module_field_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module_field_types`
--

LOCK TABLES `module_field_types` WRITE;
/*!40000 ALTER TABLE `module_field_types` DISABLE KEYS */;
INSERT INTO `module_field_types` VALUES (1,'Address','2016-10-29 08:56:41','2016-10-29 08:56:41'),(2,'Checkbox','2016-10-29 08:56:41','2016-10-29 08:56:41'),(3,'Currency','2016-10-29 08:56:41','2016-10-29 08:56:41'),(4,'Date','2016-10-29 08:56:41','2016-10-29 08:56:41'),(5,'Datetime','2016-10-29 08:56:41','2016-10-29 08:56:41'),(6,'Decimal','2016-10-29 08:56:41','2016-10-29 08:56:41'),(7,'Dropdown','2016-10-29 08:56:41','2016-10-29 08:56:41'),(8,'Email','2016-10-29 08:56:41','2016-10-29 08:56:41'),(9,'File','2016-10-29 08:56:41','2016-10-29 08:56:41'),(10,'Float','2016-10-29 08:56:41','2016-10-29 08:56:41'),(11,'HTML','2016-10-29 08:56:41','2016-10-29 08:56:41'),(12,'Image','2016-10-29 08:56:41','2016-10-29 08:56:41'),(13,'Integer','2016-10-29 08:56:41','2016-10-29 08:56:41'),(14,'Mobile','2016-10-29 08:56:41','2016-10-29 08:56:41'),(15,'Multiselect','2016-10-29 08:56:41','2016-10-29 08:56:41'),(16,'Name','2016-10-29 08:56:41','2016-10-29 08:56:41'),(17,'Password','2016-10-29 08:56:41','2016-10-29 08:56:41'),(18,'Radio','2016-10-29 08:56:41','2016-10-29 08:56:41'),(19,'String','2016-10-29 08:56:41','2016-10-29 08:56:41'),(20,'Taginput','2016-10-29 08:56:41','2016-10-29 08:56:41'),(21,'Textarea','2016-10-29 08:56:41','2016-10-29 08:56:41'),(22,'TextField','2016-10-29 08:56:41','2016-10-29 08:56:41'),(23,'URL','2016-10-29 08:56:41','2016-10-29 08:56:41'),(24,'Files','2016-10-29 08:56:41','2016-10-29 08:56:41');
/*!40000 ALTER TABLE `module_field_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module_fields`
--

DROP TABLE IF EXISTS `module_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `colname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `module` int(10) unsigned NOT NULL,
  `field_type` int(10) unsigned NOT NULL,
  `unique` tinyint(1) NOT NULL DEFAULT '0',
  `defaultvalue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `minlength` int(10) unsigned NOT NULL DEFAULT '0',
  `maxlength` int(10) unsigned NOT NULL DEFAULT '0',
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `popup_vals` text COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module_fields_module_foreign` (`module`),
  KEY `module_fields_field_type_foreign` (`field_type`),
  CONSTRAINT `module_fields_field_type_foreign` FOREIGN KEY (`field_type`) REFERENCES `module_field_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `module_fields_module_foreign` FOREIGN KEY (`module`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module_fields`
--

LOCK TABLES `module_fields` WRITE;
/*!40000 ALTER TABLE `module_fields` DISABLE KEYS */;
INSERT INTO `module_fields` VALUES (1,'name','Name',1,16,0,'',5,250,1,'',0,'2016-10-29 08:56:41','2016-10-29 08:56:41'),(2,'context_id','Context',1,13,0,'0',0,0,0,'',0,'2016-10-29 08:56:41','2016-10-29 08:56:41'),(3,'email','Email',1,8,1,'',0,250,0,'',0,'2016-10-29 08:56:41','2016-10-29 08:56:41'),(4,'password','Password',1,17,0,'',6,250,1,'',0,'2016-10-29 08:56:41','2016-10-29 08:56:41'),(5,'type','User Type',1,7,0,'Employee',0,0,0,'[\"Employee\",\"Client\"]',0,'2016-10-29 08:56:41','2016-10-29 08:56:41'),(6,'name','Name',2,16,0,'',5,250,1,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(7,'path','Path',2,19,0,'',0,250,0,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(8,'extension','Extension',2,19,0,'',0,20,0,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(9,'caption','Caption',2,19,0,'',0,250,0,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(10,'user_id','Owner',2,7,0,'1',0,0,0,'@users',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(11,'hash','Hash',2,19,0,'',0,250,0,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(12,'public','Is Public',2,2,0,'0',0,0,0,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(13,'name','Name',3,16,1,'',1,250,1,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(14,'tags','Tags',3,20,0,'[]',0,0,0,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(15,'color','Color',3,19,0,'',0,50,1,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(16,'name','Name',4,16,0,'',5,250,1,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(17,'designation','Designation',4,19,0,'',0,50,1,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(18,'gender','Gender',4,18,0,'Male',0,0,1,'[\"Male\",\"Female\"]',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(19,'mobile','Mobile',4,14,0,'',10,20,1,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(20,'mobile2','Alternative Mobile',4,14,0,'',10,20,0,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(21,'email','Email',4,8,1,'',5,250,1,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(22,'dept','Department',4,7,0,'0',0,0,1,'@departments',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(23,'city','City',4,19,0,'',0,50,0,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(24,'address','Address',4,1,0,'',0,1000,0,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(25,'about','About',4,19,0,'',0,0,0,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(26,'date_birth','Date of Birth',4,4,0,'1990-01-01',0,0,0,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(27,'date_hire','Hiring Date',4,4,0,'date(\'Y-m-d\')',0,0,0,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(28,'date_left','Resignation Date',4,4,0,'1990-01-01',0,0,0,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(29,'salary_cur','Current Salary',4,6,0,'0.0',0,2,0,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(30,'name','Name',5,16,1,'',1,250,1,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(31,'display_name','Display Name',5,19,0,'',0,250,1,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(32,'description','Description',5,21,0,'',0,1000,0,'',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(33,'parent','Parent Role',5,7,0,'1',0,0,0,'@roles',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(34,'dept','Department',5,7,0,'1',0,0,0,'@departments',0,'2016-10-29 08:56:42','2016-10-29 08:56:42'),(35,'name','Name',6,16,1,'',5,250,1,'',0,'2016-10-29 08:56:43','2016-10-29 08:56:43'),(36,'email','Email',6,8,1,'',0,250,0,'',0,'2016-10-29 08:56:43','2016-10-29 08:56:43'),(37,'phone','Phone',6,14,0,'',0,20,0,'',0,'2016-10-29 08:56:43','2016-10-29 08:56:43'),(38,'website','Website',6,23,0,'http://',0,250,0,'',0,'2016-10-29 08:56:43','2016-10-29 08:56:43'),(39,'assigned_to','Assigned to',6,7,0,'0',0,0,0,'@employees',0,'2016-10-29 08:56:43','2016-10-29 08:56:43'),(40,'connect_since','Connected Since',6,4,0,'date(\'Y-m-d\')',0,0,0,'',0,'2016-10-29 08:56:43','2016-10-29 08:56:43'),(41,'address','Address',6,1,0,'',0,1000,1,'',0,'2016-10-29 08:56:43','2016-10-29 08:56:43'),(42,'city','City',6,19,0,'',0,250,1,'',0,'2016-10-29 08:56:43','2016-10-29 08:56:43'),(43,'description','Description',6,21,0,'',0,1000,0,'',0,'2016-10-29 08:56:43','2016-10-29 08:56:43'),(44,'profile_image','Profile Image',6,12,0,'',0,250,0,'',0,'2016-10-29 08:56:43','2016-10-29 08:56:43'),(45,'profile','Company Profile',6,9,0,'',0,250,0,'',0,'2016-10-29 08:56:43','2016-10-29 08:56:43'),(46,'name','Name',7,16,1,'',0,250,1,'',0,'2016-10-29 08:56:44','2016-10-29 08:56:44'),(47,'file_name','File Name',7,19,1,'',0,250,1,'',0,'2016-10-29 08:56:44','2016-10-29 08:56:44'),(48,'backup_size','File Size',7,19,0,'0',0,10,1,'',0,'2016-10-29 08:56:44','2016-10-29 08:56:44'),(49,'name','Name',8,16,1,'',1,250,1,'',0,'2016-10-29 08:56:44','2016-10-29 08:56:44'),(50,'display_name','Display Name',8,19,0,'',0,250,1,'',0,'2016-10-29 08:56:44','2016-10-29 08:56:44'),(51,'description','Description',8,21,0,'',0,1000,0,'',0,'2016-10-29 08:56:44','2016-10-29 08:56:44'),(56,'name','Name',10,16,0,'',0,256,1,'',2,'2016-10-29 21:07:36','2016-11-07 19:58:54'),(57,'parent_id','Parent',10,7,0,'0',0,0,0,'@categories',4,'2016-10-29 21:09:01','2016-10-31 07:30:33'),(58,'sort','Sort',10,13,0,'0',0,11,0,'',6,'2016-10-29 21:09:28','2016-10-29 21:09:28'),(59,'status','Status',10,2,0,'1',0,0,0,'',1,'2016-10-29 21:29:13','2016-10-29 21:29:13'),(60,'name','Name',11,19,0,'',0,256,1,'',2,'2016-10-29 22:31:12','2016-10-29 22:31:12'),(61,'cate_id','Category',11,15,0,'',0,0,0,'@categories',5,'2016-10-29 22:32:48','2016-10-29 22:32:48'),(62,'description','Description',11,21,0,'',0,0,0,'',7,'2016-10-29 22:33:19','2016-10-31 06:44:23'),(63,'image','Image',11,22,0,'',0,256,0,'',6,'2016-10-29 22:34:03','2016-11-01 09:32:26'),(64,'sort','Sort',11,13,0,'0',0,11,0,'',9,'2016-10-29 22:34:54','2016-10-29 22:34:54'),(65,'slug','slug Url',11,22,0,'',0,256,1,'',3,'2016-10-29 22:35:25','2016-11-07 19:59:16'),(66,'status','Status',11,2,0,'1',0,0,0,'',1,'2016-10-29 22:36:00','2016-10-29 22:36:00'),(67,'module_id','Module Id',10,7,0,'',0,0,0,'[\"Articles\"]',5,'2016-10-30 10:26:06','2016-10-30 10:26:06'),(68,'module_id','Module id',11,7,0,'',0,0,0,'[\"Articles\"]',4,'2016-10-30 10:29:24','2016-10-30 10:29:24'),(69,'metaTitle','Meta Title',11,22,0,'',0,70,1,'',10,'2016-10-31 06:40:39','2016-10-31 06:40:39'),(70,'metaDes','Meta Description',11,21,0,'',0,160,1,'',11,'2016-10-31 06:41:23','2016-11-04 19:00:57'),(71,'metaKey','Meta Key',11,21,0,'',0,160,1,'',12,'2016-10-31 06:41:47','2016-11-04 19:01:12'),(72,'content','Content',11,21,0,'',0,0,1,'',8,'2016-10-31 06:44:43','2016-10-31 06:44:43'),(73,'fullname','Full Name',12,22,0,'',0,50,1,'',2,'2016-10-31 07:23:41','2016-10-31 07:24:13'),(74,'email','Email',12,8,0,'',0,60,1,'',3,'2016-10-31 07:24:05','2016-10-31 07:25:45'),(75,'phone','Phone',12,14,0,'',0,20,0,'',4,'2016-10-31 07:24:43','2016-10-31 07:24:43'),(76,'address','Address',12,1,0,'',0,150,0,'',5,'2016-10-31 07:25:31','2016-10-31 07:25:31'),(77,'subject','Subject',12,22,0,'',0,256,1,'',6,'2016-10-31 07:26:20','2016-10-31 07:26:20'),(78,'message','Message',12,21,0,'',0,0,0,'',7,'2016-10-31 07:26:40','2016-10-31 07:26:40'),(79,'status','Status',12,2,0,'2',0,0,0,'',1,'2016-10-31 07:27:05','2016-10-31 07:27:05'),(97,'name','Name',19,22,0,'',0,50,1,'',0,'2016-11-02 23:21:30','2016-11-02 23:21:30'),(98,'url','Url',19,22,0,'#',0,50,1,'',0,'2016-11-02 23:22:21','2016-11-02 23:22:21'),(99,'type','Type',19,7,0,'custom',0,0,0,'[\"custom\",\"module\"]',0,'2016-11-02 23:23:12','2016-11-02 23:23:12'),(100,'parent','Parent',19,13,0,'0',0,11,0,'',0,'2016-11-02 23:23:30','2016-11-02 23:23:30'),(101,'hierarchy','Hierarchy',19,13,0,'0',0,11,0,'',0,'2016-11-02 23:24:11','2016-11-02 23:24:11'),(102,'name','Name',20,22,0,'',0,50,1,'',1,'2016-11-02 23:29:39','2016-11-02 23:29:39'),(103,'phone','Phone',20,14,0,'',0,20,0,'',2,'2016-11-02 23:30:06','2016-11-02 23:30:06'),(104,'email','Email',20,8,0,'',0,30,0,'',3,'2016-11-02 23:30:20','2016-11-02 23:30:20'),(105,'logo','Logo',20,12,0,'',0,150,0,'',4,'2016-11-02 23:30:35','2016-11-02 23:45:04'),(106,'google_analytics','Google Analytics',20,21,0,'',0,0,0,'',8,'2016-11-02 23:31:27','2016-11-02 23:31:27'),(107,'google_webmaster','Google Webmaster',20,21,0,'',0,0,0,'',9,'2016-11-02 23:31:51','2016-11-02 23:31:51'),(108,'favicon','Favicon',20,22,0,'',0,100,0,'',5,'2016-11-02 23:32:10','2016-11-02 23:32:10'),(109,'footer','Footer',20,21,0,'',0,0,0,'',7,'2016-11-02 23:32:41','2016-11-02 23:32:41'),(110,'location','Location',20,1,0,'',0,100,0,'',6,'2016-11-02 23:33:07','2016-11-02 23:33:07'),(111,'metaTitle','MetaTitle',20,22,0,'',0,70,0,'',10,'2016-11-02 23:33:36','2016-11-02 23:33:36'),(112,'metaDes','Meta Description',20,21,0,'160',0,0,0,'',11,'2016-11-02 23:33:55','2016-11-02 23:33:55'),(113,'metaKey','Meta Key',20,21,0,'160',0,0,0,'',12,'2016-11-02 23:34:22','2016-11-02 23:34:22'),(114,'name','Name',21,22,1,'',0,30,1,'',0,'2016-11-02 23:37:36','2016-11-02 23:37:36'),(115,'url','Url',21,23,0,'',0,100,1,'',0,'2016-11-02 23:37:52','2016-11-02 23:57:29'),(116,'icon','Icon',21,22,0,'',0,50,0,'',0,'2016-11-02 23:38:27','2016-11-02 23:38:27'),(117,'name','Name',22,22,0,'',0,150,1,'',2,'2016-11-02 23:59:56','2016-11-02 23:59:56'),(118,'url','Url',22,22,0,'#',0,150,0,'',3,'2016-11-03 00:00:16','2016-11-03 00:00:16'),(119,'image','Image',22,12,0,'',0,0,1,'',4,'2016-11-03 00:00:40','2016-11-03 00:00:40'),(120,'status','Status',22,2,0,'1',0,0,0,'',1,'2016-11-03 00:01:07','2016-11-03 00:01:07'),(121,'sort','Sort',22,13,0,'0',0,11,0,'',7,'2016-11-03 00:01:24','2016-11-03 00:01:24'),(122,'slug','Slug Url',10,22,0,'',0,150,1,'',3,'2016-11-03 00:29:56','2016-11-03 00:29:56'),(123,'metaTitle','MetaTitle',10,22,0,'',0,70,1,'',7,'2016-11-03 00:30:26','2016-11-03 00:30:26'),(124,'metaDes','Meta Description',10,21,0,'160',0,0,1,'',8,'2016-11-03 00:30:46','2016-11-03 00:30:46'),(125,'metaKey','Meta Key',10,21,0,'160',0,0,1,'',9,'2016-11-03 00:31:04','2016-11-03 00:31:04'),(126,'small_text','Small Text',22,21,0,'150',0,0,0,'',5,'2016-11-04 18:57:08','2016-11-04 18:57:08'),(127,'position_text','Position Text',22,7,0,'',0,0,0,'[\"left\",\"right\",\"center\",\"bottom\"]',6,'2016-11-04 18:57:50','2016-11-04 18:57:50'),(128,'name','Name',23,22,0,'',0,150,1,'',0,'2016-11-05 04:06:28','2016-11-05 04:06:28'),(129,'image','image',23,12,0,'',0,0,0,'',0,'2016-11-05 04:07:05','2016-11-05 04:07:05'),(130,'content','Content',23,21,0,'',0,0,1,'',0,'2016-11-05 04:07:34','2016-11-05 04:07:34'),(131,'status','Status',23,2,0,'1',0,0,0,'',0,'2016-11-05 04:08:13','2016-11-05 04:08:13'),(132,'sort','Sort',23,13,0,'0',0,11,0,'',0,'2016-11-05 04:08:34','2016-11-05 04:08:34');
/*!40000 ALTER TABLE `module_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_db` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `view_col` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `controller` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fa_icon` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fa-cube',
  `is_gen` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES (1,'Users','Users','users','name','User','UsersController','fa-group',1,'2016-10-29 08:56:41','2016-10-29 08:57:10'),(2,'Uploads','Uploads','uploads','name','Upload','UploadsController','fa-files-o',1,'2016-10-29 08:56:42','2016-10-29 08:57:10'),(3,'Departments','Departments','departments','name','Department','DepartmentsController','fa-tags',1,'2016-10-29 08:56:42','2016-10-29 08:57:10'),(4,'Employees','Employees','employees','name','Employee','EmployeesController','fa-group',1,'2016-10-29 08:56:42','2016-10-29 08:57:10'),(5,'Roles','Roles','roles','name','Role','RolesController','fa-user-plus',1,'2016-10-29 08:56:42','2016-10-29 08:57:10'),(6,'Organizations','Organizations','organizations','name','Organization','OrganizationsController','fa-university',1,'2016-10-29 08:56:43','2016-10-29 08:57:10'),(7,'Backups','Backups','backups','name','Backup','BackupsController','fa-hdd-o',1,'2016-10-29 08:56:44','2016-10-29 08:57:10'),(8,'Permissions','Permissions','permissions','name','Permission','PermissionsController','fa-magic',1,'2016-10-29 08:56:44','2016-10-29 08:57:10'),(10,'Categories','Categories','categories','name','Category','CategoriesController','fa-clone',1,'2016-10-29 21:07:11','2016-10-29 21:09:39'),(11,'Articles','Articles','articles','name','Article','ArticlesController','fa-newspaper-o',1,'2016-10-29 22:30:55','2016-10-29 22:36:54'),(12,'Contacts','Contacts','contacts','fullname','Contact','ContactsController','fa-envelope-o',1,'2016-10-31 07:23:04','2016-10-31 07:28:05'),(19,'FAMenus','FAMenus','famenus','name','FAMenu','FAMenusController','fa-file-text-o',1,'2016-11-02 23:21:16','2016-11-02 23:21:41'),(20,'Settings','Settings','settings','name','Setting','SettingsController','fa-cog',1,'2016-11-02 23:28:48','2016-11-02 23:35:40'),(21,'Socials','Socials','socials','name','Social','SocialsController','fa-google-plus-square',1,'2016-11-02 23:37:07','2016-11-02 23:39:07'),(22,'Sliders','Sliders','sliders','name','Slider','SlidersController','fa-picture-o',1,'2016-11-02 23:59:38','2016-11-03 00:02:11'),(23,'Notes','Notes','notes','name','Note','NotesController','fa-building-o',1,'2016-11-05 04:05:50','2016-11-05 04:09:50');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (1,NULL,'2016-11-05 04:21:12','2016-11-05 04:21:12','Bitcoin Only',NULL,'Transactions are safe, simple and cheap.',1,0),(2,NULL,'2016-11-05 04:23:29','2016-11-05 04:23:29','Instant Deposits',NULL,'Deposit and start playing immediately. No waiting!',1,0),(3,NULL,'2016-11-05 04:23:44','2016-11-05 04:23:44','Provably Fair',NULL,'Mine positions are chosen at the start of every round and can be verified after the round ends.',1,0),(4,NULL,'2016-11-05 04:24:02','2016-11-05 04:24:18','Better Odds','','Satoshi Mines has considerably better odds than all other bitcoin mine games.',1,0),(5,NULL,'2016-11-05 04:24:38','2016-11-05 04:24:38','Mobile-Friendly',NULL,'Fun to play on your commute or during boring business meetings',1,0),(6,NULL,'2016-11-05 04:25:13','2016-11-05 04:25:13','Mobile Wallet Support',NULL,'Integrated QR Codes make it easy to deposit from your mobile wallet.',1,0);
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_categories`
--

DROP TABLE IF EXISTS `object_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) DEFAULT '0',
  `cate_id` int(11) DEFAULT '0',
  `type` varchar(255) DEFAULT 'articles',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `object` (`object_id`) USING BTREE,
  KEY `category` (`cate_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_categories`
--

LOCK TABLES `object_categories` WRITE;
/*!40000 ALTER TABLE `object_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `object_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizations`
--

DROP TABLE IF EXISTS `organizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organizations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://',
  `assigned_to` int(10) unsigned NOT NULL DEFAULT '1',
  `connect_since` date NOT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `city` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `profile_image` int(11) NOT NULL,
  `profile` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `organizations_name_unique` (`name`),
  UNIQUE KEY `organizations_email_unique` (`email`),
  KEY `organizations_assigned_to_foreign` (`assigned_to`),
  CONSTRAINT `organizations_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `employees` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizations`
--

LOCK TABLES `organizations` WRITE;
/*!40000 ALTER TABLE `organizations` DISABLE KEYS */;
INSERT INTO `organizations` VALUES (1,'Test Administrator','admin@example.com','','https://www.messenger.com',2,'1970-01-01','Test','Test','',0,0,'2016-10-31 07:33:11','2016-10-29 09:27:54','2016-10-31 07:33:11');
/*!40000 ALTER TABLE `organizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `display_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'ADMIN_ROOT','Admin Panel','Admin Panel Permission',NULL,'2016-10-29 08:57:10','2016-10-29 08:57:10');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_module`
--

DROP TABLE IF EXISTS `role_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  `acc_view` tinyint(1) NOT NULL,
  `acc_create` tinyint(1) NOT NULL,
  `acc_edit` tinyint(1) NOT NULL,
  `acc_delete` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_module_role_id_foreign` (`role_id`),
  KEY `role_module_module_id_foreign` (`module_id`),
  CONSTRAINT `role_module_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_module_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_module`
--

LOCK TABLES `role_module` WRITE;
/*!40000 ALTER TABLE `role_module` DISABLE KEYS */;
INSERT INTO `role_module` VALUES (1,1,1,1,1,1,1,'2016-10-29 08:57:10','2016-10-29 08:57:10'),(2,1,2,1,1,1,1,'2016-10-29 08:57:10','2016-10-29 08:57:10'),(3,1,3,1,1,1,1,'2016-10-29 08:57:10','2016-10-29 08:57:10'),(4,1,4,1,1,1,1,'2016-10-29 08:57:10','2016-10-29 08:57:10'),(5,1,5,1,1,1,1,'2016-10-29 08:57:10','2016-10-29 08:57:10'),(6,1,6,1,1,1,1,'2016-10-29 08:57:10','2016-10-29 08:57:10'),(7,1,7,1,1,1,1,'2016-10-29 08:57:10','2016-10-29 08:57:10'),(8,1,8,1,1,1,1,'2016-10-29 08:57:10','2016-10-29 08:57:10'),(9,2,1,1,1,1,1,'2016-10-29 09:22:08','2016-10-29 09:22:08'),(10,2,2,0,0,0,0,'2016-10-29 09:22:08','2016-10-29 09:22:08'),(11,2,3,0,0,0,0,'2016-10-29 09:22:08','2016-10-29 09:22:08'),(12,2,4,1,1,1,1,'2016-10-29 09:22:08','2016-10-29 09:22:08'),(13,2,5,0,0,0,0,'2016-10-29 09:22:08','2016-10-29 09:22:08'),(14,2,6,0,0,0,0,'2016-10-29 09:22:08','2016-10-29 09:22:08'),(15,2,7,0,0,0,0,'2016-10-29 09:22:08','2016-10-29 09:22:08'),(16,2,8,0,0,0,0,'2016-10-29 09:22:08','2016-10-29 09:22:08'),(17,3,1,0,0,0,0,'2016-10-29 09:24:10','2016-10-29 09:24:10'),(18,3,2,0,0,0,0,'2016-10-29 09:24:10','2016-10-29 09:24:10'),(19,3,3,0,0,0,0,'2016-10-29 09:24:10','2016-10-29 09:24:10'),(20,3,4,0,0,0,0,'2016-10-29 09:24:10','2016-10-29 09:24:10'),(21,3,5,0,0,0,0,'2016-10-29 09:24:10','2016-10-29 09:24:10'),(22,3,6,0,0,0,0,'2016-10-29 09:24:10','2016-10-29 09:24:10'),(23,3,7,0,0,0,0,'2016-10-29 09:24:10','2016-10-29 09:24:10'),(24,3,8,0,0,0,0,'2016-10-29 09:24:10','2016-10-29 09:24:10'),(25,4,1,0,0,0,0,'2016-10-29 09:24:35','2016-10-29 09:24:35'),(26,4,2,0,0,0,0,'2016-10-29 09:24:35','2016-10-29 09:24:35'),(27,4,3,0,0,0,0,'2016-10-29 09:24:35','2016-10-29 09:24:35'),(28,4,4,0,0,0,0,'2016-10-29 09:24:35','2016-10-29 09:24:35'),(29,4,5,0,0,0,0,'2016-10-29 09:24:35','2016-10-29 09:24:35'),(30,4,6,0,0,0,0,'2016-10-29 09:24:35','2016-10-29 09:24:35'),(31,4,7,0,0,0,0,'2016-10-29 09:24:35','2016-10-29 09:24:35'),(32,4,8,0,0,0,0,'2016-10-29 09:24:35','2016-10-29 09:24:35'),(33,5,1,0,0,0,0,'2016-10-29 09:25:01','2016-10-29 09:25:01'),(34,5,2,0,0,0,0,'2016-10-29 09:25:01','2016-10-29 09:25:01'),(35,5,3,0,0,0,0,'2016-10-29 09:25:01','2016-10-29 09:25:01'),(36,5,4,0,0,0,0,'2016-10-29 09:25:01','2016-10-29 09:25:01'),(37,5,5,0,0,0,0,'2016-10-29 09:25:01','2016-10-29 09:25:01'),(38,5,6,0,0,0,0,'2016-10-29 09:25:01','2016-10-29 09:25:01'),(39,5,7,0,0,0,0,'2016-10-29 09:25:01','2016-10-29 09:25:01'),(40,5,8,0,0,0,0,'2016-10-29 09:25:01','2016-10-29 09:25:01'),(41,6,1,0,0,0,0,'2016-10-29 09:25:29','2016-10-29 09:25:29'),(42,6,2,0,0,0,0,'2016-10-29 09:25:29','2016-10-29 09:25:29'),(43,6,3,0,0,0,0,'2016-10-29 09:25:29','2016-10-29 09:25:29'),(44,6,4,0,0,0,0,'2016-10-29 09:25:29','2016-10-29 09:25:29'),(45,6,5,0,0,0,0,'2016-10-29 09:25:29','2016-10-29 09:25:29'),(46,6,6,0,0,0,0,'2016-10-29 09:25:29','2016-10-29 09:25:29'),(47,6,7,0,0,0,0,'2016-10-29 09:25:29','2016-10-29 09:25:29'),(48,6,8,0,0,0,0,'2016-10-29 09:25:29','2016-10-29 09:25:29'),(55,1,10,1,1,1,1,'2016-10-29 21:09:39','2016-10-29 21:09:39'),(56,2,10,1,1,1,1,'2016-10-29 21:10:06','2016-10-29 21:10:06'),(57,3,10,1,1,1,1,'2016-10-29 21:10:06','2016-10-29 21:10:06'),(58,4,10,1,0,0,0,'2016-10-29 21:10:06','2016-10-29 21:10:06'),(59,5,10,1,0,0,0,'2016-10-29 21:10:06','2016-10-29 21:10:06'),(60,6,10,1,0,0,0,'2016-10-29 21:10:06','2016-10-29 21:10:06'),(61,1,11,1,1,1,1,'2016-10-29 22:36:54','2016-10-29 22:36:54'),(62,1,12,1,1,1,1,'2016-10-31 07:27:40','2016-10-31 07:27:40'),(63,2,12,1,0,1,1,'2016-10-31 07:27:40','2016-10-31 07:27:40'),(64,3,12,1,0,1,1,'2016-10-31 07:27:40','2016-10-31 07:27:40'),(65,4,12,1,0,0,0,'2016-10-31 07:27:40','2016-10-31 07:27:40'),(66,5,12,1,0,0,0,'2016-10-31 07:27:40','2016-10-31 07:27:40'),(67,6,12,1,0,0,0,'2016-10-31 07:27:40','2016-10-31 07:27:40'),(81,1,19,1,1,1,1,'2016-11-02 23:21:41','2016-11-02 23:21:41'),(82,1,20,1,1,1,1,'2016-11-02 23:35:15','2016-11-02 23:35:15'),(83,2,20,1,0,1,0,'2016-11-02 23:35:15','2016-11-02 23:35:15'),(84,3,20,1,0,1,0,'2016-11-02 23:35:15','2016-11-02 23:35:15'),(85,4,20,1,0,0,0,'2016-11-02 23:35:15','2016-11-02 23:35:15'),(86,5,20,1,0,0,0,'2016-11-02 23:35:15','2016-11-02 23:35:15'),(87,6,20,1,0,0,0,'2016-11-02 23:35:15','2016-11-02 23:35:15'),(88,1,21,1,1,1,1,'2016-11-02 23:39:00','2016-11-02 23:39:00'),(89,2,21,1,1,1,1,'2016-11-02 23:39:00','2016-11-02 23:39:00'),(90,3,21,1,1,1,1,'2016-11-02 23:39:00','2016-11-02 23:39:00'),(91,4,21,1,0,0,0,'2016-11-02 23:39:00','2016-11-02 23:39:00'),(92,5,21,1,0,0,0,'2016-11-02 23:39:00','2016-11-02 23:39:00'),(93,6,21,1,0,0,0,'2016-11-02 23:39:00','2016-11-02 23:39:00'),(94,1,22,1,1,1,1,'2016-11-03 00:01:55','2016-11-03 00:01:55'),(95,2,22,1,1,1,1,'2016-11-03 00:01:55','2016-11-03 00:01:55'),(96,3,22,1,1,1,1,'2016-11-03 00:01:55','2016-11-03 00:01:55'),(97,4,22,1,0,0,0,'2016-11-03 00:01:55','2016-11-03 00:01:55'),(98,5,22,1,0,0,0,'2016-11-03 00:01:55','2016-11-03 00:01:55'),(99,6,22,1,0,0,0,'2016-11-03 00:01:55','2016-11-03 00:01:55'),(100,1,23,1,1,1,1,'2016-11-05 04:09:50','2016-11-05 04:09:50'),(101,2,11,1,1,1,1,'2016-11-05 23:09:18','2016-11-05 23:09:18'),(102,3,11,1,1,1,1,'2016-11-05 23:09:18','2016-11-05 23:09:18'),(103,4,11,1,1,1,1,'2016-11-05 23:09:18','2016-11-05 23:09:18'),(104,5,11,1,1,0,0,'2016-11-05 23:09:18','2016-11-05 23:09:18'),(105,6,11,1,1,0,0,'2016-11-05 23:09:18','2016-11-05 23:09:18'),(106,2,19,0,0,0,0,'2016-11-05 23:12:00','2016-11-05 23:12:00'),(107,3,19,0,0,0,0,'2016-11-05 23:12:00','2016-11-05 23:12:00'),(108,4,19,0,0,0,0,'2016-11-05 23:12:00','2016-11-05 23:12:00'),(109,5,19,0,0,0,0,'2016-11-05 23:12:00','2016-11-05 23:12:00'),(110,6,19,0,0,0,0,'2016-11-05 23:12:00','2016-11-05 23:12:00'),(111,2,23,1,1,1,1,'2016-11-05 23:15:27','2016-11-05 23:15:27'),(112,3,23,1,1,1,1,'2016-11-05 23:15:27','2016-11-05 23:15:27'),(113,4,23,1,1,1,1,'2016-11-05 23:15:27','2016-11-05 23:15:27'),(114,5,23,1,0,0,0,'2016-11-05 23:15:27','2016-11-05 23:15:27'),(115,6,23,1,0,0,0,'2016-11-05 23:15:27','2016-11-05 23:15:27');
/*!40000 ALTER TABLE `role_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_module_fields`
--

DROP TABLE IF EXISTS `role_module_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_module_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `field_id` int(10) unsigned NOT NULL,
  `access` enum('invisible','readonly','write') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_module_fields_role_id_foreign` (`role_id`),
  KEY `role_module_fields_field_id_foreign` (`field_id`),
  CONSTRAINT `role_module_fields_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `module_fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_module_fields_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=758 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_module_fields`
--

LOCK TABLES `role_module_fields` WRITE;
/*!40000 ALTER TABLE `role_module_fields` DISABLE KEYS */;
INSERT INTO `role_module_fields` VALUES (1,1,1,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(2,1,2,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(3,1,3,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(4,1,4,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(5,1,5,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(6,1,6,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(7,1,7,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(8,1,8,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(9,1,9,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(10,1,10,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(11,1,11,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(12,1,12,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(13,1,13,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(14,1,14,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(15,1,15,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(16,1,16,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(17,1,17,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(18,1,18,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(19,1,19,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(20,1,20,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(21,1,21,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(22,1,22,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(23,1,23,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(24,1,24,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(25,1,25,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(26,1,26,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(27,1,27,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(28,1,28,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(29,1,29,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(30,1,30,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(31,1,31,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(32,1,32,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(33,1,33,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(34,1,34,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(35,1,35,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(36,1,36,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(37,1,37,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(38,1,38,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(39,1,39,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(40,1,40,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(41,1,41,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(42,1,42,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(43,1,43,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(44,1,44,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(45,1,45,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(46,1,46,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(47,1,47,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(48,1,48,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(49,1,49,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(50,1,50,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(51,1,51,'write','2016-10-29 08:57:10','2016-10-29 08:57:10'),(52,2,1,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(53,2,2,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(54,2,3,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(55,2,4,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(56,2,5,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(57,2,6,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(58,2,7,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(59,2,8,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(60,2,9,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(61,2,10,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(62,2,11,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(63,2,12,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(64,2,13,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(65,2,14,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(66,2,15,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(67,2,16,'write','2016-10-29 09:22:08','2016-10-29 09:22:08'),(68,2,17,'write','2016-10-29 09:22:08','2016-10-29 09:22:08'),(69,2,18,'write','2016-10-29 09:22:08','2016-10-29 09:22:08'),(70,2,19,'write','2016-10-29 09:22:08','2016-10-29 09:22:08'),(71,2,20,'write','2016-10-29 09:22:08','2016-10-29 09:22:08'),(72,2,21,'write','2016-10-29 09:22:08','2016-10-29 09:22:08'),(73,2,22,'invisible','2016-10-29 09:22:08','2016-10-29 09:22:08'),(74,2,23,'write','2016-10-29 09:22:08','2016-10-29 09:22:08'),(75,2,24,'write','2016-10-29 09:22:08','2016-10-29 09:22:08'),(76,2,25,'write','2016-10-29 09:22:08','2016-10-29 09:22:08'),(77,2,26,'write','2016-10-29 09:22:08','2016-10-29 09:22:08'),(78,2,27,'write','2016-10-29 09:22:08','2016-10-29 09:22:08'),(79,2,28,'write','2016-10-29 09:22:08','2016-10-29 09:22:08'),(80,2,29,'write','2016-10-29 09:22:08','2016-10-29 09:22:08'),(81,2,30,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(82,2,31,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(83,2,32,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(84,2,33,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(85,2,34,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(86,2,35,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(87,2,36,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(88,2,37,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(89,2,38,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(90,2,39,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(91,2,40,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(92,2,41,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(93,2,42,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(94,2,43,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(95,2,44,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(96,2,45,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(97,2,46,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(98,2,47,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(99,2,48,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(100,2,49,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(101,2,50,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(102,2,51,'readonly','2016-10-29 09:22:08','2016-10-29 09:22:08'),(103,3,1,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(104,3,2,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(105,3,3,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(106,3,4,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(107,3,5,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(108,3,6,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(109,3,7,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(110,3,8,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(111,3,9,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(112,3,10,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(113,3,11,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(114,3,12,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(115,3,13,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(116,3,14,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(117,3,15,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(118,3,16,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(119,3,17,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(120,3,18,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(121,3,19,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(122,3,20,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(123,3,21,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(124,3,22,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(125,3,23,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(126,3,24,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(127,3,25,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(128,3,26,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(129,3,27,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(130,3,28,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(131,3,29,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(132,3,30,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(133,3,31,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(134,3,32,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(135,3,33,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(136,3,34,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(137,3,35,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(138,3,36,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(139,3,37,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(140,3,38,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(141,3,39,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(142,3,40,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(143,3,41,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(144,3,42,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(145,3,43,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(146,3,44,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(147,3,45,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(148,3,46,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(149,3,47,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(150,3,48,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(151,3,49,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(152,3,50,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(153,3,51,'readonly','2016-10-29 09:24:10','2016-10-29 09:24:10'),(154,4,1,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(155,4,2,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(156,4,3,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(157,4,4,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(158,4,5,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(159,4,6,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(160,4,7,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(161,4,8,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(162,4,9,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(163,4,10,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(164,4,11,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(165,4,12,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(166,4,13,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(167,4,14,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(168,4,15,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(169,4,16,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(170,4,17,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(171,4,18,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(172,4,19,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(173,4,20,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(174,4,21,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(175,4,22,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(176,4,23,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(177,4,24,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(178,4,25,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(179,4,26,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(180,4,27,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(181,4,28,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(182,4,29,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(183,4,30,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(184,4,31,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(185,4,32,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(186,4,33,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(187,4,34,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(188,4,35,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(189,4,36,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(190,4,37,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(191,4,38,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(192,4,39,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(193,4,40,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(194,4,41,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(195,4,42,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(196,4,43,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(197,4,44,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(198,4,45,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(199,4,46,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(200,4,47,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(201,4,48,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(202,4,49,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(203,4,50,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(204,4,51,'readonly','2016-10-29 09:24:35','2016-10-29 09:24:35'),(205,5,1,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(206,5,2,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(207,5,3,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(208,5,4,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(209,5,5,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(210,5,6,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(211,5,7,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(212,5,8,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(213,5,9,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(214,5,10,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(215,5,11,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(216,5,12,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(217,5,13,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(218,5,14,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(219,5,15,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(220,5,16,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(221,5,17,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(222,5,18,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(223,5,19,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(224,5,20,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(225,5,21,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(226,5,22,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(227,5,23,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(228,5,24,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(229,5,25,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(230,5,26,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(231,5,27,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(232,5,28,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(233,5,29,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(234,5,30,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(235,5,31,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(236,5,32,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(237,5,33,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(238,5,34,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(239,5,35,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(240,5,36,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(241,5,37,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(242,5,38,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(243,5,39,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(244,5,40,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(245,5,41,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(246,5,42,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(247,5,43,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(248,5,44,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(249,5,45,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(250,5,46,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(251,5,47,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(252,5,48,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(253,5,49,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(254,5,50,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(255,5,51,'readonly','2016-10-29 09:25:01','2016-10-29 09:25:01'),(256,6,1,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(257,6,2,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(258,6,3,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(259,6,4,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(260,6,5,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(261,6,6,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(262,6,7,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(263,6,8,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(264,6,9,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(265,6,10,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(266,6,11,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(267,6,12,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(268,6,13,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(269,6,14,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(270,6,15,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(271,6,16,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(272,6,17,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(273,6,18,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(274,6,19,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(275,6,20,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(276,6,21,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(277,6,22,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(278,6,23,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(279,6,24,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(280,6,25,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(281,6,26,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(282,6,27,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(283,6,28,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(284,6,29,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(285,6,30,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(286,6,31,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(287,6,32,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(288,6,33,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(289,6,34,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(290,6,35,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(291,6,36,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(292,6,37,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(293,6,38,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(294,6,39,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(295,6,40,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(296,6,41,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(297,6,42,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(298,6,43,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(299,6,44,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(300,6,45,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(301,6,46,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(302,6,47,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(303,6,48,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(304,6,49,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(305,6,50,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(306,6,51,'readonly','2016-10-29 09:25:29','2016-10-29 09:25:29'),(331,1,56,'write','2016-10-29 21:07:37','2016-10-29 21:07:37'),(332,1,57,'write','2016-10-29 21:09:01','2016-10-29 21:09:01'),(333,1,58,'write','2016-10-29 21:09:28','2016-10-29 21:09:28'),(334,2,56,'write','2016-10-29 21:10:06','2016-10-29 21:10:06'),(335,2,57,'write','2016-10-29 21:10:06','2016-10-29 21:10:06'),(336,2,58,'write','2016-10-29 21:10:06','2016-10-29 21:10:06'),(337,3,56,'write','2016-10-29 21:10:06','2016-10-29 21:10:06'),(338,3,57,'write','2016-10-29 21:10:06','2016-10-29 21:10:06'),(339,3,58,'write','2016-10-29 21:10:06','2016-10-29 21:10:06'),(340,4,56,'readonly','2016-10-29 21:10:06','2016-10-29 21:10:06'),(341,4,57,'readonly','2016-10-29 21:10:06','2016-10-29 21:10:06'),(342,4,58,'readonly','2016-10-29 21:10:06','2016-10-29 21:10:06'),(343,5,56,'readonly','2016-10-29 21:10:06','2016-10-29 21:10:06'),(344,5,57,'readonly','2016-10-29 21:10:06','2016-10-29 21:10:06'),(345,5,58,'readonly','2016-10-29 21:10:06','2016-10-29 21:10:06'),(346,6,56,'readonly','2016-10-29 21:10:06','2016-10-29 21:10:06'),(347,6,57,'readonly','2016-10-29 21:10:06','2016-10-29 21:10:06'),(348,6,58,'readonly','2016-10-29 21:10:06','2016-10-29 21:10:06'),(349,1,59,'write','2016-10-29 21:29:13','2016-10-29 21:29:13'),(350,1,60,'write','2016-10-29 22:31:12','2016-10-29 22:31:12'),(351,1,61,'write','2016-10-29 22:32:48','2016-10-29 22:32:48'),(352,1,62,'write','2016-10-29 22:33:19','2016-10-29 22:33:19'),(353,1,63,'write','2016-10-29 22:34:03','2016-10-29 22:34:03'),(354,1,64,'write','2016-10-29 22:34:54','2016-10-29 22:34:54'),(355,1,65,'write','2016-10-29 22:35:26','2016-10-29 22:35:26'),(356,1,66,'write','2016-10-29 22:36:00','2016-10-29 22:36:00'),(357,1,67,'write','2016-10-30 10:26:07','2016-10-30 10:26:07'),(358,1,68,'write','2016-10-30 10:29:24','2016-10-30 10:29:24'),(359,1,69,'write','2016-10-31 06:40:39','2016-10-31 06:40:39'),(360,1,70,'write','2016-10-31 06:41:23','2016-10-31 06:41:23'),(361,1,71,'write','2016-10-31 06:41:47','2016-10-31 06:41:47'),(362,1,72,'write','2016-10-31 06:44:43','2016-10-31 06:44:43'),(363,1,73,'write','2016-10-31 07:23:41','2016-10-31 07:23:41'),(364,1,74,'write','2016-10-31 07:24:05','2016-10-31 07:24:05'),(365,1,75,'write','2016-10-31 07:24:43','2016-10-31 07:24:43'),(366,1,76,'write','2016-10-31 07:25:31','2016-10-31 07:25:31'),(367,1,77,'write','2016-10-31 07:26:20','2016-10-31 07:26:20'),(368,1,78,'write','2016-10-31 07:26:40','2016-10-31 07:26:40'),(369,1,79,'write','2016-10-31 07:27:05','2016-10-31 07:27:05'),(370,2,79,'write','2016-10-31 07:27:40','2016-10-31 07:27:40'),(371,2,73,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(372,2,74,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(373,2,75,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(374,2,76,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(375,2,77,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(376,2,78,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(377,3,79,'write','2016-10-31 07:27:40','2016-10-31 07:27:40'),(378,3,73,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(379,3,74,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(380,3,75,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(381,3,76,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(382,3,77,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(383,3,78,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(384,4,79,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(385,4,73,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(386,4,74,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(387,4,75,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(388,4,76,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(389,4,77,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(390,4,78,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(391,5,79,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(392,5,73,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(393,5,74,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(394,5,75,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(395,5,76,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(396,5,77,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(397,5,78,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(398,6,79,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(399,6,73,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(400,6,74,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(401,6,75,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(402,6,76,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(403,6,77,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(404,6,78,'readonly','2016-10-31 07:27:40','2016-10-31 07:27:40'),(472,1,97,'write','2016-11-02 23:21:30','2016-11-02 23:21:30'),(473,1,98,'write','2016-11-02 23:22:21','2016-11-02 23:22:21'),(474,1,99,'write','2016-11-02 23:23:12','2016-11-02 23:23:12'),(475,1,100,'write','2016-11-02 23:23:30','2016-11-02 23:23:30'),(476,1,101,'write','2016-11-02 23:24:11','2016-11-02 23:24:11'),(477,1,102,'write','2016-11-02 23:29:39','2016-11-02 23:29:39'),(478,1,103,'write','2016-11-02 23:30:06','2016-11-02 23:30:06'),(479,1,104,'write','2016-11-02 23:30:20','2016-11-02 23:30:20'),(480,1,105,'write','2016-11-02 23:30:35','2016-11-02 23:30:35'),(481,1,106,'write','2016-11-02 23:31:27','2016-11-02 23:31:27'),(482,1,107,'write','2016-11-02 23:31:51','2016-11-02 23:31:51'),(483,1,108,'write','2016-11-02 23:32:11','2016-11-02 23:32:11'),(484,1,109,'write','2016-11-02 23:32:41','2016-11-02 23:32:41'),(485,1,110,'write','2016-11-02 23:33:07','2016-11-02 23:33:07'),(486,1,111,'write','2016-11-02 23:33:36','2016-11-02 23:33:36'),(487,1,112,'write','2016-11-02 23:33:55','2016-11-02 23:33:55'),(488,1,113,'write','2016-11-02 23:34:22','2016-11-02 23:34:22'),(489,2,102,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(490,2,103,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(491,2,104,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(492,2,105,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(493,2,108,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(494,2,110,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(495,2,109,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(496,2,106,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(497,2,107,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(498,2,111,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(499,2,112,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(500,2,113,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(501,3,102,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(502,3,103,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(503,3,104,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(504,3,105,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(505,3,108,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(506,3,110,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(507,3,109,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(508,3,106,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(509,3,107,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(510,3,111,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(511,3,112,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(512,3,113,'write','2016-11-02 23:35:15','2016-11-02 23:35:15'),(513,4,102,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(514,4,103,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(515,4,104,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(516,4,105,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(517,4,108,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(518,4,110,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(519,4,109,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(520,4,106,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(521,4,107,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(522,4,111,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(523,4,112,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(524,4,113,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(525,5,102,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(526,5,103,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(527,5,104,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(528,5,105,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(529,5,108,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(530,5,110,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(531,5,109,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(532,5,106,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(533,5,107,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(534,5,111,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(535,5,112,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(536,5,113,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(537,6,102,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(538,6,103,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(539,6,104,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(540,6,105,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(541,6,108,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(542,6,110,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(543,6,109,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(544,6,106,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(545,6,107,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(546,6,111,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(547,6,112,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(548,6,113,'invisible','2016-11-02 23:35:15','2016-11-02 23:35:15'),(549,1,114,'write','2016-11-02 23:37:36','2016-11-02 23:37:36'),(550,1,115,'write','2016-11-02 23:37:52','2016-11-02 23:37:52'),(551,1,116,'write','2016-11-02 23:38:27','2016-11-02 23:38:27'),(552,2,114,'write','2016-11-02 23:39:00','2016-11-02 23:39:00'),(553,2,115,'write','2016-11-02 23:39:00','2016-11-02 23:39:00'),(554,2,116,'write','2016-11-02 23:39:00','2016-11-02 23:39:00'),(555,3,114,'write','2016-11-02 23:39:00','2016-11-02 23:39:00'),(556,3,115,'write','2016-11-02 23:39:00','2016-11-02 23:39:00'),(557,3,116,'write','2016-11-02 23:39:00','2016-11-02 23:39:00'),(558,4,114,'invisible','2016-11-02 23:39:00','2016-11-02 23:39:00'),(559,4,115,'invisible','2016-11-02 23:39:00','2016-11-02 23:39:00'),(560,4,116,'invisible','2016-11-02 23:39:00','2016-11-02 23:39:00'),(561,5,114,'invisible','2016-11-02 23:39:00','2016-11-02 23:39:00'),(562,5,115,'invisible','2016-11-02 23:39:00','2016-11-02 23:39:00'),(563,5,116,'invisible','2016-11-02 23:39:00','2016-11-02 23:39:00'),(564,6,114,'invisible','2016-11-02 23:39:00','2016-11-02 23:39:00'),(565,6,115,'invisible','2016-11-02 23:39:00','2016-11-02 23:39:00'),(566,6,116,'invisible','2016-11-02 23:39:00','2016-11-02 23:39:00'),(567,1,117,'write','2016-11-02 23:59:56','2016-11-02 23:59:56'),(568,1,118,'write','2016-11-03 00:00:16','2016-11-03 00:00:16'),(569,1,119,'write','2016-11-03 00:00:40','2016-11-03 00:00:40'),(570,1,120,'write','2016-11-03 00:01:07','2016-11-03 00:01:07'),(571,1,121,'write','2016-11-03 00:01:24','2016-11-03 00:01:24'),(572,2,120,'write','2016-11-03 00:01:55','2016-11-03 00:01:55'),(573,2,117,'write','2016-11-03 00:01:55','2016-11-03 00:01:55'),(574,2,118,'write','2016-11-03 00:01:55','2016-11-03 00:01:55'),(575,2,119,'write','2016-11-03 00:01:55','2016-11-03 00:01:55'),(576,2,121,'write','2016-11-03 00:01:55','2016-11-03 00:01:55'),(577,3,120,'write','2016-11-03 00:01:55','2016-11-03 00:01:55'),(578,3,117,'write','2016-11-03 00:01:55','2016-11-03 00:01:55'),(579,3,118,'write','2016-11-03 00:01:55','2016-11-03 00:01:55'),(580,3,119,'write','2016-11-03 00:01:55','2016-11-03 00:01:55'),(581,3,121,'write','2016-11-03 00:01:55','2016-11-03 00:01:55'),(582,4,120,'invisible','2016-11-03 00:01:55','2016-11-03 00:01:55'),(583,4,117,'invisible','2016-11-03 00:01:55','2016-11-03 00:01:55'),(584,4,118,'invisible','2016-11-03 00:01:55','2016-11-03 00:01:55'),(585,4,119,'invisible','2016-11-03 00:01:55','2016-11-03 00:01:55'),(586,4,121,'invisible','2016-11-03 00:01:55','2016-11-03 00:01:55'),(587,5,120,'invisible','2016-11-03 00:01:55','2016-11-03 00:01:55'),(588,5,117,'invisible','2016-11-03 00:01:55','2016-11-03 00:01:55'),(589,5,118,'invisible','2016-11-03 00:01:55','2016-11-03 00:01:55'),(590,5,119,'invisible','2016-11-03 00:01:55','2016-11-03 00:01:55'),(591,5,121,'invisible','2016-11-03 00:01:55','2016-11-03 00:01:55'),(592,6,120,'invisible','2016-11-03 00:01:55','2016-11-03 00:01:55'),(593,6,117,'invisible','2016-11-03 00:01:55','2016-11-03 00:01:55'),(594,6,118,'invisible','2016-11-03 00:01:55','2016-11-03 00:01:55'),(595,6,119,'invisible','2016-11-03 00:01:55','2016-11-03 00:01:55'),(596,6,121,'invisible','2016-11-03 00:01:55','2016-11-03 00:01:55'),(597,1,122,'write','2016-11-03 00:29:56','2016-11-03 00:29:56'),(598,1,123,'write','2016-11-03 00:30:26','2016-11-03 00:30:26'),(599,1,124,'write','2016-11-03 00:30:46','2016-11-03 00:30:46'),(600,1,125,'write','2016-11-03 00:31:04','2016-11-03 00:31:04'),(601,1,126,'write','2016-11-04 18:57:08','2016-11-04 18:57:08'),(602,1,127,'write','2016-11-04 18:57:50','2016-11-04 18:57:50'),(603,1,128,'write','2016-11-05 04:06:29','2016-11-05 04:06:29'),(604,1,129,'write','2016-11-05 04:07:05','2016-11-05 04:07:05'),(605,1,130,'write','2016-11-05 04:07:34','2016-11-05 04:07:34'),(606,1,131,'write','2016-11-05 04:08:13','2016-11-05 04:08:13'),(607,1,132,'write','2016-11-05 04:08:34','2016-11-05 04:08:34'),(608,2,59,'write','2016-11-05 23:08:36','2016-11-05 23:08:36'),(609,2,122,'write','2016-11-05 23:08:36','2016-11-05 23:08:36'),(610,2,67,'write','2016-11-05 23:08:36','2016-11-05 23:08:36'),(611,2,123,'write','2016-11-05 23:08:36','2016-11-05 23:08:36'),(612,2,124,'write','2016-11-05 23:08:36','2016-11-05 23:08:36'),(613,2,125,'write','2016-11-05 23:08:36','2016-11-05 23:08:36'),(614,3,59,'write','2016-11-05 23:08:36','2016-11-05 23:08:36'),(615,3,122,'write','2016-11-05 23:08:36','2016-11-05 23:08:36'),(616,3,67,'write','2016-11-05 23:08:36','2016-11-05 23:08:36'),(617,3,123,'write','2016-11-05 23:08:36','2016-11-05 23:08:36'),(618,3,124,'write','2016-11-05 23:08:36','2016-11-05 23:08:36'),(619,3,125,'write','2016-11-05 23:08:36','2016-11-05 23:08:36'),(620,4,59,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(621,4,122,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(622,4,67,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(623,4,123,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(624,4,124,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(625,4,125,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(626,5,59,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(627,5,122,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(628,5,67,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(629,5,123,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(630,5,124,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(631,5,125,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(632,6,59,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(633,6,122,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(634,6,67,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(635,6,123,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(636,6,124,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(637,6,125,'readonly','2016-11-05 23:08:36','2016-11-05 23:08:36'),(638,2,66,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(639,2,60,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(640,2,65,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(641,2,68,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(642,2,61,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(643,2,63,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(644,2,62,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(645,2,72,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(646,2,64,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(647,2,69,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(648,2,70,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(649,2,71,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(650,3,66,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(651,3,60,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(652,3,65,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(653,3,68,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(654,3,61,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(655,3,63,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(656,3,62,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(657,3,72,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(658,3,64,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(659,3,69,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(660,3,70,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(661,3,71,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(662,4,66,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(663,4,60,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(664,4,65,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(665,4,68,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(666,4,61,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(667,4,63,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(668,4,62,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(669,4,72,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(670,4,64,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(671,4,69,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(672,4,70,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(673,4,71,'write','2016-11-05 23:09:18','2016-11-05 23:09:18'),(674,5,66,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(675,5,60,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(676,5,65,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(677,5,68,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(678,5,61,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(679,5,63,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(680,5,62,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(681,5,72,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(682,5,64,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(683,5,69,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(684,5,70,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(685,5,71,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(686,6,66,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(687,6,60,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(688,6,65,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(689,6,68,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(690,6,61,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(691,6,63,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(692,6,62,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(693,6,72,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(694,6,64,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(695,6,69,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(696,6,70,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(697,6,71,'readonly','2016-11-05 23:09:18','2016-11-05 23:09:18'),(698,2,97,'write','2016-11-05 23:12:00','2016-11-05 23:12:00'),(699,2,98,'write','2016-11-05 23:12:00','2016-11-05 23:12:00'),(700,2,99,'write','2016-11-05 23:12:00','2016-11-05 23:12:00'),(701,2,100,'write','2016-11-05 23:12:00','2016-11-05 23:12:00'),(702,2,101,'write','2016-11-05 23:12:00','2016-11-05 23:12:00'),(703,3,97,'write','2016-11-05 23:12:00','2016-11-05 23:12:00'),(704,3,98,'write','2016-11-05 23:12:00','2016-11-05 23:12:00'),(705,3,99,'write','2016-11-05 23:12:00','2016-11-05 23:12:00'),(706,3,100,'write','2016-11-05 23:12:00','2016-11-05 23:12:00'),(707,3,101,'write','2016-11-05 23:12:00','2016-11-05 23:12:00'),(708,4,97,'readonly','2016-11-05 23:12:00','2016-11-05 23:12:00'),(709,4,98,'readonly','2016-11-05 23:12:00','2016-11-05 23:12:00'),(710,4,99,'readonly','2016-11-05 23:12:00','2016-11-05 23:12:00'),(711,4,100,'readonly','2016-11-05 23:12:00','2016-11-05 23:12:00'),(712,4,101,'readonly','2016-11-05 23:12:00','2016-11-05 23:12:00'),(713,5,97,'readonly','2016-11-05 23:12:00','2016-11-05 23:12:00'),(714,5,98,'readonly','2016-11-05 23:12:00','2016-11-05 23:12:00'),(715,5,99,'readonly','2016-11-05 23:12:00','2016-11-05 23:12:00'),(716,5,100,'readonly','2016-11-05 23:12:00','2016-11-05 23:12:00'),(717,5,101,'readonly','2016-11-05 23:12:00','2016-11-05 23:12:00'),(718,6,97,'readonly','2016-11-05 23:12:00','2016-11-05 23:12:00'),(719,6,98,'readonly','2016-11-05 23:12:00','2016-11-05 23:12:00'),(720,6,99,'readonly','2016-11-05 23:12:00','2016-11-05 23:12:00'),(721,6,100,'readonly','2016-11-05 23:12:00','2016-11-05 23:12:00'),(722,6,101,'readonly','2016-11-05 23:12:00','2016-11-05 23:12:00'),(723,2,126,'write','2016-11-05 23:14:46','2016-11-05 23:14:46'),(724,2,127,'write','2016-11-05 23:14:46','2016-11-05 23:14:46'),(725,3,126,'write','2016-11-05 23:14:46','2016-11-05 23:14:46'),(726,3,127,'write','2016-11-05 23:14:46','2016-11-05 23:14:46'),(727,4,126,'invisible','2016-11-05 23:14:46','2016-11-05 23:14:46'),(728,4,127,'invisible','2016-11-05 23:14:46','2016-11-05 23:14:46'),(729,5,126,'invisible','2016-11-05 23:14:46','2016-11-05 23:14:46'),(730,5,127,'invisible','2016-11-05 23:14:46','2016-11-05 23:14:46'),(731,6,126,'invisible','2016-11-05 23:14:46','2016-11-05 23:14:46'),(732,6,127,'invisible','2016-11-05 23:14:46','2016-11-05 23:14:46'),(733,2,128,'write','2016-11-05 23:15:27','2016-11-05 23:15:27'),(734,2,129,'write','2016-11-05 23:15:27','2016-11-05 23:15:27'),(735,2,130,'write','2016-11-05 23:15:27','2016-11-05 23:15:27'),(736,2,131,'write','2016-11-05 23:15:27','2016-11-05 23:15:27'),(737,2,132,'write','2016-11-05 23:15:27','2016-11-05 23:15:27'),(738,3,128,'write','2016-11-05 23:15:27','2016-11-05 23:15:27'),(739,3,129,'write','2016-11-05 23:15:27','2016-11-05 23:15:27'),(740,3,130,'write','2016-11-05 23:15:27','2016-11-05 23:15:27'),(741,3,131,'write','2016-11-05 23:15:27','2016-11-05 23:15:27'),(742,3,132,'write','2016-11-05 23:15:27','2016-11-05 23:15:27'),(743,4,128,'write','2016-11-05 23:15:27','2016-11-05 23:15:27'),(744,4,129,'write','2016-11-05 23:15:27','2016-11-05 23:15:27'),(745,4,130,'write','2016-11-05 23:15:27','2016-11-05 23:15:27'),(746,4,131,'write','2016-11-05 23:15:27','2016-11-05 23:15:27'),(747,4,132,'write','2016-11-05 23:15:27','2016-11-05 23:15:27'),(748,5,128,'invisible','2016-11-05 23:15:27','2016-11-05 23:15:27'),(749,5,129,'invisible','2016-11-05 23:15:27','2016-11-05 23:15:27'),(750,5,130,'invisible','2016-11-05 23:15:27','2016-11-05 23:15:27'),(751,5,131,'invisible','2016-11-05 23:15:27','2016-11-05 23:15:27'),(752,5,132,'invisible','2016-11-05 23:15:27','2016-11-05 23:15:27'),(753,6,128,'invisible','2016-11-05 23:15:27','2016-11-05 23:15:27'),(754,6,129,'invisible','2016-11-05 23:15:27','2016-11-05 23:15:27'),(755,6,130,'invisible','2016-11-05 23:15:27','2016-11-05 23:15:27'),(756,6,131,'invisible','2016-11-05 23:15:27','2016-11-05 23:15:27'),(757,6,132,'invisible','2016-11-05 23:15:27','2016-11-05 23:15:27');
/*!40000 ALTER TABLE `role_module_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (5,1,1,NULL,NULL),(10,2,2,NULL,NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `display_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(10) unsigned NOT NULL DEFAULT '1',
  `dept` int(10) unsigned NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  KEY `roles_parent_foreign` (`parent`),
  KEY `roles_dept_foreign` (`dept`),
  CONSTRAINT `roles_dept_foreign` FOREIGN KEY (`dept`) REFERENCES `departments` (`id`),
  CONSTRAINT `roles_parent_foreign` FOREIGN KEY (`parent`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'SUPER_ADMIN','Super Admin','Full Access Role',1,1,NULL,'2016-10-29 08:57:10','2016-10-29 08:57:10'),(2,'ADMINISTRATOR','Administrator','Nhóm người dùng có quyền sử dụng toàn bộ các tính năng có trong một website',2,2,NULL,'2016-10-29 09:22:08','2016-10-29 09:43:25'),(3,'EDITOR','Editor','Nhóm này có quyền đăng bài viết lên website (publish) và quản lý các post khác của những người dùng khác.',1,3,NULL,'2016-10-29 09:24:10','2016-10-29 09:24:10'),(4,'AUTHOR','Author','Nhóm này sẽ có quyền đăng bài lên website và quản lý các post của họ.',1,4,NULL,'2016-10-29 09:24:35','2016-10-29 09:24:35'),(5,'CONTRIBUTOR','Contributor','Nhóm này sẽ có quyền viết bài mới nhưng không được phép đăng lên mà chỉ có thể gửi để xét duyệt (Save as Review) và quản lý post của họ.',1,5,NULL,'2016-10-29 09:25:01','2016-10-29 09:25:01'),(6,'SUBSCRIBER','Subscriber','Người dùng trong nhóm này chỉ có thể quản lý thông tin cá nhân của họ',6,6,NULL,'2016-10-29 09:25:29','2016-10-29 09:43:05');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `google_analytics` text COLLATE utf8_unicode_ci NOT NULL,
  `google_webmaster` text COLLATE utf8_unicode_ci NOT NULL,
  `favicon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `footer` text COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `metaTitle` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `metaDes` text COLLATE utf8_unicode_ci NOT NULL,
  `metaKey` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,NULL,'2016-11-02 23:44:37','2016-11-08 08:24:01','BtcBomb','0979789664','lyngochung.88@gmail.com','uploads/photos/settings/581d621e99d69.png','','','uploads/photos/settings/581d6242d04c0.png','BtcBomb Company 2016','','BtcBomb','BtcBomb','BtcBomb');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sliders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#',
  `image` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `small_text` text COLLATE utf8_unicode_ci NOT NULL,
  `position_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (1,NULL,'2016-11-04 18:51:06','2016-11-05 22:30:23','The Bitcoin Minesweeper','games.html','uploads/photos/Sliders/581d49155aa90.jpg',1,0,'The more greens you find on the 5x5 grid, the higher your multiplier. Try not to hit any mines or your game will end!','left');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socials`
--

DROP TABLE IF EXISTS `socials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `socials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `icon` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `socials_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socials`
--

LOCK TABLES `socials` WRITE;
/*!40000 ALTER TABLE `socials` DISABLE KEYS */;
INSERT INTO `socials` VALUES (1,NULL,'2016-11-02 23:58:34','2016-11-05 08:23:58','Facebook','http://facebook.com/','facebook');
/*!40000 ALTER TABLE `socials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uploads`
--

DROP TABLE IF EXISTS `uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uploads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `path` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `caption` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `hash` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uploads_user_id_foreign` (`user_id`),
  CONSTRAINT `uploads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uploads`
--

LOCK TABLES `uploads` WRITE;
/*!40000 ALTER TABLE `uploads` DISABLE KEYS */;
INSERT INTO `uploads` VALUES (1,'1-11040H14H2.jpg','/Volumes/DATA/Project/php/bsstech/storage/uploads/2016-10-30-063812-1-11040H14H2.jpg','jpg','',1,'jw8ish57shmitdvoab0z',0,'2016-10-29 22:39:59','2016-10-29 22:38:12','2016-10-29 22:39:59'),(2,'1-11040H14I1.jpg','/Volumes/DATA/Project/php/bsstech/storage/uploads/2016-10-30-063816-1-11040H14I1.jpg','jpg','',1,'tsmijsl4u8jnlazsrbsy',0,'2016-10-29 22:39:52','2016-10-29 22:38:16','2016-10-29 22:39:52'),(3,'1-11040H14H5.jpg','/Volumes/DATA/Project/php/bsstech/storage/uploads/2016-10-31-175328-1-11040H14H5.jpg','jpg','',1,'bqsfqloefaqsouyz8e5r',0,NULL,'2016-10-31 09:53:28','2016-10-31 09:53:28');
/*!40000 ALTER TABLE `uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `context_id` int(10) unsigned NOT NULL DEFAULT '0',
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Employee',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'superadmin',1,'lyngochung.88@gmail.com','$2y$10$QIhTL8KHWTuJwRKH9LRIIuVfTLDkikfPhV0IGIHQZSjOsKrCUG5CS','Employee','BMjGtqXJ3DwImhvkhHU4L1OiiZFvyiQFj6olwGJuvbNcHiQxk1z1QqC8HTLL',NULL,'2016-10-29 08:57:53','2016-11-07 18:54:32'),(2,'Administrator',2,'admin@ethersmine.com','$2y$10$iRs3wvpxcUwL3NCGvoWguuwQFy1lRcouQaB5mGhMsZibjLeyOpiaC','Employee','hTo0FqbpTn3j2gx2fgp8pCE8hWGR024apBsaWSs7G7Wt1AS1g5whyJLPyfJQ',NULL,'2016-10-29 09:26:54','2016-11-07 19:57:39');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-09 23:16:10
