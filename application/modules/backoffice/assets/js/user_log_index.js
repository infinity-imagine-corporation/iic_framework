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
 * Generate HTML tag and replace in <tbody>
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
						'<td>' + data['date'] + '</td>' + 
						'<td>' + data['user'] + '</td>' + 
						'<td>' + data['action'] + '</td>' + 
						'<td>' + data['module'] + '</td>' + 
						'<td>' + data['note'] + '</td>' + 
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
	
	var url = URL_SERVER + 'backoffice/user/get_log_list';
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
	var url = URL_SERVER + 'backoffice/user/search_log';
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



/* End of file user_log_index.js */
/* Location: assets/modules/backoffice/js/user_log_index.js */