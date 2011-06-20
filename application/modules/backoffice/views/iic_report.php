<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ?></title>
<link rel="shortcut icon" href="../favicon.ico" />
<?php echo css_asset('aristo/jquery-ui-1.8.7.custom.css', 'iic_tools'); ?>
<?php echo css_asset('iic_layout.css', 'iic_tools'); ?>
<?php echo css_asset('iic_style.css', 'iic_tools'); ?>
<?php echo css_asset('backoffice.css', 'backoffice'); ?>

<?php echo js_asset('jquery-1.5.1.min.js'); ?>
<?php echo js_asset('jquery-ui-1.8.10.custom.min.js'); ?>

<script type="text/javascript">
$(function() {
	$("input[type=submit],a.button").button();
});
</script>
<style type="text/css">
li { list-style: circle; }
hr { border-top-style: dashed; }
</style>
</head>
<body>
<div class="center_box" <?php if($url_target != ''){ echo 'onkeypress="window.open(\'' . $url_target . '\',\'_self\')"';} ?>>
	<div class="gadget">
		<h3><?php echo $title; ?></h3>
		<hr />
		<div> <?php echo $message; ?> </div>
		<hr />
		<div class="center">
			<?php 
			if($url_target != '')
			{
				$button_text = ($button_text == '') ? 'OK' : $button_text;
				echo anchor($url_target, $button_text, 'class="button"');
			}
			?>
		</div>
	</div>
</div>
</body>
</html>