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

include('../../../inc/includes.php');

Html::header(PluginEnvironmentDisplay::getTypeName(2), '', "assets", "pluginenvironmentdisplay");

if (Session::haveRight("plugin_environment", READ)
    || Session::haveRight("config", UPDATE)
) {

   $env = new PluginEnvironmentDisplay();
   $env->display();

} else {
   Html::displayRightError();
}

Html::footer();
