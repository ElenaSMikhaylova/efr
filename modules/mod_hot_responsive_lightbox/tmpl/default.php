<?php
/*------------------------------------------------------------------------
# "Hot Responsive Lightbox" Joomla module
# Copyright (C) 2014 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// get the document object
$doc = JFactory::getDocument();

// add your stylesheet
$doc->addStyleSheet( 'modules/mod_hot_responsive_lightbox/tmpl/style.css' );

// style declaration
$doc->addStyleDeclaration( '

#responsivelightbox'.$uniqueid.' {
	text-align: center;
}

#responsivelightbox'.$uniqueid.' ul {
	margin: 0;
	padding: 0;
}

#responsivelightbox'.$uniqueid.' li {
	margin:'.$thumbsMarginV.'px '.$thumbsMarginH.'px;
	display: inline-block;
	background: none;
	padding: 0;
}

#responsivelightbox'.$uniqueid.' img {
	width:'.$thumbs_width.'px;
	height:'.$thumbs_height.'px;
	border:'.$borderWidth.'px solid '.$borderColor.';
	padding:'.$thumbsPadding.'px;
	background: #eee;
	-webkit-box-shadow: 0 0 0.313em rgba( 0, 0, 0, .05 );
	box-shadow: 0 0 0.313em rgba( 0, 0, 0, .05 );
	-webkit-transition: -webkit-box-shadow .3s ease, border-color .3s ease;
	transition: box-shadow .3s ease, border-color .3s ease;
}

#responsivelightbox'.$uniqueid.' img:hover,
#responsivelightbox'.$uniqueid.' img:focus {
	border:'.$borderWidth.'px solid '.$borderHoverColor.';
	background: #fff;
	-webkit-box-shadow: 0 0 0.938em rgba( 0, 0, 0, .25 );
	box-shadow: 0 0 0.938em rgba( 0, 0, 0, .25 );
}

#imagelightbox-overlay {
	background-color: rgba( '.$overlay.', .9 );
}

@media only screen and (max-width: 41.250em) {

	#responsivelightbox'.$uniqueid.' {
		width: 100%;
	}
}

' );

// load jquery
JHtml::_('jquery.framework');

// add scripts
$doc->addScript("modules/mod_hot_responsive_lightbox/js/imagelightbox.min.js");
$doc->addScript("modules/mod_hot_responsive_lightbox/js/hot_responsive_lightbox.js");

// prepare Alt values
$alt_value = explode(",", $alt);
?>
<script>
jQuery(document).ready(function() {
	<?php if($lightboxMode == "a") { ?>
	//	WITH ACTIVITY INDICATION
	jQuery( 'a[data-imagelightbox="a<?php echo $uniqueid ?>"]' ).imageLightbox(
	{
		onLoadStart:	function() { hotResponsiveLightbox.activityIndicatorOn(); },
		onLoadEnd:		function() { hotResponsiveLightbox.activityIndicatorOff(); },
		onEnd:	 		function() { hotResponsiveLightbox.activityIndicatorOff(); }
	});

	<?php }elseif($lightboxMode == "b") { ?>
	//	WITH OVERLAY & ACTIVITY INDICATION
	jQuery( 'a[data-imagelightbox="b<?php echo $uniqueid ?>"]' ).imageLightbox(
	{
		onStart: 	 function() { hotResponsiveLightbox.overlayOn(); },
		onEnd:	 	 function() { hotResponsiveLightbox.overlayOff(); hotResponsiveLightbox.activityIndicatorOff(); },
		onLoadStart: function() { hotResponsiveLightbox.activityIndicatorOn(); },
		onLoadEnd:	 function() { hotResponsiveLightbox.activityIndicatorOff(); }
	});

	<?php }elseif($lightboxMode == "c") { ?>
	//	WITH "CLOSE" BUTTON & ACTIVITY INDICATION
	var instanceC = jQuery( 'a[data-imagelightbox="c<?php echo $uniqueid ?>"]' ).imageLightbox(
	{
		quitOnDocClick:	false,
		onStart:		function() { hotResponsiveLightbox.closeButtonOn( instanceC ); },
		onEnd:			function() { hotResponsiveLightbox.closeButtonOff(); hotResponsiveLightbox.activityIndicatorOff(); },
		onLoadStart: 	function() { hotResponsiveLightbox.activityIndicatorOn(); },
		onLoadEnd:	 	function() { hotResponsiveLightbox.activityIndicatorOff(); }
	});

	<?php }elseif($lightboxMode == "d") { ?>
	//	WITH CAPTION & ACTIVITY INDICATION
	jQuery( 'a[data-imagelightbox="d<?php echo $uniqueid ?>"]' ).imageLightbox(
	{
		onLoadStart: function() { hotResponsiveLightbox.captionOff(); hotResponsiveLightbox.activityIndicatorOn(); },
		onLoadEnd:	 function() { hotResponsiveLightbox.captionOn(); hotResponsiveLightbox.activityIndicatorOff(); },
		onEnd:		 function() { hotResponsiveLightbox.captionOff(); hotResponsiveLightbox.activityIndicatorOff(); }
	});
	<?php }elseif($lightboxMode == "g") { ?>
	//	WITH ARROWS & ACTIVITY INDICATION

	var selectorG = 'a[data-imagelightbox="g<?php echo $uniqueid ?>"]';
	var instanceG = jQuery( selectorG ).imageLightbox(
	{
		onStart:		function(){ hotResponsiveLightbox.arrowsOn( instanceG, selectorG ); },
		onEnd:			function(){ hotResponsiveLightbox.arrowsOff(); hotResponsiveLightbox.activityIndicatorOff(); },
		onLoadStart: 	function(){ hotResponsiveLightbox.activityIndicatorOn(); },
		onLoadEnd:	 	function(){ jQuery( '.imagelightbox-arrow' ).css( 'display', 'block' ); hotResponsiveLightbox.activityIndicatorOff(); }
	});

	<?php }elseif($lightboxMode == "e") { ?>
	//	WITH NAVIGATION & ACTIVITY INDICATION
	var selectorE = 'a[data-imagelightbox="e<?php echo $uniqueid ?>"]';
	var instanceE = jQuery( selectorE ).imageLightbox(
	{
		onStart:	 function() { hotResponsiveLightbox.navigationOn( instanceE, selectorE ); },
		onEnd:		 function() { hotResponsiveLightbox.navigationOff(); hotResponsiveLightbox.activityIndicatorOff(); },
		onLoadStart: function() { hotResponsiveLightbox.activityIndicatorOn(); },
		onLoadEnd:	 function() { hotResponsiveLightbox.navigationUpdate( selectorE ); hotResponsiveLightbox.activityIndicatorOff(); }
	});

	<?php }else{ ?>
	//	ALL COMBINED
	var selectorF = 'a[data-imagelightbox="f<?php echo $uniqueid ?>"]';
	var instanceF = jQuery( selectorF ).imageLightbox(
	{
		onStart:		function() { hotResponsiveLightbox.overlayOn(); hotResponsiveLightbox.closeButtonOn( instanceF ); hotResponsiveLightbox.arrowsOn( instanceF, selectorF ); },
		onEnd:			function() { hotResponsiveLightbox.overlayOff(); hotResponsiveLightbox.captionOff(); hotResponsiveLightbox.closeButtonOff(); hotResponsiveLightbox.arrowsOff(); hotResponsiveLightbox.activityIndicatorOff(); },
		onLoadStart: 	function() { hotResponsiveLightbox.captionOff(); hotResponsiveLightbox.activityIndicatorOn(); },
		onLoadEnd:	 	function() { hotResponsiveLightbox.captionOn(); hotResponsiveLightbox.activityIndicatorOff(); jQuery( '.imagelightbox-arrow' ).css( 'display', 'block' ); }
	});
	<?php } ?>

});
</script>
<div id="responsivelightbox<?php echo $uniqueid; ?>">
	<ul>
	<?php
	$images_dir = $images_dir."/";
	$thumbs_dir = $images_dir."thumbs/";

	// START gallery code
					
					if(!function_exists('make_thumb_v')){	
						function make_thumb_v($src,$dest,$desired_height) {
							/* read the source image */
							$source_image = imagecreatefromjpeg($src);
							$width = imagesx($source_image);
							$height = imagesy($source_image);
							/* find the "desired width" of this thumbnail, relative to the desired height  */
							$desired_width = floor($width*($desired_height/$height));
							/* create a new, "virtual" image */
							$virtual_image = imagecreatetruecolor($desired_width,$desired_height);
							/* copy source image at a resized size */
							imagecopyresized($virtual_image,$source_image,0,0,0,0,$desired_width,$desired_height,$width,$height);
							/* create the physical thumbnail image to its destination */
							imagejpeg($virtual_image,$dest);
						}
					}
					
					
					if(!function_exists('make_thumb')){			
						function make_thumb($Dir,$Image,$NewDir,$NewImage,$MaxWidth,$MaxHeight,$Quality) {
						  list($ImageWidth,$ImageHeight,$TypeCode)=getimagesize($Dir.$Image);
						  $ImageType=($TypeCode==1?"gif":($TypeCode==2?"jpeg":
									 ($TypeCode==3?"png":FALSE)));
						  $CreateFunction="imagecreatefrom".$ImageType;
						  $OutputFunction="image".$ImageType;
						  if ($ImageType) {
							$Ratio=($ImageHeight/$ImageWidth);
							$ImageSource=$CreateFunction($Dir.$Image);
							if ($ImageWidth > $MaxWidth || $ImageHeight > $MaxHeight) {
							  if ($ImageWidth > $MaxWidth) {
								 $ResizedWidth=$MaxWidth;
								 $ResizedHeight=$ResizedWidth*$Ratio;
							  }
							  else {
								$ResizedWidth=$ImageWidth;
								$ResizedHeight=$ImageHeight;
							  }       
							  if ($ResizedHeight > $MaxHeight) {
								$ResizedHeight=$MaxHeight;
								$ResizedWidth=$ResizedHeight/$Ratio;
							  }      
							  $ResizedImage=imagecreatetruecolor($ResizedWidth,$ResizedHeight);
							  imagecopyresampled($ResizedImage,$ImageSource,0,0,0,0,$ResizedWidth,
												 $ResizedHeight,$ImageWidth,$ImageHeight);
							}
							else {
							  $ResizedWidth=$ImageWidth;
							  $ResizedHeight=$ImageHeight;     
							  $ResizedImage=$ImageSource;
							}   
							$OutputFunction($ResizedImage,$NewDir.$NewImage,$Quality);
							return true;
						  }   
						  else
							return false;
						}
					}
					
					/* function:  returns files from dir */
					if(!function_exists('get_files')){	
						function get_files($images_dir,$exts = array('jpg')) {
							$files = array();
							if($handle = opendir($images_dir)) {
								while(false !== ($file = readdir($handle))) {
									$extension = strtolower(get_file_extension($file));
									if($extension && in_array($extension,$exts)) {
										$files[] = $file;
									}
								}
								closedir($handle);
							}
							return $files;
						}
					}
					
					/* function:  returns a file's extension */
					if(!function_exists('get_file_extension')){	
						function get_file_extension($file_name) {
							return substr(strrchr($file_name,'.'),1);
						}
					}

					/** settings **/
					
					if(!is_dir($images_dir."thumbs")) {
						mkdir($images_dir."thumbs", 0755);
					}
	                
					$image_files = get_files($images_dir);
					sort($image_files);
					if(count($image_files)) {
						$index = 0;
						$index_alt = 0;
						foreach($image_files as $index=>$file) {
							$index++;
							$thumbnail_image = $thumbs_dir."thumb_".$file;
							if(!file_exists($thumbnail_image)) {
								$extension = get_file_extension($thumbnail_image);
								if($extension) {
									make_thumb($images_dir,$file,$thumbs_dir,"thumb_".$file,$thumbs_width,$thumbs_height,$image_quality);
								}
							}
							if (isset($alt_value[$index_alt])) {
								echo '<li><a href="'.$mosConfig_live_site.'/'.$images_dir.$file.'" data-imagelightbox="'.$lightboxMode.$uniqueid.'"><img src="'.$thumbnail_image.'" alt="'.$alt_value[$index_alt].'" /></a></li>';
							} else {
								echo '<li><a href="'.$mosConfig_live_site.'/'.$images_dir.$file.'" data-imagelightbox="'.$lightboxMode.$uniqueid.'"><img src="'.$thumbnail_image.'" alt="" /></a></li>';
							}
							$index_alt++;
						}
					}
					else {
						echo '<p>There are no images in this gallery.</p>';
					}			
					
	// END gallery code
	?>
	</ul>
</div>