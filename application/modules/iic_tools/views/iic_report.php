<?php 
$css			= (isset($css )) ? $css : '';
$button_text	= (isset($button_text )) ? $button_text : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ?></title>
<link rel="stylesheet" type="text/css" href="../iic_tools/css/iic_layout.css" />
<link rel="stylesheet" type="text/css" href="../iic_tools/css/iic_style.css" />
<?php if($css != '') { echo '<link rel="stylesheet" type="text/css" href="'.$css.'" />';} ?>
<style type="text/css">
li { list-style: circle; }
hr { border-top-style: dashed; }
#button_ok.iic_button, a.iic_button { color: #555; }
</style>
</head>
<body>
<div class="center_box" <?php if($url_target != ''){ echo 'onkeypress="window.open(\''.$url_target.'\',\'_self\')"';} ?>>
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
				echo '<a id="button_ok" class="iic_button" href="'.$url_target.'">'.$button_text.'</a>';
			}
			?>
		</div>
	</div>
</div>
</body>
</html>