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
<script type="text/javascript">

	jQuery(document).ready(function (){
		// Per casos de partits en Joc
		blink();
	});
	
</script>
<?php
foreach ($matches as $match){
	$style1 = '';
	if ($match->_1_my_team == 1) {
		$style1='color:red;';
		$row = -1;
	}
	$style2 = '';
	if ($match->_2_my_team == 1) {
		$style2='color:blue;'; }
		
		
	$played = null;
	if ($match->played == 4) { $played = 'class="play"'; }
?>
	<div class="row-fluid voltant">

		<div class="row-fluid cap-partits">
			<?php
				switch ($match->type) {
					case 1: // Match Liga ?>
						<div class="pull-left titols mida-titol">
							<?php
								if ($params->get('title', 1) == 1) {
									echo $match->project;
								} elseif ($params->get('title', 1) == 2) {
									echo $match->category;
								}
							?>
						</div>
						<div class="pull-right titols mida-titol">
							<?php if ($params->get('show_matchday', 1)) : ?>
								<?php if ($params->get('show_table', 1)) { ?>
									<a href="<?php echo JRoute::_(JURI::base().'index.php?option=com_joomball&view=table&id='.$match->season_id.'&matchday='.$match->number); ?>">
									<?php echo JText::_('COM_JOOMBALL_GLOBAL_MATCHDAY_NAME_'.$match->matchday) . ' ' . $match->number; ?>
									</a>
									<?php
								} else {
									echo JText::_('COM_JOOMBALL_GLOBAL_MATCHDAY_NAME_'.$match->matchday) . ' ' . $match->number;
								}
								?>
							<?php endif; ?>
						</div>
						
						<?php
						break;
					case 5: // Match Friendly
					case 6: // Match Triangular ?>
						<div class="pull-left">
							<?php
								if ($params->get('title', 1) == 1 or $params->get('title', 1) == 2) {
									echo $match->category;
								}
							?>
						</div>
						<div class="pull-right">
							<?php if ($params->get('show_matchday', 1)) :
							 	echo JText::_('COM_JOOMBALL_GLOBAL_TYPE_'.$match->type);
							 endif; ?>
						</div>
						<?php
						break;
					case 7: // Match Competition Friendly ?>
						<div class="pull-left">
							<?php
								if ($params->get('title', 1) == 1) {
									echo $match->competition;
								} elseif ($params->get('title', 1) == 2) {
									echo $match->category;
								}
							?>
						</div>
						<?php
						break;
				} ?>
		</div>
		
		<div class="center">
			<h5><?php echo $match->_1_team . ' - ' . $match->_2_team; ?></h5>
		</div>
	
		<div class="center middle titols">
			<div class="pull-left">
			<?php
				if ($params->get('show_shield', 1)) {
					$image = modJBMatchHelper::getImage($params, $match->_1_thumbnailUrl);
					$matchTeam = str_replace('"', '', $match->_1_team);
					echo JHtml::_('image', $image['path'], $matchTeam, array('title' => $matchTeam, 'width' => $image['width'], 'height' => $image['height'], 'style' => 'max-width: '.$image['width'].'px;max-height: '.$image['height'].'px;'));
				}
			?>
			</div>
			<div class="pull-right">
			<?php
				if ($params->get('show_shield', 1)) {
					$image = modJBMatchHelper::getImage($params, $match->_2_thumbnailUrl);
					$matchTeam = str_replace('"', '', $match->_2_team);
					echo JHtml::_('image', $image['path'], $matchTeam, array('title' => $matchTeam, 'width' => $image['width'], 'height' => $image['height'], 'style' => 'max-width: '.$image['width'].'px;max-height: '.$image['height'].'px;'));
				}
			?>
			</div>
			<?php
				if ($params->get('show_day', 1)) :
					$nowDay = JHTML::date('now','j');
					if (JHTML::date($match->datetime, JText::_('j')) == $nowDay) {
						echo JText::_('MOD_JBMATCH_GLOBAL_TODAY') . ' ' . $nowDay;
					} else {
						echo JHTML::date($match->datetime, 'l j F');
					}
				endif;
			?>
			<?php
				if ($params->get('marker', 0)) { ?>
					<h4 class="resultat" <?php echo $played; ?>><?php echo $match->result; ?></h4>
			<?php } else { ?>
					<h4 class="resultat"><?php echo $match->schedule; ?></h4>
			<?php } ?>
			<!-- <?php
				if ($params->get('show_day', 1)) :
					echo JText::_(JHTML::date($match->datetime, 'F'));
				endif;
			?> -->
		</div>
		
		<div class="center">
			<?php if ($params->get('show_field_town', 1)) : ?>
				<b><?php echo $match->field_town; ?></b>
			<?php endif; ?>
			<?php if ($params->get('show_field', 1)) : ?>
				<p><?php echo $match->field; ?></p>
			<?php endif; ?>
		</div>

	</div>
<?php } // Final foreach ?>
	
