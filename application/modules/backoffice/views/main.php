<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ?></title>
<?php echo css_asset('iic_layout.css', 'iic_tools'); ?>
<?php echo css_asset('iic_style.css', 'iic_tools'); ?>
<?php echo css_asset('backoffice_theme.css', 'backoffice'); ?>
</head>
<body>
<div id="container">
	<div id="head_section">
		<h1><?php echo $title ?></h1>
		<h2><?php echo $theme['head_text1'] ?></h2>
		<?php echo image_asset('line_gradient_300px.png', 'backoffice', array('alt'=>'line')); ?>
		<h3><?php echo $theme['head_text2'] ?></h3>
	</div>
	<div id="menu_section">
		<ul class="menu_main">
			<li class="active"><a href="#">Home</a></li>
			<!-- system -->
			<li class="float_r"><a href="backoffice/login/logout">Logout</a></li>
			<li class="float_r"><a href="#">Option&nbsp;&nbsp;<span class="text_8">▼</span></a>
				<ul>
					<li><a href="#">User</a></li>
					<li><a href="#">Theme</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div id="navigation"> Home </div>
	<div id="content_section">
		<?php $this->load->view($main_content); ?>
	</div>
	<div class="clear"></div>
	<div id="foot_section"> <?php echo $theme['foot_text'] ?> </div>
</div>
</body>
</html>