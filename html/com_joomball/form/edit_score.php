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

	
<div class="well-edit">

	<div class="row-fluid hidden-phone" style="margin: 0 10px">
		<div class="span12">
			<div class="span4 strong">
				<strong><?php echo JText::_('COM_JOOMBALL_GLOBAL_TEAM_HOME'); ?></strong>
			</div>
			<div class="span4">
				<strong><?php echo JText::_('COM_JOOMBALL_GLOBAL_TEAM_AWAY'); ?></strong>
			</div>
			<div class="span4">
				<strong><?php echo JText::_('COM_JOOMBALL_GLOBAL_RESULTS'); ?></strong>
			</div>
		</div>
	</div>
				
	<div class="row-striped">
	<?php
	foreach ($this->matches as $i => $match): ?>
	
		<div class="row-fluid" style="width: auto;">
			<div class="span12">
				
				<!-- LOCAL TEAM & FIELD TOWN -->
				<div class="span4">
					<div class="jb-row-fluid">
						<?php
						echo JHtml::_('jbselect.groupedlist', JHtml::_('jbselect.teams', 0, $match->type), 'matches['.$i.'][team1_id]', array(
								'id' => 'jform_team1_id',
								'list.attr' => 'class="inputbox jb-xlarge select2 span12 ' . $match->_1_my_club . '"',
								'list.select' => $match->team1_id,
								'group.items' => null,
								'option.key.toHtml' => false,
								'option.text.toHtml' => false
							));
						?>
					</div>	
				</div>
				
				<!-- VISIT TEAM & FIELD -->
				<div class="span4">
					<div class="jb-row-fluid">
						<?php
						echo JHtml::_('jbselect.groupedlist', JHtml::_('jbselect.teams', 0, $match->type), 'matches['.$i.'][team2_id]', array(
								'id' => 'jform_team2_id',
								'list.attr' => 'class="inputbox jb-xlarge select2 span12 ' . $match->_2_my_club . '"',
								'list.select' => $match->team2_id,
								'group.items' => null,
								'option.key.toHtml' => false,
								'option.text.toHtml' => false
							));
						?>
					</div>
				</div>
				
				
				
				<!-- SCORE & ACTION -->
				<div class="span4">
				
					<?php //if ($match->state_match) { ?>
					
					<table>
						<tr>
							<td class="nowrap">
								<input type="text" size="1" name="matches[<?php echo $i ?>][score1]" value="<?php echo $match->score1; ?>" class="jb-46 jb-score jb-margin-null <?php echo $match->score_style; ?>" />				
								<input type="text" size="1" name="matches[<?php echo $i ?>][score2]" value="<?php echo $match->score2; ?>" class="jb-46 jb-score jb-margin-null <?php echo $match->score_style; ?>" />
							</td>
							<td class="span12">
								<select name="matches[<?php echo $i; ?>][played]" class="inputbox select2 span12 jb-xlarge jb-margin-null small">
									<?php echo JHtml::_('select.options', array(0 => JText::_('COM_JOOMBALL_GLOBAL_PROGRAMMED'), 4 => JText::_('COM_JOOMBALL_GLOBAL_PLAY'), 1 => JText::_('COM_JOOMBALL_GLOBAL_PLAYED'), 2 => JText::_('COM_JOOMBALL_GLOBAL_SUSPENDED'), 3 => JText::_('COM_JOOMBALL_GLOBAL_POSTPONED')), 'value', 'text', $match->played, true);?>
								</select>
							</td>
						</tr>
					</table>
					<?php // } ?>

					<input type="hidden" name="matches[<?php echo $i ?>][id]" value="<?php echo $match->id; ?>" />
					<input type="hidden" name="matches[<?php echo $i ?>][matchday_id]" value="<?php echo $match->matchday_id; ?>" />
				</div>
				
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</div>	

<?php
	if ($this->theme == 'score_match') {
		$linkPrev = JURI::base().'index.php?option=com_joomball&view=form&layout=edit&theme=score_match&matchday_id='.$this->matchday->prev_matchday_id.'&team_id='.$this->team_id.'&return='.$this->return_page ;
		$linkNext = JURI::base().'index.php?option=com_joomball&view=form&layout=edit&theme=score_match&matchday_id='.$this->matchday->next_matchday_id.'&team_id='.$this->team_id.'&return='.$this->return_page ;
?>
		<ul class="pager" style="margin: 0">
		<?php if ($this->matchday->prev_matchday_id) { ?>
			<li class="previous">
				<a href="<?php echo $linkPrev; ?>">
				&larr; <?php echo JText::_('COM_JOOMBALL_GLOBAL_MATCHDAY_PREV'); ?>
				</a>
			</li>
		<?php } if ($this->matchday->next_matchday_id) { ?>
			<li class="next">
				<a href="<?php echo $linkNext; ?>">
				<?php echo JText::_('COM_JOOMBALL_GLOBAL_MATCHDAY_NEXT'); ?> &rarr;
				</a>
			</li>
		<?php } ?>
		</ul>
<?php } ?>
		

