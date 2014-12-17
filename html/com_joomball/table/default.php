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

?>
<script type="text/javascript">

	jQuery(document).ready(function (){
		jQuery("#select-round").select2();

		// Per casos de partits en Joc
		blink();
	});

	function joomball_changedoc(docid){
	  if (docid != "" && docid.options[docid.options.selectedIndex].value!="") {
	    window.location.href = docid.options[docid.options.selectedIndex].value;
	  }
	}
	
</script>
<ul class="breadcrumb" style="margin: 0 0 10px 0;padding: 2px 15px 4px 15px;">
    <li style="padding: 9px 0px 7px 0px;">
		<?php echo JText::_('COM_JOOMBALL_GLOBAL_SPORT_'.$this->item->sport); ?>
    	<span class="divider">/</span>
    </li>
    <li style="padding: 9px 0px 7px 0px;"" class="active">
		<?php echo JText::_('COM_JOOMBALL_GLOBAL_SEASON') . ' ' . $this->item->season; ?>
    </li>
</ul>

<div class="navbar espai_inferior" id="jb-navbar">
	<div class="navbar-inner">
		<a class="brand"><?php echo JText::_('COM_JOOMBALL_GLOBAL_TABLE'); ?></a>
		<?php if (!$this->print) { ?>	
		<ul class="nav pull-right">
			<li>
				<?php echo JHtml::_('icon.calendar', $this->item->id, $this->params, array('style' => 'margin: 0;')); ?>
			</li>
			<li id="fat-menu" class="dropdown">
				<a id="drop3" class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="icon-tasks"></i><span class="hidden-phone"> <?php echo JText::_('JOPTIONS'); ?></span> <b class="caret"></b>
				</a>
				<ul class="dropdown-menu pull-right">
					<li class="print-icon hidden-phone"><?php echo JHtml::_('icon.print_popup',  $this->item, $this->params); ?></li>
					<li class="email-icon"><?php echo JHtml::_('icon.email',  $this->item, $this->params); ?></li>
				</ul>
			</li>
		
		<?php } elseif ($this->print) { ?>
			<li class="pull-right" style="margin: 10px 0;">
				<?php echo JHtml::_('icon.print_screen',  $this->item, $this->params); ?>
			</li>
		<?php } ?>
		</ul>
	</div>
</div>

<?php if ($this->options) : ?>
	<div class="row-fluid"><span class="pull-right">
		<?php
			echo JHTML::_('select.genericlist',$this->options,'select-round','onchange="joomball_changedoc(this);" class="input-large"','value','text', JURI::base().'index.php?option=com_joomball&view=table&id='.$this->item->id.'&matchday='.$this->mdNumber);
			
		//echo $this->options; ?>
	</span></div>
<?php endif; ?>

<h2><?php echo $this->item->project; ?></h2>

<?php
	if ($this->matchesPrev){
		echo $this->loadTemplate('matchday_prev');
	}
?>

<?php
	if ($this->item->sport == 3) {
		// Basquet
		echo $this->loadTemplate('table_basketball');
		//echo $this->loadTemplate('table');
	} elseif ($this->item->sport == 5) {
		// Voleibol
		//echo $this->loadTemplate('table_volleyball');
		echo $this->loadTemplate('table_basketball');
		//echo $this->loadTemplate('table');
	} else {
		echo $this->loadTemplate('table');
	}
?>

<?php
	if ($this->matchesNext){
		echo $this->loadTemplate('matchday_next');
	}
?>

<?php if ($this->params->get('show_powered', 1) AND !$this->print) { JoomBallUtils::footer(); } ?>
