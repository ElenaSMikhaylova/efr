<?php
/*------------------------------------------------------------------------
# "Hot Slicebox" Joomla module
# Copyright (C) 2014 HotThemes. All Rights Reserved.
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
$linkNewWindow = $params->get('linkNewWindow','0');

for ($loop = 1; $loop <= 20; $loop += 1) {
$enableSlide[$loop] = $params->get('enableSlide'.$loop,'');
}

for ($loop = 1; $loop <= 20; $loop += 1) {
$image[$loop] = $params->get('image'.$loop,'');
}

for ($loop = 1; $loop <= 20; $loop += 1) {
$imageAlt[$loop] = $params->get('imageAlt'.$loop,'');
}

for ($loop = 1; $loop <= 20; $loop += 1) {
$imageText[$loop] = $params->get('imageText'.$loop,'');
}

for ($loop = 1; $loop <= 20; $loop += 1) {
$imageLinkArray[$loop] = $params->get('image'.$loop.'link','');
}

for ($loop = 1; $loop <= 20; $loop += 1) {
$imageTitleArray[$loop] = $params->get('image'.$loop.'title','');
}

$boxBgColor = $params->get('boxBgColor','255,255,255');
$boxTransparency = $params->get('boxTransparency','0.8');
$textColor = $params->get('textColor','#000000');
$textSize = $params->get('textSize','12');
$navArrows = $params->get('navArrows','1');
$navDots = $params->get('navDots','1');
$autoPlay = $params->get('autoPlay','1');
$animSpeed = $params->get('animSpeed','600');
$pauseTime = $params->get('pauseTime','5000');
$orientation = $params->get('orientation','v');
$perspective = $params->get('perspective','1200');
$cuboidsCount = $params->get('cuboidsCount','5');
$cuboidsRandom = $params->get('cuboidsRandom','0');
$maxCuboidsCount = $params->get('maxCuboidsCount','5');
$disperseFactor = $params->get('disperseFactor','10');
$hiddenSidesColor = $params->get('hiddenSidesColor','#222222');
$sequentialFactor = $params->get('sequentialFactor','150');

require(JModuleHelper::getLayoutPath('mod_hot_slicebox'));