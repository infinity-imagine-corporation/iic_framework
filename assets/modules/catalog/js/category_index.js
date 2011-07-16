$(function() {
	
	// ------------------------------------------------------------------------
	// Load content 
	// ------------------------------------------------------------------------
	
	list_content(0);
	
	// ------------------------------------------------------------------------
	// Quick access 
	// ------------------------------------------------------------------------
	
	$('#quick_access').change(function(){
		list_content($(this).val());
	})
	
	// ------------------------------------------------------------------------
	// Button - setup
	// ------------------------------------------------------------------------
	
	/* Button move up */
	
	$(".button_move_up").button({
		icons: {
			primary: "ui-icon-arrowreturnthick-1-n"
		}
	})
	
	/* Button move down */
	
	$(".button_move_down").button({
		icons: {
			primary: "ui-icon-arrowreturnthick-1-s"
		}
	})
	
	// ------------------------------------------------------------------------
	// Button - action
	// ------------------------------------------------------------------------
	
	/* Button move up, Button move down */
	
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
			
				var url = URL_SERVER + 'catalog/category/move_category/' + action;
				var data = {
					'id_1'			: id_1,
					'id_2'			: id_2,
					'ordering_1' 	: ordering_1,
					'ordering_2'	: ordering_2
				};
				$.post(url, data, function(response){
					
					list_content($('#quick_access').val(), id_1);
					
				})
				.error(function() { alert('Error'); });
			}
		}
		else if(checked > 1)
		{
			var msg = 'Please select only 1 item.';
			$('#dialog_alert_message').html(msg);
			$('#dialog_alert').dialog('open');
		}
		else
		{
			var msg = 'Please select at least 1 item.';
			$('#dialog_alert_message').html(msg);
			$('#dialog_alert').dialog('open');
		}
		
	});
	
});	
		
// ------------------------------------------------------------------------
// Function
// ------------------------------------------------------------------------

/**
 * List content - get new content via ajax and replace in <tbody>
 * 
 * @param integer id_parent
 * @param integer id_checked
 */	

function list_content(id_parent, id_checked)
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
			
			// Uncheck select all   
			$('#select_all').removeAttr('checked')	
			
			// Update quick access content
			get_category_selectbox_option(id_parent);
			
			// Update table content			
			$("tbody").html(list);
		}
		else
		{
			$("tbody").html("<td align='center' colspan='5'>No result found.</td>");	
		}
		
	}, "json")
	.success(function() { $('#preload').slideUp('fast'); })
	.error(function() { alert('Error: Can\'t load ' + url); });
}
	
// ------------------------------------------------------------------------

/**
 * Load create form via ajax
 * 
 * @param string url
 */	

function get_create_form(url)
{
	$.post(url, function(response){
		$('#dialog_create').html(response).dialog('open').find('#id_parent').val($('#quick_access').val())
	})
	.error(function() { alert('Error: get_create_form ' + url); });
}

// ------------------------------------------------------------------------

/**
 * Load update form via ajax
 * 
 * @param string url
 */	

function get_update_form(url)
{
	$.post(url, function(response){
		$('#dialog_update').html(response).dialog('open');
	})
	.error(function() { alert('Error'); });
}

// ------------------------------------------------------------------------

/**
 * Create content via ajax
 */	

function create_content()
{
	var dialog = $('#dialog_create');
	var url = URL_SERVER + 'catalog/category/add_category';
	var data = {
		'id_parent'		: dialog.find('#id_parent').val(),
		'name' 			: dialog.find('#name').val(),
		'description' 	: dialog.find('#description').val(),
		'is_enable' 	: dialog.find('input:radio[name=is_enable]:checked').val()
	};
	$.post(url, data, function(response){
		list_content(data['id_parent']);
	})
	.success(function() { $('#dialog_create').dialog('close'); })
	.error(function() { alert('Error'); });	
}

// ------------------------------------------------------------------------

/**
 * Update content via ajax
 */	
 
function update_content()
{
	var url = URL_SERVER + 'catalog/category/edit_category/';
	var dialog = $('#dialog_update');
	var data = {
		'id_category'	: dialog.find('#id_category').val(),
		'id_parent'		: dialog.find('#id_parent').val(),
		'id_parent_old'	: dialog.find('#id_parent_old').val(),
		'name' 			: dialog.find('#name').val(),
		'description' 	: dialog.find('#description').val(),
		'is_enable' 	: dialog.find('input:radio[name=is_enable]:checked').val()
	};
	
	$.post(url, data, function(response){
		list_content(data['id_parent']);
	})
	.success(function() { $('#dialog_update').dialog('close'); })
	.error(function() { alert('Error'); });
}

// ------------------------------------------------------------------------

/**
 * Delete content via ajax
 */	

function delete_content()
{
	var id = new Array();
	$('tbody').find('input[type=checkbox]:checked').each(function(index) {
		id.push($(this).val());
	});
	
	var url = URL_SERVER + 'catalog/category/delete_category/';
	var data = {
		'id'	: id
	};
	
	$.post(url, data, function(response){
		list_content($('#quick_access').val());
	})
	.success(function() { $('#dialog_delete').dialog('close'); })
	.error(function() { alert('Error'); });	
}

// ------------------------------------------------------------------------

/**
 * Get quick access content via ajax
 * 
 * @param integer url
 */	

function get_category_selectbox_option(id_parent)
{
	var url = URL_SERVER + 'catalog/category/get_category_selectbox_option/' + id_parent;
	
	$.post(url, function(response)
	{
		$('#quick_access').html(response);
	}, "html")
	.error(function() { alert('Error'); });
}

// ------------------------------------------------------------------------


/* End of file category_index.js */
/* Location: assets/modules/backoffice/js/main.js */