<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ?></title>
<?php echo css_asset('aristo/jquery-ui-1.8.7.custom.css', 'iic_tools'); ?>
<?php echo css_asset('iic_layout.css', 'iic_tools'); ?>
<?php echo css_asset('iic_style.css', 'iic_tools'); ?>

<?php echo css_asset('backoffice.css', 'backoffice'); ?>
<?php echo css_asset('backoffice_theme.css', 'backoffice'); ?>

<?php echo css_asset($main_content.'.css', 'backoffice'); ?>

<?php echo js_asset('jquery-1.6.1.min.js'); ?>
<?php echo js_asset('jquery-ui-1.8.10.custom.min.js'); ?>
<?php echo js_asset('ajax.config.js'); ?>

<?php echo js_asset($main_content.'.js', 'backoffice'); ?>

</head>
<body id="<?php echo $title ?>">
<div id="container">
	<!--<div id="header">
		<h1><?php echo $title ?></h1>
		<h2><?php echo $theme['header_text_1'] ?></h2>
		<?php echo image_asset('line_gradient_300px.png', 'backoffice', array('alt'=>'line')); ?>
		<h3><?php echo $theme['header_text_2'] ?></h3>
	</div>-->
	<div id="menu">
		<?php $this->load->view('menu_main'); ?>
	</div>
	<div id="navigator">Home</div>
	<div id="content">
		<?php $this->load->view($main_content); ?>
	</div>
	<div class="clear"></div>
	<div id="footer"> <?php echo $theme['footer_text'] ?> </div>
</div>
</body>
</html>