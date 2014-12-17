<?php
/**
 * FW Gallery 3.0
 * @copyright (C) 2014 Fastw3b
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.fastw3b.net/ Official website
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );

if ($this->path) {
	$item = $this->path[count($this->path) - 1];
	$back_link = 'index.php?option=com_fwgallery&view=gallery&id='.$item->id.':'.JFilterOutput :: stringURLSafe($item->name).'&Itemid='.JFHelper :: getItemid('gallery', $item->id, JRequest :: getInt('Itemid').'#fwgallerytop');
	$back_title = 'FWG_RETURN_TO_PARENT_GALLERY';
} else {
	$back_link = 'index.php?option=com_fwgallery&view=galleries&Itemid='.JFHelper :: getItemid('galleries', 0, JRequest :: getInt('Itemid'));
	$back_title = 'FWG_RETURN_TO_LIST_OF_GALLERIES';
}
$id = JRequest :: getString('id');

JHTML :: _('behavior.framework', true);
JHTML :: script('components/com_fwgallery/assets/js/cerabox.min.js');

?>
<div id="fwgallery" class="fw-gallery">
	<a name="fwgallerytop"></a>
<?php
if (!$this->params->get('hide_iphone_app_promo') and JFHelper :: detectIphone()) {
?>
	<div class="fwg-iphone-promo"><img src="<?php echo JURI :: root(true); ?>/components/com_fwgallery/assets/images/iPhoneAppStore_transp_mini.png" /></div>
<?php
}
?>
    <div class="fwg-header-return">
    	<h4>
		<a href="<?php echo JRoute::_($back_link); ?>">
			<?php echo JText :: _($back_title); ?>
			<i class="fa fa-arrow-circle-left fa-lg"></i>
		</a>
		</h4>
    </div>
	<div class="fwg-title">
		<h1 class="blau seperador">
			<?php echo $this->obj->name; ?>
		</h1>
	</div>
	<div class="fwg-description"><?php echo $this->obj->descr; ?></div>
	<form action="<?php echo JRoute :: _('index.php?option=com_fwgallery&view=gallery&Itemid='.JRequest :: getInt('Itemid').($id?('&id='.$id):'')); ?>" method="post">
<?php
if ($this->subcategories) {
?>
		<div class="fw-galleries fw-subgalleries">
		    <div class="fwgs-header row-fluid">
<?php
	if ($this->params->get('display_gallery_sorting')) {
?>
				<div class="fwgs-header-ordering span6">
					<?php echo JText :: _('FWG_ORDER_BY'); ?>: <?php echo JHTML :: _('select.genericlist', array(
						JHTML :: _('select.option', 'name', JText :: _('FWG_ALPHABETICALLY'), 'id', 'name'),
						JHTML :: _('select.option', 'new', JText :: _('FWG_NEWEST_FIRST'), 'id', 'name'),
						JHTML :: _('select.option', 'old', JText :: _('FWG_OLDEST_FIRST'), 'id', 'name'),
						JHTML :: _('select.option', 'order', JText :: _('FWG_ORDERING'), 'id', 'name')
					), 'subcategory_order', 'onchange="this.form.submit();"', 'id', 'name', $this->subcategory_order); ?>
				</div>
<?php
	}
    if ($this->params->get('display_total_galleries')) {
?>
			    <div class="fwgs-header-total span6"><?php echo JText::_('FWG_TOTAL_SUB_GALLERIES').': '.$this->gpagination->total; ?></div>
<?php
    }
?>
		    </div>
		    <div class="fwg-images-row row-fluid">
<?php
	$this->counter = 1;
	$this->row_limit = $this->params->get('galleries_a_row', 3);
	$this->gallery_image_height = $this->params->get('im_th_h');

	foreach ($this->subcategories as $row) {
		$this->row = $row;
		if (file_exists(dirname(__FILE__).'/../galleries/default_item.php')) include(dirname(__FILE__).'/../galleries/default_item.php');
		else include(JPATH_SITE.'/components/com_fwgallery/views/galleries/tmpl/default_item.php');

        if ($this->counter >= $this->row_limit) {
?>
    		</div>
		    <div class="fwg-images-row row-fluid">
<?php
        	$this->counter = 1;
        } else $this->counter++;
	}
?>
			</div>
		</div>
        <div class="pagination">
        	<?php echo $this->gpagination->getPagesLinks(); ?>
        </div>
<?php
}
if ($this->list) {
	$this->row_limit = $this->params->get('images_a_row', 3);
	$this->image_height = $this->params->get('im_mid_h');
?>
	    <div class="fwgs-header row-fluid">
<?php
if ($this->params->get('display_gallery_sorting')) {
?>
			<div class="fwgs-header-ordering">
				<?php echo JText :: _('FWG_ORDER_BY'); ?>: <?php echo JHTML :: _('select.genericlist', array(
					JHTML :: _('select.option', 'name', JText :: _('FWG_ALPHABETICALLY'), 'id', 'name'),
					JHTML :: _('select.option', 'new', JText :: _('FWG_NEWEST_FIRST'), 'id', 'name'),
					JHTML :: _('select.option', 'old', JText :: _('FWG_OLDEST_FIRST'), 'id', 'name'),
					JHTML :: _('select.option', 'order', JText :: _('FWG_ORDERING'), 'id', 'name'),
					JHTML :: _('select.option', 'voting', JText :: _('FWG_VOTING'), 'id', 'name')
				), 'order', 'onchange="this.form.submit();"', 'id', 'name', $this->order); ?>
			</div>
<?php
}
?>
	        <div class="clr"></div>
	    </div>
		<div class="fwg-images">
			<div class="fwg-images-row row-fluid">
<?php
	$this->new_days = $this->params->get('new_days');
	$this->counter = 1;
    foreach ($this->list as $row) {
    	$this->row = $row;
?>
				<div class="fwg-item span<?php echo $this->images_columns; ?>">
<?php
		echo $this->loadTemplate('item');
?>
				</div>
<?php
        if ($this->counter >= $this->row_limit) {
?>
        	</div>
			<div class="fwg-images-row row-fluid">
<?php
        	$this->counter = 1;
        } else $this->counter++;
    }
?>
			</div>
    	</div>
        <div class="pagination text-center">
        	<?php echo $this->pagination->getPagesLinks(); ?>
        </div>
<?php
	if ($this->params->get('display_galleries_lightbox')) {
?>
<script type="text/javascript">
window.addEvent('domready', function() {
	document.getElements('.fwgs-image a').each(function(el) {
		el.addEvent('click', function() {
			var id = document.getElement(this).getProperty('rel');
			if (id) {
				if (document.getElement('#fwg-preview-gallery')) document.getElement('#fwg-preview-gallery').dispose();
				if (document.getElement('#fwg-lightbox')) document.getElement('#fwg-lightbox').dispose();
				if (document.getElement('#fwg-lightboxOverallView')) document.getElement('#fwg-lightboxOverallView').dispose();
				if (document.getElement('#fwg-lightboxIndicator')) document.getElement('#fwg-lightboxIndicator').dispose();

				new Request.JSON({
					url: '<?php echo JRoute :: _('index.php?option=com_fwgallery&view=gallery', false); ?>',
					data: {
						id: id,
						format: 'json'
					},
					onSuccess: function(data) {
						var div = new Element('div', {
							'id': 'fwg-preview-gallery',
							'style': 'display: none'
						});
						div.inject(document.getElement('body'));
						for (var i in data.images) {
							var link = new Element('a', {
								'class':'fwg-lightbox',
								'href': data.images[i].link,
								'rel':'fwg-lightbox-gallery-link'
							});
							link.inject(div);
							var image = new Element('img', {
								alt: data.images[i].descr
							});
							image.inject(link);
						}
						var cerabox = new CeraBox(div.getElements('a.fwg-lightbox'), {
							titleFormat: 'Image {number} / {total} {title}'
						});
						div.getElement('a.fwg-lightbox').fireEvent('click');
					}
				}).send();
			}
		});
	});
});
</script>
<?php
	}
	if (!defined('FWGALLERY_LIGHTBOX_LOADED')) {
		define('FWGALLERY_LIGHTBOX_LOADED', true);
		echo $this->loadTemplate('scripts');
	}
} else {
    echo JText::_('FWG_NO_IMAGES_IN_THIS_GALLERY_');
}
?>
	</form>
</div>
<?php
if (!$this->params->get('hide_fw_copyright')) {
?>
<div id="fwcopy" style="display:block;visibility:visible;text-align:center;font-size:10px;padding:20px 0;">
	<?php echo JText::_("FWG_POWERED_BY"); ?> <a href="http://fastw3b.net/fwgallery.html" target="_blank"><?php echo JText::_("FWG_FW_GALLERY"); ?></a>
</div>
<?php
}
?>
