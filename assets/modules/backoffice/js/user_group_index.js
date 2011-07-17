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
});	
		
// ------------------------------------------------------------------------
// Function
// ------------------------------------------------------------------------

/**
 * List content - get new content via ajax and replace in <tbody>
 * 
 * @param integer limit
 * @param integer offset
 */	

function list_content(limit, offset)
{
	// Show preload
	$('#preload').slideDown('fast');
	
	// Setup variable
	var limit = limit || '';
	var offset = offset || '';
	
	var url = URL_SERVER + 'backoffice/user/get_group_list';
	var data = {
					'limit'		:limit,
					'offset' 	:offset
			   };
			   
	// Setup ajax
	$.post(url, data, function(response)
	{
		if(response != '')
		{
			 var list = '';
			 
			 $.each(response, function(i, data) 
			 {
				list += '<tr rel="' + data['id'] + '">' + 
							'<td><input type="checkbox" id="' + data['id'] + '" value="' + data['id'] + '" /></td>' + 
							'<td>' + data['name'] + '</td>' + 
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
			$("tbody").html("<td align='center' colspan='2'>No result found.</td>");	
		}
		
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
	var url = URL_SERVER + 'backoffice/user/create_group';
	var data = {
					'name' : dialog.find('#name').val()
			   };
	
	// Setup ajax		   
	$.post(url, data, function(response)
	{
		list_content();
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
	var url = URL_SERVER + 'backoffice/user/update_group';
	var dialog = $('#dialog_update');
	var data = {
					'id'	: dialog.find('#id').val(),
					'name'	: dialog.find('#name').val()
			   };
	
	// Setup ajax
	$.post(url, data, function(response)
	{
		list_content();
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


/* End of file category_index.js */
/* Location: assets/modules/backoffice/js/main.js */