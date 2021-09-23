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
    opacity:0;
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
        for ($priority_loop = 1; $priority_loop <= 20; $priority_loop += 1) {
            for ($loop = 1; $loop <= 20; $loop += 1) {
                if ($enableSlide[$loop] == "true" && $priority[$loop] == $priority_loop) {

                    // let's check if retina slide image exists
                    $enable_retina_image = false;
                    $slide_name_array = [];
                    $slide_name_parts = 0;
                    $slide_name_without_extension = "";
                    $slide_name_part = "";
                    $slide_name_without_extension = "";
                    $slide_retina_image = "";

                    $slide_name_array = explode(".", $image[$loop]);
                    $slide_name_parts = count($slide_name_array);

                    foreach ($slide_name_array as $slide_name_part) {

                        if($slide_name_part != end($slide_name_array)) {
                            $slide_name_without_extension = $slide_name_without_extension . $slide_name_part . ".";
                        }

                    }

                    // remove the last dot
                    $slide_name_without_extension = rtrim($slide_name_without_extension, ".");

                    // this is retina slide image
                    $slide_retina_image = $slide_name_without_extension.'-2x.'.end($slide_name_array);

                    // check if retina image exists for slide
                    if (file_exists($slide_retina_image)) {
                        $enable_retina_image = true;
                    }
                    ?>
                    <div class="gallery-cell">
                        <img <?php if($enable_retina_image == true) { echo 'srcset="'.$mosConfig_live_site.'/'.$slide_retina_image.' 2x"'; } ?> src="<?php echo $mosConfig_live_site.'/'.$image[$loop]; ?>" alt="<?php echo $imageAlt[$loop]; ?>" />
                        <?php if ($imageHeading[$loop] || $imageText[$loop]) { ?>
                        <div class="contents">
                            <?php if ($imageHeading[$loop]) { ?>
                            <h2><?php echo $imageHeading[$loop]; ?></h2>
                            <?php }
                            
                            // retina images in slide content
                            $regex      = '#<img(.*?)>#s';
                            $matches    = array();
                            $fileNameExtension = "-2x";

                            // find all instances of <img> and put in $matches
                            preg_match_all($regex, $imageText[$loop], $matches, PREG_SET_ORDER);

                            foreach ($matches as $match) {
                
                                // Isolate string inside src of the <img>
                                preg_match("/src=\"([^\"]*)\"/", $match[1], $image_src);
                                
                                // Image name without extension:
                                // Since image name can contain dots, we should explode string per .
                                // Then join all elements, except the last element.

                                $image_name_without_extension = "";
                                if (isset($image_src[1])) {
                                    $image_name_array = explode(".", $image_src[1]);
                                }
                                $image_name_parts = count($image_name_array);

                                foreach ($image_name_array as $image_name_part) {

                                    if($image_name_part != end($image_name_array)) {
                                        $image_name_without_extension = $image_name_without_extension . $image_name_part . ".";
                                    }

                                }

                                // remove the last dot
                                $image_name_without_extension = rtrim($image_name_without_extension, ".");

                                // this is retina image
                                $retina_image = $image_name_without_extension.$fileNameExtension.'.'.end($image_name_array);

                                // if retina image exists AND if there's no srcset already defined
                                // add srcset to the <img>

                                $srcset_exists = strpos($match[1], "srcset");

                                if (file_exists($retina_image) && $srcset_exists === false) {
                                    $output = '<img srcset="'.JURI::base().$image_name_without_extension.$fileNameExtension.'.'.end($image_name_array).' 2x"' . $match[1] . '>';
                                    $imageText[$loop] = preg_replace( "#<img($match[1])>#s", $output , $imageText[$loop] );
                                }

                                // END retina image code
                            }
                            echo $imageText[$loop]; ?>  
                        </div>
                        <?php } ?>
                    </div>
            <?php
                }
            }
        }
        ?>
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
        jQuery('.hot_swipe_carousel_slides<?php echo $uniqueid; ?> .contents').css('opacity', 1);
    });
</script>