<?php
/*
 * @version $Id: HEADER 15930 2011-10-30 15:47:55Z tsmr $
 -------------------------------------------------------------------------
 environmen plugin for GLPI
 Copyright (C) 2009-2016 by the environmen Development Team.

 https://github.com/InfotelGLPI/environmen
 -------------------------------------------------------------------------

 LICENSE

 This file is part of environmen.

 environmen is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 environmen is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with environmen. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

/**
 * @return bool
 */
function plugin_environment_install() {
   global $DB;

   include_once(GLPI_ROOT . "/plugins/environment/inc/profile.class.php");

   $update = false;
   if ($DB->tableExists("glpi_plugin_environment_profiles")
       && $DB->fieldExists("glpi_plugin_environment_profiles", "interface")) {

      $update = true;
      $DB->runFile(GLPI_ROOT . "/plugins/environment/sql/update-1.3.0.sql");
      $DB->runFile(GLPI_ROOT . "/plugins/environment/sql/update-1.4.0.sql");

   } else if ($DB->tableExists("glpi_plugin_environment_profiles")
              && $DB->fieldExists("glpi_plugin_environment_profiles", "connections")) {

      $update = true;
      $DB->runFile(GLPI_ROOT . "/plugins/environment/sql/update-1.4.0.sql");

   }

   if ($update) {
      //Do One time on 0.78
      $query_  = "SELECT *
            FROM `glpi_plugin_environment_profiles` ";
      $result_ = $DB->query($query_);
      if ($DB->numrows($result_) > 0) {

         while ($data = $DB->fetch_array($result_)) {
            $query = "UPDATE `glpi_plugin_environment_profiles`
                  SET `profiles_id` = '" . $data["id"] . "'
                  WHERE `id` = '" . $data["id"] . "';";
            $DB->query($query);

         }
      }

      $query = "ALTER TABLE `glpi_plugin_environment_profiles`
               DROP `name` ;";
      $DB->query($query);
   }

   PluginEnvironmentProfile::initProfile();
   PluginEnvironmentProfile::createFirstAccess($_SESSION['glpiactiveprofile']['id']);
   $migration = new Migration("2.0.0");
   $migration->dropTable('glpi_plugin_environment_profiles');

   $_SESSION["glpi_plugin_environment_installed"] = 1;

   return true;
}

/**
 * @return bool
 */
function plugin_environment_uninstall() {

   return true;
}
