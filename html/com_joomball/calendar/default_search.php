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
	$data = array('view' => $this);
	$filters = $data['view']->filterForm->getGroup('filter');
?>

	<fieldset id="filter-search">
		<legend class="legend-filter"><?php echo JText::_('COM_JOOMBALL_SEARCH'); ?></legend>
		<div class="row-fluid">
			
			<div class="span6">
				<div class="control-group">
					<?php //echo $filters['team_select']->label; ?>
					<div class="controls">
						<?php echo $filters['filter_team']->input; ?>
					</div>
				</div>
			</div>
			<div class="span3">
				<div class="control-group">
					<?php //echo $filters['team_select']->label; ?>
					<div class="controls">
						<?php echo $filters['filter_team_select']->input; ?>
					</div>
				</div>
			</div>
			<div class="span3">
				<div class="control-group">
					<div class="controls">
						<div id="toolbar" class="btn-toolbar" style="margin: 0;">
							<div id="toolbar-search" class="btn-wrapper pull-right">
								<!-- Button Search -->
								<button type="submit" class="btn btn-info" onclick="document.id('reset').value=4;"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			 
		</div>
		
		<input type="hidden" id="reset" name="reset" value="<?php echo $this->state->get('filter.reset'); ?>" />
			
	</fieldset>
	
<?php endif; ?>	
