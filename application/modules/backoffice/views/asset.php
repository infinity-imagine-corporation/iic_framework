<!--jQuery-->
<?php echo js_asset('jquery-1.6.1.min.js', 'backoffice');?>

<!--jQuery UI Theme-->
<?php echo js_asset('jquery-ui-1.8.10.custom.min.js', 'backoffice');?>
<?php echo css_asset('aristo/Aristo.css', 'iic_tools');?>

<!--jQuery UI - Date picker-->
<?php echo js_asset('jquery-ui-1.8.10.offset.datepicker.min.js', 'backoffice');?>
<?php echo js_asset('jquery.ui.datepicker-th.js', 'backoffice');?>

<!--Selectlist-->
<?php echo css_asset('jquery.selectlist.css', 'iic_tools');?>
<?php echo js_asset('jquery.selectlist.js', 'backoffice');?>

<!--Form Validate-->
<?php echo css_asset('jquery.validate.css', 'iic_tools');?>
<?php echo js_asset('jquery.validate.min.js', 'backoffice');?>
<?php echo js_asset('jquery.validate.config.js', 'backoffice');?>

<!--Ajax Form-->
<?php echo js_asset('jquery.form.js', 'backoffice');?>

<!--iic_tools assets-->
<?php echo css_asset('iic_layout.css', 'iic_tools');?>
<?php echo css_asset('iic_style.css', 'iic_tools');?>

<!--Backoffice assets-->
<?php echo css_asset('backoffice.css', 'backoffice');?>
<?php echo css_asset('backoffice_theme.css', 'backoffice');?>
<?php echo js_asset('ajax.config.js', 'backoffice');?>
<?php echo js_asset('main.js', 'backoffice');?>

<!--Module assets-->
<?php echo css_asset($module.'.css', $module);?>
<?php echo js_asset($module.'.js', $module);?>

<!--Page assets-->
<?php echo css_asset($page.'.css', $module);?>
<?php echo js_asset($page.'.js', $module);?>