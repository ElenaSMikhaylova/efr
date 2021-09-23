<?php
/*------------------------------------------------------------------------
# "Hot Maps" Joomla module
# Copyright (C) 2011 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// Path assignments
$mosConfig_absolute_path = JPATH_SITE;
$mosConfig_live_site = JURI :: base();
if(substr($mosConfig_live_site, -1)=="/") { $mosConfig_live_site = substr($mosConfig_live_site, 0, -1); }
 
// get parameters from the module's configuration
$mapid = $params->get('mapid','');
$apikey = $params->get('apikey','');
$module_width = $params->get('module_width','257');
$module_width_unit = $params->get('module_width_unit','px');
$module_height = $params->get('module_height','172');
$border = $params->get('border','none');
$address = $params->get('address','');
$satellite = $params->get('satellite','1');
$pre_text = $params->get('pre_text','');
$post_text = $params->get('post_text','');
$hue = $params->get('hue','');
$saturation = $params->get('saturation','0');
$lightness = $params->get('lightness','0');
$gamma = $params->get('gamma','1');
$visibility = $params->get('visibility','on');
$labels = $params->get('labels','on');
$water = $params->get('water','');
$zoom = $params->get('zoom','16');
$disablezoom = $params->get('disablezoom','false');
$disableui = $params->get('disableui','true');
$defaultmarker = $params->get('defaultmarker','1');
$mapoffsetx = $params->get('mapoffsetx','0');
$mapoffsety = $params->get('mapoffsety','0');

for ($loop = 1; $loop <= 5; $loop += 1) {
$markerlat[$loop] = $params->get('markerlat'.$loop,'');
}

for ($loop = 1; $loop <= 5; $loop += 1) {
$markerlng[$loop] = $params->get('markerlng'.$loop,'');
}

for ($loop = 1; $loop <= 5; $loop += 1) {
$markertitle[$loop] = $params->get('markertitle'.$loop,'');
}

require(JModuleHelper::getLayoutPath('mod_hot_maps'));
