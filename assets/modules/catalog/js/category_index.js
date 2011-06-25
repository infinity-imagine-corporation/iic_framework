$(function() {
	
list_category(0);

$('#quick_access').change(function(){
	list_category($(this).val());
})
		
/*------------------------------------------------------------*/
/* Content */
/*------------------------------------------------------------*/

function list_category(id_parent, id_checked)
{
	$('#preload').slideDown('fast');
	
	var id_checked = id_checked || '';
	var class_checked = '';
	var url = URL_SERVER + 'catalog/category/get_category_list/'+id_parent;
	var data = 'id_parent = ' + id_parent;
	
	$.post(url, data, function(response)
	{
		if(response != '')
		{
			 var list = '';
			 $.each(response, function(i, data) {
				 
				 if(id_checked == data['id_category'])
				 {
					 var checked = 'checked="checked"';
					 class_checked = 'class="checked"';
				 }
				 else
				 {
					 class_checked = '';
				 }
				 
				 var status = (data['is_enable'] == 0) ? 'Disable' : 'Enable';
				 var status_color = (data['is_enable'] == 0) ? 'red' : 'green';
				 
				list += '<tr rel="' + data['id_category'] + '" ' + class_checked + '>' + 
							'<td><input type="checkbox" id="' + data['id_category'] + '" value="' + data['id_category'] + '" rel="' + data['ordering'] + '" ' + checked + ' /></td>' + 
							'<td>' + data['name'] + '</td>' + 
							'<td>' + data['description'] + '</td>' + 
							'<td class="center ' + status_color + '">' + status + '</td>' + 
							'<td></td>' +
						'</tr>';
			  });
				
			$("tbody").html(list);
			get_category_selectbox_option(id_parent);
		}
		else
		{
			$("tbody").html("<td align='center' colspan='5'>No result found.</td>");	
		}
		
	}, "json")
	.success(function() { $('#preload').slideUp('fast'); })
	.error(function() { alert('Error'); });
}

function get_category_selectbox_option(id_parent)
{
	var url = URL_SERVER + 'catalog/category/get_category_selectbox_option/' + id_parent;
	
	$.post(url, function(response)
	{
		$('#quick_access').html(response);
	}, "html")
	.error(function() { alert('Error'); });
}
	
/*------------------------------------------------------------*/
/* Checkbox */
/*------------------------------------------------------------*/

$('#select_all').live('click', function(){
	if($(this).attr('checked') == 'checked')
	{
		$('tbody').find('input[type=checkbox]').attr('checked', 'checked');
	}
	else
	{
		$('tbody').find('input[type=checkbox]').removeAttr('checked');
	}
});

$('tbody').find('input[type=checkbox]').live('click', function()
{
	$(this).parent().parent().toggleClass('checked');	
});

/*------------------------------------------------------------*/
/* Button */
/*------------------------------------------------------------*/

/* Setup Button */

$('.button_add').button({
	icons: {
		primary: "ui-icon-plusthick"
	}
})
$(".button_delete").button({
	icons: {
		primary: "ui-icon-trash"
	}
})
$(".button_move_up").button({
	icons: {
		primary: "ui-icon-arrowreturnthick-1-n"
	}
})
$(".button_move_down").button({
	icons: {
		primary: "ui-icon-arrowreturnthick-1-s"
	}
})

/* Button Add */

$('.button_add').click(function(){
	
	var url = URL_SERVER + 'catalog/category/add_category_form';
	$.post(url, function(response){
		
		
		$('#dialog_add').html(response).dialog('open').find('#id_parent').val($('#quick_access').val())
	})
	.error(function() { alert('Error: ' + url); });
});

/* Button Edit */
	
$('.table td:not(td:has(input))').live('click', function(){
	
	id_category = $(this).parent().attr('rel');
	var url = URL_SERVER + 'catalog/category/get_category_form/' + id_category;
	
	$.post(url, function(response){
		$('#dialog_edit').html(response).dialog('open');
	})
	.error(function() { alert('Error'); });
	
});

/* Button delete */

$('.button_delete').click(function(){
	
	var checked = $('tbody').find('input[type=checkbox]:checked').length;
	
	if(checked > 0)
	{
		$('#dialog_delete').dialog('open');
	}
	else
	{
		var msg = '<p><span class="ui-icon ui-icon-alert"></span>Please select at least 1 item.</p>';
		$('#dialog_alert').html(msg).dialog('open');
	}
});
	

/* Button move up */

$(".button_move_up, .button_move_down").click(function(){
	
	var checked = $('tbody').find('input[type=checkbox]:checked').length;
	var total_checkbox = $('tbody').find('input[type=checkbox]').length;
	
	if(checked == 1)
	{
		var action = ($(this).attr('rel') == 'up') ? 'up' : 'down';
		var checkbox_1 = $('tbody').find('input[type=checkbox]:checked');
		var index_1 = parseInt($('tbody').find('input[type=checkbox]').index(checkbox_1));
		
		if(action == 'up' && index_1 == 0)
		{
			alert('Top');
		}
		else if(action == 'down' && index_1 == (total_checkbox - 1))
		{
			alert('Bottom');
		}
		else
		{
			var id_1 = checkbox_1.attr('id');
			var ordering_1 = checkbox_1.attr('rel');
			var index_2 = (action == 'up') ? (index_1 - 1) : (index_1 + 1);
			var checkbox_2 = $('tbody').find('input[type=checkbox]:eq(' + index_2 + ')')
			var id_2 = checkbox_2.attr('id');
			var ordering_2 = checkbox_2.attr('rel');
		
			//alert('id: '+ id_1 + '=>'+id_2+', Ordering: '+ordering_1+'=>'+ordering_2);
			var url = URL_SERVER + 'catalog/category/move_category/' + action;
			var data = {
				'id_1'			: id_1,
				'id_2'			: id_2,
				'ordering_1' 	: ordering_1,
				'ordering_2'	: ordering_2
			};
			$.post(url, data, function(response){
				
				list_category($('#quick_access').val(), id_1);
				
			})
			.error(function() { alert('Error'); });
		}
	}
	else if(checked > 1)
	{
		var msg = '<p><span class="ui-icon ui-icon-alert"></span>Please select only 1 item.</p>';
		$('#dialog_alert').html(msg).dialog('open');
	}
	else
	{
		var msg = '<p><span class="ui-icon ui-icon-alert"></span>Please select at least 1 item.</p>';
		$('#dialog_alert').html(msg).dialog('open');
	}
	
});
	
/*------------------------------------------------------------*/
/* Dialog */
/*------------------------------------------------------------*/

$('#dialog_alert').dialog({
	title		: 'Alert',
	autoOpen	: false,
	resizable	: false,
	width		: 400,
	height		: 'auto',
	modal		: true,
	buttons		: {
					OK: function() 
					{
						$(this).dialog("close");
					}
				  }
});	

$('#dialog_add').dialog({
	title		: 'Add Category',
	autoOpen	: false,
	resizable	: false,
	width		: 500,
	height		: 'auto',
	modal		: true,
	buttons		: {
					Save: function() {
						
						var dialog = $('#dialog_add');
						var url = URL_SERVER + 'catalog/category/add_category';
						var data = {
							'id_parent'		: dialog.find('#id_parent').val(),
							'name' 			: dialog.find('#name').val(),
							'description' 	: dialog.find('#description').val(),
							'is_enable' 	: dialog.find('input:radio[name=is_enable]:checked').val()
						};
						$.post(url, data, function(response){
							list_category(data['id_parent']);
						})
						.success(function() { $('#dialog_add').dialog('close'); })
						.error(function() { alert('Error'); });
					}
				  }
});	

$('#dialog_edit').dialog({
	title		: 'Edit Category',
	autoOpen	: false,
	resizable	: false,
	width		: 500,
	height		: 'auto',
	modal		: true,
	buttons		: {
					Save: function() {
						
						var url = URL_SERVER + 'catalog/category/edit_category/';
						var dialog = $('#dialog_edit');
						var data = {
							'id_category'	: dialog.find('#id_category').val(),
							'id_parent'		: dialog.find('#id_parent').val(),
							'id_parent_old'	: dialog.find('#id_parent_old').val(),
							'name' 			: dialog.find('#name').val(),
							'description' 	: dialog.find('#description').val(),
							'is_enable' 	: dialog.find('input:radio[name=is_enable]:checked').val()
						};
						
						$.post(url, data, function(response){
							list_category(data['id_parent']);
						})
						.success(function() { $('#dialog_edit').dialog('close'); })
						.error(function() { alert('Error'); });
					}
				  }
});	

$('#dialog_delete').dialog({
	title		: 'Confirm Delete',
	autoOpen	: false,
	resizable	: false,
	width		: 400,
	height		: 'auto',
	modal		: true,
	buttons		: {
					Delete: function() 
					{
						var id = new Array();
						$('tbody').find('input[type=checkbox]:checked').each(function(index) {
							id.push($(this).val());
						});
						//alert('Delete: ' + id);
						
						var url = URL_SERVER + 'catalog/category/delete_category/';
						var data = {
							'id'	: id
						};
						
						$.post(url, data, function(response){
							list_category($('#quick_access').val());
						})
						.success(function() { $('#dialog_delete').dialog('close'); })
						.error(function() { alert('Error'); });
					}
				  }
});	

/*------------------------------------------------------------*/
/* End */
/*------------------------------------------------------------*/	
	
});