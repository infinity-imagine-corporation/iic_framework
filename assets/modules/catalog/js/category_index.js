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
	var url = URL_SERVER + 'catalog/category/get_category_list/'+id_parent;
	var data = 'id_parent = ' + id_parent;
	
	$.post(url, data, function(response)
	{
		if(response.status == 1)
		{
			 var list = '';

			 $.each(response.data, function(i, data) {
				 
				 var status = (data['is_enable'] == 0) ? 'Disable' : 'Enable';
				 var status_color = (data['is_enable'] == 0) ? 'red' : 'green';
				 
				list += '<tr rel="'+data['id_category']+'">'+
							'<td><input type="checkbox" id="id_'+data['id_category']+'" name="id['+data['id_category']+']" value="'+data['category']+'" /></td>'+
							'<td>' + data['name'] + '</td>' +
							'<td>' + data['description']  +'</td>' +
							'<td class="center ' + status_color + '">' + status + '</td>' +
							'<td></td>' +
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
	var url = URL_SERVER + 'catalog/category/get_category_selectbox_option/' + id_parent;
	
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
	
	var url = URL_SERVER + 'catalog/category/add_category_form';
	$.post(url, function(response){
		$('#dialog_add').html(response).dialog('open');
	})
	.error(function() { alert('Error: ' + url); });
});

/* Button Edit */
	
$('.table td:not(td:has(input))').live('click', function(){
	
	id_category = $(this).parent().attr('rel');
	var url = URL_SERVER + 'catalog/category/get_category_form/' + id_category;
	
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
						
						var id_parent = $('#dialog_add').find('#id_parent').val();
						var url = URL_SERVER + 'catalog/category/add_category';
						var data = {
							'id_parent'		: id_parent,
							'name' 			: $('#dialog_add').find('#name').val(),
							'description' 	: $('#dialog_add').find('#description').val(),
							'is_enable' 	: $('#dialog_add').find('input:radio[name=is_enable]:checked').val()
						};
						$.post(url, data, function(response){
							list_category(id_parent);
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
	modal		: true,
	buttons		: {
					Save: function() {
						
						var id_category = $('#dialog_edit').find('#id_category').val();
						var url = URL_SERVER + 'catalog/category/edit_category/' + id_category;
						var data = {
							'id_category'	: id_category,
							'id_parent'		: $('#dialog_edit').find('#id_parent').val(),
							'name' 			: $('#dialog_edit').find('#name').val(),
							'description' 	: $('#dialog_edit').find('#description').val(),
							'is_enable' 	: $('#dialog_edit').find('input:radio[name=is_enable]:checked').val()
						};
						
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