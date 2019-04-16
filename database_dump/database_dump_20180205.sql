CREATE DATABASE  IF NOT EXISTS `ducsbank` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ducsbank`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ducsbank
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.26-MariaDB

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'uniquely identifies all accounts.',
  `acc_no` varchar(45) NOT NULL COMMENT 'Candidate key. Possibly the primary key.\nUnique for a account.',
  `acc_cust_id` varchar(45) DEFAULT NULL COMMENT 'the account belongs to some customer.\nThis customer id maps to him, in `customers` table.',
  `acc_branch_id` varchar(45) DEFAULT NULL COMMENT 'branch id of the account',
  `acc_type` varchar(45) DEFAULT 'savings' COMMENT 'savings or current account',
  `balance` varchar(45) DEFAULT NULL,
  `acc_start_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'when was the account opened. set by database.',
  `acc_status` varchar(45) DEFAULT 'active' COMMENT 'active or inactive or suspended ',
  PRIMARY KEY (`acc_id`,`acc_no`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Account details. A user can have multiple accounts, in diff branches.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'010','1','1','savings','1000','2018-02-02 18:22:45','active'),(2,'011','2','1','savings','2000','2018-02-02 18:26:05','active'),(3,'100','3','1','savings','3000','2018-02-02 23:20:00','active'),(4,'101','4','2','savings','4000','2018-02-02 23:20:00','active'),(5,'111','5','1','savings','5000','2018-02-03 04:48:01','active');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beneficiaries`
--

DROP TABLE IF EXISTS `beneficiaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beneficiaries` (
  `ben_id` int(11) NOT NULL AUTO_INCREMENT,
  `ben_acc_id` int(11) DEFAULT NULL COMMENT 'Foreign key, account_id of ben. maps to accounts table.\nCan do with just this. \nand mapping based on details entered by users.',
  `ben_name` varchar(45) DEFAULT NULL,
  `ben_bank_ifsc_code` varchar(45) DEFAULT NULL,
  `ben_transfer_limit` int(11) DEFAULT NULL COMMENT 'can receive only upto this amount in one transaction.',
  `ben_bank_ac_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`ben_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COMMENT='Stores the records of beneficiary of a account. \nUse case - multiple customers can have the same receiver account added as ben. In that case storing his name and other details repeatedly is not good.\nIdeally, there should have been a sender_ac_id & ben_acc_ id, which maps to account table, with code logic, mapping to correct entries, based on details which user enters. There is no need to store their details. as they already exist in customers table.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beneficiaries`
--

LOCK TABLES `beneficiaries` WRITE;
/*!40000 ALTER TABLE `beneficiaries` DISABLE KEYS */;
INSERT INTO `beneficiaries` VALUES (1,4,'user Naveen','mca17',10000,11),(7,1,'sumit','mca17',1000,111),(15,1,'Rahul Dewan','mca17',10000,1110);
/*!40000 ALTER TABLE `beneficiaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'uniquely identifies branches',
  `branch_IFSC_code` varchar(45) NOT NULL COMMENT 'IFSC code of branch. \nBranch code is last few numbers usually. so  can be used for that as well.',
  `branch_address` varchar(45) DEFAULT NULL,
  `branch_email` varchar(45) DEFAULT NULL,
  `branch_phone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Table holds all branch related details';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,'mca17','ducs','mca@ducs.com','8950636065'),(2,'msc17','ducs',NULL,NULL);
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'uniquely identifies customers.',
  `cust_user_id` int(11) NOT NULL COMMENT 'Foregn key. \nmaps customers to `user` table.',
  `CIF_number` varchar(45) DEFAULT NULL COMMENT 'Customer information file. Unique for a customer, irrespective of how many accounts they have.\nCan be used as primary key.',
  `cust_name` varchar(45) DEFAULT NULL,
  `cust_email` varchar(45) DEFAULT NULL,
  `cust_phone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='stores customer details';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,3,'001','user jatin',NULL,NULL),(2,4,'002','user rohilla',NULL,NULL),(3,1,'003','jatin',NULL,NULL),(4,2,'004','rohilla',NULL,NULL),(5,5,'005','sumit',NULL,NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `managers`
--

DROP TABLE IF EXISTS `managers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `managers` (
  `manager_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'uniquely identifies all managers',
  `manager_user_id` int(11) NOT NULL COMMENT 'This is a foreign key from `users` table.\nIt tells us about the existence of a user, before it can be a manager.',
  `manager_branch_id` int(11) NOT NULL COMMENT 'foreign key from branches table, for branch details.\nThis tells which branch does the manager manages.',
  `manager_name` varchar(45) DEFAULT NULL,
  `manager_address` varchar(45) DEFAULT NULL,
  `manager_email` varchar(45) DEFAULT NULL,
  `manager_phone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`manager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Stores manager related details';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `managers`
--

LOCK TABLES `managers` WRITE;
/*!40000 ALTER TABLE `managers` DISABLE KEYS */;
INSERT INTO `managers` VALUES (1,1,1,'jatin','idk','ok@gmai.com','999999999'),(2,2,2,'rohilla',NULL,NULL,NULL);
/*!40000 ALTER TABLE `managers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'uniquely identifies all transactions',
  `trans_sender_id` int(11) DEFAULT NULL COMMENT 'account id of the sender.\nForeign key. Maps to accounts table.',
  `trans_receiver_id` int(11) DEFAULT NULL COMMENT 'account id of the receiver.\nForeign key. Maps to accounts table.',
  `trans_amount` int(11) DEFAULT NULL COMMENT 'amount to be transferred. \nMust be less than upto target limit set for the beneficiary. But that is code logic.',
  `trans_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'exact date and time of transaction. Auto set by database.',
  PRIMARY KEY (`trans_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='Keeps records of transactions';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,1,2,500,'2018-02-02 18:28:49'),(2,1,2,100,'2018-02-03 03:11:27'),(3,10,111,67,'2018-02-03 04:53:06'),(4,10,111,67,'2018-02-03 04:53:41'),(5,10,111,67,'2018-02-03 04:54:21'),(6,10,111,99,'2018-02-03 04:55:19'),(7,10,111,99,'2018-02-03 04:57:30');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Uniquely identifies all users',
  `user_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_type` varchar(45) NOT NULL DEFAULT 'customer' COMMENT 'either customer or manager',
  `user_status` varchar(45) DEFAULT 'activated' COMMENT 'Is the netbanking for that user activated or not. This is just for showing as of now. Actual implementation in code will require rejecting login if status is deactivated.',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='This table holds the records of all users. May it be customer or manager. It is used for login verifications.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'jatin','jatin','manager','activated'),(2,'rohilla','rohilla','manager','activated'),(3,'user jatin','user_jatin','customer','activated'),(4,'user rohilla','user_rohilla','customer','activated'),(5,'sumit','user sumit','customer','activated');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ducsbank'
--

--
-- Dumping routines for database 'ducsbank'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-05 13:23:32
