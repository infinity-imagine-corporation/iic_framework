// ------------------------------------------------------------------------
// DOM - action
// ------------------------------------------------------------------------

$(function() 
{
	// ------------------------------------------------------------------------
	// Dialog - Setup
	// ------------------------------------------------------------------------
	
	$('#dialog_upload').dialog(
	{
		title		: 'ประเภทและขนาดไฟล์ อัพโหลด',
		autoOpen	: true,
		draggable	: false,
		resizable	: false,
		width		: 400,
		height		: 'auto',
		modal		: true,
		buttons		: {
						บันทึก: function() 
						{
							update_content()
						}
					  }
	});	
	
	// Set icon
	$('#dialog_upload').next().find('button')
	.removeClass('ui-button-text-only')
	.addClass('ui-button-text-icon-primary')
	.prepend('<span class="ui-button-icon-primary ui-icon ui-icon-disk"/>');
	
	// ------------------------------------------------------------------------
	// Dialog - Action
	// ------------------------------------------------------------------------
	
	$('#dialog_upload').keypress(function(event)
	{
		if (event.keyCode == '13') 
		{
			update_content();
		}
	})
		
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


// ------------------------------------------------------------------------

/**
 * Update content via ajax
 */	
 
function update_content()
{
	// Setup variable
	var url = URL_SERVER + 'backoffice/setting/update_upload_setting';
	var dialog = $('#dialog_upload');
	var data = dialog.find('form').serializeArray()
	
	//alert(data);
	
	// Setup ajax
	$.post(url, data, function()
	{
		$('#dialog_upload').dialog('close');
		window.open(URL_SERVER + 'backoffice/', '_self');
	})
	.error(function() 
	{  
		var msg = 'Error: update_content(' + url + ')';
		$('#dialog_alert_message').html(msg);
		$('#dialog_alert').dialog('open');
	});
}

// ------------------------------------------------------------------------


/* End of file upload_index.js */
/* Location: assets/modules/backoffice/js/upload_index.js */