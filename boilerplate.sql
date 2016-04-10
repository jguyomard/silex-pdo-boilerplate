-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
-- ------------------------------------------------------

--
-- Table structure for table `article`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_title` varchar(250) NOT NULL,
  `article_create_at` datetime NOT NULL,
  `article_description` text NOT NULL,
  PRIMARY KEY (`article_id`),
  KEY `article_create_at` (`article_create_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

INSERT INTO `article` VALUES (1,'Foo','2014-10-06 09:42:00','Hi Foo!'),(2,'Bar','2014-10-06 09:42:01','Ho Bar!');

-- Dump completed on 2015-06-12 19:59:10
