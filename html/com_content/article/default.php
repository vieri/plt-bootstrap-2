<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$info    = $params->get('info_block_position', 0);
JHtml::_('behavior.caption');
$useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author'));

?>
<div class="item-page<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Article">
	<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<div class="page-header">
		<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
	</div>
	<?php endif;
if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
{
	echo $this->item->pagination;
}
?>
	
	<!-- TITULO NOTICIA -->
	<?php if ($params->get('show_title') || $params->get('show_author')) : ?>
	<div class="row-fluid">
		<div class="span12 page-header">
			<h2 class="blau seperador" itemprop="name">	
				<?php echo $this->escape($this->item->title); ?>
			</h2>
			<?php if ($this->item->state == 0) : ?>
				<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
			<?php endif; ?>
			<?php if (strtotime($this->item->publish_up) > strtotime(JFactory::getDate())) : ?>
				<span class="label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
			<?php endif; ?>
			<?php if ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != '0000-00-00 00:00:00') : ?>
				<span class="label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
	<!-- FINAL TITULO NOTICIA -->

	<!-- BLOQUE INFORMACIÓN -->
	<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
		<div class="row-fluid espai_inferior">
			<div class="span12 nopadding">
				<small class="gris">
					<!-- NOMBRE CATEGORIA -->
					<?php $title = $this->escape($this->item->category_title); ?>
					<?php $url = '<a class="label label-info" href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '" itemprop="genre">' . $title . '</a>'; ?>
					<?php echo JText::sprintf($url); ?>
					<!-- NOMBRE AUTOR -->
					<?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
					<?php $author = '<span class="fa fa-user padding-intern"></span> <span itemprop="name">' . $author . '</span>'; ?>
					<?php echo JText::sprintf($author); ?>
					<!-- FECHA PUBLICACIÓN -->
					<span class="fa fa-calendar padding-intern"></span>
					<time datetime="<?php echo JHtml::_('date', $this->item->publish_up, 'c'); ?>" itemprop="datePublished">
						<?php echo JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3')); ?>
					</time>
					<span class="fa fa-eye padding-intern"></span>
					<meta itemprop="interactionCount" content="UserPageVisits:<?php echo $this->item->hits; ?>" />
					<span><?php echo $this->item->hits; ?></span>
				</small>
			</div>
		</div>
	<?php endif; ?>
	<!-- FINAL BLOQUE INFORMACIÓN -->

	

	<?php if (!$params->get('show_intro')) : echo $this->item->event->afterDisplayTitle; endif; ?>
	<?php echo $this->item->event->beforeDisplayContent; ?>

	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position)))
		|| (empty($urls->urls_position) && (!$params->get('urls_position')))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php if ($params->get('access-view')):?>
	<?php if (isset($images->image_fulltext) && !empty($images->image_fulltext)) : ?>
	<?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
	
	<div class="row-fluid">

		<!-- <div class="padding-intern pull-<?php echo htmlspecialchars($imgfloat); ?> item-image">  -->
		<div class="span12 text-center"> 
			<img 
				<?php if ($images->image_fulltext_caption): echo 'class="caption"'.' title="' .htmlspecialchars($images->image_fulltext_caption) . '"'; endif; ?>
				src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>" 
				class="img-responsive center-block espai_inferior" itemprop="image"/> 
		</div>
		
		<?php endif; ?>
		<?php
		if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && !$this->item->paginationrelative):
			echo $this->item->pagination;
		endif;
		?>
		
		<?php if (isset ($this->item->toc)) :
			echo $this->item->toc;
		endif; ?>
		
		<div class="row-fluid">
			<div class="span12" itemprop="articleBody">
				<?php echo $this->item->text; ?>
			</div>
		</div>

		<div class="span12">
			<?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
				<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
				<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
			<?php endif; ?>
		</div>
			
		<div class="row-fluid">
			<div class="span12 text-right">
				<form><input class="btn btn-info" type="button" onclick="history.go(-1);return true;" value="Tornar"></form>
			</div>
		</div>
		
	
	</div>

	<?php if ($useDefList && ($info == 1 || $info == 2)) : ?>
		<div class="article-info muted">
			<dl class="article-info">
			<dt class="article-info-term"><?php echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>

			<?php if ($info == 1) : ?>
				<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
					<dd class="createdby" itemprop="author" itemscope itemtype="http://schema.org/Person">
						<?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
						<?php $author = '<span itemprop="name">' . $author . '</span>'; ?>
						<?php if (!empty($this->item->contact_link) && $params->get('link_author') == true) : ?>
							<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', $this->item->contact_link, $author, array('itemprop' => 'url'))); ?>
						<?php else: ?>
							<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
						<?php endif; ?>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_parent_category') && !empty($this->item->parent_slug)) : ?>
					<dd class="parent-category-name">
						<?php $title = $this->escape($this->item->parent_title); ?>
						<?php if ($params->get('link_parent_category') && $this->item->parent_slug) : ?>
							<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)) . '" itemprop="genre">' . $title . '</a>'; ?>
							<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
						<?php else : ?>
							<?php echo JText::sprintf('COM_CONTENT_PARENT', '<span itemprop="genre">' . $title . '</span>'); ?>
						<?php endif; ?>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_category')) : ?>
					<dd class="category-name">
						<?php $title = $this->escape($this->item->category_title); ?>
						<?php if ($params->get('link_category') && $this->item->catslug) : ?>
							<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '" itemprop="genre">' . $title . '</a>'; ?>
							<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
						<?php else : ?>
							<?php echo JText::sprintf('COM_CONTENT_CATEGORY', '<span itemprop="genre">' . $title . '</span>'); ?>
						<?php endif; ?>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_publish_date')) : ?>
					<dd class="published">
						<span class="icon-calendar"></span>
						<time datetime="<?php echo JHtml::_('date', $this->item->publish_up, 'c'); ?>" itemprop="datePublished">
							<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
						</time>
					</dd>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ($params->get('show_create_date')) : ?>
				<dd class="create">
					<span class="icon-calendar"></span>
					<time datetime="<?php echo JHtml::_('date', $this->item->created, 'c'); ?>" itemprop="dateCreated">
						<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3'))); ?>
					</time>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_modify_date')) : ?>
				<dd class="modified">
					<span class="icon-calendar"></span>
					<time datetime="<?php echo JHtml::_('date', $this->item->modified, 'c'); ?>" itemprop="dateModified">
						<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
					</time>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_hits')) : ?>
				<dd class="hits">
					<span class="icon-eye-open"></span>
					<meta itemprop="interactionCount" content="UserPageVisits:<?php echo $this->item->hits; ?>" />
					<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
				</dd>
			<?php endif; ?>
			</dl>
			<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
				<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
				<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php
if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative):
	echo $this->item->pagination;
?>
	<?php endif; ?>
	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php // Optional teaser intro text for guests ?>
	<?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
	<?php echo $this->item->introtext; ?>
	<?php //Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
		$link1 = JRoute::_('index.php?option=com_users&view=login');
		$link = new JUri($link1);?>
	<p class="readmore">
		<a href="<?php echo $link; ?>">
		<?php $attribs = json_decode($this->item->attribs); ?>
		<?php
		if ($attribs->alternative_readmore == null) :
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		elseif ($readmore = $this->item->alternative_readmore) :
			echo $readmore;
			if ($params->get('show_readmore_title', 0) != 0) :
				echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
			endif;
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
		else :
			echo JText::_('COM_CONTENT_READ_MORE');
			echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		endif; ?>
		</a>
	</p>
	<?php endif; ?>
	<?php endif; ?>
	<?php
if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative) :
	echo $this->item->pagination;
?>
	<?php endif; ?>
	<?php echo $this->item->event->afterDisplayContent; ?> </div>
