<?php
/**
 * 
 * @package			Joomla
 * @subpackage		Components - com_joomball
 * 
 * @author			JoomBall! Project
 * @link			http://www.joomball.com
 * @copyright		Copyright © 2011 JoomBall! Project - All Rights Reserved
 * @license			GNU/GPL, http://www.gnu.org/licenses/gpl-3.0.html
 * 
 **/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>


	
<ul class="nav nav-tabs">
	<li class="active"><a href="#details" data-toggle="tab"><?php echo JText::_('JDETAILS') ?></a></li>
	<?php if ($this->theme != 'article') { ?>
	<li><a href="#matches" data-toggle="tab"><?php echo JText::_('COM_JOOMBALL_GLOBAL_MATCHES') ?></a></li>
	<?php } ?>
	<?php if ($this->pluginActive) : ?>
	<li><a href="#media" data-toggle="tab"><?php echo JText::_('COM_JOOMBALL_GLOBAL_MEDIA') ?></a></li>
	<?php endif; ?>
	<li><a href="#publishing" data-toggle="tab"><?php echo JText::_('COM_CONTENT_PUBLISHING') ?></a></li>
	<li><a href="#language" data-toggle="tab"><?php echo JText::_('JFIELD_LANGUAGE_LABEL') ?></a></li>
	<li><a href="#metadata" data-toggle="tab"><?php echo JText::_('COM_CONTENT_METADATA') ?></a></li>
</ul>

<div class="tab-content">
	
	<div class="tab-pane active" id="details">
		<div class="control-group">
			<div class="control-label">
				<label id="jform_title-lbl" class="hidden required" for="jform_title"><?php echo JText::_('JGLOBAL_TITLE'); ?></label>
			</div>
			<div class="controls">
				<?php echo $this->form->getInput('title'); ?>
			</div>
		</div>
		<div class="row-flow">
			<div class="span6">
				<div class="control-group">
					<div class="controls">
						<?php echo $this->form->getInput('catid'); ?>
					</div>
				</div>	
			</div>
			<div class="span6">
				<div class="control-group">
					<div class="controls">
						<?php echo $this->form->getInput('alias'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row-flow">
			<div class="span10">
				<div class="control-group">
					<div class="controls">
						<?php if ($this->pluginActive) : ?>
						<?php echo $this->form->getInput('extended_subtitle', 'attribs'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="span2" style="margin-bottom: 18px;">
				<?php echo $this->form->renderField('featured'); ?>
			</div>
		</div>
		
		<div class="row-flow">
			<div class="span12">	
				<?php echo $this->form->getInput('articletext'); ?>
			</div>
		</div>
	</div>

	<?php if ($this->template->chronic) { ?>
	<div class="tab-pane" id="matches">
		<?php // --> Afegim partits
			if($this->template->score) {
				echo $this->loadTemplate('score');
			}
			
			if($this->template->date) {
				echo $this->loadTemplate('date');
			}
		?>
	</div>
	<?php } ?>
	
	<?php if ($this->pluginActive) : ?>
	<?php echo JLayoutHelper::render('media.media', null, JPATH_ADMINISTRATOR.'/components/com_joomball/layouts'); ?>
	<?php endif; ?>
	
	<div class="tab-pane" id="publishing">
		<?php echo $this->form->renderField('tags'); ?>
		<?php echo $this->form->renderField('created_by_alias'); ?>
		<?php //if ($this->item->params->get('access-change')) : ?>
			<?php echo $this->form->renderField('state'); ?>
			<?php echo $this->form->renderField('publish_up'); ?>
			<?php echo $this->form->renderField('publish_down'); ?>
		<?php //endif; ?>
		<?php echo $this->form->renderField('access'); ?>
					
		<?php if (is_null($this->item->id)):?>
			<div class="row-flow">
			<div class="span12">
			<div class="control-group">
				<div class="control-label">
				</div>
				<div class="controls">
					<?php echo JText::_('COM_CONTENT_ORDERING'); ?>
				</div>
			</div>
			</div>
			</div>
		<?php endif; ?>
	</div>
				
	<div class="tab-pane" id="language">
		<?php echo $this->form->renderField('language'); ?>
	</div>
	
	<div class="tab-pane" id="metadata">
		<?php echo $this->form->renderField('metadesc'); ?>
		<?php echo $this->form->renderField('metakey'); ?>

		<?php if ($this->params->get('enable_category', 0) == 1) :?>
		<input type="hidden" name="jform[catid]" value="<?php echo $this->params->get('catid', 1); ?>" />
		<?php endif; ?>
	</div>
</div>





