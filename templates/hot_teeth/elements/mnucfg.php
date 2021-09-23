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

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Joomla.Framework
 * @subpackage	Form
 * @since		1.6
 */
class JFormFieldMnucfg extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'mnucfg';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
	    require_once JPATH_ADMINISTRATOR . '/components/com_menus/helpers/menus.php';
		$menuTypes	= MenusHelper::getMenuTypes();
		
	    $OUT= '';
	    ob_start();
		?>
		
		<!-- THESE ARE MODELS FOR PARAMETER PANELS OF MENU TYPES -->
		
		<!-- DROP-DOWN MENU -->
		<div formenu="navv" class="menu_parms_panel" style="display:none">

			<label><?php echo jText::sprintf('MNU_SHOW_MENU_NAME'); ?></label>
			<input parameter="show_menu_name_navv" type="hidden" class="flipyesno" value="0" autocomplete="off" />

		   	<h3>Menu Script Settings</h3>

			<label><?php echo jText::sprintf('MNU_ANIM_EFFECT'); ?></label>
			<select parameter="animation_effect">
				<option value="fadeToggle" selected="selected">Fade</option>
				<option value="slideToggle">Slide</option>
				<option value="toggle">Show</option>
				<option value="show(0)">None</option>
			</select>
			<label><?php echo jText::sprintf('MNU_ANIM_SPEED'); ?></label>
			<input parameter="animation_speed" type="number" value="300" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_ARROWS'); ?></label>
			<input parameter="arrows" type="hidden" class="flipyesno" value="0" autocomplete="off" />

			<h3>Dimensions and Padding</h3>

			<label><?php echo jText::sprintf('MNU_DROP_DOWN_ALIGNMENT'); ?></label>
			<select parameter="drop_down_alignment">
				<option value="left" selected="selected">Left</option>
				<option value="center">Center</option>
				<option value="right">Right</option>
			</select>
			<label><?php echo jText::sprintf('MNU_DROP_DOWN_BUTTON_HEIGHT'); ?></label>
			<input parameter="drop_down_button_height" type="number" value="30" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_DROP_DOWN_BUTTON_WIDTH'); ?></label>
			<input parameter="drop_down_button_width" type="number" value="0" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_DROP_DOWN_BUTTON_HORIZ_PADDING'); ?></label>
			<input parameter="drop_down_button_horiz_padding" type="number" value="15" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_DROP_DOWN_PANE_WIDTH'); ?></label>
			<input parameter="drop_down_pane_width" type="number" value="160" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_DROP_DOWN_PANE_PADDING'); ?></label>
			<input parameter="drop_down_pane_padding" type="number" value="12" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_DROP_DOWN_PANE_HEIGHT'); ?></label>
			<input parameter="drop_down_pane_height" type="number" value="25" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_DROP_DOWN_PANE_HORIZ_PADDING'); ?></label>
			<input parameter="drop_down_pane_horiz_padding" type="number" value="10" autocomplete="off" size="3" />

		   	<h3>Font Settings</h3>

			<label>Font Settings</label>
			<input parameter="font_family_hotfont_lbl" type="text" filter="raw" readonly="readonly"  value="Arial, Helvetica, sans-serif" autocomplete="off" />
			<input parameter="font_family_hotfont" json="true" filter="raw" type="hidden" value='{"fontFamily":"Arial, Helvetica, sans-serif","fontWeight":"normal","fontStyle":"normal"}' autocomplete="off" /> 
			<a class="modal btn system menu" title="Select" href="#system" rel="{size: {x: 800, y: 500}, onOpen: initializeForSystem}">System Fonts</a>	
			<a class="modal btn google menu" title="Select" href="#google" rel="{size: {x: 800, y: 500}, onOpen: initializeForGoogleMenu}">Google Fonts</a>
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_FONT_SIZE_LBL'); ?></label>
			<input parameter="font_size" type="number" value="14" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_TEXT_ALIGN_LBL'); ?></label>
			<select parameter="text_align">
				<option value="left" selected="selected">Left</option>
				<option value="center">Center</option>
				<option value="right">Right</option>
			</select>
		
			<label><?php echo jText::sprintf('MNU_TEXT_COLOR'); ?></label>
			<input parameter="text_color" value="#666666"  class="mini settings minicolors-theme-bootstrap" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_ACTIVE_TEXT_COLOR'); ?></label>
			<input parameter="active_text_color" value="#ffffff"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_LINKS_HOVER_COLOR'); ?></label>
			<input parameter="links_hover_color" value="#dddddd"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>

		   	<h3>Font Settings (Sublevels)</h3>
			
			<label>Font Settings</label>
			<input parameter="font_family_sub_hotfont_lbl" type="text" filter="raw" readonly="readonly"  value="Arial, Helvetica, sans-serif" autocomplete="off" />
			<input parameter="font_family_sub_hotfont" json="true" filter="raw" type="hidden" value='{"fontFamily":"Arial, Helvetica, sans-serif","fontWeight":"normal","fontStyle":"normal"}' autocomplete="off" /> 
			<a class="modal btn system menu" title="Select" href="#system" rel="{size: {x: 800, y: 500}, onOpen: initializeForSystem}">System Fonts</a>	
			<a class="modal btn google menu" title="Select" href="#google" rel="{size: {x: 800, y: 500}, onOpen: initializeForGoogleMenu}">Google Fonts</a>
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_FONT_SIZE_LBL'); ?></label>
			<input parameter="font_size_sub" type="number" value="12" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_TEXT_COLOR'); ?></label>
			<input parameter="text_color_sub" value="#666666"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_LINKS_HOVER_COLOR'); ?></label>
			<input parameter="links_hover_color_sub" value="#333333"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>

		   	<h3>Buttons and Panes Color</h3>
	
			

			<label><?php echo jText::sprintf('MNU_BUTTON_BG'); ?></label>
			<input parameter="button_bg" value="#dddddd"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_ACTIVE_BUTTON_BG'); ?></label>
			<input parameter="active_button_bg" value="#333333"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_BUTTON_HOVER_BG'); ?></label>
			<input  parameter="button_hover_bg" value="#666666"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_DROP_DOWN_PANE_BG'); ?></label>
			<input parameter="drop_down_pane_bg" value="#eeeeee"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_DROP_DOWN_PANE_HOVER_BG'); ?></label>
			<input parameter="drop_down_hover_bg" value="#e6e6e6"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>

			<h3>Borders</h3>

			<label><?php echo jText::sprintf('MNU_BORDER_SIZE_FIRST_LVL'); ?></label>
			<input parameter="border_size_first_lvl" type="number" value="1" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_BORDER_COLOR_FIRST_LVL'); ?></label>
			<input parameter="border_color_first_lvl" value="#cccccc"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_BORDER_SIZE_SUB_LVL'); ?></label>
			<input parameter="border_size_sub_lvl" type="number" value="1" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_BORDER_COLOR_SUB_LVL'); ?></label>
			<input parameter="border_color_sub_lvl" value="#dddddd"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>

		</div>
		<!-- END DROP-DOWN MENU -->
		 
		<!-- HORIZONTAL MENU -->
		<div formenu="navh" class="menu_parms_panel" style="display:none">
			<label><?php echo jText::sprintf('MNU_SHOW_MENU_NAME'); ?></label>
			<input parameter="show_menu_name_navv" type="hidden" class="flipyesno" value="0" autocomplete="off" />
			<label><?php echo jText::sprintf('MNU_ANIM_SPEED'); ?></label>
			<input parameter="animation_speed" type="number"  value="450" autocomplete="off" size="3" />

			<h3>First Level</h3>

			<label><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_HORIZONTAL_PANE_COLOR_LBL'); ?></label>
			<input parameter="tab_color" value="#dddddd"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_HORIZONTAL_PANE_HEIGHT_LBL'); ?></label>
			<input parameter="tab_height" type="number" value="40" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_HORIZONTAL_PADDING_LBL'); ?></label>
			<input parameter="horiz_button_padding" type="number" value="20" autocomplete="off" size="3" />
			
			<label>Font Settings</label>
			<input parameter="font_family_hotfont_lbl" type="text" filter="raw" readonly="readonly" value="Arial, Helvetica, sans-serif" autocomplete="off" />
			<input parameter="font_family_hotfont" json="true" filter="raw" type="hidden" value='{"fontFamily":"Arial, Helvetica, sans-serif","fontWeight":"normal","fontStyle":"normal"}' autocomplete="off" /> 
			
			<a class="modal btn system menu" title="Select" href="#system" rel="{size: {x: 800, y: 500}, onOpen: initializeForSystem}">System Fonts</a>
			
			<a class="modal btn google menu" title="Select" href="#google" rel="{size: {x: 800, y: 500}, onOpen: initializeForGoogleMenu}">Google Fonts</a>
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_FONT_SIZE_LBL'); ?></label>
			<input parameter="font_size" type="number"  value="14" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_TEXT_COLOR'); ?></label>
			<input parameter="text_color" value="#333333"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_BUTTON_BG'); ?></label>
			<input parameter="button_bg" value="#cccccc"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_LINKS_HOVER_COLOR'); ?></label>
			<input parameter="links_hover_color" value="#000000"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_BUTTON_HOVER_BG'); ?></label>
			<input parameter="button_hover_bg" value="#aaaaaa"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_ACTIVE_TEXT_COLOR'); ?></label>
			<input parameter="active_text_color" value="#FFFFFF"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_ACTIVE_BUTTON_BG'); ?></label>
			<input parameter="active_button_bg" value="#333333"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_BORDER_SIZE_FIRST_LVL'); ?></label>
			<input parameter="border_size_first_lvl" type="number" value="1" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_BORDER_COLOR_FIRST_LVL'); ?></label>
			<input parameter="border_color_first_lvl" value="#666666"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_BORDER_COLOR_ACTIVE'); ?></label>
			<input parameter="border_color_active" value="#333333"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_MARGIN_SIZE'); ?></label>
			<input parameter="margin_size" type="number" value="0" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_HORIZONTAL_BORDER_RADIUS'); ?></label>
			<input parameter="border_radius" type="number" value="0" autocomplete="off" size="3" />
			
			<h3>Second Level</h3>

			<label><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_HORIZONTAL_PANE_COLOR_LBL'); ?></label>
			<input parameter="tab_color_sub" value="#333333"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_HORIZONTAL_PANE_HEIGHT_LBL'); ?></label>
			<input parameter="tab_height_sub" type="number" value="25" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_HORIZONTAL_PADDING_LBL'); ?></label>
			<input parameter="horiz_button_padding_sub" type="number" value="15" autocomplete="off" size="3" />
		
			<label>Font Settings</label>
			<input parameter="font_family_sub_hotfont_lbl" type="text" filter="raw" readonly="readonly" value="Arial, Helvetica, sans-serif" autocomplete="off" />
			<input parameter="font_family_sub_hotfont" json="true" filter="raw" type="hidden" value='{"fontFamily":"Arial, Helvetica, sans-serif","fontWeight":"normal","fontStyle":"normal"}' autocomplete="off" /> 	
			<a class="modal btn system menu" title="Select" href="#system" rel="{size: {x: 800, y: 500}, onOpen: initializeForSystem}">System Fonts</a>	
			<a class="modal btn google menu" title="Select" href="#google" rel="{size: {x: 800, y: 500}, onOpen: initializeForGoogleMenu}">Google Fonts</a>
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_FONT_SIZE_LBL'); ?></label>
			<input parameter="font_size_sub" type="number" value="12" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_SUBMENU_TEXT_COLOR'); ?></label>
			<input parameter="text_color_sub" value="#dddddd"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_SUBMENU_TEXT_HOVER_COLOR'); ?></label>
			<input parameter="links_hover_color_sub" value="#ffffff"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>

			<h3>Third Level and Deeper</h3>

			<label><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_PANE_COLOR_LBL'); ?></label>
			<input parameter="tab_color_sub_sub" value="#782320"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_HORIZONTAL_PANE_WIDTH_LBL'); ?></label>
			<input parameter="tab_width_sub_sub" type="number" value="150" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_HORIZONTAL_PANE_PADDING_LBL'); ?></label>
			<input parameter="horiz_pane_padding_sub_sub" type="number" value="15" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_HORIZONTAL_MENU_ITEM_HEIGHT'); ?></label>
			<input parameter="horiz_pane_menu_item_height_sub_sub" type="number" value="20" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_FONT_SIZE_LBL'); ?></label>
			<input parameter="font_size_sub_sub" type="number"  value="11" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_SUBMENU_TEXT_COLOR'); ?></label>
			<input parameter="text_color_sub_sub" value="#ffffff"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_SUBMENU_TEXT_HOVER_COLOR'); ?></label>
			<input parameter="links_hover_color_sub_sub" value="#cccccc"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>

		</div>
		<!-- END HORIZONTAL MENU -->
		
		<!-- ACCORDION MENU-->
		<div formenu="acc" class="menu_parms_panel" style="display:none">
			<label><?php echo jText::sprintf('MNU_SHOW_MENU_NAME'); ?></label>
			<input parameter="show_menu_name_acc" type="hidden" class="flipyesno" value="0" autocomplete="off" />

			<h3>Menu Script Settings</h3>
			
			<label><?php echo jText::sprintf('MNU_ACCORDION_COLAPSIBLE'); ?></label>
			<input parameter="collapsible" type="hidden" class="flipyesno" value="1" autocomplete="off" />
			<label><?php echo jText::sprintf('MNU_ACCORDION_EQUAL_HEIGHT'); ?></label>
			<input parameter="equalheight" type="hidden" class="flipyesno" value="0" autocomplete="off" />
			<label><?php echo jText::sprintf('MNU_TRIGGER'); ?></label>
			<select parameter="trigger" >
				<option value="click" selected="selected">Click</option>
				<option value="mouseover">Mouse over</option>
			</select> 
			<label><?php echo jText::sprintf('MNU_ANIM_EFFECT'); ?></label>
			<select parameter="animation" >
				<option value="slide" selected="selected">Slide</option>
				<option value="bounceslide">Bounceslide</option>
			</select> 
			<label><?php echo jText::sprintf('MNU_ACCORDION_SUBPANEL_SLIDETO'); ?></label>
			<select parameter="subpanelslide">
				<option value="right" selected="selected">To Right</option>
				<option value="down">Drop</option>
			</select> 
			<label><?php echo jText::sprintf('MNU_ANIM_SPEED'); ?></label>
			<input parameter="animation_speed" type="number"  value="450" autocomplete="off" size="3" />

			<h3>Font Settings</h3>

			<label>Font Settings</label>
			<input parameter="font_family_hotfont_lbl" type="text" filter="raw" readonly="readonly" value="Arial, Helvetica, sans-serif" autocomplete="off" />
			<input parameter="font_family_hotfont" json="true" filter="raw" type="hidden" value='{"fontFamily":"Arial, Helvetica, sans-serif","fontWeight":"normal","fontStyle":"normal"}' autocomplete="off" /> 
			
			<a class="modal btn system menu" title="Select" href="#system" rel="{size: {x: 800, y: 500}, onOpen: initializeForSystem}">System Fonts</a>
			
			<a class="modal btn google menu" title="Select" href="#google" rel="{size: {x: 800, y: 500}, onOpen: initializeForGoogleMenu}">Google Fonts</a>
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_FONT_SIZE_LBL'); ?></label>
			<input parameter="font_size" type="number" value="12" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_TEXT_COLOR'); ?></label>
			<input parameter="text_color" value="#FFFFFF"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_LINKS_HOVER_COLOR'); ?></label>
			<input parameter="links_hover_color" value="#FFFFFF"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_FONT_SIZE_SUB_LBL'); ?></label>
			<input parameter="font_size_sub" type="number" value="12" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_TEXT_COLOR_SUB'); ?></label>
			<input parameter="text_color_sub" value="#FFFFFF"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_LINKS_HOVER_COLOR_SUB'); ?></label>
			<input parameter="links_hover_color_sub" value="#ffffff"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>

			<h3>Accordion Layout and Style</h3>
			
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_ACCORDION_PANE_BG'); ?></label>
			<input parameter="accordion_pane_bg" value="#a0deb1" placeholder="#rrggbb" class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false">
			
			
			
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_ACCORDION_PANE_BORDER_COLOR'); ?></label>
			<input parameter="accordion_pane_border_color" value="#000000"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_ACCORDION_PANE_BORDER_SIZE'); ?></label>
			<input parameter="accordion_pane_border_size" type="number" value="1" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_ACCORDION_PANE_BORDER_RADIUS'); ?></label>
			<input parameter="accordion_pane_border_radius" type="number" value="5" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_SUBMENU_TEXT_HOVER_COLOR'); ?></label>
			<input parameter="submenu_text_hover_color" value="#ffffff"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>

		</div>
		<!-- END ACCORDION MENU -->
		
		<!-- JOOMLA STANDARD MENU -->
		<div formenu="standard" class="menu_parms_panel" style="display:none">
		    
		    <label><?php echo jText::sprintf('MNU_SHOW_MENU_NAME'); ?></label>
			<input parameter="show_menu_name_standard" type="hidden" class="flipyesno" value="0" autocomplete="off" />
			<label><?php echo jText::sprintf('MNU_DIRECTION'); ?></label>
			<select parameter="direction">
				<option value="vertical" selected="selected">Vertical</option>
				<option value="horizontal">Horizontal</option>
			</select> 
			
			<h3>Main Level</h3>

			<label>Font Settings</label>
			<input parameter="font_family_hotfont_lbl" type="text" filter="raw" readonly="readonly" value="Arial, Helvetica, sans-serif" autocomplete="off" />
			<input parameter="font_family_hotfont" json="true" filter="raw" type="hidden" value='{"fontFamily":"Arial, Helvetica, sans-serif","fontWeight":"normal","fontStyle":"normal"}' autocomplete="off" /> 
			
			<a class="modal btn system menu" title="Select" href="#system" rel="{size: {x: 800, y: 500}, onOpen: initializeForSystem}">System Fonts</a>
			
			<a class="modal btn google menu" title="Select" href="#google" rel="{size: {x: 800, y: 500}, onOpen: initializeForGoogleMenu}">Google Fonts</a>
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_FONT_SIZE_LBL'); ?></label>
			<input parameter="font_size" type="number" value="14" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_TEXT_ALIGN_LBL'); ?></label>
			<select parameter="text_align">
				<option value="left" selected="selected">Left</option>
				<option value="center">Center</option>
				<option value="right">Right</option>
			</select>

			<label><?php echo jText::sprintf('MNU_TEXT_COLOR'); ?></label>
			<input parameter="text_color" value="#666666"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_LINKS_HOVER_COLOR'); ?></label>
			<input parameter="links_hover_color" value="#333333"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_VERTICAL_PADDING'); ?></label>
			<input parameter="vertical_padding" type="number" value="5" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_HORIZONTAL_PADDING'); ?></label>
			<input parameter="horizontal_padding" type="number" value="0" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('MNU_BOTTOM_MARGIN'); ?></label>
			<input parameter="bottom_margin" type="number" value="5" autocomplete="off" size="3" />

			<h3>Sub-Levels</h3>
			

			<label>Font Settings</label>
			<input parameter="font_family_sub_hotfont_lbl" type="text" filter="raw" readonly="readonly" value="Arial, Helvetica, sans-serif" autocomplete="off" />
			<input parameter="font_family_sub_hotfont" json="true" filter="raw" type="hidden" value='{"fontFamily":"Arial, Helvetica, sans-serif","fontWeight":"normal","fontStyle":"normal"}' autocomplete="off" /> 
			
			<a class="modal btn system menu" title="Select" href="#system" rel="{size: {x: 800, y: 500}, onOpen: initializeForSystem}">System Fonts</a>
			
			<a class="modal btn google menu" title="Select" href="#google" rel="{size: {x: 800, y: 500}, onOpen: initializeForGoogleMenu}">Google Fonts</a>			
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_FONT_SIZE_LBL'); ?></label>
			<input parameter="font_size_sub" type="number" value="11" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_TEXT_ALIGN_LBL'); ?></label>
			<select parameter="text_align_sub">
				<option value="left" selected="selected">Left</option>
				<option value="center">Center</option>
				<option value="right">Right</option>
			</select>

			<label><?php echo jText::sprintf('MNU_TEXT_COLOR'); ?></label>
			<input parameter="text_color_sub" value="#782320"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_LINKS_HOVER_COLOR'); ?></label>
			<input parameter="links_hover_color_sub" value="#333333"  class="mini settings" data-position="right" data-control="hue" size="7" maxlength="7" aria-invalid="false"/>
			<label><?php echo jText::sprintf('MNU_MARGIN_SIZE'); ?></label>
			<input parameter="margin_sub" type="number" value="10" autocomplete="off" size="3" />
			<label><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_HORIZONTAL_MENU_ITEM_HEIGHT'); ?></label>
			<input parameter="subitem_height" type="number" value="15" autocomplete="off" size="3" />

		</div>
		<!-- END JOOMLA STANDARD MENU -->
		
		<!-- PARAMETER PANELS END -->
		
	    <input type="hidden" name="<?php echo $this->name; ?>" id="<?php echo $this->id; ?>" value="" />
		<script type="text/javascript">
		    var mcfg = <?php echo $this->value ? $this->value : "[]"; ?>;
			var current = mcfg;
			jQuery("#<?php echo $this->id; ?>").val(JSON.stringify(mcfg));
		</script>
		<div id="mnupanel<?php echo $this->id; ?>">
			<p><?php echo jText::sprintf('TPL_HOT_TEETH_MENU_NAME_CLICK'); ?></p>

			<?php	
			foreach ($menuTypes as $menutype) {

				// Get title of the menu from db per menutype
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query->select($db->quoteName('title'));
				$query->from($db->quoteName('#__menu_types'));
				$query->where($db->quoteName('menutype') . ' LIKE '. $db->quote($menutype));
				$db->setQuery($query);
				$menu_name = $db->loadResult();
			?>

			<h4 class="menusSettingsTab"><?php echo $menu_name; ?></h4>
			<div class="menusSettingsContainer">
				<select menu="<?php echo $menutype;?>" class="MenuTypeSelect">
				<option value="navv" ><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_DROPDOWN');?></option>
				<option value="navh" ><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_HOR');?></option>
				<option value="acc" ><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_ACC');?></option>
				<option value="standard" ><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_CLASSIC');?></option>
				<option value="none" ><?php echo jText::sprintf('TPL_HOT_TEETH_MNU_NONE');?></option>
				</select>
				<div class="menusSettingsField"></div>
				<div class="clr"></div>
			</div>
		<?php
		}
		?>
		</div>

	    <script type="text/javascript">
			window.setTimeout(function(){ 
				window.loadMenuPanel<?php echo $this->id; ?> = function(fobject,menu_type,sparms) {
				    if(!menu_type){
						menu_type = fobject.val();  
					}
						 
					var panel = fobject.parent().find('DIV').first();
			 
					if(!jQuery('.menu_parms_panel[formenu="' + menu_type + '"]')[0]) {
						panel.html("");
						fobject.val("none");
						return;	
					}
			
					panel.html(jQuery('.menu_parms_panel[formenu="' + menu_type + '"]').html());
				 
					try{

						if(!sparms){
							sparms = window.getMenuParms<?php echo $this->id; ?>(fobject);
						}
						var mnu_parms = (typeof sparms === 'object') ? sparms : eval("(" + sparms + ")");
						
						for(var prop in mnu_parms){
						   if(mnu_parms.hasOwnProperty(prop)){
							   panel.find('*[parameter="'+ prop +'"]').val(mnu_parms[prop]);
						   } 	
						}
						/*
						var mnu_parms = sparms.split('~');
						for(var j = 0; j < mnu_parms.length ; j++){
							var parm =  mnu_parms[j].split(':')[0];
							var pval =  mnu_parms[j].split(':')[1];
							panel.find('*[parameter="'+ parm +'"]').val(pval);
						}*/

					}catch(e){}	
	            
					panel.find('.flipyesno').each(function(ind){
					    window.createFlipYesNo(jQuery(this));
				    });
				
				};

	        	window.getMenuParms<?php echo $this->id; ?> = function(fobject){
					var panel = fobject.parent().find('DIV').first();
					var sparms = {};
	            	panel.find('select, input, textarea').each(function(IndP){
					   sparms[jQuery(this).attr('parameter')] = jQuery(this).val();
					   
					   //if(sparms != "") sparms += '~';
						//sparms += (jQuery(this).attr('parameter') + ":" + jQuery(this).val());
						/*if(jQuery(this).attr('id')=='font_hot_breakpoint')
							console.log(jQuery(this).attr('value'));*/
					});            
	  				return sparms;
				};  

				window.lastsaveMenuParmsTime = 0;
				
	        	window.saveMenuParms<?php echo $this->id; ?> = function(){
					
					if(window.lastsaveMenuParmsTime + 200 > new Date().getTime())
						return;
					
					window.lastsaveMenuParmsTime = new Date().getTime();
					
					var newVal = [];
					
			        jQuery("#mnupanel<?php echo $this->id; ?> .MenuTypeSelect").each(function(ind){
						
						var mnu    = {};
						mnu.name   = jQuery(this).attr("menu");
						mnu.type   = jQuery(this).val();
						mnu.config = window.getMenuParms<?php echo $this->id; ?>(jQuery(this));
						newVal.push(mnu);
					   //if(newVal != "")newVal += "&";
					   //newVal += (jQuery(this).attr("menu") + "=" + jQuery(this).val() + "=" + window.getMenuParms<?php echo $this->id; ?>(jQuery(this))); 
					});
					
					current = newVal;
					
			        jQuery("#<?php echo $this->id; ?>").val( JSON.stringify( newVal ))  ;
				};		

                window.save_menu_cfg_fn = window.saveMenuParms<?php echo $this->id; ?>; 				
			  
				jQuery("#mnupanel<?php echo $this->id; ?> .MenuTypeSelect").each(function(indx){
					window.loadMenuPanel<?php echo $this->id; ?>(jQuery(this),'none',null);
				});
			  
	        	var vals = mcfg;
				
				for(var i = 0; i < vals.length ; i++){
					
					var mnu       = vals[i].name;
					var mnu_val   = vals[i].type;
					if(mnu_val == "") mnu_val = "standard";

					var fobject = jQuery('#mnupanel<?php echo $this->id; ?> select[menu="' + mnu + '"]');
					fobject.val(mnu_val);
					
					window.loadMenuPanel<?php echo $this->id; ?>(fobject,mnu_val,vals[i].config);
				}
				

				jQuery("#mnupanel<?php echo $this->id; ?> .MenuTypeSelect").change(function(){
					window.loadMenuPanel<?php echo $this->id; ?>(jQuery(this),null,null);   				
				});
				
				window.setInterval(function(){
					window.saveMenuParms<?php echo $this->id; ?>();
				},200);
				
	 
			},150);
	  	</script>

		<?php
		$OUT = ob_get_contents();
        ob_end_clean();		
        
		return $OUT;
	}
}

?>