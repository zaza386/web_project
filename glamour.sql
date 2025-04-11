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
INSERT INTO `product` VALUES (1,'Liquid Blush','product-1.jpg','4',30.00,'Face','A luxurious, organic liquid lip tint that glides on like silk, delivering a soft matte finish with a burst of natural color. Infused with nourishing botanical oils for long-lasting hydration and comfort.','This silky, organic Liquid Blush delivers a fresh burst of color that blends seamlessly into the skin.  \nFormulated with skin-loving botanicals, it enhances your natural glow while nourishing your cheeks.  \nLightweight and buildable, it provides a radiant, dewy finish for an all-day youthful look.\n\n? Why You’ll Love It:\n\n✔ Plant-Based Pigments – Rich color derived from natural sources.\n\n✔ Skin-Friendly Formula – Infused with aloe vera and rosehip oil.\n\n✔ Dewy Finish – Perfect for a healthy, flushed look.\n\n✔ Clean Beauty – Vegan, cruelty-free, and free of synthetic additives.\n\nIdeal for daily wear or special occasions when you want that natural flush with extra skincare benefits.'),(2,'Cheeks Highlighter','product-2.jpg','7',41.00,'Face','A luxurious, organic liquid highlighter that melts into the skin for a natural, radiant glow. Its silky formula blends effortlessly, delivering a luminous finish that lasts all day. Infused with nourishing botanical oils to hydrate and enhance your skin’s natural brilliance.','Glow naturally with this organic Cheeks Highlighter, crafted for a smooth, luminous finish.  \nIts creamy texture glides effortlessly, catching the light just right on every skin tone.  \nPowered by botanical oils, it hydrates while highlighting your best features.\n\n? Why You’ll Love It:\n\n✔ Light-Reflecting Minerals – For a radiant, shimmer-free glow.\n\n✔ Smooth & Blendable – Melts into skin with no residue.\n\n✔ Skin-Nourishing – With jojoba oil and vitamin E.\n\n✔ Ethical & Clean – Sustainably made, free from harsh chemicals.\n\nPerfect for brightening cheekbones, brow bones, or the bridge of your nose with a touch of nature’s light.'),(3,'Bronzer Stick','product-3.jpg','3',38.00,'Face','A luxurious, organic bronzing stick that effortlessly glides onto the skin, providing a natural, sun-kissed glow. Its creamy texture blends smoothly, leaving a warm, radiant finish that lasts throughout the day. Enriched with nourishing botanical oils to hydrate and enhance your skin’s natural radiance, giving you a beautifully bronzed look with every application.','Bring warmth and definition with this organic Bronzer Stick, designed to sculpt and enhance your complexion.  \nIts creamy, blendable formula provides a natural sun-kissed finish without streaks.  \nPacked with nourishing oils, it’s skincare and makeup in one.\n\n? Why You’ll Love It:\n\n✔ Natural Bronze Tint – Buildable color for all skin types.\n\n✔ Easy Application – Glides on and blends effortlessly.\n\n✔ Enriched with Botanicals – Contains cocoa butter and avocado oil.\n\n✔ Eco-Minded – Zero-waste packaging and cruelty-free.\n\nWhether you’re contouring or adding glow, this bronzer is your go-to for effortless definition.'),(4,'Lip Compo -Lip Liner & Lipstick-','product-4.jpg','5',49.99,'Lips','An indulgent, organic lip liner and lipstick that smoothly glides across your lips, offering a vibrant, matte finish. Its creamy formula blends seamlessly, delivering long-lasting color and definition. Enriched with nourishing botanical oils to keep your lips hydrated, soft, and naturally plump throughout the day.','A power pair for your pout: this Lip Combo combines an ultra-precise liner with a smooth, hydrating lipstick.  \nBoth enriched with organic oils and butters, they work in harmony to define, fill, and nourish your lips.  \nFrom subtle nudes to bold reds, it’s the perfect duo for lasting elegance.\n\n? Why You’ll Love It:\n\n✔ 2-in-1 Magic – Liner + Lipstick for perfect coordination.\n\n✔ Moisturizing Formula – Infused with argan oil and shea butter.\n\n✔ Smudge-Proof Wear – Color stays fresh all day.\n\n✔ Sustainable – Eco-conscious packaging and ethical production.\n\nYour must-have set for a complete lip look with clean beauty at its core.'),(5,'Eye Shadow','product-5.jpg','6',100.00,'Eyes','Creamy organic eyeshadow that glides on like velvet. Buildable, blendable color lasts all day without creasing. Enriched with botanical oils to nourish delicate eyelids while delivering rich pigment payoff. From subtle daytime shades to dramatic evening hues - effortless beauty that cares for your skin.','This Eye Shadow blends the purity of nature with rich, long-lasting pigments for every mood.  \nFormulated with organic minerals and oils, it’s gentle on sensitive eyes while delivering vibrant color.  \nPerfect for creating soft day looks or dramatic night styles.\n\n? Why You’ll Love It:\n\n✔ Bold & Natural – Rich pigment from safe, non-toxic ingredients.\n\n✔ Non-Irritating – Ideal for delicate eye areas.\n\n✔ Easy to Blend – Smooth application and buildable texture.\n\n✔ Green Beauty – Vegan, cruelty-free, and recyclable packaging.\n\nExplore endless looks with this eye shadow made for both artistry and care.'),(6,'Brow Putty','product-6.jpg','8',26.00,'Eyes','This creamy organic brow putty glides on like silk, effortlessly shaping and filling sparse areas for feathery, hair-like strokes. Buildable and blendable, it lasts all day without flaking or fading. Enriched with nourishing botanical oils to condition brows while delivering rich, natural-looking pigment. From soft everyday definition to bold, sculpted arches—effortless beauty that cares for your skin.','Sculpt, shape, and set with this organic Brow Putty, designed to tame and define brows with a soft, natural hold.  \nIts nourishing formula conditions your brow hairs while locking them in place.  \nNo crunch, no residue – just beautifully groomed brows.\n\n? Why You’ll Love It:\n\n✔ Natural Hold – Keeps brows in place without stiffness.\n\n✔ Brow-Nourishing – Contains castor oil and vitamin B5.\n\n✔ Flexible Texture – Easy to shape and rework.\n\n✔ Ethical Choice – Cruelty-free and packaged sustainably.\n\nWhether you\'re going bold or keeping it minimal, this brow essential gives you control and care in one swipe.');
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

-- Dump completed on 2025-04-11  7:02:40
