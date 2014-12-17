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

JHtml::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers/html');
JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');

JHtml::_('behavior.tooltip');
JHtml::_('jbselect2.select2');

$params = array();
?>
<script type="text/javascript">

//	window.addEvent('domready', function() {
		// Per casos de partits en Joc
	//	blink();
//	});

	jQuery(document).ready(function (){
		blink();
	});

//	$(document).on('ready', function(){
//		$('.select2').select2();
//	});

</script>

<div class="items-list">

	<form action="<?php echo JRoute::_('index.php?option=com_joomball&view=calendar'); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-vertical">
	
		<?php // --> Afegim buscador
	//		if($this->params->get('matches_search', 'top') == 'top') {
				echo $this->loadTemplate('search');
	//		}
		?>
	
		<div class="clr"> </div>
		
		<ul class="breadcrumb" style="margin: 0 0 10px 0;padding: 2px 15px 4px 15px;">
		    <li style="padding: 9px 0px 7px 0px;">
				<?php echo JText::_('COM_JOOMBALL_GLOBAL_SPORT_'.$this->season->sport); ?>
		    	<span class="divider">/</span>
		    </li>
		    <li style="padding: 9px 0px 7px 0px;" class="active">
				<?php echo JText::_('COM_JOOMBALL_GLOBAL_SEASON') . ' ' . $this->season->season; ?>
		    </li>
		</ul>

		<div class="navbar" id="jb-navbar">
			<div class="navbar-inner">
				<a class="brand"><?php echo JText::_('COM_JOOMBALL_GLOBAL_CALENDAR'); ?></a>
				<?php if (!$this->print) { ?>	
				<ul class="nav pull-right">
					<li>
						<?php
							if ($this->season->params->get('show_table', true)) {
								echo JHtml::_('icon.table', $this->season->id,  $params);
							}
						?>
					</li>
					<li id="fat-menu" class="dropdown">
						<a id="drop3" class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="icon-tasks"></i><span class="hidden-phone"> <?php echo JText::_('JOPTIONS'); ?></span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu pull-right">
							<li class="print-icon hidden-phone"><?php echo JHtml::_('icon.print_popup',  $this->season, $this->params); ?></li>
							<li class="email-icon"><?php echo JHtml::_('icon.email',  $this->season, $this->params); ?></li>
						</ul>
					</li>
				
				<?php } elseif ($this->print) { ?>
					<li class="pull-right" style="margin: 10px 0;">
						<?php echo JHtml::_('icon.print_screen',  $this->season, $this->params); ?>
					</li>
				<?php } ?>
				</ul>
			</div>
		</div>

		<h2><?php echo $this->season->project; ?></h2>
		
		<?php
			if ($this->items) {
				$showRetired = 0;
				$showSuspended = 0;
				$numSuspended = 0;
				$showPostponed = 0;
				$numPostponed = 0;
				foreach ($this->items as &$matchday){ ?>
		
				<table class="table-bordered table table-striped table-hover table-condensed classificacio">
					<thead>
						<tr>
							<th class="center" colspan="5">
							<?php
								echo JText::_($matchday->matchday);
								echo ' ' . $matchday->number;
								if ($matchday->date != '0000-00-00') {
									echo '<span style="font-weight:normal;margin-left:10px;">( ';
									echo JoomballHtml::date($matchday->date, $this->params->get('format_date', 'COM_JOOMBALL_DATE_FORMAT_LC4'));	// Data Jornada
									echo ' )</span>';
								}
							?>
							</th>
						</tr>
					</thead>
					
					<tbody>
					
					<?php  
						foreach ($matchday->matches as &$match){
						//	$viewRest = 1;
//							$style1 = '';
//								if ($match->_1_my_team == 1) {
//									$style1='font-weight:bold;color:red;'; }
//							$style2 = '';
//								if ($match->_2_my_team == 1) {
//									$style2='font-weight:bold;color:blue;'; }
					//				if (empty($match['team_home']) or empty($match['team_away']) or $match['2_retired']) {$viewRest = 0;} else {$viewRest = 1;}
					?>
						<tr class="white">
							<td class="middle text-right <?php echo $match->_1_my_club; ?>">
								<?php
								if (isset($match->_1_team)) { // --> Per si Descansa
									if ($match->_1_retired) {
										echo JHtml::tooltip('', JText::_('COM_JOOMBALL_TOOLTIP_TEAM_RETIRED'), '', JText::_('COM_JOOMBALL_TOOLTIP_RET'), '', '', 'hasTip br mr toolTip red-bg');
								//		$viewRest = 0;
										$showRetired = 1;
									}
								?>
									<span class="hidden-phone">
									<?php
										echo $match->_1_team; // Equip Local
										if (is_file($match->_1_thumbnailUrl) and ($this->params->get('show_shield', 5) == 1 or $this->params->get('show_shield', 5) == 5)) {
											// Logo equip
											echo JHtml::_('image', $match->_1_thumbnailUrl, $match->_1_team, array('title' => $match->_1_team, 'width' => 20, 'height' => 20, 'style' => 'margin: 0 5px;vertical-align: middle;max-height: 20px;'));
										}
									?>
									</span>
									<span class="visible-phone">
										<?php echo $match->_1_team_short; // Equip Local ?>
									</span>
								<?php
									
								} else {
									if ($match->params->get('name_team_rests')) {
										echo $match->params->get('name_team_rests');
									} else {
										echo JText::_('COM_JOOMBALL_GLOBAL_REST') ;
									}
								}
								?>	
							</td>
							<td class="middle <?php echo $match->_2_my_club; ?>">
								<?php
								if (isset($match->_2_team)) { // --> Per si Descansa
								?>
									<span class="hidden-phone">
									<?php
										if (is_file($match->_2_thumbnailUrl) and $this->params->get('show_shield', 1)) {
											// Logo equip
											echo JHtml::_('image', $match->_2_thumbnailUrl, $match->_2_team, array('title' => $match->_2_team, 'width' => 20, 'height' => 20, 'style' => 'margin: 0 5px;vertical-align: middle;max-height: 20px;'));
										}
										echo $match->_2_team; // Equip Visitant
									?>
									</span>
									<span class="visible-phone">
										<?php echo $match->_2_team_short; // Equip Visitant ?>
									</span>
								<?php
									if ($match->_2_retired) {
										echo JHtml::tooltip('', JText::_('COM_JOOMBALL_TOOLTIP_TEAM_RETIRED'), '', JText::_('COM_JOOMBALL_TOOLTIP_RET'), '', '', 'hasTip br ml toolTip red-bg');
										$showRetired = 1;
									}
								} else {
									if ($match->params->get('name_team_rests')) {
										echo $match->params->get('name_team_rests');
									} else {
										echo JText::_('COM_JOOMBALL_GLOBAL_REST') ;
									}
								}
								?>	
							</td>
							<?php if ($this->state->get('show_field')) { ?>
								<td class="center middle">
									<?php if (!$match->state_match) { echo $match->params->get('field', null); } ?>
								</td>
							<?php } ?>
							<td class="center middle">
								<?php echo JoomballHtml::date($match->date, $this->params->get('format_date', 'COM_JOOMBALL_DATE_FORMAT_LC4')); // Data partit ?>
								<?php //echo JoomballHtml::date($match->date, $this->params->get('format_date', 'DATE_FORMAT_LC4')); // Data partit ?>
							</td>
							<?php if ($match->played == 2) { ?>
								<td class="center middle td-bold">
									<?php echo JHtml::tooltip(JText::_('COM_JOOMBALL_TOOLTIP_MATCH_SUSPENDED'), JText::_('COM_JOOMBALL_GLOBAL_MATCH_SUSPENDED'), '', JText::_('COM_JOOMBALL_TOOLTIP_SUS'), '', '', 'hasTip toolTip br brown-bg'); ?>
								</td>
							<?php $showSuspended = 1; $numSuspended ++;
								} elseif ($match->played == 3) { ?>
								<td class="center middle td-bold">
									<?php echo JHtml::tooltip(JText::_('COM_JOOMBALL_TOOLTIP_MATCH_POSTPONED'), JText::_('COM_JOOMBALL_GLOBAL_MATCH_POSTPONED'), '', JText::_('COM_JOOMBALL_TOOLTIP_POS'), '', '', 'hasTip toolTip br blue-bg'); ?>
								</td>
							<?php $showPostponed = 1; $numPostponed ++;
								} elseif ($match->result){ ?>
								<?php if ($match->played == 4) {$classPlay = ' class="play"';} else {$classPlay = '';} ?>
								<td class="center middle nowrap td-bold"><span<?php echo $classPlay; ?>><?php echo $match->result; ?></span></td>
								<?php } elseif (!$match->state_match) { ?>
								<td class="center middle"><?php echo $match->schedule; ?></td>
							<?php } else { ?>
								<td></td>
							<?php } ?>
						</tr>
					<?php
						} // Tanquem foreach match
					?>
					</tbody>
					
					</table>
	
				<?php
				 } // Tanquem foreach matchday
				
			
			 } else { ?>
				<tr>
					<td colspan="5">
						<p class="title">
							<?php echo JText::_('COM_JOOMBALL_GLOBAL_CALENDAR_PENDING'); ?> 
						</p>
					</td>
				</tr>
			<?php } ?>
		
		<?php
			if ($showRetired) {
				echo JHtml::tooltip('', JText::_('COM_JOOMBALL_GLOBAL_TEAM_RETIRED'), '', JText::_('COM_JOOMBALL_TOOLTIP_RET'), '', '', 'hasTip toolTip br ml mr red-bg');
				echo '<span class="mr info-icon">' . JText::_('COM_JOOMBALL_GLOBAL_TEAM_RETIRED') . '</span>';
			}
			if ($showSuspended) {
				echo JHtml::tooltip('', JText::_('COM_JOOMBALL_GLOBAL_MATCH_SUSPENDED'), '', JText::_('COM_JOOMBALL_TOOLTIP_SUS'), '', '', 'hasTip toolTip br ml mr brown-bg');
				echo '<span class="mr info-icon">' . JText::_('COM_JOOMBALL_GLOBAL_MATCH_SUSPENDED');
				echo ' [' . $numSuspended . ']' . '</span>';
			}
			if ($showPostponed) {
				echo JHtml::tooltip('', JText::_('COM_JOOMBALL_GLOBAL_MATCH_POSTPONED'), '', JText::_('COM_JOOMBALL_TOOLTIP_POS'), '', '', 'hasTip toolTip br ml mr blue-bg');
				echo '<span class="mr info-icon">' . JText::_('COM_JOOMBALL_GLOBAL_MATCH_POSTPONED');
				echo ' [' . $numPostponed . ']' . '</span>';
			}
		?>
	
		<div>
			<input type="hidden" name="id" value="<?php echo $this->season->id; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
		
	</form>
	
</div>
	
<?php if ($this->params->get('show_powered', 1) AND !$this->print) { JoomBallUtils::footer(); } ?>

