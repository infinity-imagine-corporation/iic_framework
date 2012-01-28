<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ?></title>
<?php $this->load->view('backoffice/asset'); ?>
</head>
<body id="<?php echo $page ?>">
<div id="container">
	<!--<div id="header">
		<h1><?php echo $title ?></h1>
		<h2><?php echo $theme['header_text_1'] ?></h2>
		<?php echo image_asset('line_gradient_300px.png', 'backoffice', array('alt'=>'line')); ?>
		<h3><?php echo $theme['header_text_2'] ?></h3>
	</div>-->
	<div id="menu">
		<?php $this->load->view('backoffice/menu'); ?>
	</div>
	<div id="navigator">
		<?php $this->load->view('backoffice/navigator'); ?>
	</div>
	
	<div id="content">
		<div id="preload">Loading...</div>
		<?php 
		if($template != '')
		{
			$this->load->view($template); 
		}
		else 
		{
			$this->load->view($page); 
		}
		?>
		<div id="dialog_alert" class="dialog">
			<p><span class="ui-icon ui-icon-alert"></span><span id="dialog_alert_message"></span></p>
		</div>
		<div id="dialog_create" class="dialog"></div>
		<div id="dialog_read" class="dialog"></div>
		<div id="dialog_update" class="dialog"></div>
		<div id="dialog_delete" class="dialog">
			<p><span class="ui-icon ui-icon-alert"></span>
			ข้อมูลที่คุณเลือกจะถูกลบอย่างถาวร โดยไม่สามารถนำกลับมาได้ คุณต้องการลบใช่หรือไม่?</p>
		</div>
	</div>
	<div class="clear"></div>
	<div id="footer"><?php echo $theme['footer_text'] ?></div>
</div>
</body>
</html>