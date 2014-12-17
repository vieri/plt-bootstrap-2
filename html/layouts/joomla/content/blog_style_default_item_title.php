<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Create a shortcut for params.
$params = $displayData->params;
$canEdit = $displayData->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
?>
		
	<h2 class="nomargintop" itemprop="name">
		<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($displayData->slug, $displayData->catid)); ?>" itemprop="url">
		<?php echo $this->escape($displayData->title); ?></a>
	</h2>
			
	<?php if ($displayData->state == 0) : ?>
		<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
	<?php endif; ?>
	
	<?php if (strtotime($displayData->publish_up) > strtotime(JFactory::getDate())) : ?>
		<span class="label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
	<?php endif; ?>
	
	<?php if ((strtotime($displayData->publish_down) < strtotime(JFactory::getDate())) && $displayData->publish_down != '0000-00-00 00:00:00') : ?>
		<span class="label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
	<?php endif; ?>
		
	
