$(function() 
{
	jQuery.validator.setDefaults
	({ 
		debug			: false,
		errorElement	: "i",
		errorPlacement	: function(error, element) 
						  {
							  error.appendTo(element.prev());
						  }
	});	
});