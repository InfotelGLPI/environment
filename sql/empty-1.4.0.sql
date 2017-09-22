DROP TABLE IF EXISTS `glpi_plugin_environment_profiles`;
CREATE TABLE `glpi_plugin_environment_profiles` (
  `id`              INT(11) NOT NULL        AUTO_INCREMENT,
  `profiles_id`     INT(11) NOT NULL        DEFAULT '0'
  COMMENT 'RELATION to glpi_profiles (id)',
  `environment`     CHAR(1)
                    COLLATE utf8_unicode_ci DEFAULT NULL,
  `appliances`      CHAR(1)
                    COLLATE utf8_unicode_ci DEFAULT NULL,
  `webapplications` CHAR(1)
                    COLLATE utf8_unicode_ci DEFAULT NULL,
  `accounts`        CHAR(1)
                    COLLATE utf8_unicode_ci DEFAULT NULL,
  `domains`         CHAR(1)
                    COLLATE utf8_unicode_ci DEFAULT NULL,
  `databases`       CHAR(1)
                    COLLATE utf8_unicode_ci DEFAULT NULL,
  `badges`          CHAR(1)
                    COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_id` (`profiles_id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci;