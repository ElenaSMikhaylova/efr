<?php
/*------------------------------------------------------------------------
# "Hot Slicebox" Joomla module
# Copyright (C) 2014 HotThemes. All Rights Reserved.
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
$doc->addScript($mosConfig_live_site.'/modules/mod_hot_slicebox/js/modernizr.custom.46884.js');
$doc->addScript($mosConfig_live_site.'/modules/mod_hot_slicebox/js/jquery.slicebox.js');
?>
<!-- Internet Explorer HTML5 fix -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php

// inline style
$doc->addStyleDeclaration( '

.sb-description h3 {
    font-size: '.$textSize.'px;
    color: '.$textColor.';
}

.sb-description {
    background: rgba('.$boxBgColor.', '.$boxTransparency.');
}

');

// add stylesheet
$doc->addStyleSheet( 'modules/mod_hot_slicebox/tmpl/style.css' );

$number_of_slides = -1;

?>

<div>
    <?php if($navArrows) { ?>
    <div id="nav-arrows" class="nav-arrows">
        <a href="#"><img src="<?php echo $mosConfig_live_site; ?>/modules/mod_hot_slicebox/images/arrow_right.png" alt="arrow right"/></a>
        <a href="#"><img src="<?php echo $mosConfig_live_site; ?>/modules/mod_hot_slicebox/images/arrow_left.png" alt="arrow left"/></a>
    </div>
    <?php } ?>
    <ul id="sb-slider" class="sb-slider">
        <?php for ($loop = 1; $loop <= 20; $loop += 1) { ?>
            <?php if($enableSlide[$loop]=="true") { $number_of_slides++; ?>
            <li>
                <a href="<?php if($imageLinkArray[$loop]) { echo $imageLinkArray[$loop]; }else{ echo "#"; } ?>" title="<?php echo $imageTitleArray[$loop]; ?>"<?php if($linkNewWindow) { ?> target="_blank"<?php } ?>><img src="<?php echo $mosConfig_live_site.'/'.$image[$loop]; ?>" alt="<?php echo $imageAlt[$loop]; ?>"/></a>
                <?php if($imageText[$loop]) { ?>
                <div class="sb-description">
                    <h3><?php echo $imageText[$loop]; ?></h3>
                </div>
                <?php } ?>
            </li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>
<?php if($navDots) { ?>
<div id="nav-dots" class="nav-dots">
    <span class="nav-dot-current"></span>
    <?php for ($loop = 1; $loop <= $number_of_slides; $loop += 1) { ?>
    <span></span>
    <?php } ?>
</div>
<?php } ?>

<script type="text/javascript">
    jQuery(function() {

        var Page = (function() {

            var $navArrows = jQuery( '#nav-arrows' ).hide(),
                $navDots = jQuery( '#nav-dots' ).hide(),
                $nav = $navDots.children( 'span' ),
                $shadow = jQuery( '#shadow' ).hide(),
                slicebox = jQuery( '#sb-slider' ).slicebox( {
                    onReady : function() {

                        $navArrows.show();
                        $navDots.show();
                        $shadow.show();

                    },
                    onBeforeChange : function( pos ) {

                        $nav.removeClass( 'nav-dot-current' );
                        $nav.eq( pos ).addClass( 'nav-dot-current' );

                    },
                    orientation : '<?php echo $orientation; ?>',
                    perspective : <?php echo $perspective; ?>,
                    cuboidsCount : <?php echo $cuboidsCount; ?>,
                    cuboidsRandom : <?php if ($cuboidsRandom) { echo "true"; }else{ echo "false"; } ?>,
                    maxCuboidsCount : <?php echo $maxCuboidsCount; ?>,
                    disperseFactor : <?php echo $disperseFactor; ?>,
                    colorHiddenSides : '<?php echo $hiddenSidesColor; ?>',
                    sequentialFactor : <?php echo $sequentialFactor; ?>,
                    speed : <?php echo $animSpeed; ?>,
                    autoplay : <?php if ($autoPlay) { echo "true"; }else{ echo "false"; } ?>,
                    interval : <?php echo $pauseTime; ?>
                } ),
                
                init = function() {

                    initEvents();
                    
                },
                initEvents = function() {

                    // add navigation events
                    $navArrows.children( ':first' ).on( 'click', function() {

                        slicebox.next();
                        return false;

                    } );

                    $navArrows.children( ':last' ).on( 'click', function() {
                        
                        slicebox.previous();
                        return false;

                    } );

                    $nav.each( function( i ) {
                    
                        jQuery( this ).on( 'click', function( event ) {
                            
                            var $dot = jQuery( this );
                            
                            if( !slicebox.isActive() ) {

                                $nav.removeClass( 'nav-dot-current' );
                                $dot.addClass( 'nav-dot-current' );
                            
                            }
                            
                            slicebox.jump( i + 1 );
                            return false;
                        
                        } );
                        
                    } );

                };

                return { init : init };

        })();

        Page.init();

    });
</script>