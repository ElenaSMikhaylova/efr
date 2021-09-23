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

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

include_once JPATH_BASE.DS."administrator".DS."components".DS."com_joomlaupdate".DS."models".DS."default.php";

$filePath	=	JPATH_BASE.DS."administrator".DS."components".DS."com_joomlaupdate".DS."helpers".DS."download.php";
$fileExists = JFile::exists($filePath);
if($fileExists)
{
		include_once JPATH_BASE.DS."administrator".DS."components".DS."com_joomlaupdate".DS."helpers".DS."download.php";
}

/**
 * Variant Controller
 *
 * @package    
 * @subpackage Controllers
 */
class AutoupdateController extends JControllerLegacy
{

	public function getUpdate(){
		
		$model = new JoomlaupdateModelDefault();
		$info = $model->getUpdateInformation();
		$params = JComponentHelper::getParams('com_autoupdate');
		$emails = trim($params->get('emails'));
		$emails = explode(",", $emails);
		$mailer = JFactory::getMailer();
		$config = JFactory::getConfig();
		$sender = array( 
			$config->get( 'mailfrom' ),
			$config->get( 'fromname' ) 
		);
		//$info['installed'] = "3.0.3";
		if($info['installed'] == $info['latest'])
		{
			echo  JText::_('COM_AUTOUPDATE_SITE_ALREADY_LATEST');
			jexit();
		} 
		
		$model->purge();
		$model->refreshUpdates();
		
		if (!is_null($info['object'])){
			
			$file = $model->download();
			
			if ($file){
				
				$tempdir = $config->get('tmp_path');
				$target = $tempdir . '/' . $file;
				JFactory::getApplication()->setUserState('com_joomlaupdate.file', $file);
				
				if (JArchive::extract($target,JPATH_ROOT.'/')){
					
					$model->finaliseUpgrade();
					$model->cleanUp();
					
					// Now sending emails
					$mailer->setSender($sender);
					$mailer->addRecipient($emails);
					
					$mailer->setSubject(JText::sprintf( 'COM_AUTOUPDATE_EMAIL_SUBJECT', $info["latest"] ));
					$mailer->setBody(JText::sprintf( 'COM_AUTOUPDATE_EMAIL_BODY', JURI::base(),$info["installed"],$info["latest"] ));
					$mailer->Encoding = 'base64';
					$mailer->Send();
					
					echo JText::_('COM_AUTOUPDATE_SITE_UPDATED');
				}
				
			}
		} else {
			echo JText::_('COM_AUTOUPDATE_SITE_LATEST');
		}
		jexit(); // I don't want to run other Joomla stuff
	}
}
?>