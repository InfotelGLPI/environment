ALTER TABLE `glpi_plugin_environment_profiles`
  ADD `backups` CHAR(1) DEFAULT NULL,
  ADD `parametre` CHAR(1) DEFAULT NULL,
  ADD `badges` CHAR(1) DEFAULT NULL,
  ADD `droits` CHAR(1) DEFAULT NULL,
  DROP COLUMN `interface`,
  DROP COLUMN `is_default`;