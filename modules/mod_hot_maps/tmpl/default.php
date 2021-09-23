<?php
/*------------------------------------------------------------------------
# "Hot Maps" Joomla module
# Copyright (C) 2011 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// get the document object
$doc = JFactory::getDocument();

// add your stylesheet
$doc->addStyleSheet( 'modules/mod_hot_maps/tmpl/hot_maps.css' );

$doc->addStyleDeclaration( '

#map {
	width: '.$module_width.$module_width_unit.';
	height: '.$module_height.'px;
	border: '.$border.';
}

' );

?>

<?php if($pre_text) { ?>
<div class="maps_pretext"><?php echo $pre_text ?></div>
<?php } ?>

<div id="map"></div>
<script>
	function initMap() {

	    var customMapType = new google.maps.StyledMapType([
	        {
				stylers: [
					{hue: '<?php echo $hue; ?>'},
					{visibility: '<?php echo $visibility; ?>'},
					{gamma: <?php echo $gamma; ?>},
					{saturation: <?php echo $saturation; ?>},
					{lightness: <?php echo $lightness; ?>}
				]
	        },
	        {
				elementType: 'labels',
				stylers: [
					{visibility: '<?php echo $labels; ?>'}
				]
	        },
	        {
				featureType: 'water',
				stylers: [
					{color: '<?php echo $water; ?>'}
				]
	        }
	    ], {
	        name: 'Custom Style'
	    });
	    var customMapTypeId = 'custom_style';

	    var map = new google.maps.Map(document.getElementById('map'), {
			zoom: <?php echo $zoom; ?>,
			disableDefaultUI: <?php echo $disableui; if($disablezoom == "true") { ?>,
			scrollwheel: false<?php } ?>
	    });

	    var geocoder = new google.maps.Geocoder();
	    geocodeAddress(geocoder, map);

	    // additional markers
	    <?php
	    for ($loop = 1; $loop <= 5; $loop += 1) {
	    	if ($markerlat[$loop] && $markerlng[$loop]) { ?>
		    var marker<?php echo $loop; ?> = new google.maps.Marker({
				position: {lat: <?php echo $markerlat[$loop] ?>, lng: <?php echo $markerlng[$loop] ?>},
				map: map,
				title: '<?php echo $markertitle[$loop] ?>'
		    });
	    <?php
			}
		} ?>

	    map.mapTypes.set(customMapTypeId, customMapType);
	    <?php if($satellite) { ?>
		map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
		<?php }else{ ?>
	    map.setMapTypeId(customMapTypeId);
	    <?php } ?>
	    
	}

	function geocodeAddress(geocoder, resultsMap) {
		var address = "<?php echo $address; ?>";
		geocoder.geocode({'address': address}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				resultsMap.setCenter(results[0].geometry.location);
				resultsMap.panBy(<?php echo $mapoffsetx; ?>, <?php echo $mapoffsety; ?>);
				<?php if($defaultmarker) { ?>
				var marker = new google.maps.Marker({
			    	map: resultsMap,
			    	position: results[0].geometry.location
			    });
			    <?php } ?>
			} else {
			    alert('Geocode was not successful for the following reason: ' + status);
			}
		});
	}

</script>
<script src="https://maps.googleapis.com/maps/api/js?<?php if($apikey) { echo "key=".$apikey."&amp;"; } ?>callback=initMap" async defer></script>

<?php if($post_text) { ?>
<div class="maps_posttext"><?php echo $post_text ?></div>
<?php } ?>

