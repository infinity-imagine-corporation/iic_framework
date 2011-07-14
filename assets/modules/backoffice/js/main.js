$(function() {	
		
	/*------------------------------------------------------------*/
	/* Checkbox */
	/*------------------------------------------------------------*/
	
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
	$('tbody').find('input[type=checkbox]').live('click', function()
	{
		$(this).parent().parent().toggleClass('checked');	
	});	
	
	/*------------------------------------------------------------*/
	/* Button */
	/*------------------------------------------------------------*/
	
	/* Setup button */
	
	$('.button_create').button({
		icons: {
			primary: "ui-icon-plusthick"
		}
	})
	
	$(".button_delete").button({
		icons: {
			primary: "ui-icon-trash"
		}
	})
	
	/* Button create */
	
	$('.button_create').click(function(){
		get_create_form();
	});
	
	/* Button update */
		
	$('.table td:not(td:has(input))').live('click', function(){
		var id_category = $(this).parent().attr('rel');
		get_update_form(id_category);
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
	
	/*------------------------------------------------------------*/
	/* Dialog */
	/*------------------------------------------------------------*/
	
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
	
	/*------------------------------------------------------------*/
	/* End */
	/*------------------------------------------------------------*/
	
});