<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $theme['header_text_1'] . ' - ' . $title ?></title>
<link rel="shortcut icon" href="../favicon.ico" />
<?php $this->load->view('backoffice/asset'); ?>
<script type="text/javascript">
$(function() 
{
	$('#username').focus();
	
	$('#dialog').dialog({
	title		: '<?php echo $theme['header_text_1'] ?>',
	autoOpen	: true,
	resizable	: false,
	draggable	: false,
	width		: 300,
	height		: 'auto',
	modal		: false,
	buttons		: [
					{
						text	: LANG_LOGIN,
						click	: function() 
								  {
									  $('form').submit();
								  }
					}
				  ]
	});	
	
	$('form').keypress(function(event)
	{
		if(event.keyCode == '13') 
		{
			$(this).submit();
		}
	});
});
</script>
<style type="text/css">
#error_msg { margin: 15px 0px; }
div.ui-dialog a.ui-dialog-titlebar-close { display: none; }
</style>
</head>

<body>
<div id="dialog" class="dialog">
	<p id="error_msg" class="center red text_12 bold"><?php echo $error_msg ?></p>
	<?php echo form_open($form_target); ?>
		<label for="username"><?php echo $this->lang->line('username') ?></label>
		<input type="text" name="username" id="username" value="" />
		<label for="password"><?php echo $this->lang->line('password') ?></label>
		<input type="password" name="password" id="password" />
	<?php echo form_close() ?> </div>
</body>
</html>