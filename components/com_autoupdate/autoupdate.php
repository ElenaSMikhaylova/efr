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
defined('_JEXEC') or die('=;)');

// DS has removed from J 3.0
if(!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}


$controller = JControllerLegacy::getInstance('autoupdate');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
