DROP TABLE IF EXISTS `glpi_plugin_environment_profiles`;
CREATE TABLE `glpi_plugin_environment_profiles` (
  `ID`           INT(11)     NOT NULL AUTO_INCREMENT,
  `name`         VARCHAR(255)         DEFAULT NULL,
  `interface`    VARCHAR(50) NOT NULL DEFAULT 'environment',
  `is_default`   SMALLINT(6) NOT NULL DEFAULT '0',
  `environment`  CHAR(1)              DEFAULT NULL,
  `applicatifs`  CHAR(1)              DEFAULT NULL,
  `appweb`       CHAR(1)              DEFAULT NULL,
  `certificates` CHAR(1)              DEFAULT NULL,
  `compte`       CHAR(1)              DEFAULT NULL,
  `connections`  CHAR(1)              DEFAULT NULL,
  `domain`       CHAR(1)              DEFAULT NULL,
  `sgbd`         CHAR(1)              DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `interface` (`interface`)
)
  ENGINE = MyISAM;