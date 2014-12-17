<?php
/**
 * 
 * @package			Joomla
 * @subpackage		Templates - joomball
 * 
 * @author			JoomBall! Project
 * @link			http://www.joomball.com
 * @copyright		Copyright © 2011 JoomBall! Project - All Rights Reserved
 * @license			GNU/GPL, http://www.gnu.org/licenses/gpl-3.0.html
 * 
 **/

// No direct access
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
$title = $item->anchor_title ? 'title="' . $item->anchor_title . '" ' : '';
if ($item->menu_image)
{
	$item->params->get('menu_text', 1) ?
	$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" /><span class="image-title">' . $item->title . '</span> ' :
	$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" />';
}
else
{
	$linktype = $item->title;
}
?>

<a  href="<?php echo $item->flink; ?>" <?php echo $title;
	if ($item->deeper and $item->level == 1) { echo ' class="separator dropdown-toggle" data-toggle="dropdown"'; }
?>><?php echo $linktype;
if ($item->deeper and $item->level == 1) { ?>  <b class="caret"></b><?php }
?></a>
		
