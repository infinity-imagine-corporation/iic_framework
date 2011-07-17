// ------------------------------------------------------------------------
// DOM - action
// ------------------------------------------------------------------------

$(function() 
{
	// ------------------------------------------------------------------------
	// Load content 
	// ------------------------------------------------------------------------
	
	list_content(0);
	
	// ------------------------------------------------------------------------
	// Quick access - Action
	// ------------------------------------------------------------------------
	
	$('#quick_access').change(function()
	{
		list_content($(this).val());
	})
	
	// ------------------------------------------------------------------------
	// Button - Setup
	// ------------------------------------------------------------------------
	
	/* Button move up */
	
	$(".button_move_up").button(
	{
		icons: { primary: "ui-icon-arrowreturnthick-1-n" }
	})
	
	/* Button move down */
	
	$(".button_move_down").button(
	{
		icons: { primary: "ui-icon-arrowreturnthick-1-s" }
	})
	
	// ------------------------------------------------------------------------
	// Button - Action
	// ------------------------------------------------------------------------
	
	/* Button move up, Button move down */
	
	$(".button_move_up, .button_move_down").click(function()
	{
		var checked = $('tbody').find('input[type=checkbox]:checked').length;
		var total_checkbox = $('tbody').find('input[type=checkbox]').length;
		
		if(checked == 1)
		{
			// Check action
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
				// Setup variable
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
				
				// Setup ajax
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
	// Show preload
	$('#preload').slideDown('fast');
	
	// Setup variable
	var id_checked = id_checked || '';
	var class_checked = '';
	var url = URL_SERVER + 'catalog/category/get_category_list/'+id_parent;
	var data = 'id_parent = ' + id_parent;
	
	// Setup ajax
	$.post(url, data, function(response)
	{
		if(response != '')
		{
			 var list = '';
			 $.each(response, function(i, data) 
			 {
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
			update_selectbox_option(id_parent);
			
			// Update table content			
			$("tbody").html(list);
		}
		else
		{
			// Uncheck select all   
			$('#select_all').removeAttr('checked')	
			
			// Update quick access content
			update_selectbox_option(id_parent);
			
			// Update table content		
			$("tbody").html("<td align='center' colspan='5'>No result found.</td>");	
		}
		
	}, "json")
	.success(function() { $('#preload').slideUp('fast'); })
	.error(function() 
	{  
		var msg = 'Error: list_content(' + id_parent + ', ' + id_checked + ')';
		$('#dialog_alert_message').html(msg);
		$('#dialog_alert').dialog('open');
	});
}

// ------------------------------------------------------------------------

/**
 * Create content via ajax
 */	

function create_content()
{
	// Setup variable
	var dialog = $('#dialog_create');
	var url = URL_SERVER + 'catalog/category/create_category';
	var data = {
					'id_parent'		: dialog.find('#id_parent').val(),
					'name' 			: dialog.find('#name').val(),
					'description' 	: dialog.find('#description').val(),
					'is_enable' 	: dialog.find('input:radio[name=is_enable]:checked').val()
			   };
	
	// Setup ajax		   
	$.post(url, data, function(response)
	{
		list_content(data['id_parent']);
	})
	.success(function() { $('#dialog_create').dialog('close'); })
	.error(function() 
	{  
		var msg = 'Error: create_content(' + url + ')';
		$('#dialog_alert_message').html(msg);
		$('#dialog_alert').dialog('open');
	});
}

// ------------------------------------------------------------------------

/**
 * Update content via ajax
 */	
 
function update_content()
{
	// Setup variable
	var url = URL_SERVER + 'catalog/category/update_category';
	var dialog = $('#dialog_update');
	var data = {
		'id_category'	: dialog.find('#id_category').val(),
		'id_parent'		: dialog.find('#id_parent').val(),
		'id_parent_old'	: dialog.find('#id_parent_old').val(),
		'name' 			: dialog.find('#name').val(),
		'description' 	: dialog.find('#description').val(),
		'is_enable' 	: dialog.find('input:radio[name=is_enable]:checked').val()
	};
	
	// Setup ajax
	$.post(url, data, function(response)
	{
		list_content(data['id_parent']);
	})
	.success(function() { $('#dialog_update').dialog('close'); })
	.error(function() 
	{  
		var msg = 'Error: update_content(' + url + ')';
		$('#dialog_alert_message').html(msg);
		$('#dialog_alert').dialog('open');
	});
}

// ------------------------------------------------------------------------

/**
 * Get quick access content via ajax
 * 
 * @param integer url
 */	

function update_selectbox_option(id_parent)
{
	// Setup variable
	var url = URL_SERVER + 'catalog/category/update_selectbox_option/' + id_parent;
	
	// Setup ajax
	$.post(url, function(response)
	{
		$('#quick_access').html(response);
	}, "html")
	.error(function() 
	{  
		var msg = 'Error: update_selectbox_option(' + id_parent + ')';
		$('#dialog_alert_message').html(msg);
		$('#dialog_alert').dialog('open');
	});
}

// ------------------------------------------------------------------------


/* End of file category_index.js */
/* Location: assets/modules/backoffice/js/main.js */