-- MySQL dump 10.13  Distrib 8.0.43, for Linux (x86_64)
--
-- Host: localhost    Database: yiishopping_db
-- ------------------------------------------------------
-- Server version	8.0.43-0ubuntu0.22.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-cart-user_id` (`user_id`),
  CONSTRAINT `fk-cart-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'MOBILE PHONES','latest mobile phones available in the market',1759745018,1759745018,'68e393fab4d51.jpg'),(2,'LAPTOPS','latest laptops available in the market',1759745056,1759745433,'68e3959917171.jpg'),(3,'HEAD PHONES','latest headphones available in the market',1759745097,1759745109,'68e39455b951f.webp');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1759290298),('m130524_201442_init',1759290308),('m190124_110200_add_verification_token_column_to_user_table',1759290308),('m251001_034702_add_role_to_user_table',1759290665),('m251001_050524_create_category_table',1759295357),('m251001_050616_create_product_table',1759295357),('m251001_050726_create_order_table',1759295357),('m251001_050820_create_order_item_table',1759295358),('m251001_050951_create_cart_table',1759295440);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-order-user_id` (`user_id`),
  CONSTRAINT `fk-order-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-order_item-order_id` (`order_id`),
  KEY `fk-order_item-product_id` (`product_id`),
  CONSTRAINT `fk-order_item-order_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-order_item-product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_item`
--

LOCK TABLES `order_item` WRITE;
/*!40000 ALTER TABLE `order_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-product-category_id` (`category_id`),
  CONSTRAINT `fk-product-category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,1,'i phone 13','',55000.00,'68e3a66be2d54.jpg',2025,2025),(2,1,'i phone 14','',65000.00,'68e3a1f39a101.jpg',2025,2025),(3,1,'i phone 15','',75000.00,'68e3a4d69211e.jpg',2025,2025),(4,1,'i phone 16','',89000.00,'68e3a50bea4a7.webp',2025,2025),(5,1,'i phone 17','',120000.00,'68e3a56adaaf4.webp',2025,2025),(6,2,'MacBook Air M4','',99900.00,'68e3a7bd9bc4e.webp',2025,2025),(7,2,'MacBook Air M2','',64999.00,'68e3a883944a4.webp',2025,2025),(8,2,'Mac Book Pro','',239990.00,'68e3a8d85c6bc.webp',2025,2025),(9,3,'Apple Air Pods Max','',59900.00,'68e3a930db27d.webp',2025,2025),(10,3,'Apple Air Pods Max','',115003.00,'68e3a9714e5e2.webp',2025,2025),(11,3,'Apple Air Pods Max','',112334.00,'68e3a9a9ae3b1.webp',2025,2025);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','82681fa11207f67bf004a8bc5921397e','$2y$10$wyl8hZ1ERixN03NLB1l4/u9lMG.gq/jnN2YNkSmCto54p6vuW0TD2',NULL,'admin@example.com',10,1759290746,1759292959,NULL,'admin'),(4,'john','J4LobVkjIKZx6hT1daodyVzK5j3dPIBG','$2y$13$2rGRcpX/bUNgcP0iqpu.1e2o/rri5dfo/Xv5DNummIWunJZrPEbGm',NULL,'john@example.com',10,1759318328,1759318328,NULL,'user'),(5,'jane','z4OlqzOk_QceDXVTr9G1K3kXMbRqaiR-','$2y$13$0Ov3HepQBpp///hep3IpF.jJ4VMpBGT8OpITqsWhUItqJKtAwMJsq',NULL,'jane@example.com',10,1759319319,1759319319,NULL,'user'),(6,'mike','zUJoaJ_06JitBJCXwhRT51GxcRtflNFq','$2y$13$Tg8wdrXeUVohLdoL5GjdZeUhxpYWLzgyJg79IuVFWku.fVwVrUyQ2',NULL,'mike@example.com',10,1759319354,1759319354,NULL,'user'),(7,'lisa','6bbiYaPNYYtrJg67QE-TudxQ3EjK7pRD','$2y$13$lZBvZQfceENmxwps/UsVcOwCe/WII3PmzD3kvDNVnMkcI5uaJDWK2',NULL,'lisa@example.com',10,1759319414,1759319414,NULL,'user'),(8,'tom','MIOe4g19O7tMwR5CIePHOq4CJDJPY5MN','$2y$13$ikrsGiRo7qxCTDfrHKylo.9dnGiZg2PsYXwTJmw/cvO4ghEjRQLJm',NULL,'tom@example.com',10,1759319437,1759319437,NULL,'user'),(9,'amal','3B2Wvs_XhWGQgLQwx8gSokmmtsW1HaNr','$2y$13$GsLnAgC4sDgWJvjAhKWEZOBUDhQe3jcVgfdlVgS/gDuBP5IBQs5ES','5x_fZEi2Y9ZTH8ElzTBF3AprN0lnvdic_1759476548','amal@gmail.com',10,1759463385,1759476548,NULL,'user'),(10,'vishak','AwiYU7JkUbJJ3ooVrAP6yxUbWt7JC4WM','$2y$13$tfuTrnAs5v.66yXSlKXHfunhQNtvIf/zp./WDVJXOEFhddJPJOIn.',NULL,'vishak@gmail.com',10,1759463668,1759463668,'hrNkM2Jy8nsbU5kr3XVb7GQIvJ6MPWep_1759463668','user');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-06 17:14:27
