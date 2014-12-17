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

JHtml::_('behavior.caption');
?>

<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<div class="row-fluid">
		<div class="span12 espai_inferior">
			<h3 class="blau_blog subratllat_blog"><i class="fa fa-newspaper-o fa-lg"></i>  <?php echo $this->escape($this->params->get('page_heading')); ?> </h3>
		</div>
	</div>
<?php endif; ?>

<!-- TITULO CATEGORIA -->
<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
	<div class="row-fluid">
		<div class="span12 espai_inferior">
			<h1 class="blau seperador"> <?php echo $this->escape($this->params->get('page_subheading')); ?>
				<?php if ($this->params->get('show_category_title')) : ?>
					<?php echo $this->category->title; ?>
				<?php endif; ?>
			</h1>
		</div>
	</div>
<?php endif; ?>
<!-- FINAL TITULO CATEGORIAL -->

<!-- ARTICULOS -->	
<?php foreach ($this->intro_items as $key => &$item) : ?>
	<div class="row-fluid espai_inferior seperador">
		<div itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
			<?php
			$this->item = & $item;
			echo $this->loadTemplate('item');
			?>
		</div>
	</div>
<?php endforeach; ?>
<!-- FINAL ARTICULOS -->

<!-- PAGINACIÓN -->
<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
	<div class="pagination text-center">
		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<p> <?php echo $this->pagination->getPagesCounter(); ?> </p>
		<?php endif; ?>
		<?php echo $this->pagination->getPagesLinks(); ?> 
	</div>
<?php endif; ?>
<!-- FINAL PAGINACIÓN -->


