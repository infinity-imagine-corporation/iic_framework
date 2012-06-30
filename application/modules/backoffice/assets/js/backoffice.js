$(function()
{
	adjust_layout()
	
	$(window).resize(function()
	{
		adjust_layout();
	});
})

function adjust_layout()
{
	var page_height = $(window).height();
	var content_height = (page_height - 180 - 35 - 30); // window - header - nav - footer
	
	$('#content').css('min-heignt', content_height);
	$('#content').height(content_height);
	
	$('.dashboard').css('min-heignt', content_height - 50);
	$('.dashboard').height(content_height - 30);
}
