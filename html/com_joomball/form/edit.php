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
JHtml::_('behavior.tabstate');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.calendar');
JHtml::_('behavior.formvalidation');
JHtml::_('jbfileupload.fileUpload');
JHtml::_('jbselect2.select2', 'select');

$listDirn = 'asc';
$saveOrderingUrl = 'index.php?option=com_joomball&view=media&format=json&_method=ORDER';
JHtml::_('sortablelist.sortable', 'fileList', 'item-form', strtolower($listDirn), $saveOrderingUrl);
?>

<script type="text/javascript">

	<?php if ($this->template->content and $this->pluginActive) : ?>

	jQuery(document).ready(function (){
		'use strict';
	
		var url = '<?php echo $this->url; ?>';
	
		// Initialize the jQuery File Upload widget:
		jQuery('#item-form').fileupload({
			// Uncomment the following to send cross-domain cookies:
			//xhrFields: {withCredentials: true},
			url: url,
			autoUpload: true,
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				jQuery('#progress .progress-bar').css(
					'width',
					progress + '%'
				);
			}
		});

		// Load existing files:
		jQuery.ajax({
			url: jQuery('#item-form').fileupload('option', 'url'),
			dataType: 'json',
			context: jQuery('#item-form')[0]
		}).always(function () {
			jQuery(this).removeClass('fileupload-processing');
		}).done(function (result) {
			jQuery(this).fileupload('option', 'done')
				.call(this, jQuery.Event('done'), {result: result});
		});
	});

	<?php endif; ?>

	<?php if ($this->template->date or $this->template->score) : ?>
		jQuery(document).ready(function (){
			
			jQuery('#jform_team1_id,#jform_team2_id').select2({
				placeholder: Joomla.JText._('COM_JOOMBALL_FIELD_TEAM_SELECT'),
				allowClear: true
			});
			
		});
	<?php endif; ?>
	
	Joomla.submitbutton = function(task)
	{
		if (task == 'form.cancel' || document.formvalidator.isValid(document.id('item-form')))
		{
			Joomla.submitform(task, document.getElementById('item-form'));
		}
	}
	
</script>

<div class="edit item-page<?php echo $this->pageclass_sfx; ?>">
	
	<?php if ($this->template->breadcrumb) : ?>
	
	<ul class="breadcrumb" style="margin: 0 0 10px 0;padding: 2px 15px 4px 15px;">
		<li style="padding: 9px 0px 7px 0px;">
			<?php echo $this->matchday->project; ?>
			<span class="divider">/</span>
		</li>
		<li style="padding: 9px 0px 7px 0px;"" class="active">
			<?php echo $this->matchday->matchday_number; ?>
	    </li>
	</ul>
	
	<?php endif; ?>
	
	<div class="navbar" id="jb-navbar">
		<div class="navbar-inner">
			<a class="brand"><?php echo $this->title; ?></a>
		</div>
	</div>
	
	<form action="<?php echo JRoute::_($this->link); ?>" method="post" name="adminForm" id="item-form" enctype="multipart/form-data" class="form-validate">
		
		<div class="row-fluid">
		
			<div id="toolbar" class="btn-toolbar">
				<?php if (!empty($this->item->id)) : ?>
						<div id="toolbar-preview" class="btn-wrapper">
						<?php echo JHtml::_('icon.preview',  $this->item); ?>
						</div>	
				<?php endif; ?>
				<div id="toolbar-apply" class="btn-wrapper">
					<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('form.apply')">
						<span class="icon-edit icon-white"></span>&#160;<?php echo JText::_('COM_JOOMBALL_TOOLBAR_APLY') ?>
					</button>
				</div>
				<div id="toolbar-save" class="btn-wrapper">
					<button type="button" class="btn btn-success" onclick="Joomla.submitbutton('form.save')">
						<span class="icon-ok"></span>&#160;<?php echo JText::_('COM_JOOMBALL_TOOLBAR_SAVE_CLOSE') ?>
					</button>
				</div>
				<div id="toolbar-cancel" class="btn-wrapper">
					<button type="button" class="btn btn-danger" onclick="Joomla.submitbutton('form.cancel')">
						<span class="icon-remove"></span>&#160;<?php echo JText::_('COM_JOOMBALL_TOOLBAR_CANCEL') ?>
					</button>
				</div>
			</div>
			
		</div>
		
		<fieldset>
		
			<?php // --> Afegim jornada en cas que n'hi hagi
				if($this->template->score & !$this->template->chronic) { ?>
					<?php echo $this->loadTemplate('score'); ?>
			<?php } ?>
			
			<?php // --> Afegim jornada en cas que n'hi hagi
				if($this->template->date & !$this->template->chronic) {
					echo $this->loadTemplate('date');
				}
			?>
			
			<?php // --> Afegim edici� de l'article o crònica
				if ($this->template->content) {
					echo $this->loadTemplate('content');
				}
			?>
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="return" value="<?php echo $this->return_page;?>" />
			<?php echo JHTML::_( 'form.token' ); ?>
		
		</fieldset>
	</form>

</div>

<?php echo JLayoutHelper::render('media.template', array('featured' => 1), JPATH_ADMINISTRATOR.'/components/com_joomball/layouts'); ?>
