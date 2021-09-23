<?php
/*------------------------------------------------------------------------
# "Hot Full Carousel" Joomla module
# Copyright (C) 2013 HotThemes. All Rights Reserved.
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
	$imageHeading[$loop] = $params->get('imageHeading'.$loop,'');
}

for ($loop = 1; $loop <= 20; $loop += 1) {
	$imageText[$loop] = $params->get('imageText'.$loop,'');
}

for ($loop = 1; $loop <= 20; $loop += 1) {
	$priority[$loop] = $params->get('priority'.$loop,'');
}

$pauseTime = $params->get('pauseTime','5000');
$textAreaWidth = $params->get('textAreaWidth','50');
$textAreaLeft = $params->get('textAreaLeft','24');
$textAreaCenter = $params->get('textAreaCenter','0');
$textAreaTop = $params->get('textAreaTop','80');
$textAreaPadding = $params->get('textAreaPadding','1');
$boxBgColor = $params->get('boxBgColor','255,255,255');
$boxTransparency = $params->get('boxTransparency','0.8');
$textColor = $params->get('textColor','#000000');
$headingSize = $params->get('headingSize','24');
$textSize = $params->get('textSize','12');
$navArrows = $params->get('navArrows','1');
$navDots = $params->get('navDots','1');
$uniqueid = $params->get('uniqueid','');
$fullWidth = $params->get('fullWidth','1');
$slideWidth = $params->get('slideWidth','23%');
$slideMargin = $params->get('slideMargin','2%');

require(JModuleHelper::getLayoutPath('mod_hot_swipe_carousel'));