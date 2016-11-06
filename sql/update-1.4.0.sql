ALTER TABLE `glpi_plugin_environment_profiles`
  CHANGE `ID` `id` INT(11) NOT NULL AUTO_INCREMENT,
  ADD `profiles_id` INT(11) NOT NULL DEFAULT '0'
COMMENT 'RELATION to glpi_profiles (id)',
  CHANGE `environment` `environment` CHAR(1)
COLLATE utf8_unicode_ci DEFAULT NULL,
  CHANGE `applicatifs` `appliances` CHAR(1)
COLLATE utf8_unicode_ci DEFAULT NULL,
  CHANGE `appweb` `webapplications` CHAR(1)
COLLATE utf8_unicode_ci DEFAULT NULL,
  CHANGE `certificates` `certificates` CHAR(1)
COLLATE utf8_unicode_ci DEFAULT NULL,
  CHANGE `compte` `accounts` CHAR(1)
COLLATE utf8_unicode_ci DEFAULT NULL,
  DROP `connections`,
  CHANGE `domain` `domains` CHAR(1)
COLLATE utf8_unicode_ci DEFAULT NULL,
  CHANGE `sgbd` `databases` CHAR(1)
COLLATE utf8_unicode_ci DEFAULT NULL,
  DROP `backups`,
  DROP `parametre`,
  CHANGE `badges` `badges` CHAR(1)
COLLATE utf8_unicode_ci DEFAULT NULL,
  DROP `droits`,
  ADD INDEX (`profiles_id`);