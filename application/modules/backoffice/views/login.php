<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ?></title>
<link rel="shortcut icon" href="../favicon.ico" />
<?php echo css_asset('iic_layout.css', 'iic_tools'); ?>
<?php echo css_asset('iic_style.css', 'iic_tools'); ?>
<?php echo css_asset('backoffice_theme.css', 'backoffice'); ?>
<style type="text/css">
.center_box > div.gadget { padding: 1px; width: 350px; }

#form_section { padding: 20px; }

input[type=text], input[type=password] { width: 300px; }
</style>
</head>

<body onload="document.getElementById('username').focus();">
<div class="center_box">
	<div class="gadget">
		<div id="head_section">
			<h2><?php echo $theme['head_text1'] ?></h2>
			<?php echo image_asset('line_gradient_300px.png', 'backoffice', array('alt'=>'line', 'width'=>'100%', 'height'=>'1')); ?>
			<h3><?php echo $theme['head_text2'] ?></h3>
		</div>
		<div id="form_section">
			<p id="error_msg" class="center red text_12 bold"><?php echo $error_msg ?></p>
			<?php echo form_open('backoffice/login/validate'); ?>
				<label for="username">Username</label>
				<input type="text" name="username" id="username" value="" />
				<label for="password">Password</label>
				<input type="password" name="password" id="password" />
				<div class="center">
					<input name="Submit" type="submit" value="Login" />
				</div>
			<?php echo form_close() ?>
		</div>
		<div id="foot_section"><?php echo $theme['foot_text'] ?></div>
	</div>
</div>
</body>
</html>