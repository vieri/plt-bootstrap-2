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
?>

<?php if (empty($this->items)) : ?>
	<div class="alert alert-no-items">
		<?php echo JText::_('COM_JOOMBALL_GLOBAL_CONTACTS_NO'); ?>
	</div>
<?php else : ?>
	<!-- <h1 class="blau seperador"><?php echo $this->state->get('title'); ?></h1>	 -->
		<?php $group = ''; $li = 0; ?>
		<?php $ul = $this->params->get('contact_column', 3) == 3 ? 4 : 6; ?>
		<?php foreach ($this->items as $key => $item) : ?>
			<?php if ($item->position < 20) : ?>
				<!-- INICI MOSTRA ELS JUGADORS SEPERATS PER POSICIÓ -->
				<?php if ($group != $item->position) : ?>
					<?php if ($key > 0) { echo '</ul>'; } ?>
					<h3 class="blau espai_inferior plantilla text-center"><?php echo JText::_(JHtml::_('jboptions.position', $item->position)); ?></h3><ul class="thumbnails">
					<?php $group = $item->position; ?>
					<?php $li = 0; ?>
				<?php elseif ($li == $ul) : ?>
					</ul><ul class="thumbnails">
					<?php $li = 0; ?>
				<?php endif; ?>
				<!-- FI MOSTRA ELS JUGADORS SEPARATS PER POSICIÓ -->
			<?php endif; ?>
			<?php if ($item->position > 19 and $item->position < 100) : ?>
				<!-- INICI MOSTRA EL COS TÈCNIC SENSE SEPARAR -->
				<?php if ($group != $item->contact_group) : ?>
					<?php if ($key > 0) { echo '</ul>'; } ?>
					<h3 class="blau espai_inferior plantilla text-center"><?php echo JText::_(JHtml::_('jboptions.contact_group', $item->contact_group)); ?></h3><ul class="thumbnails">
					<?php $group = $item->contact_group; ?>
					<?php $li = 0; ?>
				<?php elseif ($li == $ul) : ?>
					</ul><ul class="thumbnails">
					<?php $li = 0; ?>
				<?php endif; ?>
				<!-- FI MOSTRA EL COS TÈCNIC SENSE SEPARAR -->
			<?php endif; ?>
			<!-- INICI MOSTRA ELS MEMBRES DEL CLUB -->
			<?php if ($item->position > 99) : ?>
				<?php if ($group != $item->contact_group) : ?>
					<?php if ($key > 0) { echo '</ul>'; } ?>
					<h1 class="blau seperador"><?php echo JText::_(JHtml::_('jboptions.contact_group', $item->contact_group)); ?></h1><ul class="thumbnails">
					<?php $group = $item->contact_group; ?>
					<?php $li = 0; ?>
				<?php elseif ($li == $ul) : ?>
					</ul><ul class="thumbnails">
					<?php $li = 0; ?>
				<?php endif; ?>
			<?php endif; ?>
			<!-- FI MOSTRA ELS MEMBRES DEL CLUB -->
			
			<?php $li++; ?>
			<li class="span<?php echo $this->params->get('contact_column', 3); ?>">
				<div class="thumbnail">
					<?php if ($item->thumbnailUrl) : ?>
						<img class="center img-rounded" title="<?php echo $item->contact; ?>" src="<?php echo JURI::root().$item->thumbnailUrl; ?>">
					<?php endif; ?>
					<div class="caption">
						<h4>
							<?php if ($item->contact_group == 1 and !empty($item->number)) : ?>
								<span class="num-jugador"><?php echo $item->number; ?></span> -  
							<?php endif; ?>
							<?php echo $item->alias; ?>
						</h4>
						<p><?php echo $item->position ? JText::_(JHtml::_('jboptions.position', $item->position)) : '-'; ?></p>
						<?php if ($item->contact_group == 22) : ?>
							<p><?php echo $item->team; ?></p>
						<?php endif; ?>
					</div>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>

<?php if ($this->params->get('show_powered', 1) AND !$this->print) { JoomBallUtils::footer(); } ?>
