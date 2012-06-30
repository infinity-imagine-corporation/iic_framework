<?php $button_text = (isset($button_text) && $button_text != '') ? $button_text : 'OK'; ?>
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
	$('#dialog').dialog(
	{
		title		: '<?php echo $title ?>',
		autoOpen	: true,
		resizable	: false,
		draggable	: false,
		width		: 400,
		height		: 'auto',
		modal		: false,
		zIndex		: 2000,
		buttons		: [
						  {
							text	: '<?php echo $button_text; ?>',
							click	: function() 
									  {
										  window.open('<?php echo base_url().$url_target ?>','_self');
									  }
						  }
					  ]
	});	
	
	$('body').keypress(function(event)
	{
		if (event.keyCode == '13') 
		{
			window.open('<?php echo base_url().$url_target ?>','_self');
		}
	})
});
</script>
<style type="text/css">
li { list-style: circle; margin-left: 15px; }
hr { border-top-style: dashed; }
div.ui-dialog a.ui-dialog-titlebar-close { display: none; }
#dialog { margin-top: 10px; }
</style>
</head>

<body>
<div id="dialog" class="dialog">
	<?php echo $message; ?>
</div>
</body>
</html>