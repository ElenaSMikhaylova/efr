<?php
/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2015 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/
if($LoadMENU_Acc){ ?>
<link rel="stylesheet" href="<?php echo $template_path ?>/css/menu_accordion.css" type="text/css" />
<script type="text/javascript" src="<?php echo $template_path ?>/js/jquery.hjt.accmenu.js"></script>
<script type="text/javascript">
<?php
foreach($mnucfg as $menu_name => $menu){
  if($menu['type'] == "acc" || strpos($menu['type'], "acc")){ ?>
     jQuery(document).ready(function(){
	  jQuery('.mnu_<?php echo $menu_name;?>').accmenu({
				collapsible: <?php echo $menu['collapsible'] == "1"? "true" : "false"; ?>,
				equalheight: <?php echo $menu['equalheight'] == "1"? "true" : "false"; ?>,
				event:'<?php echo $menu['trigger']; ?>',
				animation:'<?php echo $menu['animation']; ?>',
				subpanelslide:'<?php echo $menu['subpanelslide']; ?>',
				subpanelspeed: <?php echo $menu['animation_speed']; ?>
	  });
	 });
  <?php
  }
}
?>
</script>
<?php
}

if($LoadMENU_Navv){?>
<script type="text/javascript">
<?php
foreach($mnucfg as $menu_name => $menu) {

	// cut dashes from menu names to prevent JS error
	$menu_name_correct = str_replace("-", "", $menu_name);

	if($menu['type'] == "navv" || strpos($menu['type'], "navv")){ ?>
	function isAppleDevice(){
		return (
			(navigator.userAgent.toLowerCase().indexOf("ipad") > -1) ||
			(navigator.userAgent.toLowerCase().indexOf("iphone") > -1) ||
			(navigator.userAgent.toLowerCase().indexOf("ipod") > -1)
		);
	}

	(function(jQuery){  
		jQuery.fn.dropDownMenu_<?php echo $menu_name_correct; ?> = function(options) {  
	  
			var defaults = {  
				speed: 300,  
				effect: 'fadeToggle'
			};  
			var options = jQuery.extend(defaults, options);  
	      
			return this.each(function() {

				var screenWidth = jQuery("body").width();

		    	jQuery('.mnu_<?php echo $menu_name;?> ul').hide();
		    	jQuery('.mnu_<?php echo $menu_name;?> li ul li').filter(':last-child').css('border-bottom', 'none');

		    	if(screenWidth > <?php echo $responsiveMenuTriggerValue; ?>) {

			    	jQuery('.mnu_<?php echo $menu_name;?> li').hover(function(){
			      		jQuery(this).children('ul').stop()[options.effect](options.speed);
			    	},function(){
			      		jQuery(this).css('position','relative').children('ul').stop()[options.effect](options.speed);
			    	});

			    }else{

			    	jQuery('.mnu_<?php echo $menu_name;?> li a[href="#"]').toggle(function(){
			      		jQuery(this).parent().find('ul:first:not(:visible)').stop(true,true)[options.effect](options.speed);
			    	},function(){
			      		jQuery(this).parent().css('position', 'relative').find('ul:first:visible').stop(true,true)[options.effect](options.speed);
			    	});
											
					jQuery("nav ul.navv").find("li > ul").prev().addClass("firstClick");		

			    }
				jQuery(document).on("click",".mnu_<?php echo $menu_name;?> a", function(){
					if(!jQuery(this).hasClass("firstClick"))
						jQuery(this).addClass("firstClick");
					
					return true;
				});
				
				
				jQuery(document).on("click",".mnu_<?php echo $menu_name;?> .firstClick",function(e){	
					if((jQuery("html.no-touchevents").length == 1 && screenWidth > <?php echo $responsiveMenuTriggerValue; ?>) || (isAppleDevice() && screenWidth > <?php echo $responsiveMenuTriggerValue; ?>)){
						return true;
					}
					e.preventDefault(); 

					var href = jQuery(this).attr("href");
					var target = jQuery(this).attr("target");
					var link = jQuery(this);
					jQuery(this).attr("href","#");
					jQuery(this).attr("target","");
					
					jQuery(this).removeClass("firstClick");
					
					setTimeout(function(){
						link.attr("href",href);
						link.attr("target",target);
					},200);
					if(screenWidth > <?php echo $responsiveMenuTriggerValue; ?>){
						jQuery(this).children('ul').stop()[options.effect](options.speed);
					}			
					else
						jQuery(this).parent().find('ul:first:not(:visible)').stop(true,true)[options.effect](options.speed);
				});
				
				jQuery(window).resize(function(){
					var screenWidth = jQuery("body").width();
					if(screenWidth > <?php echo $responsiveMenuTriggerValue; ?>)
						jQuery("nav ul.navv").find("li > ul").prev().removeClass("firstClick");
					else
						jQuery("nav ul.navv").find("li > ul").prev().addClass("firstClick");
				});
				
		  	});  
	 	};  
	})(jQuery);

	jQuery(document).ready(function(){
		jQuery('.mnu_<?php echo $menu_name;?>').dropDownMenu_<?php echo $menu_name_correct;?>({
			speed: <?php echo $menu['animation_speed']; ?>,
			effect: '<?php echo $menu['animation_effect']; ?>'
      	});
		
			//hover menu fix	
		setTimeout(function(){
		  jQuery('#blocker').remove();
		  jQuery("nav ul.navv").find("li > ul").prev().addClass("firstClick");
		}, 1000)
		
		//first click for touchecren wide devices
		
	});
<?php	 
	}
}
?>
</script>  
<?php } ?>