<?php
/**
 * @version       v1.0.2 Auto Update for Joomla 3 $
 * @package       Auto Update for Joomla 3
 * @copyright     Copyright © 2015 JoomlaShowroom.com - All rights reserved.
 * @license       GNU/GPL       
 * @author        JoomlaShowroom.com
 * @author mail   info@JoomlaShowroom.com
 * @website       http://JoomlaShowroom.com
*/

//--No direct access
defined('_JEXEC') or die('Resrtricted Access');
// DS has removed from J 3.0
if(!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
static $version;
$extension = 'com_autoupdate';
$lang = JFactory::getLanguage();
$source = JPATH_ADMINISTRATOR . '/components/' . $extension;
$lang->load("$extension.sys", JPATH_ADMINISTRATOR, null, false, false)
  ||    $lang->load("$extension.sys", $source, null, false, false)
  ||    $lang->load("$extension.sys", JPATH_ADMINISTRATOR, $lang->getDefault(), false, false)
  ||    $lang->load("$extension.sys", $source, $lang->getDefault(), false, false);

    JToolBarHelper::title( JText::_( 'COM_AUTOUPDATE_TITLE' ), 'generic.png' );
    JToolbarHelper::preferences('com_autoupdate');
?>
<div class="well">
   <?php
    echo JText::_('AUTO_UPDATE_WELCOME');
    echo JText::_('AUTO_UPDATE_WELCOME_SUB' );
    echo JText::_('AUTO_UPDATE_INFORMATIONS');
    echo JText::_('AUTO_UPDATE_INSTRUCTIONS');
    echo JText::_('AUTO_UPDATE_NOTIFICATIONS' );
    echo JText::_("AUTO_UPDATE_CRON_DESC");
    echo JText::_("AUTO_UPDATE_CRON" );
	?>
    <a href="<?php echo JURI::root(); ?>index.php?option=com_autoupdate&task=getUpdate" class="btn btn-success" target="_blank"><?php echo JText::_("AUTO_UPDATE_CRON_URL" );?></a><br /><br />
   <pre><?php echo JURI::root(); ?>index.php?option=com_autoupdate&task=getUpdate</pre>
    <?php
    echo JText::_("AUTO_UPDATE_SUGGESTIONS");
	echo '<p>&nbsp;</p>';
	$info = array();
    $xml=JFactory::getXML(JPATH_ADMINISTRATOR.DS.'components'.DS.$extension.DS.'com_autoupdate.xml');
	$version=(string)$xml->version;
	// Get installed version
	$info['version_installed']=$version;
	 // Get latest version
  //  $manifest=JFactory::getXML('http://joomlashowroom.com/media/versionsxml/extension_versions.xml');
	   $manifest= simplexml_load_file('http://www.joomlashowroom.com/updates_xml/autoupdate3.xml');
	//echo '<pre>';print_r($manifest)."gffu"; die;
	if(count($manifest)) {
   /* $i=0;
		foreach($manifest->children() as $child) {
			$c = count($child->extension); 
			$c = $c-1;
			if($i==0) {
				$string = $child->extension[$c];
				if($string->attributes()->{'name'}=="auto update core")
					{
				$info['version_latest'] = $string->attributes()->{'version'};
			}
			}
			$i++;
		}*/
		$info['version_latest'] = $manifest->version;
	}
	// Set the version status
	$info['version_status'] = version_compare($info['version_installed'], $info['version_latest']);
	$info['version_enabled'] = 1;
	if(is_array($info) && count($info) > 0) {
	
		echo "<table width='100%' style ='margin-bottom: 0px; width: 100%; '>";
		if($info['version_status'] == -1) {
			// Version output in red			
			echo "<tr><td width='40%'><img src='".JUri::root()."administrator/components/com_autoupdate/assets/images/upgrade1.png' border='0' align='middle' /></td>";		
			echo  '<td>'.JText::_('PRODUCT_VERSION_UPDATE_TEXT').'<br/><a href="http://www.joomlashowroom.com" target="_blank"><input type="button" value="'.JText::_('PRODUCT_VERSION_UPDATE').'"/> </a></td></tr>';
			
			echo "<tr><td>".JText::_('PRODUCT_INSTALLED_VERSION')."</td>";
			echo "<td>".$info['version_installed']."</td></tr>";							
			echo "<tr><td>".JText::_('PRODUCT_AVALIABLE_VERSION')."</td>";
			echo "<td>".$info['version_latest']."</td></tr>";		
		}else{						 						
			echo "<tr><td width='40%'>".JText::_('PRODUCT_VERSION_UPTODATE')."</td>";
			echo "<td><img src='".JUri::root()."administrator/components/com_autoupdate/assets/images/tick.png' border='0' align='middle' /></td></tr>";		
			echo "<tr><td>".JText::_('PRODUCT_INSTALLED_VERSION')."</td>";
			echo "<td>".$info['version_installed']."</td></tr>";							
			echo "<tr><td>".JText::_('PRODUCT_AVALIABLE_VERSION')."</td>";
			echo "<td>".$info['version_latest']."</td></tr>";			
		}
		echo "</table>";
	}
   echo '<p>&nbsp;</p>';
	
?>

<div class="row-fluid" style ="margin-bottom: 0px; padding-top:20px; border-top: thin solid rgb(229, 229, 229);">
			<div class="span3" style="text-align:left; vertical-align:middle;">
				<a href="http://www.joomlashowroom.com" target="_blank"> <?php echo JText::_('PRODUCT_SUPPORT_CENTER'); ?> </a> <br /><a href="http://twitter.com/joomlashowroom" target="_blank"> <?php echo JText::_('PRODUCT_FOLLOW_US_TWITTER'); ?> </a> <br /><a href="https://billing.cloudaccess.net/aff.php?aff=21" target="_blank"> <?php echo JText::_('FREE JOOMLA CLOUD HOSTING'); ?> </a>
			</div>
				<div class="span6"  style="text-align:center; vertical-align:middle;"> <?php echo JText::_('PRODUCT_NAME').": ".JText::_('PRODUCT_DESCRIPTION'); ?> <br/> <?php echo JText::_('LBLCOPYRIGHT').": ".JText::_('COPYRIGHT');?> <br/> <?php echo JText::_('LBLPHPVERSION').": (".JText::_('PRODUCT_PHP_VERSION_REQUIRED').") (".JText::_('PRODUCT_PHP_VERSION_CURRENT')." ".@phpversion().")";?> </div>
				<div class="span3" style=" text-align:right; vertical-align:middle;"><a href="http://www.joomlashowroom.com" target="_blank"><img src="<?php echo JUri::root();?>administrator/components/com_autoupdate/assets/images/Joomla_Showroom_logo.png" border="0" /></a></div>
</div>	
</div>