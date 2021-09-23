<?php
/*------------------------------------------------------------------------
# "Hot Swipe Carousel" Joomla module
# Copyright (C) 2015 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access'); // no direct access

// get the document object
$doc = JFactory::getDocument();

// load jQuery
JHtml::_('jquery.framework');

// load scripts
$doc->addScript($mosConfig_live_site.'/modules/mod_hot_swipe_carousel/js/flickity.pkgd.min.js');

// add your stylesheet
$doc->addStyleSheet( 'modules/mod_hot_swipe_carousel/tmpl/style.css' );

// style declaration
$doc->addStyleDeclaration( '

.hot_swipe_carousel_slides'.$uniqueid.' .contents {
    top: '.$textAreaTop.'px;
    left: '.$textAreaLeft.'%;
    width: '.$textAreaWidth.'%;
    color: '.$textColor.';
    padding: '.$textAreaPadding.'%;
    background: rgba('.$boxBgColor.','.$boxTransparency.');
    font-size:'.$textSize.'px;
}

.hot_swipe_carousel_slides'.$uniqueid.' .contents h2 {
    font-size:'.$headingSize.'px;
}

.hot_swipe_carousel_slides'.$uniqueid.' img {
    max-width: 99999px;
    width: 100%;
}

.hot_swipe_carousel_slides'.$uniqueid.' .contents {
    position: absolute;
}

' );

if($fullWidth) {

$doc->addStyleDeclaration( '

.hot_swipe_carousel_slides'.$uniqueid.' .gallery-cell {
    width: 100%;
}

' );

}else{

$doc->addStyleDeclaration( '

.hot_swipe_carousel_slides'.$uniqueid.' .gallery-cell {
    width: '.$slideWidth.';
    margin-right: '.$slideMargin.';
}

' );

}

if($textAreaCenter) {

$doc->addStyleDeclaration( '

.hot_swipe_carousel_slides'.$uniqueid.' .contents {
    left:0;
    right:0;
    margin-left:auto;
    margin-right:auto;
}

' );

}

?>

<div class="hot_swipe_carousel_slides<?php echo $uniqueid; ?>">
    <?php
        for ($loop = 1; $loop <= 20; $loop += 1) {
            if ($enableSlide[$loop]=="true") { ?>
            <div class="gallery-cell">
                <img src="<?php echo $mosConfig_live_site.'/'.$image[$loop]; ?>" alt="<?php echo $imageAlt[$loop]; ?>" />
                <?php if ($imageHeading[$loop] || $imageText[$loop]) { ?>
                <div class="contents">
                    <div class="svg-container">
                        <svg width='570' height='200' viewBox="0 0 100 100" preserveAspectRatio="none">
                            <polygon points="5,0 5,90 100,90 100,10" style="fill:#000;opacity:0.2" />
                            <polygon points="5,10 0,100 95,85 100,10" style="fill:#000;opacity:0.4" />
                        </svg>
                    </div>
                    <?php if ($imageHeading[$loop]) { ?>
                    <h2><?php echo $imageHeading[$loop]; ?></h2>
                    <?php } ?>
                    <?php echo $imageText[$loop]; ?> 
                </div>
                <?php } ?>
            </div>
        <?php }
        } ?>
</div>
<script>
    jQuery(document).ready(function(){
        jQuery('.hot_swipe_carousel_slides<?php echo $uniqueid; ?>').flickity({
            // options
            cellAlign: 'left',
            contain: true,
            freeScroll: false,
            wrapAround: true,
            prevNextButtons: <?php if($navArrows) { echo "true"; }else{ echo "false"; } ?>,
            pageDots: <?php if($navDots) { echo "true"; }else{ echo "false"; } ?>,
            autoPlay: <?php echo $pauseTime; ?>,
            imagesLoaded: true<?php if ($fullWidth == 0) { ?>,
            "percentPosition": false<?php } ?>
        });
    });
</script>