// ------------------------------------------------------------------------
// DOM - action
// ------------------------------------------------------------------------

$(function() 
{
	// ------------------------------------------------------------------------
	// Load content 
	// ------------------------------------------------------------------------
	
	get_content();
	
	// ------------------------------------------------------------------------
});	
		
// ------------------------------------------------------------------------
// Function
// ------------------------------------------------------------------------

/**
 * List content - get new content via ajax and replace in <tbody>
 * 
 * @param json content
 */	

function generate_html(content)
{
	if(content != '')
	{
		 var list = '';
		 
		 $.each(content, function(i, data) 
		 {
			list += '<tr rel="' + data['id'] + '">' + 
						'<td><input type="checkbox" id="' + data['id'] + '" value="' + data['id'] + '" /></td>' + 
						'<td>' + data['name'] + '</td>' + 
						'<td>' + data['username'] + '</td>' + 
						'<td>' + data['group'] + '</td>' + 
						'<td>' + data['role'] + '</td>' + 
					'</tr>';
		  });
		
		// Uncheck select all   
		$('#select_all').removeAttr('checked');
		
		// Update table content			
		$("tbody").html(list);
	}
	else
	{
		// Uncheck select all   
		$('#select_all').removeAttr('checked');
		
		// Update table content			
		$("tbody").html("<td align='center' colspan='6'>No result found.</td>");	
	}
}

// ------------------------------------------------------------------------

/**
 * Get content via ajax
 */	

function get_content()
{

	// Show preload
	$('#preload').slideDown('fast');
	
	// Setup variable
	var limit = limit || '';
	var offset = offset || '';
	
	var url = URL_SERVER + 'backoffice/user/get_user_list';
	var data = {
					'limit'		:limit,
					'offset' 	:offset
			   };
			   
	// Setup ajax
	$.post(url, data, function(response)
	{
		generate_html(response);	
	}, "json")
	.success(function() { $('#preload').slideUp('fast'); })
	.error(function() 
	{  
		var msg = 'Error: list_content(' + limit + ', ' + offset + ')';
		$('#dialog_alert_message').html(msg);
		$('#dialog_alert').dialog('open');
	});
}

// ------------------------------------------------------------------------

/**
 * Search content via ajax
 */	
 
function search_content()
{
	// Setup variable
	var url = URL_SERVER + 'backoffice/user/search_user';
	var data = {
					'keyword'	: $('#keyword').val(),
					'criteria'	: $('#criteria').val()
			   };
	
	// Setup ajax
	$.post(url, data, function(response)
	{
		generate_html(response);
	}, "json")
	.error(function() 
	{  
		var msg = 'Error: search_content(' + url + ')';
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
	var url = URL_SERVER + 'backoffice/user/create_user';
	var data = {
					'name'		: dialog.find('#name').val(),
					'username'	: dialog.find('#username').val(),
					'password'	: dialog.find('#password').val(),
					'id_group'	: dialog.find('#id_group').val(),
					'id_role'	: dialog.find('#id_role').val()
			   };
	
	// Setup ajax		   
	$.post(url, data, function(response)
	{
		get_content();
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
	var url = URL_SERVER + 'backoffice/user/update_user';
	var dialog = $('#dialog_update');
	var data = {
					'id'		: dialog.find('#id').val(),
					'name'		: dialog.find('#name').val(),
					'username'	: dialog.find('#username').val(),
					'password'	: dialog.find('#password').val(),
					'id_group'	: dialog.find('#id_group').val(),
					'id_role'	: dialog.find('#id_role').val()
			   };
	
	// Setup ajax
	$.post(url, data, function(response)
	{
		get_content();
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
 * Delete content via ajax
 */	

function delete_content()
{
	// Setup variable
	var checked = $('tbody').find('input[type=checkbox]:checked');
	var url = URL_SERVER + 'backoffice/user/delete_user';
	var id = new Array();
	
	checked.each(function(index) 
	{
		id.push($(this).val());
	});
	
	var data = {
					'id' : id
			   };
	
	// Setup ajax
	$.post(url, data, function(response)
	{
		get_content();
	})
	.success(function() { $('#dialog_delete').dialog('close'); })
	.error(function() 
	{  
		var msg = 'Error: delete_content(' + url + ')';
		$('#dialog_alert_message').html(msg);
		$('#dialog_alert').dialog('open');
	});
}

// ------------------------------------------------------------------------


/* End of file user_index.js */
/* Location: assets/modules/backoffice/js/user_index.js */