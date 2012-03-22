// ------------------------------------------------------------------------
// DOM - action
// ------------------------------------------------------------------------

$(function() 
{
	// ------------------------------------------------------------------------
	// Load content 
	// ------------------------------------------------------------------------
	
	list_content();
	
	// ------------------------------------------------------------------------
	// Quick access - Action
	// ------------------------------------------------------------------------
	
	$('#quick_access').change(function()
	{
		list_content($(this).val());
	})
	
	// ------------------------------------------------------------------------
	// Tabs - Setup
	// ------------------------------------------------------------------------
	
	$( "#tabs" ).tabs();
		
	// ------------------------------------------------------------------------
	// Buttion - Setup
	// ------------------------------------------------------------------------
	
	/* Button create */
	
	$('.button_save').button(
	{
		icons: {
			primary: "ui-icon-disk"
		}
	})
	
});	
		
// ------------------------------------------------------------------------
// Function
// ------------------------------------------------------------------------

/**
 * List content - get new content via ajax and replace in <tbody>
 * 
 * @param json response
 */	

function generate_html(response, id_target)
{
	if(response != '')
	{
		var checked = '';
		var class_checked = '';	
			
		 var list = '';
		 $.each(response, function(i, data) 
		 {
			list += '<tr rel="' + data['id'] + '" ' + class_checked + '>' + 
						'<td width="50%">' + data['name'] + '</td>' + 
						'<td width="10%" class="center"><input type="checkbox" id="' + data['id'] + '" value="' + data['id'] + '" ' + checked + ' /></td>' + 
						'<td width="10%" class="center"><input type="checkbox" id="' + data['id'] + '" value="' + data['id'] + '" ' + checked + ' /></td>' + 
						'<td width="10%" class="center"><input type="checkbox" id="' + data['id'] + '" value="' + data['id'] + '" ' + checked + ' /></td>' + 
						'<td width="10%" class="center"><input type="checkbox" id="' + data['id'] + '" value="' + data['id'] + '" ' + checked + ' /></td>' + 
						'<td width="10%" class="center"><input type="checkbox" id="' + data['id'] + '" value="' + data['id'] + '" ' + checked + ' /></td>' +
					'</tr>';
		  });
		
		// Update table content			
		$("#" + id_target + " tbody").html(list);
	}
	else
	{
		// Uncheck select all   
		$('#select_all').removeAttr('checked')	
		
		// Update quick access content
		update_selectbox_option(id_parent);
		
		// Update table content		
		$("#" + id_target + " tbody").html("<td align='center' colspan='5'>No result found.</td>");	
	}
}
// ------------------------------------------------------------------------

/**
 * List content - get new content via ajax and replace in <tbody>
 * 
 */	

function list_content()
{
	get_group_content();
	get_role_content();
	get_user_content();
}

// ------------------------------------------------------------------------

/**
 * Get user group
 * 
 */	
 
function get_group_content()
{
	// Show preload
	$('#preload').slideDown('fast');
	
	// Setup variable
	var limit = limit || '';
	var offset = offset || '';
	
	var url = URL_SERVER + 'backoffice/user/get_group_list';
	var data = {
					'limit'		: limit,
					'offset'	: offset
			   };
			   
	// Setup ajax
	$.post(url, data, function(response)
	{
		generate_html(response, 'table_group');	
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
 * Get user role
 * 
 */	
 
function get_role_content()
{

	// Show preload
	$('#preload').slideDown('fast');
	
	// Setup variable
	var limit = limit || '';
	var offset = offset || '';
	
	var url = URL_SERVER + 'backoffice/user/get_role_list';
	var data = {
					'limit'		:limit,
					'offset' 	:offset
			   };
			   
	// Setup ajax
	$.post(url, data, function(response)
	{
		generate_html(response, 'table_role');	
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
 * Get user role
 */	

function get_user_content()
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
		generate_html(response, 'table_user');	
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
 * Create content via ajax
 */	

function create_content()
{
	// Setup variable
	var dialog = $('#dialog_create');
	var url = URL_SERVER + 'backoffice/setting/create_category';
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
	var url = URL_SERVER + 'backoffice/setting/update_category';
	var dialog = $('#dialog_update');
	var data = {
		'id'	: dialog.find('#id_category').val(),
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
 * Delete content via ajax
 */	

function delete_content(url)
{
	// Setup variable
	var id = new Array();
	
	$('tbody').find('input[type=checkbox]:checked').each(function(index) 
	{
		id.push($(this).val());
	});
	
	var data = {
					'id' : id
			   };
	
	// Setup ajax
	$.post(url, data, function(response)
	{
		list_content($('#quick_access').val());
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

/**
 * Get quick access content via ajax
 * 
 * @param integer url
 */	

function update_selectbox_option(id_parent)
{
	// Setup variable
	var url = URL_SERVER + 'backoffice/setting/update_selectbox_option/' + id_parent;
	
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


/* End of file permission_index.js */
/* Location: assets/modules/backoffice/js/permission_index.js */