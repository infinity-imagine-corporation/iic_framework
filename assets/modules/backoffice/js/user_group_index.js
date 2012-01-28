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
}

// ------------------------------------------------------------------------


/* End of file user_group_index.js */
/* Location: assets/modules/backoffice/js/user_group_index.js */