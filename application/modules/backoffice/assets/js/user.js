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
					'<td>' + data['username'] + '</td>' + 
					'<td>' + data['group'] + '</td>' + 
					'<td>' + data['role'] + '</td>' + 
				'</tr>';
	});
	
	return list;
}

// ------------------------------------------------------------------------


/* End of file user.js */
/* Location: assets/modules/backoffice/js/user.js */