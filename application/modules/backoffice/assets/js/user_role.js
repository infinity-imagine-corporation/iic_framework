$(function() 
{
	// Load content 
	get_content();
});	
		
// ------------------------------------------------------------------------

/**
 * Generate HTML tag and replace in <tbody>
 * 
 * @param json content
 */	

function generate_html(content)
{
	var list = '';
		 
	$.each(content, function(i, data) 
	{
		list += '<tr rel="' + data['id'] + '">' + 
					'<td><input type="checkbox" id="' + data['id'] + '" value="' + data['id'] + '" /></td>' + 
					'<td>' + data['name'] + '</td>' + 
				'</tr>';
	});
	 
	return list;
}

// ------------------------------------------------------------------------


/* End of file user_role_index.js */
/* Location: assets/modules/backoffice/js/user_role_index.js */