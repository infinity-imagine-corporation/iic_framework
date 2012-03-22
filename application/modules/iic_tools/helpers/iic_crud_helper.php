<?php 
// ------------------------------------------------------------------------

/**
  * Genarate pagination
  *
  * @access		public
  *
  * @param		int		$total_rows
  * @param		string	$target
  * @param		int		$current_page
  * @param		int		$rows_per_page
  *
  * @return		mixed	$_pagination
  */
  
function get_pagination($total_rows, $target, $current_page, $rows_per_page = 10)
{	
	// Set total page
	$_total_page = ceil($total_rows / $rows_per_page);
	$_pagination = '';
	
	// Create previous button
	if($current_page > 1 )
	{
		$_pagination .= '<a href="'.$target.($current_page - 1).'" title="Previous">&nbsp;Prev&nbsp;</a>&nbsp;';
	}
	
	$_loop = 1;
			
	// Create page button
	while($_loop <= $_total_page) 
	{
		if($_loop <= 3 || $_loop > ($_total_page - 3))
		{
			if($_loop == $current_page)
			{
				$_pagination .= '<strong>'.$_loop.'</strong>'; 
			}
			else
			{
				$_pagination .= '<a href="'.$target.$_loop.'" title="Page '.$_loop.'">&nbsp;'.$_loop.'&nbsp;</a>';
			}
		}
		else if($_loop == 4 && $current_page >= 8)
		{
			$_pagination .= " ... ";
		}
		else if($_loop >= ($current_page - 3) && $_loop <= ($current_page + 3) && $current_page > 3 && $current_page <= ($_total_page - 3))
		{
			if($_loop == $current_page)
			{
				$_pagination .= '<strong>'.$_loop.'</strong>'; 
			}
			else
			{
				$_pagination .= '<a href="'.$target.$_loop.'" title="Page '.$_loop.'">&nbsp;'.$_loop.'&nbsp;</a>';
			}
		}
		else if($_loop == ($_total_page - 3) && $current_page < ($_total_page - 3))
		{
			$_pagination .= " ... ";
		}
		
		$_loop++;
	}
	
	// Create next button
	if($current_page != $_total_page && $_total_page != 0)
	{
		$_pagination .= '&nbsp;<a href="'.$target.($current_page + 1).'" title="Next">&nbsp;Next&nbsp;</a>';
	}
	
	return $_pagination;
}

// ------------------------------------------------------------------------

/**
  * Calculate new size with original ratio
  *
  * @access		public
  *
  * @param		string	$image_uri
  * @param		int		$max_width
  * @param		int		$max_height
  *
  * @return		array	$_new_size
  */
  
function calc_image_size($image_uri, $max_width = 300, $max_height = 300)
{		
	// Get original size
	$_img_info	 = @getimagesize($image_uri);
	$_img_width	 = $_img_info[0];
	$_img_height = $_img_info[1];
	
	$_new_height	= '';
	$_new_width		= '';
	
	// Set new width
	if($_img_width > $max_width)
	{
		$_new_width		= $max_width;
		$_new_height	= floor($_new_width * $_img_height / $_img_width);
	} 
	else 
	{
		$_new_width = $_img_info[0];
	}	
	
	// Set new height
	if($_new_height > $max_height)
	{
		$_new_height = $max_width;
		$_new_width  = floor($_new_height * $_img_width / $_img_height);
	} 
	
	$_new_size['width'] = $_new_width;
	$_new_size['height'] = $_new_height;
	
	return $_new_size;
}

// ------------------------------------------------------------------------

/**
  * Genarate image tag with preview size
  *
  * @access		public
  *
  * @param		string	$image_uri
  * @param		int		$max_width
  * @param		int		$max_height
  *
  * @return		mixed	$_previewer
  */
  
function get_image_preview($image_uri, $max_width = 300, $max_height = 300)
{		
	$_new_size	 = calc_image_size($image_uri, $max_width, $max_height);
	$_new_width = $_new_size['width'];
	$_new_height = $_new_size['height'];
	
	$_description = 'Click to view enlarge image';
	
	$_previewer = '<a href="'.$image_uri.'" target="_blank"><img src="'.$image_uri.'" width="'.$_new_width.'" height="'.$_new_height.'" alt="'.$_description.'" title="'.$_description.'"></a>';
	
	return $_previewer;
}

// ------------------------------------------------------------------------

/**
  * Genarate image tag with preview size for CRUD 
  *
  * @access		public
  *
  * @param		string	$image_uri
  * @param		string	$label
  * @param		int		$max_width
  * @param		int		$max_height
  *
  * @return		mixed	$_previewer
  */
  
function get_crud_image_preview($image_uri, $label, $max_width = 300, $max_height = 300)
{
	$_new_size		= calc_image_size($image_uri, $max_width, $max_height);
	$_new_width		= $_new_size['width'];
	$_new_height	= $_new_size['height'];
	
	$_description = 'Click to view enlarge image';
	
	$_previewer = '<label><a href="'.$image_uri.'" target="_blank"><img src="'.$image_uri.'" width="'.$_new_width.'" height="'.$_new_height.'" alt="'.$_description.'" title="'.$_description.'"></a></label>';
	$_previewer .= '<label class="normal">Original size: '.$_new_width.' x '.$_new_height.'</label>';
	$_previewer .= '<label><input type="checkbox" name="delete_'.$label.'" value="1"> Delete this image</label>';
	
	return $_previewer;
}

// ------------------------------------------------------------------------


/* End of file iic_crud_helper.php */
/* Location: ./iic_tools/helpes/iic_crud_helper.php */