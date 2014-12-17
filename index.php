<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript('templates/' . $this->template . '/js/template.js');
$doc->addScript('templates/' . $this->template . '/js/scroll.js');

// Add Stylesheets
$doc->addStyleSheet('templates/' . $this->template . '/css/template.css');
$doc->addStyleSheet('templates/' . $this->template . '/css/font-awesome.css');
$doc->addStyleSheet('templates/' . $this->template . '/css/buttons.css');
$doc->addStyleSheet('templates/' . $this->template . '/css/competicio.css');
$doc->addStyleSheet('templates/' . $this->template . '/css/ceroda.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle')) . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<?php // Use of Google Font ?>
	<?php if ($this->params->get('googleFont')) : ?>
		<link href='//fonts.googleapis.com/css?family=<?php echo $this->params->get('googleFontName'); ?>' rel='stylesheet' type='text/css' />
		<style type="text/css">
			h1,h2,h3,h4,h5,h6,.site-title{
				font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFontName')); ?>', sans-serif;
			}
		</style>
	<?php endif; ?>
	<?php // Template color ?>
	<?php if ($this->params->get('templateColor')) : ?>
	<style type="text/css">
		body.site
		{
			border-top: 3px solid <?php echo $this->params->get('templateColor'); ?>;
			background-color: <?php echo $this->params->get('templateBackgroundColor'); ?>
		}
		a
		{
			color: <?php echo $this->params->get('templateColor'); ?>;
		}
		.navbar-inner, .nav-list > .active > a, .nav-list > .active > a:hover, .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover, .nav-pills > .active > a, .nav-pills > .active > a:hover,
		.btn-primary
		{
			background: <?php echo $this->params->get('templateColor'); ?>;
		}
		.navbar-inner
		{
			-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
		}
	</style>
	<?php endif; ?>
	<!--[if lt IE 9]>
		<script src="<?php echo $this->baseurl; ?>/media/jui/js/html5.js"></script>
	<![endif]-->
</head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
?>">

	<!-- Body -->
	<div class="body">

			<!-- Header -->
			<?php if ($this->countModules('logo')) : ?>
			<header class="header" role="banner">
				<div class="header-inner clearfix">
					<div class="logo">
						<a class="brand pull-left" href="<?php echo $this->baseurl; ?>">
							<jdoc:include type="modules" name="logo" style="none" />
						</a>
					</div>
				</div>
			</header>
			<?php endif; ?>
			<?php if ($this->countModules('navigation')) : ?>
				<nav class="navigation" role="navigation" id="main-nav">
				    <div class="navbar">
				    	<div class="navbar-inner">
				    		<div class="menus">
						        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						           <span class="icon-bar"></span>
						           <span class="icon-bar"></span>
						           <span class="icon-bar"></span>
						        </a>
						        <h1 class="text-center exo hidden-desktop">MENU</h1>
						        <div class="nav-collapse collapse">
									<jdoc:include type="modules" name="navigation" style="none" />	        	
						        </div>
						    </div>
				    	</div>
					</div>  
					
				</nav>
			<?php endif; ?>

			<?php if ($this->countModules('subnavigation')) : ?>
				<nav class="subnavigation" role="navigation">
					<jdoc:include type="modules" name="subnavigation" style="none" />
				</nav>
			<?php endif; ?>

		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			
			<jdoc:include type="message" />

			<!-- Sobre contingut -->
			<?php if ($this->countModules('top-content')) : ?>
				<div class="top-content">
					<jdoc:include type="modules" name="top-content" style="none" />
				</div>
			<?php endif; ?>
			<!-- Sobre contingut -->

			<div class="row-fluid">
				<?php if ($this->countModules('esquerra')) : ?>
					<!-- Begin Sidebar -->
					<div id="sidebar" class="span3">
						<div class="sidebar-nav">
							<jdoc:include type="modules" name="esquerra" style="xhtml" />
						</div>
					</div>
					<!-- End Sidebar -->
				<?php endif; ?>
				<main id="content" role="main" class="<?php echo $span; ?>">
					<!-- Begin Content -->
					<jdoc:include type="modules" name="position-3" style="xhtml" />
					
					<jdoc:include type="component" />
					<jdoc:include type="modules" name="position-2" style="none" />
					<!-- End Content -->
				</main>
				<?php if ($this->countModules('dreta')) : ?>
					<div id="aside" class="span3">
						<!-- Begin Right Sidebar -->
						<jdoc:include type="modules" name="dreta" style="xhtml" />
						<!-- End Right Sidebar -->
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<footer class="footer" role="contentinfo">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<div class="row-fluid">
			<jdoc:include type="modules" name="footer" style="none" />
			<p class="span11 superior10">
				&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?> | Tots els drets reservats 
				| Desenvolupament <a href="http://www.websdefutbol.com" target="_blank" title="Webs de Futbol">Webs de Futbol</a>
			</p>
			<p class="span1 text-right">
				<a href="#top" id="back-top">
					<i class="icon-chevron-up amunt"></i>
					<!-- <?php echo JText::_('TPL_PROTOSTAR_BACKTOTOP'); ?> -->
				</a>
			</p>
			</div>
		</div>
	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
