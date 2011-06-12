<?php
	require_once('connect.php');
	
	function list_category($id_parent = 0)
	{
		$sql = 'SELECT id_category, name 
				FROM category 
				WHERE id_parent = ' . $id_parent;
		$result = mysql_query($sql);
		
		if(mysql_num_rows($result) > 0)
		{
			$list = '<ul>';
			
			while($data = mysql_fetch_array($result))
			{
				// count category
				$sql = 'SELECT id_category, name 
						FROM category 
						WHERE id_parent = ' . $data['id_category'];
				$result_category = mysql_query($sql);
				$result_category_row = mysql_num_rows($result_category);
				
				// count item
				$sql = 'SELECT *
						FROM category_item
						WHERE id_category = ' . $data['id_category'];
				$result_feature = mysql_query($sql);
				$result_feature_row = mysql_num_rows($result_feature);
				
				$list .= '<li><span class="bold">' . $data['name'] . '</span> (' . $result_category_row . '/' . $result_feature_row . ') ';
				$list .= '<i class="category_option">[ <i class="edit_category" rel="' . $data['id_category'] . '">Edit</i> | ';
				$list .= '<i class="delete_category" rel="' . $data['id_category'] . '">Delete</i> ] </i>';
				$list .= list_category($data['id_category']);
				$list .= list_feature($data['id_category']);
				$list .= '</li>';
			}
			
			$list .= '</ul>';
			
			return $list;
		}
	}
	
	function list_feature($id_category)
	{
		$sql = 'SELECT category_item.id_item, story.name, priority, important, game_version.name as game_version_name, status_name
				FROM category_item
				
			 	LEFT JOIN story 
				ON category_item.id_item = story.id_story
				
				LEFT JOIN game_version
				ON story.id_game_version = game_version.id_game_version
				
			 	LEFT JOIN working_status 
				ON story.id_working_status = working_status.id_working_status
				
			 	WHERE id_category = ' . $id_category;
		$result = mysql_query($sql);
		
		// create item table
		if(mysql_num_rows($result) > 0)
		{
			$list = '<ul>';
		
			while($data = mysql_fetch_array($result))
			{
				$list .=	'<li rel="' . $data['id_item'] . '" class="item"><table><tr>'.
								//'<td rel="id_item">' . $data['id_item'] . '</td>'.
								'<td rel="name">' . $data['name'] . '</td>'.
								'<td rel="important">' . $data['important'] . '</td>'.
								'<td rel="priority">' . $data['priority'] . '</td>'.
								'<td rel="id_game_version">' . $data['game_version_name'] . '</td>'.
								'<td rel="status_name">' . $data['status_name'] . '</td>'.
								'<td rel="delete_story"><a class="ui-icon ui-icon-trash"></a></td>'.
							'</tr></table></li>';		
			}
			
			$list .= '</ul>';
			 
			return $list;
		}
	}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>List</title>
<?php echo css_asset('aristo/jquery-ui-1.8.7.custom.css'); ?>
<?php echo css_asset('jquery.treeview.css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>iic_tools/css/iic_layout.css" />
<?php echo css_asset('style.css'); ?>
<style type="text/css">
body { margin: 10px; }

.bold { font-weight: bold; }

.category_option
{ 
	cursor: pointer; 
	color: #EEE; 
}

.category_option > i:hover
{
	color: #39F; 
}

#navigation { 
	background: #FFF;
	/*position: fixed;*/
}

li
{
	font-size: 12px;
	line-height: 12px;
}

li.item
{
	padding: 5px 8px 2px 18px;
}

li.item:hover
{
	background-color: #E7F1F8;
	cursor: pointer;
}

table
{
	margin: -3px 0px 0px 0px;
	width: 100%;
}

td[rel=id_item]
{
	width: 30px;
	text-align: left;
}

td[rel=name]
{
	width: auto;
	text-align: left;
}

td[rel=important], td[rel=priority], td[rel=delete_story]
{
	width: 50px;
	text-align: center;
}

td[rel=delete_story]
{
	width: 20px;
	text-align: center;
}

td[rel=status_name],td[rel=id_game_version] 
{ 
	width: 150px; 
	text-align: center;
}
</style>
<?php echo js_asset('ajax.config.js'); ?>
<?php echo js_asset('jquery-1.5.1.min.js'); ?>
<?php echo js_asset('jquery-ui-1.8.10.custom.min.js'); ?>
<?php echo js_asset('jquery.cookie.js'); ?>
<?php echo js_asset('jquery.treeview.js'); ?>
<script type="text/javascript">
$(function(){
	
	// Icon Buttons
	$("#button_add_category").button({
		icons: {
			primary: 'ui-icon-folder-collapsed'
		}
	});
	
	// Icon Buttons
	$("#button_add_story").button({
		icons: {
			primary: 'ui-icon-document-b'
		}
	});
	
	$('#master_story_list > ul').treeview({
		collapsed: false
	});
	
	$('li.item').click(function(){
		
		id_story = $(this).attr('rel');
		var url = URL_SERVER + 'index.php/story/get_story_form/' + id_story;
		
		$.post(url, function(response){
			clear_div();
			$('#dialog').html(response);
		    $('#dialog').dialog('open');
		})
		.error(function() { alert('Error'); });
		
	});
	
	$('#dialog').dialog({
		
		title		: 'Edit Story',
		autoOpen	: false,
		resizable	: false,
		width		: 500,
		height		: 425,
		modal		: false,
		buttons		: {
						Save: function() {
							var url = URL_SERVER + 'index.php/story/edit_story/' + id_story;
							var data = {
								'name'					: $('#name').val(),
								'description'			: $('#description').val(),
								'as' 					: $('#as').val(),
								'i_want_to' 			: $('#i_want_to').val(),
								'so_that' 				: $('#so_that').val(),
								'priority' 				: $('#priority').val(),
								'important'				: $('#important').val(),
								'point' 				: $('#point').val(),
								'id_working_status' 	: $('#id_working_status').val(),
								'id_game_version' 		: $('#id_game_version').val(),
								'id_iteration'  		: $('#id_iteration').val(),
								'id_category'			: $('#id_category').val(),
								'old_category'			: $('#old_category').val()
							};
							$.post(url, data, function(response){
								$(this).dialog("close");
								location.href = URL_SERVER + 'index.php/story/master_story_list';
							})
							.error(function() { alert('Error'); });
						}
					  }
	});
	
	$('i.edit_category').click(function(){
		
		id_category = $(this).attr('rel');
		var url = URL_SERVER + 'index.php/category/get_category_form/' + id_category;
		
		$.post(url, function(response){
			clear_div();
			$('#dialog_edit_category').html(response);
		    $('#dialog_edit_category').dialog('open');
		})
		.error(function() { alert('Error'); });
		
	});
	
	$('#dialog_edit_category').dialog({
		title		: 'Edit Category',
		autoOpen	: false,
		resizable	: false,
		width		: 500,
		height		: 425,
		modal		: false,
		buttons		: {
						Save: function() {
							var url = URL_SERVER + 'index.php/category/edit_category/' + id_category;
							var id_parent = ($('#id_category').val() == $('#id_parent').val()) ? 0 : $('#id_parent').val();
							var data = {
								'id_category'	: $('#id_category').val(),
								'id_parent'		: id_parent,
								'name' 			: $('#name').val(),
								'description' 	: $('#description').val(),
								'is_enable' 	: $('input:radio[name=is_enable]:checked').val()
							};
							$.post(url, data, function(response){
								$(this).dialog("close");
								location.href = URL_SERVER + 'index.php/story/master_story_list';
							})
							.error(function() { alert('Error'); });
						}
					  }
	});	
	
	$('#button_add_category').click(function(){
		if($('#dialog_add_category').html() == ' ')
		{
			var url = URL_SERVER + 'index.php/category/add_category_form';
			$.post(url, function(response){
				clear_div();
				$('#dialog_add_category').html(response);
			});
		}
		$('#dialog_add_category').dialog('open');
	});
	
	$('#dialog_add_category').dialog({
		title		: 'Add Category',
		autoOpen	: false,
		resizable	: false,
		width		: 500,
		height		: 425,
		modal		: false,
		buttons		: {
						Save: function() {
							var url = URL_SERVER + 'index.php/category/add_category';
							var data = {
								'id_parent'		: $('#id_parent').val(),
								'name' 			: $('#name').val(),
								'description' 	: $('#description').val(),
								'is_enable' 	: $('input:radio[name=is_enable]:checked').val()
							};
							$.post(url, data, function(response){
								$(this).dialog("close");
								location.href = URL_SERVER + 'index.php/story/master_story_list';
							})
							.error(function() { alert('Error'); });
						}
					  }
	});	
	
	$('#button_add_story').click(function(){
		if($('#dialog_add_story').html() == ' ')
		{
			var url = URL_SERVER + 'index.php/story/add_story_form';
			$.post(url, function(response){
				clear_div();
				$('#dialog_add_story').html(response);
			});
		}
		$('#dialog_add_story').dialog('open');
	});
	
	$('#dialog_add_story').dialog({
		title		: 'Add Story',
		autoOpen	: false,
		resizable	: false,
		width		: 500,
		height		: 425,
		modal		: false,
		buttons		: {
						Save: function() {
							var url = URL_SERVER + 'index.php/story/add_story';
							var data = {
								'name'					: $('#name').val(),
								'description'			: $('#description').val(),
								'as' 					: $('#as').val(),
								'i_want_to' 			: $('#i_want_to').val(),
								'so_that' 				: $('#so_that').val(),
								'priority' 				: $('#priority').val(),
								'important'				: $('#important').val(),
								'point' 				: $('#point').val(),
								'id_working_status' 	: $('#id_working_status').val(),
								'id_game_version' 		: $('#id_game_version').val(),
								'id_iteration'  		: $('#id_iteration').val(),
								'id_category'			: $('#id_category').val()
							};
							$.post(url, data, function(response){
								$(this).dialog("close");
								location.href = URL_SERVER + 'index.php/story/master_story_list';
							})
							.error(function() { alert('Error'); });
						}
					  }
	});
	
	function clear_div()
	{
		$('#dialog').html(' ');
		$('#dialog_add_category').html(' ');
		$('#dialog_edit_category').html(' ');	
		$('#dialog_add_story').html(' ');	
	}
});
</script>
</head>
<body>
<div id="navigation">
	<a id="button_add_category" href="#">Add Category</a>
	<a id="button_add_story" href="#">Add Story</a>
<hr>
</div>
<div id="master_story_list">
	<?php echo list_category(); ?>
</div>
<div id="dialog"> </div>
<div id="dialog_add_story"> </div>
<div id="dialog_add_category"> </div>
<div id="dialog_edit_category"> </div>
</body>
</html>