$(function() {	
	
	// ------------------------------------------------------------------------
	// Checkbox
	// ------------------------------------------------------------------------
	
	/* Select all */
	
	$('#select_all').live('click', function(){
		if($(this).attr('checked') == 'checked')
		{
			$('tbody').find('input[type=checkbox]').attr('checked', 'checked').parent().parent().addClass('checked');
		}
		else
		{
			$('tbody').find('input[type=checkbox]').removeAttr('checked');
		}
	});
	
	/* Hilite selected row */
	
	$('tbody').find('input[type=checkbox]').live('click', function(){
		$(this).parent().parent().toggleClass('checked');	
	});	
		
	// ------------------------------------------------------------------------
	// Buttion - setup
	// ------------------------------------------------------------------------
	
	/* Button create */
	
	$('.button_create').button({
		icons: {
			primary: "ui-icon-plusthick"
		}
	})
	
	/* Button delete */
	
	$(".button_delete").button({
		icons: {
			primary: "ui-icon-trash"
		}
	})
	
	// ------------------------------------------------------------------------
	// Buttion - action
	// ------------------------------------------------------------------------
	
	/* Button create */
	
	$('.button_create').click(function(){
		var form_uri = $(this).attr('rel');
		var url = URL_SERVER + form_uri;
		
		get_create_form(url);
	});
	
	/* Button update (when clik on table row) */
	
	$('.table td:not(td:has(input[type=checkbox]))').live('click', function(){
		var form_uri = $('.button_create').attr('rel');
		var id_content = $(this).parent().attr('rel');
		var url = URL_SERVER + form_uri + '/' + id_content;
		
		get_update_form(url);
	});
	
	/* Button delete */
	
	$('.button_delete').click(function(){
		var checked = $('tbody').find('input[type=checkbox]:checked').length;
		
		if(checked > 0)
		{
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
	// Dialog
	// ------------------------------------------------------------------------
	
	$('#dialog_alert').dialog({
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
	
	$('#dialog_create').dialog({
		title		: 'Add Category',
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
	
	$('#dialog_update').dialog({
		title		: 'Edit Category',
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
	
	$('#dialog_delete').dialog({
		title		: 'Confirm Delete',
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
	
});


/* End of file main.js */
/* Location: assets/modules/backoffice/js/main.js */