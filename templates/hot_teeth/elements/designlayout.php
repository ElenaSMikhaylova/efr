<?php
/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2015 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

defined('JPATH_BASE') or die;
jimport('joomla.form.formfield');
JHtml::_('behavior.modal', 'a.modal');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Joomla.Framework
 * @subpackage	Form
 * @since		1.6
 */
class JFormFieldDesignLayout extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'designlayout';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
        $OUT= '';
	    ob_start();
		?>
		<div id="layoutdesigner<?php echo $this->id; ?>">
			<input type="hidden" name="<?php echo $this->name; ?>" id="<?php echo $this->id; ?>" value="<?php echo $this->value; ?>" />
			<table class="layoutDesigner">
				<tr>
					<td class="ui-state-default" style="background-position: 50% 0;">
		    			<ul class="toolBox">
	        				<li class="edit_row" id="layout_addRow" style="background-position: 50% 0;">
								<span class="caption" ><?php echo jText::sprintf('TPL_HOT_TEETH_ADD_ROW') ;?></span>
 			    				<table cellpadding="0" cellspacing="0">
									<tr>
                						<td>	
				    						<table cellpadding="0" cellspacing="0">
				    							<tr>
				    								<td>
				    									<a href="#" class="deleteRow"></a>
				    								</td>
				    								<td>
				    									<span><?php echo jText::sprintf('TPL_HOT_TEETH_NAME') ;?></span>
				    								</td>
				    								<td>
				    									<input type="text" class="layoutrow_name" value="" />
				    								</td>
				    							</tr>
                    							<tr>
                    								<td>
                    								</td>
                    								<td>
                    									<span><?php echo jText::sprintf('TPL_HOT_TEETH_CLASS') ;?></span>
                    								</td>
                    								<td>
                    									<input type="text" class="layoutrow_class" value="" />
                    								</td>
                    							</tr>					 
											</table>
										</td>
										<td>
											<div class="layout_row_container">
	                    						<ul class="layout_row">
	                    						</ul>
                							</div>					
										</td>
									</tr>
								</table>
							</li>
							<li class="ui-state-default" style="background-position: 50% 0;">
			    				<span class="caption"><?php echo jText::sprintf('TPL_HOT_TEETH_UNASSIGNED_MODULE_POSITIONS'); ?></span>
			    				<ul class="unassignedPositions drag_module_positions" >
									<?php
										global $tadmin_mpos;
										global $tadmin_menus;
										// listing of CONTENT on Layout builder
										echo '<li wX="1" off="0" mp="joom_content" class="mpos_draggable cpos"><span>'.jText::sprintf('TPL_HOT_TEETH_CONTENT_BOX').'</span><div class="clr"></div><a title="Move left" href="javascript:void(0);" class="off_left"></a><a title="Move right" href="javascript:void(0);" class="off_right"></a></li>';
										// listing of all module positions and sparky elements on Layout builder
										foreach($tadmin_mpos as $mpos){
											if($mpos!="abovecontent" && $mpos!="belowcontent") {
										  		echo '<li wX="1" off="0" mp="'.$mpos.'" class="mpos_draggable '.$mpos.'"><span>'.$mpos.'</span><div class="clr"></div><a title="Move left" href="javascript:void(0);" class="off_left"></a><a title="Move right" href="javascript:void(0);" class="off_right"></a></li>';
											}
										}
										// listing of menus on Layout builder
										foreach($tadmin_menus as $mpos){
										  	echo '<li wX="1" off="0" mp="'.$mpos.'" class="mpos_draggable sparky_menu '.$mpos.'"><span>'.$mpos.'</span><div class="clr"></div><a title="Move left" href="javascript:void(0);" class="off_left"></a><a title="Move right" href="javascript:void(0);" class="off_right"></a></li>';
										}				
								    ?>
								</ul>
							</li>
            			</ul>
					</td>
				</tr>
				<tr>
					<td>
						<div class="LayoutModel">
							<ul id="sortable">
							</ul>
						</div>
						<div class="sparky_legend"><span class="cpos"></span> <?php echo jText::sprintf('TPL_HOT_TEETH_MAIN_CONTENT'); ?> <span class="modulepositions"></span> <?php echo jText::sprintf('TPL_HOT_TEETH_MODULE_POSITIONS'); ?> <span class="sparky_menu"></span> <?php echo jText::sprintf('TPL_HOT_TEETH_MENUS_LEGEND'); ?> <span class="sparkyfeatures"></span> <?php echo jText::sprintf('TPL_HOT_TEETH_SPARKY_FEATURES'); ?></div>
					</td>
				</tr>
			</table>
		<script type="text/javascript">
			var currentGrid = 0;
			var changed = false;
			var gridSize = {
				"1":"800",
				"2":"399",
				"3":"265",
				"4":"198",
				"5":"158",
				"6":"131",
				"7":"112",
				"8":"98",
				"9":"87",
				"10":"78",
				"11":"70",
				"12":"64",
				"13":"59",
				"14":"55",
				"15":"51",
				"16":"49",
				"17":"45",
				"18":"42",
				"19":"40",
				"20":"38",
				"21":"36",
				"22":"34",
				"23":"32",
				"24":"30",
				
			};
			jQuery(document).ready(function(){
				currentGrid = parseInt(jQuery("#jform_params_gridSystem").val());
				jQuery(".LayoutModel").addClass("grid"+currentGrid);
				
				jQuery('.width_value input').each(function(ind){
				var WIDTH_ID = jQuery(this).attr('id');
				if(WIDTH_ID=="jform_params_gridSystem"){
					jQuery("#width" + WIDTH_ID).slider({
					value:jQuery(this).val(),
					min: 1,
					max: 24,
					step: 1,
					slide: function( event, ui ) {
						jQuery("#" + WIDTH_ID).val(  ui.value ).trigger('change');
						jQuery("#disp" + WIDTH_ID).html( ui.value );
					},
					change: function( event, ui ) {
						if(parseInt(jQuery("#jform_params_gridSystem").val())!=currentGrid){
							if(confirm("<?php echo jText::sprintf('TPL_HOT_TEETH_GRID_CONFIRM') ;?>")){
									jQuery('#sortable > .edit_row').each(function(){
										jQuery(this).find('.mpos_draggable').appendTo(jQuery('#layoutdesigner<?php echo $this->id; ?> .unassignedPositions'));
										jQuery(this).remove();
									});
									pushObjectLayout();
									setTimeout(function(){
										jQuery("#toolbar-apply button").click();
									},300);
								}
						  else{
							  jQuery("#jform_params_gridSystem").val(currentGrid);
							  jQuery("#width" + WIDTH_ID).slider( "option", "value", currentGrid );
							  jQuery("#dispjform_params_gridSystem").html(currentGrid);
						  }
						}
					},
					orientation: "horizontal"
				});
				}	
			});
				
	
			});
			window.setTimeout(function(){
				
				var gridSystem = parseInt(jQuery("#jform_params_gridSystem").val());
				var min = parseInt(gridSize[gridSystem]);
				jQuery(".layout_row").css("background-size",gridSystem*(min+2)+"px auto");
				
				var css = '.mpos_draggable {width:'+min+'px;}',
				head = document.head || document.getElementsByTagName('head')[0],
				style = document.createElement('style');

				style.type = 'text/css';
				if (style.styleSheet){
				  style.styleSheet.cssText = css;
				} else {
				  style.appendChild(document.createTextNode(css));
				}

				head.appendChild(style);
				
		        if(window.layoutEditorLoaded<?php echo $this->id; ?>){ 
					return;
				}
				window.layoutEditorLoaded<?php echo $this->id; ?> = true;
				
				jQuery( "#layoutdesigner<?php echo $this->id; ?> #sortable" ).sortable({
					revert: true,
					receive: function(event, ui) { 
				     window.hookRowEvents<?php echo $this->id; ?>(); 
					}
				});
				
				jQuery( "#layoutdesigner<?php echo $this->id; ?> #layout_addRow" ).click(function(){
				     var row = jQuery('#layoutdesigner<?php echo $this->id; ?> #layout_addRow').clone(false).first();
					 row.removeAttr('id');
					 row.removeClass('ui-state-hover');
					 jQuery('#layoutdesigner<?php echo $this->id; ?> #sortable').append(row);
					 window.hookRowEvents<?php echo $this->id; ?>();
					 pushObjectLayout();
				});
				
				jQuery( "#layoutdesigner<?php echo $this->id; ?> ul, #layoutdesigner<?php echo $this->id; ?> li" ).disableSelection();
				
				jQuery('#layoutdesigner<?php echo $this->id; ?> #layout_addRow').button({ text: true, icons: { primary: 'ui-icon-plusthick'} });
				
			    jQuery('#layoutdesigner<?php echo $this->id; ?> .off_left').addClass('ui-widget-content ui-icon ui-icon-triangle-1-w');
				jQuery('#layoutdesigner<?php echo $this->id; ?> .off_right').addClass('ui-widget-content ui-icon ui-icon-triangle-1-e');
				
				
				jQuery('#layoutdesigner<?php echo $this->id; ?> .off_left').click(function(){
				  if(jQuery(this).parent().parent().hasClass('layout_row')){
				     if(parseInt(jQuery(this).parent().css('marginLeft')) > 10){
						 var off = parseInt(jQuery(this).parent().attr('off'));
						 jQuery(this).parent().attr('off',off - 1);
						 jQuery(this).parent().css('marginLeft', String((off - 1) * (min+2)-2) + 'px' );
					 }
				  }
				});
				
				jQuery('#layoutdesigner<?php echo $this->id; ?> .off_right').click(function(){
					if(jQuery(this).parent().parent().hasClass('layout_row')){
				    	var totalRowW = 0;
						jQuery(this).parent().parent().find('.mpos_draggable').each(function(ind){
							totalRowW += (jQuery(this).outerWidth() + parseInt(jQuery(this).css('marginLeft')));
						});
					 
						if(totalRowW + min < 804){
							var off = parseInt(jQuery(this).parent().attr('off'));
							jQuery(this).parent().attr('off',off + 1);
							jQuery(this).parent().css('marginLeft', String((off + 1) * min +2*off+1) + 'px' );
						}
				  	}
					pushObjectLayout();
				}); 
				
 			    jQuery('#layoutdesigner<?php echo $this->id; ?> .unassignedPositions').sortable({
					connectWith: "#layoutdesigner<?php echo $this->id; ?> .drag_module_positions",
					revert: true,
					tolerance: "touch"
			    }).disableSelection();
		 
        	window.hookRowEvents<?php echo $this->id; ?> = function(){
				
				
				
		    	jQuery('#layoutdesigner<?php echo $this->id; ?> .LayoutModel .edit_row:not([hooked])').each(function(ind){
			    	jQuery(this).attr('hooked',true);
				 
					jQuery(this).find('.deleteRow')
						.button({ text: true, icons: { primary: 'ui-icon-closethick'} })
						.click(function(){
							if(confirm("<?php echo jText::sprintf('TPL_HOT_TEETH_DELETE_ROW_CONFIRM') ;?>")){
								var r_el = jQuery(this).closest('.edit_row');
								r_el.find('.mpos_draggable').appendTo(jQuery('#layoutdesigner<?php echo $this->id; ?> .unassignedPositions'));
								r_el.remove();
								pushObjectLayout();
							}
						});
				 
					jQuery(this).find('.layout_row').attr('id','ID_' + String(Math.floor(Math.random()*1000000)));
                	jQuery(this).find('.layout_row').addClass('drag_module_positions');
					jQuery(this).find('.layout_row').sortable({
						connectWith: "#layoutdesigner<?php echo $this->id; ?> .drag_module_positions",
						revert: 100,
						tolerance: "touch", 
						receive: function(event, ui) { 
						
	  				    	ui.item.css('marginLeft',0);
							ui.item.attr('off',0);
							var totalRowW = 0;
							ui.item.parent().find('.mpos_draggable').each(function(ind) {
						    	totalRowW += jQuery(this).outerWidth();
							});
							var cells = Math.round(ui.item.innerWidth() / (min + 2));
							var diff =  Math.round(( getRowWidth() - totalRowW ) / (min + 2));
							
							var grw = getRowWidth();
							
							if(totalRowW > grw) {
								
								var avail = (grw - (totalRowW - ui.item.outerWidth()));
								
								if( avail >= min) {							
									ui.item.innerWidth((cells - Math.abs(diff)) * min + 10 );	
	                        		ui.item.attr('wX', (cells - Math.abs(diff)));					
									
								}else{
						    		ui.item.appendTo(ui.sender);			
								}
							}
						},
						update: function(){
						pushObjectLayout();
					}
					}).disableSelection();
				});
			}
		   
			window.save_layout<?php echo $this->id; ?> = function (){
		    	var serialised = '';
		    	jQuery('#layoutdesigner<?php echo $this->id; ?> .LayoutModel .edit_row').each(function(ind){
			    	var entry = 	jQuery(this).find('.layoutrow_name').first().val() + '+' +
									jQuery(this).find('.layoutrow_class').first().val() + '+';
					var mposs = '';
					jQuery(this).find('.mpos_draggable').each(function(index){
				    	if(mposs != ''){
							mposs = mposs + ',';
						}
						mposs = mposs + jQuery(this).attr('mp') + '=' + jQuery(this).attr('wX') + '=' + jQuery(this).attr('off');
					});			 
					entry += mposs;
					if(serialised != ''){
						serialised = serialised + '&';
					}
					serialised = serialised + entry;
				});
            	jQuery('#<?php echo $this->id; ?>').val(serialised);
			}
		   
			window.load_layout<?php echo $this->id; ?> = function(passed){
		    	try{
					jQuery(".LayoutModel .mpos_draggable").appendTo('.unassignedPositions');
					jQuery(".LayoutModel .edit_row").remove();
					if(typeof passed === 'undefined')
						var value = jQuery('#<?php echo $this->id; ?>').val().split('&');
					else
						var value = passed.split('&');
					for(var i = 0; i < value.length;i++){
						value[i] = value[i].split('+');
						value[i][2] = value[i][2].split(',');
						var row = jQuery('#layoutdesigner<?php echo $this->id; ?> #layout_addRow').clone(false).first();
						row.removeAttr('id');
						jQuery('#layoutdesigner<?php echo $this->id; ?> #sortable').append(row);
						row.find('.layoutrow_name').first().val(value[i][0]);
						row.find('.layoutrow_class').first().val(value[i][1]);	

						for(var j = 0; j < value[i][2].length;j++){
						    var pName  = value[i][2][j].split('=')[0];
							var pWidth = parseInt(value[i][2][j].split('=')[1]);
							var pOff   = parseInt(value[i][2][j].split('=')[2]);
						
							if(String(pWidth) == 'NaN')pWidth = 0;
							if(String(pOff) == 'NaN')pOff = 0;
						
							var box = null;
							box = jQuery('#layoutdesigner<?php echo $this->id; ?> .unassignedPositions .mpos_draggable[mp="' + pName + '"]');
						    box.appendTo(row.find('.layout_row').first());
							box.attr('wX',pWidth);
							box.attr('off',pOff);
						
							box.innerWidth(pWidth * min - 2);
							box.css('marginLeft',String(pOff * min) + 'px');
						}
					}
					window.hookRowEvents<?php echo $this->id; ?>();
            	}catch(ex){
				}
			   
			window.setInterval( function(){
				try{
				jQuery('#layoutdesigner<?php echo $this->id; ?> .unassignedPositions .mpos_draggable').resizable( "disable" );
				}
				catch(e1){
					
				}
				jQuery('#layoutdesigner<?php echo $this->id; ?> .unassignedPositions .mpos_draggable').css({'width':'70px'});
				jQuery('#layoutdesigner<?php echo $this->id; ?> .unassignedPositions .mpos_draggable').css({'width':'auto'});
				try{
				jQuery('#layoutdesigner<?php echo $this->id; ?> .LayoutModel .mpos_draggable').resizable( "enable" );
				
				}
				catch(e2){
					
				}
					
			    if( jQuery('#layoutdesigner<?php echo $this->id; ?> #sortable .edit_row').length == 0){
					if( jQuery('#layoutdesigner<?php echo $this->id; ?> #sortable .initialRow').length == 0){
						jQuery('#layoutdesigner<?php echo $this->id; ?> #sortable').append(jQuery('<li class="initialRow"><?php echo jText::sprintf('TPL_HOT_TEETH_ADD_DRAG'); ?></li>')); 
						}
					}else{
					    if( jQuery('#layoutdesigner<?php echo $this->id; ?> #sortable .initialRow').length > 0){
							jQuery('#layoutdesigner<?php echo $this->id; ?> #sortable .initialRow').remove();
						}
					}
			    	window.save_layout<?php echo $this->id; ?>();
				},350);
			}
			
			function getRowWidth(){
				return gridSystem * (min + 2) - 2;
			}
		   
			window.load_layout<?php echo $this->id; ?>();
		    	jQuery('#layoutdesigner<?php echo $this->id; ?> .mpos_draggable').resizable({
					maxHeight: 48,
					maxWidth: getRowWidth(),
					minHeight: 48,
					minWidth: min,
					grid: min+2,
					handles: 'e',
					create: function(){
						var cells = Math.round(jQuery(this).innerWidth()/min);
						if(cells>1){
							jQuery(this).innerWidth(cells*(min + 2) -2);
						}
						else{
							jQuery(this).innerWidth(min);
						}
						
					},
					stop: function(event, ui) { 
						var cells =Math.round(jQuery(this).innerWidth() / (min+2));
						jQuery(this).attr('wX', cells);
						jQuery(this).innerWidth(cells*(min + 2) - 2);
 
						if(jQuery(this).parent().hasClass('layout_row')){
					    	var RowTotalW = 0;
							jQuery(this).parent().find('.mpos_draggable').each(function(ind){
								RowTotalW += jQuery(this).outerWidth();
							});
							
							var diff =  Math.round(( getRowWidth() - RowTotalW ) / (min+2));
							
							if(RowTotalW > getRowWidth()){
	
                        		jQuery(this).innerWidth( (cells - Math.abs(diff)) * (min + 2) -2 )  ;		
                        		jQuery(this).attr('wX', (cells - Math.abs(diff)));						  
							}
						}
						pushObjectLayout();
					}
				});
		  	},300);
  
		</script>
		 
		</div> 
		 
	<?php
		$OUT = ob_get_contents();
    	ob_end_clean();		
    	return $OUT;
	}
}
