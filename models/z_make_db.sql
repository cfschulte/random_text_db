--
--  Generic 
-- 
DROP TABLE IF EXISTS `generic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic` (
  `id`           mediumint NOT NULL AUTO_INCREMENT,
  `descriptor`   varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOAD DATA LOCAL INFILE 'generic.txt' INTO TABLE generic FIELDS TERMINATED BY '\t' LINES TERMINATED BY '\n' (id,descriptor);



--
--  text_block 
-- 
DROP TABLE IF EXISTS `text_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `text_block` (
  `id`           mediumint NOT NULL AUTO_INCREMENT,
  `text_source`  mediumint DEFAULT NULL,
  `char_count`   int DEFAULT NULL,
  `text_block`   TEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
--  text_source 
-- 
DROP TABLE IF EXISTS `text_source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `text_source` (
  `id`           mediumint NOT NULL AUTO_INCREMENT,
  `descriptor`   varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOAD DATA LOCAL INFILE 'source.txt' INTO TABLE source FIELDS TERMINATED BY '\t' LINES TERMINATED BY '\n' (id,descriptor);

--
--  saved_site 
-- 
DROP TABLE IF EXISTS `saved_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saved_site` (
  `id`             mediumint NOT NULL AUTO_INCREMENT,
  `site_category`  mediumint DEFAULT NULL,
  `url`            varchar(256) NOT NULL,
  `title`          varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
--  site_category 
-- 
DROP TABLE IF EXISTS `site_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_category` (
  `id`            mediumint NOT NULL AUTO_INCREMENT,
  `display_order` int DEFAULT NULL,
  `descriptor`    varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
