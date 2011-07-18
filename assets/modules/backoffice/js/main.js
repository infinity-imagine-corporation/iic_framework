// ------------------------------------------------------------------------
// DOM - action
// ------------------------------------------------------------------------

$(function() 
{	
	// ------------------------------------------------------------------------
	// Input[text] - Action
	// ------------------------------------------------------------------------
	
	$('#keyword').keyup(function() {
		search_content();
	});
	
	// ------------------------------------------------------------------------
	// Select - Action
	// ------------------------------------------------------------------------
	
	$('#criteria').change(function() {
		search_content();
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
		icons: {
			primary: "ui-icon-plusthick"
		}
	})
	
	/* Button delete */
	
	$(".button_delete").button(
	{
		icons: {
			primary: "ui-icon-trash"
		}
	})
	
	// ------------------------------------------------------------------------
	// Buttion - Action
	// ------------------------------------------------------------------------
	
	/* Button create */
	
	$('.button_create').click(function()
	{
		// Setup variable
		var form_uri = $(this).attr('rel');
		var url = URL_SERVER + form_uri;
		
		// Call ajax function
		get_create_form(url);
	});
	
	/* Button update (when clik on table row) */
	
	$('.table td:not(td:has(input[type=checkbox]))').live('click', function()
	{
		// Setup variable
		var form_uri = $('.button_create').attr('rel');
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
			var msg = 'Please select at least 1 item.';
			$('#dialog_alert_message').html(msg);
			$('#dialog_alert').dialog('open');
		}
	});
	
	// ------------------------------------------------------------------------
	// Dialog - Setup
	// ------------------------------------------------------------------------
	
	$('#dialog_alert').dialog(
	{
		title		: 'Alert',
		autoOpen	: false,
		resizable	: false,
		width		: 400,
		height		: 'auto',
		modal		: true,
		buttons		: {
						OK: function() 
						{
							$(this).dialog("close");
						}
					  }
	});	
	
	$('#dialog_create').dialog(
	{
		title		: 'Create New Data',
		autoOpen	: false,
		resizable	: false,
		width		: 500,
		height		: 'auto',
		modal		: true,
		buttons		: {
						Save: function() 
						{
							create_content();							
						}
					  }
	});	
	
	$('#dialog_update').dialog(
	{
		title		: 'Update Data',
		autoOpen	: false,
		resizable	: false,
		width		: 500,
		height		: 'auto',
		modal		: true,
		buttons		: {
						Save: function() 
						{
							update_content();
						}
					  }
	});	
	
	$('#dialog_delete').dialog(
	{
		title		: 'Confirm Delete Data',
		autoOpen	: false,
		resizable	: false,
		width		: 400,
		height		: 'auto',
		modal		: true,
		buttons		: {
						Delete: function() 
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
		if (event.keyCode == '13') 
		{
			create_content();
		}
	})
	
	$('#dialog_update').keypress(function(event)
	{
		if (event.keyCode == '13') 
		{
			update_content();
		}
	})
	
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
		$('#dialog_create').html(response).dialog('open').find('#id_parent').val($('#quick_access').val())
	})
	.error(function() 
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
		$('#dialog_update').html(response).dialog('open');
	})
	.error(function() 
	{  
		var msg = 'Error: get_create_form(' + url + ')';
		$('#dialog_alert_message').html(msg);
		$('#dialog_alert').dialog('open');
	});
}

// ------------------------------------------------------------------------


/* End of file main.js */
/* Location: assets/modules/backoffice/js/main.js */