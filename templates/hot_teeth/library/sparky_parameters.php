<?php
/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2015 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/
$h1FontHot = json_decode(str_replace("\\","",$this->params->get("h1FontHot", "{fontFamily:'Arial, Helvetica, sans-serif', fontWeight: 'normal', fontStyle:'normal'}")),"true");
$h1Family = $h1FontHot['fontFamily'];
$h1Weight = $h1FontHot['fontWeight'];
$h1Style = $h1FontHot['fontStyle'];
$h1Color = $this->params->get("h1Color", "#333333");
$h1Size = $this->params->get("h1Size", "60");
$h1Align = $this->params->get("h1Align", "left");
$h1Underline = $this->params->get("h1Underline", "0");

$h2FontHot = json_decode(str_replace("\\","",$this->params->get("h2FontHot", "{fontFamily:'Arial, Helvetica, sans-serif', fontWeight: 'normal', fontStyle:'normal'}")),"true");
$h2Family = $h2FontHot['fontFamily'];
$h2Weight = $h2FontHot['fontWeight'];
$h2Style = $h2FontHot['fontStyle'];
$h2Color = $this->params->get("h2Color", "#333333");
$h2Size = $this->params->get("h2Size", "32");
$h2Align = $this->params->get("h2Align", "left");
$h2Underline = $this->params->get("h2Underline", "0");

$h3FontHot = json_decode(str_replace("\\","",$this->params->get("h3FontHot", "{fontFamily:'Arial, Helvetica, sans-serif', fontWeight: 'normal', fontStyle:'normal'}")),"true");
$h3Family = $h3FontHot['fontFamily'];
$h3Weight = $h3FontHot['fontWeight'];
$h3Style = $h3FontHot['fontStyle'];
$h3Color = $this->params->get("h3Color", "#333333");
$h3Size = $this->params->get("h3Size", "18");
$h3Align = $this->params->get("h3Align", "left");
$h3Underline = $this->params->get("h3Underline", "0");

$h4FontHot = json_decode(str_replace("\\","",$this->params->get("h4FontHot", "{fontFamily:'Arial, Helvetica, sans-serif', fontWeight: 'normal', fontStyle:'normal'}")),"true");
$h4Family = $h4FontHot['fontFamily'];
$h4Weight = $h4FontHot['fontWeight'];
$h4Style = $h4FontHot['fontStyle'];
$h4Color = $this->params->get("h4Color", "#333333");
$h4Size = $this->params->get("h4Size", "14");
$h4Align = $this->params->get("h4Align", "left");
$h4Underline = $this->params->get("h4Underline", "0");

$pFontHot = json_decode(str_replace("\\","",$this->params->get("pFontHot", "{fontFamily:'Arial, Helvetica, sans-serif', fontWeight: 'normal', fontStyle:'normal'}")),"true");
$pFamily = $pFontHot['fontFamily'];
$pWeight = $pFontHot['fontWeight'];
$pStyle = $pFontHot['fontStyle'];
$pColor = $this->params->get("pColor", "#333333");
$pSize = $this->params->get("pSize", "14");
$pAlign = $this->params->get("pAlign", "left");

$linksColor = $this->params->get("linksColor", "#8B1E20");
$linksHoverColor = $this->params->get("linksHoverColor", "#333333");
$linksWeight = $this->params->get("linksWeight", "normal");
$linksStyle = $this->params->get("linksStyle", "normal");
$linksUnderline = $this->params->get("linksUnderline", "0");
$linksUnderlineHover = $this->params->get("linksUnderlineHover", "0");

$randomizeCssLink = $this->params->get("randomizeCssLink", "0");

// FEATURES  ------------------------------------------------------------

$scrollToTopSwitch = $this->params->get("scrollToTopSwitch", "0");
$scrollToTopImageFile = $this->params->get("scrollToTopImageFile", "top.png");
$scrollToTopPosition = $this->params->get("scrollToTopPosition", "bottom_right");

$equalHeightClasses = $this->params->get("equalHeightClasses", "");

// BODY BACKGROUND  -----------------------------------------------------

$bodyBgColor = $this->params->get("bodyBgColor", "#FFFFFF");
$bodyBgImageSwitch = $this->params->get("bodyBgImageSwitch", "0");
$bodyBgImageFile = $this->params->get("bodyBgImageFile", "");
$bodyBgImageVerticalAlign = $this->params->get("bodyBgImageVerticalAlign", "top");
$bodyBgImageHorizontalAlign = $this->params->get("bodyBgImageHorizontalAlign", "center");
$bodyBgImageRepeat = $this->params->get("bodyBgImageRepeat", "repeat");
$bodyBgImageFixedSwitch = $this->params->get("bodyBgImageFixedSwitch", "");
$containerBgColor = $this->params->get("containerBgColor", "transparent");

// LOGO  ----------------------------------------------------------------

$logoImageSwitch = $this->params->get("logoImageSwitch", "0");
$logoImageFile = $this->params->get("logoImageFile", "");
$logoImageAlt = $this->params->get("logoImageAlt", "");

$logoFontHot = json_decode(str_replace("\\","",$this->params->get("logoFontHot", "{fontFamily:'Arial, Helvetica, sans-serif', fontWeight: 'normal', fontStyle:'normal'}")),"true");
$logoFamily = $logoFontHot['fontFamily'];
$logoWeight = $logoFontHot['fontWeight'];
$logoStyle = $logoFontHot['fontStyle'];
$logoText = $this->params->get("logoText", "Sparky");
$logoColor = $this->params->get("logoColor", "#000000");
$logoSize = $this->params->get("logoSize", "40");
$logoAlign = $this->params->get("logoAlign", "left");

$sloganFontHot = json_decode(str_replace("\\","",$this->params->get("sloganFontHot", "{fontFamily:'Arial, Helvetica, sans-serif', fontWeight: 'normal', fontStyle:'normal'}")),"true");
$sloganFamily = $sloganFontHot['fontFamily'];
$sloganWeight = $sloganFontHot['fontWeight'];
$sloganStyle = $sloganFontHot['fontStyle'];
$sloganText = $this->params->get("sloganText", "");
$sloganColor = $this->params->get("sloganColor", "#000000");
$sloganSize = $this->params->get("sloganSize", "14");
$sloganAlign = $this->params->get("sloganAlign", "left");

$copyright = $this->params->get("copyright", "Your Company");

// TOP PANEL  ----------------------------------------------------------------

$topPanelSwitch = $this->params->get("topPanelSwitch", "0");
$topPanelOpen = $this->params->get("topPanelOpen", "Open");
$topPanelClose = $this->params->get("topPanelClose", "Close");
$topPanelButtonWidth = $this->params->get("topPanelButtonWidth", "75");
$topPanelButtonHeight = $this->params->get("topPanelButtonHeight", "18");
$topPanelButtonBgColor = $this->params->get("topPanelButtonBgColor", "#000000");
$topPanelButtonTextColor = $this->params->get("topPanelButtonTextColor", "#FFFFFF");
$topPanelButtonTextSize = $this->params->get("topPanelButtonTextSize", "10");
$topPanelButtonBorderColor = $this->params->get("topPanelButtonBorderColor", "#666666");
$topPanelButtonBorderRadius = $this->params->get("topPanelButtonBorderRadius", "5");
$topPanelBgColor = $this->params->get("topPanelBgColor", "#000000");
$topPanelH3Color = $this->params->get("topPanelH3Color", "#CCCCCC");
$topPanelTextColor = $this->params->get("topPanelTextColor", "#CCCCCC");

// FONT RESIZE  --------------------------------------------------------------

$fontResizeMinus = $this->params->get("fontResizeMinus", "A-");
$fontResizeReset = $this->params->get("fontResizeReset", "Reset");
$fontResizePlus = $this->params->get("fontResizePlus", "A+");

// ANALYTICS  ----------------------------------------------------------------

$analyticsSwitch = $this->params->get("analyticsSwitch", "0");
$analyticsAccount = $this->params->get("analyticsAccount", "");

// GOOGLE FONTS  -------------------------------------------------------------

$googleWebFonts = $this->params->get("googleWebFonts", "");

// RESPONSIVENESS  -----------------------------------------------------------

$enableResponsive = $this->params->get("enableResponsive", "1");
$enableResponsiveMenu = $this->params->get("enableResponsiveMenu", "1");
$responsiveMenuTriggerValue = $this->params->get("responsiveMenuTriggerValue", "980");
$menuIcon = $this->params->get("menuIcon", "");
$menuIconImage = $this->params->get("menuIconImage", "");
$enableMenuIconImage = $this->params->get("enableMenuIconImage", "0");

// PARALLAX SCROLL  -----------------------------------------------------------

$parallaxScroll = $this->params->get("parallaxScroll", "0");
$parallaxScrollClasses = $this->params->get("parallaxScrollClasses", "");
$parallaxScrollSpeed = $this->params->get("parallaxScrollSpeed", "2");

// IMAGE ANIMATION  -----------------------------------------------------------

$imageAnimation = $this->params->get("imageAnimation", "0");

// SCRIPTS LOADING

$lazyLoad = $this->params->get("lazyLoad", "0");

?>