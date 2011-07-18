<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ?></title>

<!--iic_tools assets-->
<?php echo css_asset('aristo/jquery-ui-1.8.7.custom.css', 'iic_tools'); ?>
<?php echo css_asset('iic_layout.css', 'iic_tools'); ?>
<?php echo css_asset('iic_style.css', 'iic_tools'); ?>

<!--Backoffice assets-->
<?php echo css_asset('backoffice.css', 'backoffice'); ?>
<?php echo css_asset('backoffice_theme.css', 'backoffice'); ?>
<?php echo js_asset('jquery-1.6.1.min.js', 'backoffice'); ?>
<?php echo js_asset('jquery-ui-1.8.10.custom.min.js', 'backoffice'); ?>
<?php echo js_asset('ajax.config.js', 'backoffice'); ?>
<?php echo js_asset('main.js', 'backoffice'); ?>

<!--Module assets-->
<?php echo css_asset($page.'.css', $module); ?>
<?php echo js_asset($page.'.js', $module); ?>

</head>
<body id="<?php echo $title ?>">
<div id="container">
	<div id="header">
		<h1><?php echo $title ?></h1>
		<h2><?php echo $theme['header_text_1'] ?></h2>
		<?php echo image_asset('line_gradient_300px.png', 'backoffice', array('alt'=>'line')); ?>
		<h3><?php echo $theme['header_text_2'] ?></h3>
	</div>
	<div id="menu">
		<?php $this->load->view('backoffice/menu'); ?>
	</div>
	<div id="navigator">
		<div id="user_info">
			<b>User : </b><?php echo $this->session->userdata('name'); ?>&nbsp;&nbsp;
			<b>Group : </b><?php echo $this->session->userdata('group'); ?>&nbsp;&nbsp;
			<b>Role : </b><?php echo $this->session->userdata('role'); ?> 
		</div>
		<div id="address">Home</div>
	</div>
	
	<div id="content">
		<div id="preload">Loading...</div>
		<?php $this->load->view($page); ?>
		<div id="dialog_alert" class="dialog">
			<p><span class="ui-icon ui-icon-alert"></span><span id="dialog_alert_message"></span></p>
		</div>
		<div id="dialog_create" class="dialog"></div>
		<div id="dialog_update" class="dialog"></div>
		<div id="dialog_delete" class="dialog">
			<p><span class="ui-icon ui-icon-alert"></span>
			These items will be permanently deleted and cannot be recovered. Are you sure?</p>
		</div>
	</div>
	<div class="clear"></div>
	<div id="footer"><?php echo $theme['footer_text'] ?></div>
</div>
</body>
</html>