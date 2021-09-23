<?php
/*------------------------------------------------------------------------
# "Hot Teeth" - Joomla Template Framework
# Copyright (C) 2015 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/
defined( '_JEXEC' ) or die( 'Restricted access' );
if(!defined('DS')) {
    define("DS", DIRECTORY_SEPARATOR);
}

define( 'YOURBASEPATH', dirname(__FILE__) );
$template_path = $this->baseurl.'/templates/'.$this->template;

$css_request = false;
if (isset($_GET['css_request'])) {
   if($_GET['css_request'] == "1") $css_request = true;
}
if(!$css_request){

// script options
$loadJqueryUI = $this->params->get("loadJqueryUI", "0");
$loadFontAwesome = $this->params->get("loadFontAwesome", "0");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<?php if (preg_match("/2.5/i", JVERSION)) { ?>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript">
     jQuery.noConflict();
</script>
<?php } ?>

<jdoc:include type="head" />

<?php if($loadJqueryUI) { ?>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<?php 
//Google font include
$google_obj = $this->params->get("googleUrl","{}");
$google_obj = json_decode($google_obj, true);
foreach($google_obj as $key => $g_o){
	$subsets= implode(",",$g_o['charsets']);
	?>
<link href='https://fonts.googleapis.com/css?family=<?php echo str_replace(" ","+",$key);?>:<?php echo $g_o['variant']?>&amp;subset=<?php echo $subsets; ?>' rel='stylesheet' type='text/css'>
<?php
}
?>

<?php	// template parameters
}		
		
		// template layout -----------------------------------------------------------------
		$templateWidth = $this->params->get("templateWidth", "960");
		$fluidWidth = $this->params->get("fluidWidth", "0");
		$layoutdesign = $this->params->get("layoutdesign", "");
		$cellPaddingHorizontal = $this->params->get("cellPaddingHorizontal", "0");
		$cellPaddingVertical = $this->params->get("cellPaddingVertical", "0");
		$cellMarginHorizontal = $this->params->get("cellMarginHorizontal", "10");
		$cellMarginVertical = $this->params->get("cellMarginVertical", "0");
		$textDirection = $this->params->get("textDirection", "ltr");
		
		//----------END LAYOUT-----------------------------------------------------------

		// Check if abovecontent and belowcontent are active ----------------------------

		$abovecontent = $this->countModules('abovecontent');
		$belowcontent = $this->countModules('belowcontent');

		// Get active style from parameters
		$templateStyle = $this->params->get("templateStyle", "0");
		
		// Call sparky Parameters -------------------------------------------------------
		
		require(dirname(__FILE__).DS.'library'.DS.'sparky_parameters.php');
		
		// READ MENU CONFIGURATION ///////////////////////////////////////////////////////

		$LoadMENU_Acc  = false;
		$LoadMENU_Navh = false;
		$LoadMENU_Navv  = false;	
		
		global $mnucfg;
		$mnucfg = array();
		
		$mnu_load = json_decode($this->params->get("mnucfg", "[]"));
		foreach($mnu_load as $mnu){
			
			$mnu_name = $mnu->name;
			$mnu_val  = $mnu->type;

			if($mnu_val == "acc"){
				$LoadMENU_Acc = true;
			}else if($mnu_val == "navh"){
				$LoadMENU_Navh = true;
			}else if($mnu_val == "navv"){
				$LoadMENU_Navv = true;
			}

			$mnucfg[$mnu_name] = array();
			$mnucfg[$mnu_name]['type'] = $mnu_val;
			
			foreach( $mnu->config as $prop => $value){
				$mnucfg[$mnu_name][$prop] = $value;
			}
		}
		
		// Get all menu types from DB into $all_menus array
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName('menutype'));
		$query->from($db->quoteName('#__menu_types'));
		$db->setQuery($query);
		$all_menus = $db->loadColumn();
		
		
	    ////////////////////////////////////////////////////////////////////////////////
		//e.g.: echo $mnucfg['footer1']['text_color'];
		
		$spread_mode = true; //set this to 'false' if you don't want modules to spread to empty modules right of them
		
		//READ MODULE GRID START////////////////////////////////////////////////////////
		$module_grid = $layoutdesign;
		$module_grid = explode('&',$module_grid);
		$loop = 0;
		for($loop = 0; $loop < count($module_grid) ; $loop++){
			$module_grid[$loop] = explode('+',$module_grid[$loop]);
			if(stripos($module_grid[$loop][2], "joom_content") > -1){
		    	$module_grid[$loop][3] = true; 
			}else{
		    	$module_grid[$loop][3] = false;
			}
			$module_grid[$loop][2] = explode(',',$module_grid[$loop][2]);
			$I = 0;
			for($I = 0; $I < count($module_grid[$loop][2]) ; $I++){
				$module_grid[$loop][2][$I] = explode('=',$module_grid[$loop][2][$I]); 
				$module_grid[$loop][2][$I][1] =intval($module_grid[$loop][2][$I][1]);
				$module_grid[$loop][2][$I][2] =intval($module_grid[$loop][2][$I][2]);
			}
		   
			if($spread_mode){
				$carry_cell = 0;
				$last_hasm  = -1;
			   
				for($I = count($module_grid[$loop][2]) - 1 ;$I >= 0; $I--){
					if(
						// if no modules in position, and not Sparky element, and not menu
					 	($this->countModules($module_grid[$loop][2][$I][0]) == 0)
					 	&&
					 	$module_grid[$loop][2][$I][0] != 'joom_content'
					 	&&
					 	$module_grid[$loop][2][$I][0] != 'logo'
					 	&&
					 	$module_grid[$loop][2][$I][0] != 'fontresize'
					 	&&
					 	$module_grid[$loop][2][$I][0] != 'copyright'
					 	&&
					 	(!in_array($module_grid[$loop][2][$I][0], $all_menus))
				 	){
						$carry_cell += ($module_grid[$loop][2][$I][1] + $module_grid[$loop][2][$I][2]);
						$module_grid[$loop][2][$I][1] = 0;
						$module_grid[$loop][2][$I][2] = 0;
					}else{
						// otherwise, it's module position with modules published
						$module_grid[$loop][2][$I][1] += $carry_cell;
						$carry_cell = 0;
						$last_hasm  = $I;
					}
				}
			   
				if($last_hasm != -1 && $carry_cell > 0){
					$module_grid[$loop][2][$last_hasm][1] += $carry_cell; 
				}
			} 
		}
		//READ MODULE GRID END////////////////////////////////////////////////////////
		
if($css_request){
	header("Content-type: text/css; charset: UTF-8");     
	header("Expires: ".gmdate("D, d M Y H:i:s", time() + 60*60)." GMT");
	require(dirname(__FILE__).DS.'css'.DS.'template_css.php');
	exit;

}else{

$u = JFactory::getURI();
$css_url = $u->toString();
$css_url = strrpos($css_url,'?')? $css_url.'&css_request=1' :  $css_url.'?css_request=1';
if ($randomizeCssLink) { $css_url = $css_url.'&amp;diff='.rand(); }
?>
<link rel="stylesheet" href="<?php echo $template_path ?>/css/joomla.css" type="text/css" />
<?php if($loadFontAwesome) { ?>
<link rel="stylesheet" href="<?php echo $template_path ?>/css/font-awesome.min.css">
<?php } ?>
<link rel="stylesheet" href="<?php echo $css_url; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo $template_path ?>/css/template_css.css" type="text/css" />
<!--[if lt IE 9]>
	<script src="<?php echo $template_path ?>/js/html5shiv.min.js"></script>
	<script src="<?php echo $template_path ?>/js/respond.min.js"></script>
<![endif]-->
<?php
// This adds live style switching (cookie based)
	
	// check if it cookie
	if(isset($_COOKIE['Style']))
	{
	$templateStyle = $_COOKIE['Style'];
	}
	
	$templateStyleTest = "";

	// check if in link
	if (isset($_GET['style'])) {
		$templateStyleTest = $_GET['style']; 
	}
	
	if ($templateStyleTest) { 
		$templateStyle = $templateStyleTest;
		$Month = 2592000 + time(); 
		setcookie("Style", $templateStyle, $Month);
	}

// Get specific parameters for this style from /styles
	
if($templateStyle) { ?>
<link rel="stylesheet" href="<?php echo $template_path ?>/styles/style<?php echo $templateStyle; ?>.css" type="text/css" />
<?php } ?>
<?php if($textDirection=="rtl") { ?>
<link rel="stylesheet" href="<?php echo $template_path ?>/css/rtl.css" type="text/css" />
<?php } ?>
<?php require(dirname(__FILE__).DS.'library'.DS.'menu_js.php'); ?>
<?php if($enableResponsiveMenu){ ?><script type="text/javascript" src="<?php echo $template_path ?>/js/responsive-nav.min.js"></script><?php } ?>

<script type="text/javascript" src="<?php echo $template_path ?>/js/modernizr-custom.js"></script>
</head>
<?php 
$menu = JFactory::getApplication()->getMenu();
$lang = JFactory::getLanguage();
?>
<body<?php if($menu->getActive() == $menu->getDefault($lang->getTag())) { echo ' class="sparky_home"'; }else{ echo ' class="sparky_inner"'; } ?>>
<div id="blocker" ></div>
<?php if ($topPanelSwitch) {
	require(dirname(__FILE__).DS.'library'.DS.'top_panel.php');
} ?>
<div class="sparky_wrapper">
<?php if (!$layoutdesign) { echo JText::_('TPL_HOT_TEETH_NO_LAYOUT'); } ?>
<?php
$cell_size = $templateWidth / 12;
$cell_size = floor($cell_size);  
$empty_no  = 0;

foreach($module_grid as $gridRow) {

//$gridRow[0] - Name
//$gridRow[1] - Class
//$gridRow[2] - ModulePos1,ModulePos2...
//$gridRow[3] - Holds content flag: true/false
//$mposition[0] - position name 
//$mposition[1] - number of grid cells occupied by position
//$mposition[2] - number of empty cells left of module 

	$modules_in_row = 0;
	foreach($gridRow[2] as $mposition) {

		// number of active modules in the row increases
		$modules_in_row += $this->countModules($mposition[0]);

		// if position is CONTENT or Sparky feature, we increase number of modules in row
		if ($mposition[0] == "joom_content" || $mposition[0] == "logo" || $mposition[0] == "fontresize" || $mposition[0] == "copyright") {
			$modules_in_row++;
		}

		// if position is in $all_menus array, we increase number of modules in row
		if (in_array($mposition[0], $all_menus)) {
			$modules_in_row++;
		}

	}
	if($modules_in_row) {
	?>
    <div class="sparky_full<?php if($gridRow[1]) { echo ' '.$gridRow[1]; } ?>">
        <?php
        // if row name is header or footer, we'll put this HTML5 container <header> or <footer>
        if($gridRow[0]=="header") {
        	echo '<header class="container">';
        }elseif($gridRow[0]=="footer"){
			echo '<footer class="container">';
        }else{ ?>
        <div class="container">
        <?php } ?>
            <div <?php if($gridRow[0]) { echo 'id="'.$gridRow[0].'"'; } ?> class="row">
            <?php   
            foreach($gridRow[2] as $mposition) {
				$mpwidth = $cell_size * $mposition[1];  
				if($mpwidth == 0) continue;
				$mpleft_off = $cell_size * $mposition[2];  
				if($mposition[0] == "joom_content") {			/////////////////// if CONTENT cell
	                if($mpleft_off){							// if empty cells
	                ?>
	                  <div class="cell mp_empty<?php echo $empty_no; ?> span<?php echo $empty_no; ?>">
	                     <!-- EMPTY CELL -->
	                     <div>&nbsp;</div>
	                  </div>
	                <?php
	                 $empty_no++;
	                }  
	                ?>
	                <div class="content_sparky span<?php echo $mposition[1];?>">
	                    <div class="cell_pad">
	                        <jdoc:include type="message" />
	                        <?php if($abovecontent) { ?>
	                        <div class="abovecontent">
	                        	<jdoc:include type="modules" name="abovecontent" style="xhtml" />
	                        </div>
	                        <?php } ?>
	                        <jdoc:include type="component" />
	                        <?php if($belowcontent) { ?>
	                        <div class="belowcontent">
	                        	<jdoc:include type="modules" name="belowcontent" style="xhtml" />
	                        </div>
	                        <?php } ?>
	                    </div>
	                </div>
                <?php
                }elseif($mposition[0] == "logo") {				/////////////////// if logo cell
					if($mpleft_off){							// if empty cells
						require(dirname(__FILE__).DS.'library'.DS.'empty.php');
						$empty_no++;
					}
					require(dirname(__FILE__).DS.'library'.DS.'logo.php');
				}elseif($mposition[0] == "fontresize") {		/////////////////// if fontresize cell
					if($mpleft_off){							// if empty cells
						require(dirname(__FILE__).DS.'library'.DS.'empty.php');
						$empty_no++;
					}
					require(dirname(__FILE__).DS.'library'.DS.'font_resize.php');
				}elseif($mposition[0] == "copyright") {			/////////////////// if copyright cell
					if($mpleft_off){							// if empty cells
						require(dirname(__FILE__).DS.'library'.DS.'empty.php');
						$empty_no++;
					}
					require(dirname(__FILE__).DS.'library'.DS.'c.php');
				}elseif(in_array($mposition[0], $all_menus)) {	/////////////////// if menu cell
					if($mpleft_off){							// if empty cells
						require(dirname(__FILE__).DS.'library'.DS.'empty.php');
						$empty_no++;
					}
					require(dirname(__FILE__).DS.'library'.DS.'menu_loader.php');
				}else{											/////////////////// if module position cell
	                if($mpleft_off){							// if empty cells
						require(dirname(__FILE__).DS.'library'.DS.'empty.php');
						$empty_no++;
	                } 
	                ?>
					<div class="cell mp_<?php echo $mposition[0];?> span<?php echo $mposition[1];?>">
						<div class="cell_pad">
							<jdoc:include type="modules" name="<?php echo $mposition[0]; ?>" style="xhtml" />
						</div>
					</div>
	                <?php 
	            }
        	} ?>
            </div>
            <div class="clr"></div> 
        <?php if($gridRow[0]=="header") {
        	echo '</header>';
        }elseif($gridRow[0]=="footer"){
			echo '</footer>';
        }else{ ?>
        </div>
        <?php } ?>
        <div class="clr"></div> 
    </div>
<?php
	} // if $modules_in_row
} // foreach($module_grid as $gridRow)
?>
</div>
<?php
if ($equalHeightClasses) {
	require(dirname(__FILE__).DS.'library'.DS.'equal_height.php');
}
if ($scrollToTopSwitch) {
	require(dirname(__FILE__).DS.'library'.DS.'scroll_to_top.php');
}
if ($analyticsSwitch && $analyticsAccount) {
	require(dirname(__FILE__).DS.'library'.DS.'analytics.php');
}
if ($parallaxScroll && $parallaxScrollClasses) {
?>
<script type="text/javascript">
// parallax scroll
jQuery(document).ready(function(){
	$window = jQuery(window);           
	jQuery('<?php echo $parallaxScrollClasses; ?>').each(function(){
		var $bgobj = jQuery(this);
		jQuery(window).scroll(function() {
			var yPos = -($window.scrollTop() / <?php echo $parallaxScrollSpeed; ?>);
			var coords = '50% '+ yPos + 'px';
			$bgobj.css({ backgroundPosition: coords });
		});
	});
});
</script>
<?php }
if ($imageAnimation) { ?>
<script src="<?php echo $template_path ?>/js/jquery.easing-1.3.js"></script>
<script src="<?php echo $template_path ?>/js/jquery.transform2d.js"></script>
<script src="<?php echo $template_path ?>/js/jquery.appear.js"></script>
<?php }
if ($lazyLoad) { ?>
<script src="<?php echo $template_path ?>/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
// lazy load
jQuery(function() {
    jQuery("img.lazy").lazyload();
});
</script>
<?php } ?>
<?php if($enableResponsiveMenu) { ?>
<script src="<?php echo $template_path ?>/js/floating_row.js"></script>
<script type="text/javascript">
<?php
foreach($mnucfg as $menu_name => $menu) {
	if($menu['type'] == "navv"){ ?>
		if( jQuery(".container_<?php echo $menu_name;?>").length ) {
			var navigation = responsiveNav(".container_<?php echo $menu_name;?>");
		}
<?php	 
	}
}
?>
</script>
<?php } ?>
<script>
// hover effects to hot responsive lightbox
jQuery("#responsivelightboxgallery li a").prepend("<img class='gallery_hover_bg' src='<?php echo $template_path ?>/images/custom/gallery<?php if($templateStyle) { echo $templateStyle; } ?>.png' alt='' />");
jQuery("#responsivelightboxgallery li a").prepend("<img class='gallery_hover_plus' src='<?php echo $template_path ?>/images/custom/gallery_plus.png' alt='' />");
</script>
<script src="<?php echo $template_path ?>/js/hot_teeth.js"></script>
<?php if($textDirection=="rtl") { ?>
<script>
var galleryPlus = function() {
	var thumbMove = (jQuery("#responsivelightboxgallery li").innerWidth()) / 2 - 31;
	jQuery("img.gallery_hover_plus").css({
		marginTop: thumbMove + "px",
		marginRight: thumbMove + "px",
		marginLeft: "0px"
	});
};
</script>
<?php } ?>
</body>
</html>
<?php } // if($css_request) ?>