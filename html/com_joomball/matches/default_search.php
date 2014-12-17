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

if (!$this->print) :
	$this->params->get('show_filters', 1) ? $class = null : $class = 'class="hide"';

	$data = array('view' => $this);
	$filters = $data['view']->filterForm->getGroup('filter');
	
	// Load the form list fields
	$list = $data['view']->filterForm->getGroup('list'); ?>
	
	<fieldset id="filter-search" <?php echo $class; ?>>
		<legend class="legend-filter"><?php echo JText::_('COM_JOOMBALL_SEARCH_MATCHES'); ?></legend>
		<div class="row-fluid">
			<div class="span6">
				
				<div class="span12">
					<div class="clearfix">
						<div class="js-stools-field-filter" style="display: inline-block;">
							<?php echo $filters['filter_begin']->label; ?>
							<?php echo $filters['filter_begin']->input; ?>
						</div>
						<div class="js-stools-field-filter" style="display: inline-block;">
							<?php echo $filters['filter_end']->label; ?>
							<?php echo $filters['filter_end']->input; ?>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="span6">
							<?php echo $list['list_fullordering']->label; ?>
							<?php echo $list['list_fullordering']->input; ?>
						</div>
						<div class="span6">
							<?php echo $list['list_limit']->label; ?>
							<?php echo $list['list_limit']->input; ?>
						</div>
					</div>				
				</div>
				<div class="row-fluid<?php echo JHtml::_('jboptions.showClass', $this->params->get('show_filter_club', 1)); ?>" style="margin-top: 10px;">
					<div class="span12">
						<div class="control-group">
							<div class="controls">
								<?php echo $filters['filter_club']->input; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="control-group">
							<div class="controls">
								<?php echo $filters['filter_category']->input; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid<?php echo JHtml::_('jboptions.showClass', $this->params->get('show_filter_competition', 1)); ?>">
					<div class="span12">
						<div class="control-group">
							<div class="controls">
								<?php echo $filters['filter_competition']->input; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="span6">
				<div class="row-fluid">
					<div class="span12">
						<div class="span6">
							
							<div class="control-group">
								<?php echo $filters['filter_played']->label; ?>
								<div class="controls">
									<?php echo $filters['filter_played']->input; ?>
								</div>
							</div>
							
							<div class="control-group">
								<?php echo $filters['filter_retired']->label; ?>
								<div class="controls">
									<?php echo $filters['filter_retired']->input; ?>
								</div>
							</div>
							
						</div>
						<div class="span6">
								
							<div class="control-group<?php echo JHtml::_('jboptions.showClass', $this->params->get('show_filter_organism', 1)); ?>">
								<div class="controls">
									<?php echo $filters['filter_organism']->input; ?>
								</div>
							</div>
							
							<div class="control-group<?php echo JHtml::_('jboptions.showClass', $this->params->get('show_filter_sport', 1)); ?>">
								<div class="controls">
									<?php echo $filters['filter_sport']->input; ?>
								</div>
							</div>
							
							<div class="control-group<?php echo JHtml::_('jboptions.showClass', $this->params->get('show_filter_season', 1)); ?>">
								<div class="controls">
									<?php echo $filters['filter_season']->input; ?>
								</div>
							</div>
								
							<div class="control-group<?php echo JHtml::_('jboptions.showClass', $this->params->get('show_filter_type', 1)); ?>">
								<div class="controls">
									<?php echo $filters['filter_type']->input; ?>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div id="toolbar" class="btn-toolbar">
							<div id="toolbar-reset" class="btn-wrapper">
								<button type="button" class="btn btn-success" onclick="document.id('reset').value=2;this.form.submit();"><?php echo JText::_('COM_JOOMBALL_GLOBAL_RESET'); ?></button>
							</div>
							<div id="toolbar-clear" class="btn-wrapper">
								<button type="button" class="btn btn-warning" onclick="filterClear();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
							</div>
							<div id="toolbar-search" class="btn-wrapper">
								<button type="submit" class="btn btn-primary" onclick="document.id('reset').value=0;"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
							</div>
						</div>		
					</div>
				</div>
			
			</div>
		</div>
		
		<input type="hidden" id="reset" name="reset" value="<?php echo $this->state->get('filter.reset'); ?>" />
		
	</fieldset>
	
<?php endif; ?>	
