<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ?></title>
<link rel="shortcut icon" href="../favicon.ico" />
<?php $this->load->view('backoffice/asset'); ?>

<script type="text/javascript">
$(function() 
{
	$("input[type=submit]").button();
	$('#username').focus();
});
</script>

<style type="text/css">

div.gadget 
{ 
	padding: 0px; 
	max-width: 350px; 
	margin: auto;
	box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.5);
}

#header
{
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
}

#form_section 
{ 
	background: #FFF; 
	padding: 20px;
}

#form_section label
{
	font-size: 14px;
}

#footer
{
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
}

p { margin: 0px; }

form 
{ 
	padding: 0px 10px;
	margin-left: -13px;
}

input[type=text], input[type=password] { width: 100%; }

#submit
{ 
	position: relative;
	margin-right: -10px; 
}

.table
{
	display: table;
	height: 100%;
	position: absolute;
	top: 0;
}

.table_cell 
{ 
	display: table-cell; 
	vertical-align: middle;
}
</style>
</head>

<body class="table">
<div class="table_cell">
	<div class="gadget">
		<div id="header">
			<h2><?php echo $theme['header_text_1'] ?></h2>
			<?php echo image_asset('line_gradient_300px.png', 'backoffice', array('alt'=>'line', 'width'=>'100%', 'height'=>'1')); ?>
			<h3><?php echo $theme['header_text_2'] ?></h3>
		</div>
		<div id="form_section">
			<p id="error_msg" class="center red text_12"><?php echo $error_msg ?></p>
			<?php echo form_open($form_target); ?>
				<label for="username"><?php echo $this->lang->line('username') ?></label>
				<input type="text" name="username" id="username" value="" />
				<label for="password"><?php echo $this->lang->line('password') ?></label>
				<input type="password" name="password" id="password" />
				<div class="right">
					<input name="Submit" id="submit" type="submit" value="<?php echo $this->lang->line('login') ?>" />
				</div>
			<?php echo form_close() ?>
		</div>
		<div id="footer"><?php echo $theme['footer_text'] ?></div>
	</div>
</div>
</body>
</html>