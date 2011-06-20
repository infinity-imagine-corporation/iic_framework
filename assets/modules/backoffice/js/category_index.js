$(function() {
	
	/* Button */
	
	$( ".button_add" ).button({
		icons: {
			primary: "ui-icon-plusthick"
		}
	})
	$( ".button_delete" ).button({
		icons: {
			primary: "ui-icon-trash"
		}
	})
	$( ".button_move_up" ).button({
		icons: {
			primary: "ui-icon-arrowreturnthick-1-n"
		}
	})
	$( ".button_move_down" ).button({
		icons: {
			primary: "ui-icon-arrowreturnthick-1-s"
		}
	})
	
	$('.button_add').click(function(){
		if($('#dialog').html() == '')
		{
			var url = URL_SERVER + '/category/add_category_form';
			$.post(url, function(response){
				$('#dialog').html('').html(response);
			});
		}
		$('#dialog').dialog('open');
	});
	
	/* Dialog */
	
	$('#dialog').dialog({
		title		: 'Add Category',
		autoOpen	: false,
		resizable	: false,
		width		: 500,
		height		: 425,
		modal		: false,
		buttons		: {
						Save: function() {
							var url = URL_SERVER + '/category/add_category';
							var data = {
								'id_parent'		: $('#id_parent').val(),
								'name' 			: $('#name').val(),
								'description' 	: $('#description').val(),
								'is_enable' 	: $('input:radio[name=is_enable]:checked').val()
							};
							$.post(url, data, function(response){
								$(this).dialog("close");
								location.href = URL_SERVER + '/story/master_story_list';
							})
							.error(function() { alert('Error'); });
						}
					  }
	});	
	
	$('i.edit_category').click(function(){
		
		id_category = $(this).attr('rel');
		var url = URL_SERVER + 'category/get_category_form/' + id_category;
		
		$.post(url, function(response){
			clear_div();
			$('#dialog_edit_category').html(response);
		    $('#dialog_edit_category').dialog('open');
		})
		.error(function() { alert('Error'); });
		
	});
	
	$('#dialog_edit_category').dialog({
		title		: 'Edit Category',
		autoOpen	: false,
		resizable	: false,
		width		: 500,
		height		: 425,
		modal		: false,
		buttons		: {
						Save: function() {
							var url = URL_SERVER + 'index.php/category/edit_category/' + id_category;
							var id_parent = ($('#id_category').val() == $('#id_parent').val()) ? 0 : $('#id_parent').val();
							var data = {
								'id_category'	: $('#id_category').val(),
								'id_parent'		: id_parent,
								'name' 			: $('#name').val(),
								'description' 	: $('#description').val(),
								'is_enable' 	: $('input:radio[name=is_enable]:checked').val()
							};
							$.post(url, data, function(response){
								$(this).dialog("close");
								location.href = URL_SERVER + 'index.php/story/master_story_list';
							})
							.error(function() { alert('Error'); });
						}
					  }
	});	
	
});