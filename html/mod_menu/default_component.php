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
$class = $item->anchor_css ? 'class="' . $item->anchor_css . '" ' : '';
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

switch ($item->browserNav)
{
	default:
	case 0:
		?><a <?php 
		echo $class;
		?>href="<?php 
		echo $item->flink;
		?>" <?php 
		echo $title;
		if ($item->deeper and $item->level == 1) { echo ' class="dropdown-toggle" data-toggle="dropdown"'; }
		?>><?php 
		echo $linktype;
		if ($item->deeper and $item->level == 1) { ?><b class="caret"></b><?php }
		?></a><?php
		break;
	case 1:
		// _blank
		?><a <?php 
		echo $class;
		?>href="<?php 
		echo $item->flink;
		?>" target="_blank" <?php 
		echo $title;
		?>><?php 
		echo $linktype;
		?></a><?php
		break;
	case 2:
		// Window.open
		?><a <?php 
		echo $class;
		?>href="<?php 
		echo $item->flink;
		?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;" <?php 
		echo $title;
		?>><?php 
		echo $linktype;
		?></a>
		<?php
		break;
}
