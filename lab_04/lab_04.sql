CREATE DATABASE  IF NOT EXISTS `test` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `test`;
-- MySQL dump 10.13  Distrib 8.0.40, for macos14 (x86_64)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	9.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `id_feedback` int NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `text` varchar(250) DEFAULT NULL,
  `status` varchar(60) DEFAULT NULL,
  `contact` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_feedback`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,'2025-01-23','Анна','Фотограф Джон Доу сделал невероятные снимки на нашей свадьбе. Работает с душой, и результат превзошел все ожидания!','approve','5852525'),(2,'2025-01-23','Петр','Качество фотографий на высшем уровне! Очень рад, что выбрал Джона для фотосессии.','approve','929221214'),(3,'2025-01-23','Мария','Отличная работа, фотографии получились живыми и эмоциональными. Всем рекомендую!','approve','454645'),(4,'2025-01-23','Ирина','Очень талантливый фотограф! Он умел найти прекрасные ракурсы и создать атмосферу комфорта.','new','0000000000'),(5,'2025-01-23','Jiwon','정말 멋진 사진을 찍어주셨어요! 촬영 내내 편안하고 즐거운 분위기에서 작업을 했습니다. 강력히 추천합니다!','approve',''),(6,'2025-01-23','Minji','사진의 퀄리티가 최고였습니다! 덕분에 우리의 특별한 순간이 더 빛나게 되었습니다.','approve',''),(7,'2025-01-23','Seojin','촬영이 매우 자연스럽고 즐거운 분위기에서 진행되었습니다. 결과에 완전히 만족합니다!','new','');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id_message` int NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `status` varchar(60) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `contact` varchar(60) DEFAULT NULL,
  `text` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_message`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'2025-01-23','readed','Анна','5852525','Тест'),(2,'2025-01-23','readed','Евгений','5852525','аывгангуквнагкуне');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id_order` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `pref_date` date DEFAULT NULL,
  `status` varchar(60) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `contact` varchar(60) DEFAULT NULL,
  `type` varchar(60) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'2025-01-23','2025-03-07','in_progress','Анна','5852525','Портретная фотосъемка','Тест');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `photos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `portfolio_id` int NOT NULL,
  `folder_id` int NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `portfolio_id` (`portfolio_id`),
  CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photos`
--

LOCK TABLES `photos` WRITE;
/*!40000 ALTER TABLE `photos` DISABLE KEYS */;
INSERT INTO `photos` VALUES (1,1,1,'001.jpg'),(2,1,1,'002.jpg'),(3,1,1,'003.jpg'),(4,1,1,'004.jpg'),(5,1,1,'005.jpg'),(6,1,1,'006.jpg'),(7,1,1,'007.jpg'),(8,1,1,'008.jpg'),(9,1,1,'009.jpg'),(10,1,1,'010.jpg'),(11,1,1,'011.jpg'),(12,1,1,'012.jpg'),(13,1,1,'013.jpg'),(14,1,1,'014.jpg'),(15,1,1,'015.jpg'),(16,1,1,'016.jpg'),(17,1,1,'017.jpg'),(18,2,2,'001.jpg'),(19,2,2,'002.jpg'),(20,2,2,'003.jpg'),(21,2,2,'004.jpg'),(22,2,2,'005.jpg'),(23,2,2,'006.jpg'),(24,2,2,'007.jpg'),(25,2,2,'008.jpg'),(26,2,2,'009.jpg'),(27,2,2,'010.jpg'),(28,2,2,'011.jpg'),(29,2,2,'012.jpg'),(30,2,2,'013.jpg'),(31,2,2,'014.jpg'),(32,2,2,'015.jpg'),(33,2,2,'016.jpg'),(34,2,2,'017.jpg'),(35,2,2,'018.jpg'),(36,2,2,'019.jpg'),(37,2,2,'020.jpg'),(38,3,3,'001.jpg'),(39,3,3,'002.jpg'),(40,3,3,'003.jpg'),(41,3,3,'004.jpg'),(42,3,3,'005.jpg'),(43,3,3,'006.jpg'),(44,3,3,'007.jpg'),(45,3,3,'008.jpg'),(46,3,3,'009.jpg'),(47,3,3,'010.jpg'),(48,3,3,'011.jpg'),(49,3,3,'012.jpg'),(50,3,3,'013.jpg'),(51,3,3,'014.jpg'),(52,3,3,'015.jpg'),(53,3,3,'016.jpg'),(54,3,3,'017.jpg'),(55,3,3,'018.jpg'),(56,3,3,'019.jpg'),(57,3,3,'020.jpg');
/*!40000 ALTER TABLE `photos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio`
--

DROP TABLE IF EXISTS `portfolio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `likes` int DEFAULT '0',
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio`
--

LOCK TABLES `portfolio` WRITE;
/*!40000 ALTER TABLE `portfolio` DISABLE KEYS */;
INSERT INTO `portfolio` VALUES (1,'Концерт группы КОПЕНGАGЕН','06.12.2024 | Санкт-Петербург | Factory 3',0,'https://vk.com/album-25792743_307889425'),(2,'Квиз от фестиваля «Призрачный город» и China Quiz','Квиз от фестиваля «Призрачный город» и China Quiz\r\nБольшой Ресторан Цинь, Санкт-Петербург\r\n24.08.2024',0,'https://vk.com/wall-51959858_525'),(3,'Автограф-сессия Сергея Дружко 25.02.24','25 февраля в нашем магазине состоялось грандиозное побоище рептилоидов против Сергея, в котором приняло участие немало гостей. Ищите себя и сохраняйте на память!\r\nБлагодарим нашего бессменного фото-мастера Елену Мухину!\r\n#событие28ой',3,'https://vk.com/wall-51959858_521');
/*!40000 ALTER TABLE `portfolio` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-23  4:03:49
