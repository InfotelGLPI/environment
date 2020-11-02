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

if (!defined('GLPI_ROOT')) {
   die("Sorry. You can't access directly to this file");
}

/**
 * Class PluginEnvironmentDisplay
 */
class PluginEnvironmentDisplay extends CommonGLPI {

   static $rightname = "plugin_environment";
   static $plugins   = ['accounts', 'databases', 'badges'];

   /**
    * @param int $nb
    *
    * @return translated
    */
   static function getTypeName($nb = 0) {

      return __('Environment', 'environment');
   }

   /**
    * @return array
    */
   static function getMenuContent() {
      global $CFG_GLPI;

      $menu          = [];
      $menu['title'] = self::getMenuName();
      $menu['page']  = "/plugins/environment/front/display.php";

      $plugs = self::$plugins;
      foreach ($plugs as $plug) {
         $plugin = new Plugin();
         if ($plugin->isActivated($plug)) {
            if (Session::haveRight("plugin_" . $plug, READ)) {
               $table    = "glpi_plugin_" . $plug . "_" . $plug;
               $dbu      = new DbUtils();
               $itemtype = $dbu->getItemTypeForTable($table);

               if (!class_exists($itemtype)) {
                  continue;
               }
               $item = new $itemtype();

               $menu['options'][$plug]['title']           = $item::getTypeName();
               $menu['options'][$plug]['page']            = $item::getSearchURL(false);
               $menu['options'][$plug]['links']['search'] = $item::getSearchURL(false);
               if (Session::haveRight("plugin_" . $plug, CREATE)) {
                  $menu['options'][$plug]['links']['add'] = $item::getFormURL(false);
               }
            }

            if ($plug == "accounts") {
               $image                                   = "<img src='" . $CFG_GLPI["root_doc"] . "/plugins/accounts/pics/cadenas.png' title='" .
                                                          _n('Encryption key', 'Encryption keys', 2, 'accounts') . "' alt='" .
                                                          _n('Encryption key', 'Encryption keys', 2, 'accounts') . "'>";
               $menu['options'][$plug]['links'][$image] = PluginAccountsHash::getSearchURL(false);

               $menu['options']['hash']['title']           = PluginAccountsHash::getTypeName(2);
               $menu['options']['hash']['page']            = PluginAccountsHash::getSearchURL(false);
               $menu['options']['hash']['links']['search'] = PluginAccountsHash::getSearchURL(false);
               $menu['options']['hash']['links'][$image]   = PluginAccountsHash::getSearchURL(false);;

               if (PluginAccountsHash::canCreate()) {
                  $menu['options']['hash']['links']['add'] = PluginAccountsHash::getFormURL(false);
               }

            }
         }
      }

      $menu['icon'] = self::getIcon();

      return $menu;
   }

   static function getIcon() {
      return "fas fa-globe";
   }

   static function removeRightsFromSession() {
      if (isset($_SESSION['glpimenu']['assets']['types']['PluginEnvironmentDisplay'])) {
         unset($_SESSION['glpimenu']['assets']['types']['PluginEnvironmentDisplay']);
      }
      if (isset($_SESSION['glpimenu']['assets']['content']['pluginenvironmentdisplay'])) {
         unset($_SESSION['glpimenu']['assets']['content']['pluginenvironmentdisplay']);
      }
   }


   /**
    * @param array $options
    *
    * @return array
    */
   function defineTabs($options = []) {
      $ong = [];
      $this->addStandardTab(__CLASS__, $ong, $options);
      return $ong;
   }


   /**
    * @param CommonGLPI $item
    * @param int        $withtemplate
    *
    * @return array|string
    */
   function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {
      $tabs = [];
      if ($item->getType() == __CLASS__) {

         $plugs = self::$plugins;
         $nb    = 1;
         foreach ($plugs as $plug) {
            $plugin = new Plugin();
            if ($plugin->isActivated($plug)) {
               $table    = "glpi_plugin_" . $plug . "_" . $plug;
               $dbu      = new DbUtils();
               $itemtype = $dbu->getItemTypeForTable($table);

               if (!class_exists($itemtype)) {
                  continue;
               }
               $item      = new $itemtype();
               $tabs[$nb] = $item::getTypeName(2);
            }
            $nb++;
         }
         return $tabs;
      }
      return '';
   }


   /**
    * @param CommonGLPI $item
    * @param int        $tabnum
    * @param int        $withtemplate
    *
    * @return bool
    */
   static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0) {

      $plugs = self::$plugins;
      $tab   = [];
      $nb    = 1;
      foreach ($plugs as $plug) {
         $plugin   = new Plugin();
         $function = "show$plug";
         if ($plugin->isActivated($plug)) {
            $tab[$nb] = $function;
         }
         $nb++;
      }

      $funct = $tab[$tabnum];
      if ($funct) {
         self::$funct();
      }
      return true;
   }
}
