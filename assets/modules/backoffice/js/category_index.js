$(function() {
	
list_category(0);

$('#quick_access').change(function(){
	list_category($(this).val());
})
		
/*------------------------------------------------------------*/
/* Content */
/*------------------------------------------------------------*/

function list_category(id_parent)
{
	$('#preload').slideDown('fast');
	var url = URL_SERVER + 'backoffice/category/get_category_list/'+id_parent;
	var data = 'id_parent = ' + id_parent;
	
	$.post(url, data, function(response)
	{
		if(response.status == 1)
		{
			 var list = '';

			 $.each(response.data, function(i, data) {
				list += '<tr rel="'+data['id_category']+'">'+
							'<td><input type="checkbox" id="id_'+data['id_category']+'" name="id['+data['id_category']+']" value="'+data['category']+'" /></td>'+
							'<td>'+data['name']+'</td>'+
							'<td>'+data['description']+'</td>'+
							'<td>'+data['is_enable']+'</td>'+
							'<td></td>'+
						'</tr>';
			  });
				
			$("tbody").html(list);
			get_category_selectbox_option(id_parent);
		}
		else
		{
			$("tbody").html("<td align='center' colspan='5'>No result found.</td>");	
		}
	}, "json")
	.success(function() { $('#preload').slideUp('fast'); })
	.error(function() { alert('Error'); });
}

function get_category_selectbox_option(id_parent)
{
	var url = URL_SERVER + 'backoffice/category/get_category_selectbox_option/' + id_parent;
	
	$.post(url, function(response)
	{
		$('#quick_access').html(response);
	}, "HTML")
	.error(function() { alert('Error'); });
}
	
/*------------------------------------------------------------*/
/* Button */
/*------------------------------------------------------------*/

/* Setup Button */

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

/* Button Add */

$('.button_add').click(function(){
	if($('#dialog_add').html() == '')
	{
		var url = URL_SERVER + 'backoffice/category/add_category_form';
		$.post(url, function(response){
			$('#dialog_add').html('').html(response);
		})
		.error(function() { alert('Error: ' + url); });
	}
	$('#dialog_add').dialog('open');
});

/* Button Edit */
	
$('.table tr').live('click', function(){
	
	id_category = $(this).attr('rel');
	var url = URL_SERVER + 'backoffice/category/get_category_form/' + id_category;
	
	$.post(url, function(response){
		$('#dialog_edit').html(response).dialog('open');
	})
	.error(function() { alert('Error'); });
	
});
	
/*------------------------------------------------------------*/
/* Dialog */
/*------------------------------------------------------------*/

$('#dialog_add').dialog({
	title		: 'Add Category',
	autoOpen	: false,
	resizable	: false,
	width		: 500,
	height		: 425,
	modal		: true,
	buttons		: {
					Save: function() {
						var url = URL_SERVER + 'backoffice/category/add_category';
						var data = {
							'id_parent'		: $('#id_category').val(),
							'name' 			: $('#name').val(),
							'description' 	: $('#description').val(),
							'is_enable' 	: $('input:radio[name=is_enable]:checked').val()
						};
						$.post(url, data, function(response){
							list_category();
						})
						.success(function() { $('#dialog_add').dialog('close'); })
						.error(function() { alert('Error'); });
					}
				  }
});	

$('#dialog_edit').dialog({
	title		: 'Edit Category',
	autoOpen	: false,
	resizable	: false,
	width		: 500,
	height		: 425,
	modal		: false,
	buttons		: {
					Save: function() {
						
						var id_category = $('#id_category').val();
						var url = URL_SERVER + 'backoffice/category/edit_category/' + id_category;
						var id_parent = ($('#id_category').val() == $('#id_parent').val()) ? 0 : $('#id_parent').val();
						var data = {
							'id_category'	: id_category,
							'id_parent'		: id_parent,
							'name' 			: $('#name').val(),
							'description' 	: $('#description').val(),
							'is_enable' 	: $('input:radio[name=is_enable]:checked').val()
						};
						
						//alert(data['id_category']);
						
						$.post(url, data, function(response){
							list_category(data['id_parent']);
						})
						.success(function() { $('#dialog_edit').dialog('close'); })
						.error(function() { alert('Error'); });
					}
				  }
});	

/*------------------------------------------------------------*/
/* End */
/*------------------------------------------------------------*/	
	
});