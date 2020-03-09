DROP TABLE IF EXISTS `geoip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `geoip` (
  `ip` varchar(255) NOT NULL DEFAULT '',
  `continent_code` varchar(255) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL DEFAULT '',
  `country_code` varchar(50) NOT NULL DEFAULT '',
  `country_code3` varchar(50) NOT NULL DEFAULT '',
  `latitude` varchar(50) NOT NULL DEFAULT '',
  `longitude` varchar(50) NOT NULL DEFAULT '',
  `timezone` varchar(50) NOT NULL DEFAULT '',
  `offset` varchar(50) NOT NULL DEFAULT '',
  `asn` varchar(50) NOT NULL DEFAULT '',
  `organization` varchar(255) NOT NULL DEFAULT '',
  `date` varchar(50) NOT NULL DEFAULT '',
  `cat` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

