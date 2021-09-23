<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;
?>
			<dd class="published">
				<time datetime="<?php echo JHtml::_('date', $displayData['item']->publish_up, 'c'); ?>" itemprop="datePublished">
					<span class="teeth_day"><?php echo JText::sprintf(JHtml::_('date', $displayData['item']->publish_up, JText::_('d'))); ?></span>
					<span class="teeth_month"><?php echo JText::sprintf(JHtml::_('date', $displayData['item']->publish_up, JText::_('M'))); ?></span>
					<span class="teeth_year"><?php echo JText::sprintf(JHtml::_('date', $displayData['item']->publish_up, JText::_('Y'))); ?></span>
				</time>
			</dd>