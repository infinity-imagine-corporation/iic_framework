// ------------------------------------------------------------------------
// DOM - action
// ------------------------------------------------------------------------

$(function()
{

	// ------------------------------------------------------------------------
	// Search Section - Action
	// ------------------------------------------------------------------------

	$('#keyword').keyup(function()
	{
		search_content();
	});

	$('#criteria').change(function()
	{
		search_content();
	});

	$('#buttton_advance_search').click(function()
	{
		var advance_search_section = $('#advance_search_section');
		var arrow = $('#buttton_advance_search span');

		if(advance_search_section.css('display') == "none")
		{
			advance_search_section.slideDown();
			arrow.html('&#x25BC;')
		}
		else
		{
			advance_search_section.slideUp();
			arrow.html('&#x25C0;')
		}
	});

	// ------------------------------------------------------------------------
	// Input[checkbox] - Action
	// ------------------------------------------------------------------------

	/* Select all */

	$('#select_all').live('click', function()
	{
		if($(this).attr('checked') == 'checked')
		{
			$('tbody').find('input[type=checkbox]').attr('checked', 'checked').parent().parent().addClass('checked');
		}
		else
		{
			$('tbody').find('input[type=checkbox]').removeAttr('checked');
			$('tbody').find('tr').removeClass('checked');
		}
	});
	/* Hilite selected row */

	$('tbody').find('input[type=checkbox]').live('click', function()
	{
		$(this).parent().parent().toggleClass('checked');
	});
	
	// ------------------------------------------------------------------------
	// Buttion - Setup
	// ------------------------------------------------------------------------

	/* Button create */

	$('.button_create').button(
	{
		icons :
		{
			primary : "ui-icon-plusthick"
		}
	})

	/* Button delete */

	$(".button_delete").button(
	{
		icons :
		{
			primary : "ui-icon-trash"
		}
	})

	// ------------------------------------------------------------------------
	// Buttion - Action
	// ------------------------------------------------------------------------

	/* Button create */

	$('.button_create').click(function()
	{
		// Setup variable
		var url = URL_SERVER + $('#config_uri_form').val();

		// Call ajax function
		get_create_form(url);
	});
	
	/* Button update (when clik on table row) */

	$('.table td:not(td:has(input[type=checkbox]))').live('click', function()
	{
		// Setup variable
		var form_uri = $('#config_uri_form').val();
		var id_content = $(this).parent().attr('rel');
		var url = URL_SERVER + form_uri + '/' + id_content;

		// Call ajax function
		get_update_form(url);
	});
	
	/* Button delete */

	$('.button_delete').click(function()
	{
		// Setup variable
		var checked = $('tbody').find('input[type=checkbox]:checked').length;

		if(checked > 0)
		{
			// Open dialog
			$('#dialog_delete').dialog('open');
		}
		else
		{
			var msg = 'โปรดเลือกข้อมูลอย่างน้อย 1 แถว.';
			$('#dialog_alert_message').html(msg);

			// Open dialog
			$('#dialog_alert').dialog('open');
		}
	});
	
	/* Button delete attachfile*/
	
	$('a.delete_attachfile').live('click', function()
	{
		var file_id = '#' + $(this).attr('rel');
		
		// Hide attachfile
		$(this).parent().parent().parent().fadeOut();
		
		// Set delete this file
		$(file_id).val('1');
	});
	
	// ------------------------------------------------------------------------
	// Dialog - Setup
	// ------------------------------------------------------------------------

	/* Dialog alerte */

	$('#dialog_alert').dialog(
	{
		title : 'Alert',
		autoOpen : false,
		draggable : false,
		resizable : false,
		width : 400,
		height : 'auto',
		modal : true,
		buttons :
		{
			OK : function()
			{
				$(this).dialog("close");
			}
		}
	});

	/* Dialog create */

	$('#dialog_create').dialog(
	{
		title : 'Create',
		autoOpen : false,
		draggable : false,
		resizable : false,
		width : 'auto',
		height : 'auto',
		modal : true,
		buttons :
		{
			Save : function()
			{
				create_content();
			}
		}
	});

	// Set icon
	$('#dialog_create').next().find('button').removeClass('ui-button-text-only').addClass('ui-button-text-icon-primary').prepend('<span class="ui-button-icon-primary ui-icon ui-icon-disk"/>');

	/* Dialog update */

	$('#dialog_update').dialog(
	{
		title : 'Edit',
		autoOpen : false,
		draggable : false,
		resizable : false,
		minWidth : 400,
		width : 'auto',
		height : 'auto',
		modal : true,
		buttons :
		{
			Save : function()
			{
				update_content();
			}
		}
	});

	// Set icon
	$('#dialog_update').next().find('button').removeClass('ui-button-text-only').addClass('ui-button-text-icon-primary').prepend('<span class="ui-button-icon-primary ui-icon ui-icon-disk"/>');

	/* Dialog delete */

	$('#dialog_delete').dialog(
	{
		title : 'Confirm delete content',
		autoOpen : false,
		draggable : false,
		resizable : false,
		width : 400,
		height : 'auto',
		modal : true,
		buttons :
		{
			Delete : function()
			{
				delete_content();
			}
		}
	});

	// ------------------------------------------------------------------------
	// Dialog - Action
	// ------------------------------------------------------------------------

	$('#dialog_create').keypress(function(event)
	{
		if(event.keyCode == '13')
		{
			create_content();
		}
	})

	$('#dialog_update').keypress(function(event)
	{
		if(event.keyCode == '13')
		{
			update_content();
		}
	})
	
	// ------------------------------------------------------------------------
	// Validator
	// ------------------------------------------------------------------------

	jQuery.validator.setDefaults(
	{
		debug : true,
		errorElement : "i",
		errorPlacement : function(error, element)
		{
			error.appendTo(element.prev());
		}
	});
	
	// ------------------------------------------------------------------------

});

// ------------------------------------------------------------------------
// Function
// ------------------------------------------------------------------------

/**
 * Load create form via ajax
 *
 * @param string url
 */

function get_create_form(url)
{
	// Setup ajax
	$.post(url, function(response)
	{
		$('#dialog_create').html(response);
		$('#dialog_create').dialog('open')
	}).error(function()
	{
		var msg = 'Error: get_create_form(' + url + ')';
		$('#dialog_alert_message').html(msg);
		$('#dialog_alert').dialog('open');
	});
}

// ------------------------------------------------------------------------

/**
 * Load update form via ajax
 *
 * @param string url
 */

function get_update_form(url)
{
	// Setup ajax
	$.post(url, function(response)
	{
		$('#dialog_update').html(response);
		$('#dialog_update').dialog('open');
	}).error(function()
	{
		var msg = 'Error: get_update_form(' + url + ')';
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
	var dialog	= $('#dialog_create');
	var form	= dialog.find('form');
	var url 	= URL_SERVER + $('#config_uri_create').val();
	var config 	= {
						'target' 		: '',
						'beforeSubmit' 	: showRequest,
						'success' 		: showResponse,
						'url' 			: url,
						'type' 			: 'post'
					};

	// Pre-submit callback
	function showRequest(formData, jqForm, data)
	{
		// Show preload
		$('#preload').slideDown('fast');

		return true;
	}

	// Post-submit callback
	function showResponse(responseText, statusText, xhr, $form)
	{
		get_content();

		$('#preload').slideUp('fast');

		dialog.dialog('close');
	}

	// Validate form
	if(form.valid())
	{
		dialog.find('form').ajaxSubmit(config);
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
	var limit	= 25;
	var offset	= (limit * parseInt($('.pagination').find('strong').html())) - limit;
	
	offset = (isNaN(offset)) ? 0 : offset;
	
	var url = URL_SERVER + $('#config_uri_list').val();
	var data = {
					'limit'		: limit,
					'offset' 	: offset
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
 * Update content via ajax
 */	
 
function update_content()
{
	// Setup variable
	var dialog	= $('#dialog_update');
	var form 	= dialog.find('form');	
	var url		= URL_SERVER + $('#config_uri_update').val();
	var config	= { 
					  'target'		: '',   
					  'beforeSubmit': showRequest, 
					  'success'		: showResponse,
					  'url'			: url,
					  'type'		: 'post'
				  }; 
		
	// Pre-submit callback 
	function showRequest(formData, jqForm, data) 
	{ 
		// Show preload
		$('#preload').slideDown('fast');
		
		return true; 
	} 
	 
	// Post-submit callback 
	function showResponse(responseText, statusText, xhr, $form)  
	{ 
		get_content();
		
		$('#preload').slideUp('fast'); 
		
		dialog.dialog('close');
	} 
	
	// Validate form
	if(form.valid())
	{
		dialog.find('form').ajaxSubmit(config); 
	}
}

// ------------------------------------------------------------------------

/**
 * Delete content via ajax
 */	

function delete_content()
{
	// Setup variable
	var checked	= $('tbody').find('input[type=checkbox]:checked');
	var url		= URL_SERVER + $('#config_uri_delete').val();
	var id		= new Array();
	
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

/**
 * Search content via ajax
 */	
 
function search_content()
{
	// Setup variable
	var url = URL_SERVER + $('#config_uri_search').val();
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


/* End of file main.js */
/* Location: assets/modules/backoffice/js/main.js */