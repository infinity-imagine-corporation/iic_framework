<?php 
// ------------------------------------------------------------------------

/**
  * Convert multiple stirng seperate value with comma (not CSV format) to array
  *
  * @access		public
  * @param		stirng	$text
  * @return		array	
  */
  
function get_square_image($image, $width, $height)
{	
	// Get image properties	
	$image_info		= getimagesize($_FILES["image"]["tmp_name"]);
	$image_width	= $image_info[0];
	$image_height	= $image_info[1];
	
	// Set max width & max height
	$max_width	= 500;
	$max_height = 500;
	
	$src_w = $image_width;
	$src_h = $image_height;
	
	$src_x = 0;
	$src_y = 0;
	
	$tmp_image_w = 0;
	$tmp_image_h = 0;
	
	if($image_width != $max_width)
	{
		$tmp_image_w = $max_width;
		$tmp_image_h = round($tmp_image_w * $image_height / $image_width);
	
		$dst_x = 0;
		$dst_y = ($max_height - $image_height) / 2;
	}
	
	if($tmp_image_h > $max_height)
	{	
		$tmp_image_h = $max_height;
		$tmp_image_w = round($tmp_image_h * $image_width / $image_height);
		
		$dst_x = ($max_width - $tmp_image_w) / 2;
		$dst_y = 0;
	}
	else
	{
		$dst_x = ($max_width - $tmp_image_w) / 2;
		$dst_y = ($max_height - $tmp_image_h) / 2;
	}
		
	$dst_w = $tmp_image_w;
	$dst_h = $tmp_image_h;
	
	// Get source image
	if($_FILES["image"]["type"] == "image/jpeg") 
	{
		$temp_image = imagecreatefromjpeg($_FILES["image"]["tmp_name"]);
	} 
	else if($_FILES["image"]["type"] == "image/png")
	{
		$temp_image = imagecreatefrompng($_FILES["image"]["tmp_name"]);
	}  
	else if($_FILES["image"]["type"] == "image/gif")
	{
		$temp_image = imagecreatefromgif($_FILES["image"]["tmp_name"]);
	} 
	
	// Create themp image
	$thumbnail = imagecreatetruecolor($max_width, $max_height);
	
	// Set background color
	$bg_color = imagecolorallocate($thumbnail, 255, 255, 255);
	imagefill($thumbnail, 0, 0, $bg_color);
	
	// Create thumbnail image
	imagecopyresampled($thumbnail, $temp_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

	// Display image
	header('Content-type: '.$_FILES["image"]["type"].' ');
	header('Content-Disposition: inline; filename="'.$_FILES["image"]["name"].'"');
	
	imagejpeg($thumbnail);
	
	// Delete themp image
	imagedestroy($thumbnail);
}

// ------------------------------------------------------------------------


/* End of file iic_image_helper.php */
/* Location: ./iic_tools/helpers/iic_image_helper.php */