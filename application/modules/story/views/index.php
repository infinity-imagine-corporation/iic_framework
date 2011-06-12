<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>List</title>
<?php echo css_asset('jquery.treeview.css', 'story'); ?>
<style type="text/css">
.bold { font-weight: bold; }

li
{
	font-size: 12px;
	line-height: 12px;
}

li.item:hover { background-color: #E7F1F8; }

table
{
	margin-top: -3px;
	width: 100%; 
}


td[rel=id_item]
{
	width: 20px;
	text-align: left;
}

td[rel=name]
{
	width: auto;
	text-align: left;
}

td[rel=important],td[rel=priority],td[rel=release_in_version]
{
	width: 50px;
	text-align: center;
}

td[rel=status_name]
{
	width: 150px;
}
</style>
<?php echo js_asset('jquery-1.5.1.min.js'); ?>
<?php echo js_asset('jquery.cookie.js', 'story'); ?>
<?php echo js_asset('jquery.treeview.js', 'story'); ?>
<script type="text/javascript">
$(function(){
	$("#navigation > ul").treeview({
		collapsed: false
	});
});
</script>
</head>
<body>
<div id="navigation">
<?php
	echo 'test';
?>
</div>
</body>
</html>