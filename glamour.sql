CREATE DATABASE  IF NOT EXISTS `glamour` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `glamour`;
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: glamour
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `idAdmin` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Zainab','za12','ZA12','za12@iau.edu.sa'),(2,'Zinab','az12','AZ12','az12@iau.edu.sa');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `idProduct` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `picture` varchar(45) DEFAULT NULL,
  `stock` varchar(45) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `categories` varchar(45) NOT NULL,
  `description1` varchar(1000) DEFAULT NULL,
  `description2` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idProduct`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Liquid Blush','product-1.jpg','4',30.00,'Face','A luxurious, organic liquid lip tint that glides on like silk, delivering a soft matte finish with a burst of natural color. Infused with nourishing botanical oils for long-lasting hydration and comfort.','Rosé Luxe Velvet Tint is the perfect fusion of elegance and clean beauty. Made with 100% organic ingredients, this lightweight lip tint provides a velvety-smooth application with a rich, pigmented finish. The formula is enriched with rosehip oil, shea butter, and vitamin E, ensuring your lips stay hydrated and plump throughout the day.'),(2,'Cheeks Highlighter','product-2.jpg','7',41.00,'Face','A luxurious, organic liquid highlighter that melts into the skin for a natural, radiant glow. Its silky formula blends effortlessly, delivering a luminous finish that lasts all day. Infused with nourishing botanical oils to hydrate and enhance your skin’s natural brilliance.','Cheeks Highlighter is the perfect fusion of radiance and clean beauty. Made with 100% organic ingredients, this lightweight liquid highlighter blends seamlessly into the skin, delivering a luminous, dewy glow that looks naturally lit-from-within. The formula is enriched with jojoba oil, aloe vera, and vitamin E, keeping your skin hydrated, smooth, and glowing all day long.'),(3,'Bronzer Stick','product-3.jpg','3',38.00,'Face','A luxurious, organic bronzing stick that effortlessly glides onto the skin, providing a natural, sun-kissed glow. Its creamy texture blends smoothly, leaving a warm, radiant finish that lasts throughout the day. Enriched with nourishing botanical oils to hydrate and enhance your skin’s natural radiance, giving you a beautifully bronzed look with every application.','Bronze Stick is your go-to for a natural, sun-kissed glow with a touch of clean beauty. Made with 100% organic ingredients, this easy-to-apply bronzing stick glides on smoothly, offering a buildable, warm finish that blends seamlessly into your skin. Formulated with nourishing botanical oils, including jojoba and vitamin E, it keeps your skin hydrated, soft, and glowing with a sunlit radiance all day long.'),(4,'Lip Compo -Lip Liner & Lipstick-','product-4.jpg','5',49.99,'Lips','An indulgent, organic lip liner and lipstick that smoothly glides across your lips, offering a vibrant, matte finish. Its creamy formula blends seamlessly, delivering long-lasting color and definition. Enriched with nourishing botanical oils to keep your lips hydrated, soft, and naturally plump throughout the day.','Lip Compo is your perfect duo for vibrant, defined lips with a touch of clean beauty. Crafted with 100% organic ingredients, this smooth-gliding lip liner and lipstick combo delivers rich, long-lasting color with a velvety finish. Infused with nourishing oils like argan and coconut oil, it keeps your lips soft, smooth, and hydrated all day long.'),(5,'Eye Shadow','product-5.jpg','6',100.00,'Eyes','Creamy organic eyeshadow that glides on like velvet. Buildable, blendable color lasts all day without creasing. Enriched with botanical oils to nourish delicate eyelids while delivering rich pigment payoff. From subtle daytime shades to dramatic evening hues - effortless beauty that cares for your skin.','Eye Shadow is your perfect pair for mesmerizing eyes with clean, organic beauty. Crafted with 100% natural ingredients, this velvety eyeshadow duo glides on effortlessly, delivering rich, blendable color with a matte and shimmer finish. Infused with soothing botanical oils like jojoba and chamomile, it keeps delicate eyelids hydrated while ensuring crease-proof wear all day.'),(6,'Brow Putty','product-6.jpg','8',26.00,'Eyes','This creamy organic brow putty glides on like silk, effortlessly shaping and filling sparse areas for feathery, hair-like strokes. Buildable and blendable, it lasts all day without flaking or fading. Enriched with nourishing botanical oils to condition brows while delivering rich, natural-looking pigment. From soft everyday definition to bold, sculpted arches—effortless beauty that cares for your skin.','Brow Putty – Your secret to naturally full, perfectly groomed brows with clean beauty. This innovative organic formula combines the precision of a pencil with the natural finish of powder. The creamy wax-based putty melts onto skin and hairs, creating feather-light strokes that look like your own brows – only better.');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-11  4:01:45
