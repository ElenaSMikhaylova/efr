<?php

// @copyright	Copyright (C) 2014 HotThemes - All rights reserved.
// @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

// no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// Path assignments
$mosConfig_absolute_path = JPATH_SITE;
$mosConfig_live_site = JURI :: base();
if(substr($mosConfig_live_site, -1)=="/") { $mosConfig_live_site = substr($mosConfig_live_site, 0, -1); }

$images_dir = $params->get('images_dir','images/sampledata/fruitshop');
$thumbs_width = $params->get('thumbsWidth', 200);
$thumbs_height = $params->get('thumbsHeight', 200);
$image_quality = $params->get('imageQuality', 80);
$thumbsMarginV = $params->get('thumbsMarginV','10');
$thumbsMarginH = $params->get('thumbsMarginH','10');
$thumbsPadding = $params->get('thumbsPadding','3');
$borderWidth = $params->get('borderWidth','1');
$borderColor = $params->get('borderColor','#cccccc');
$borderHoverColor = $params->get('borderHoverColor','#ffffff');
$backgroundColor = $params->get('backgroundColor','#eeeeee');
$backgroundHoverColor = $params->get('backgroundHoverColor','#ffffff');
$lightboxMode = $params->get('lightboxMode','f');
$overlay = $params->get('overlay','#ffffff');
$uniqueid = $params->get('uniqueid','');
$alt = $params->get('alt','');

require(JModuleHelper::getLayoutPath('mod_hot_responsive_lightbox'));
