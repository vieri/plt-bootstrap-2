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
$params = $this->item->params;
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
$canEdit = $this->item->params->get('access-edit');
$info    = $params->get('info_block_position', 0);
?>

<div class="span4 text-center">
	<?php echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>	
</div>

<div class="span8">
	<?php echo JLayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>
    <div class="row-fluid">
            <div class="span12 nopadding">
                <small class="gris">
                <!-- NOMBRE CATEGORIA -->
                <?php echo '<span class="label label-info">' . $this->escape($this->item->category_title) . '</span>'; ?>
                <!-- NOMBRE AUTOR -->
                <?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
                <?php $author = '<span class="fa fa-user padding-intern"></span> <span itemprop="name">' . $author . '</span>'; ?>
                <?php echo JText::sprintf($author); ?>
                <!-- FECHA PUBLICACIÓN -->
                <span class="fa fa-calendar padding-intern"></span>
                <time datetime="<?php echo JHtml::_('date', $this->item->publish_up, 'c'); ?>" itemprop="datePublished">
                    <?php echo JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3')); ?>
                </time>
                </small>
            </div>
        </div>
        
        <!-- INTRO TEXT -->
        <?php echo $this->item->event->beforeDisplayContent; ?> <?php echo $this->item->introtext; ?>   
        <!-- FINAL INTRO TEXT -->
        
        <!-- LEER MÁS -->
        <?php if ($params->get('show_readmore') && $this->item->readmore) :
            if ($params->get('access-view')) :
                $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
            else :
                $menu = JFactory::getApplication()->getMenu();
                $active = $menu->getActive();
                $itemId = $active->id;
                $link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
                $returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
                $link = new JUri($link1);
                $link->setVar('return', base64_encode($returnURL));
            endif; ?>
            <?php echo JLayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link)); ?>
        <?php endif; ?>
        <!-- FINAL LEER MÁS -->
	
</div>