<?php 
// ------------------------------------------------------------------------
// Array 
// ------------------------------------------------------------------------

/**
  * Display array key => value
  *
  * @access		public
  * @param		array	$arr
  */
  
function print_array($arr)
{
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

// ------------------------------------------------------------------------

/**
  * Convert array to stirng seperate value with comma (not CSV format)
  *
  * @access		public
  * @param		array	$arr
  * @return		stirng	
  */
  
function array_to_comma($arr)
{
	return implode(',', $arr);
}

// ------------------------------------------------------------------------

/**
  * Convert multiple stirng seperate value with comma (not CSV format) to array
  *
  * @access		public
  * @param		stirng	$text
  * @return		array	
  */
  
function comma_to_array($text)
{
	return explode(',', $text);
}

// ------------------------------------------------------------------------
// Date Time	
// ------------------------------------------------------------------------

/**
  * Change date format
  *
  * @access		public
  * @param		string	$date
  * @param		string	$old_separator
  * @param		string	$old_format		Separate date with (-), y = Year, m = mouth, d = date Example: y-m-d or d-m-y or m-d-y
  * @param		string	$new_separator
  * @param		string	$new_format		Separate date with (-), y = Year, m = mouth, d = date Example: y-m-d or d-m-y or m-d-y
  * @return		string	
  */
	
function change_date_format($date, $old_separator = "-", $old_format = 'y-m-d', $new_separator = " / ", $new_format = "d-m-y")
{	
	// Get old format
	@list($_old_format_path1, $_old_format_path2, $_old_format_path3) = explode('-', $old_format);
	
	// Indendify date path
	@list($_date_path[$_old_format_path1], $_date_path[$_old_format_path2], $_date_path[$_old_format_path3]) = explode($old_separator, $date);
	
	// Get new format
	@list($_new_format_path1, $_new_format_path2, $_new_format_path3) = explode('-', $new_format);
	
	// Set new format
	$_new_date = $_date_path[$_new_format_path1].$new_separator.$_date_path[$_new_format_path2].$new_separator.$_date_path[$_new_format_path3];
	
	return $_new_date;
}

// ------------------------------------------------------------------------

/**
  * Change date time format
  *
  * @access		public
  * @param		string	$date_time
  * @return		string	
  */

function change_date_time_format($date_time)
{	
	@list($_date, $_time) = explode(" ", $date_time);
	
	$_new_date		= change_date_format($_date);
	$_new_date_time = $_new_date.' '.substr($_time, 0, 5);
	
	return $_new_date_time;
}  

// ------------------------------------------------------------------------

function get_timestamp($date_time)
{
	$_mktime['Y']	= date('Y');
	$_mktime['m']	= date('m');
	$_mktime['d']	= date('d');
	$_mktime['H']	= 0;
	$_mktime['i']	= 0;
	$_mktime['s']	= 0;
	
	// Check type of $date_time (date_time, date, time)
	if(strlen($date_time) == 19) // YYYY-MM-DD HH:MM:SS
	{
		list($_date, $_time) = explode(' ', $date_time);
		
		list($_mktime['Y'], $_mktime['m'], $_mktime['d']) = explode("-", $_date);
		
		list($_mktime['H'], $_mktime['i'], $_mktime['s']) = split(':',$_time);
		
		$_return = TRUE;
	}
	else if(strlen($date_time) == 10) // YYYY-MM-DD
	{
		list($_mktime['Y'], $_mktime['m'], $_mktime['d']) = explode("-", $date_time);
		
		$_return = TRUE;
	}
	else if(strlen($date_time) <= 8) // HH:MM:SS or HH:MM
	{
		if(strlen($date_time) == 8) // HH:MM:SS
		{
			list($_mktime['H'], $_mktime['i'], $_mktime['s']) = explode(':', $date_time);
		
			$_return = TRUE;
		}
		else if(strlen($date_time) == 5) // HH:MM
		{
			list($_mktime['H'] , $_mktime['i']) = explode(":", $date_time);
		
			$_mktime['s'] = 0;
			
			$_return = TRUE;
		}
		else
		{
			$_return = FALSE;
		}
	}
	else
	{
		$_return = FALSE;
	}
	
	if($_return)
	{
		return mktime($_mktime['H'], $_mktime['i'], $_mktime['s'], $_mktime['m'], $_mktime['d'], $_mktime['Y']); 
	}
	else
	{
		return 'Error';
	}
}

// ------------------------------------------------------------------------

function get_date_timestamp($date)
{
	list($_mktime['Y'], $_mktime['m'], $_mktime['d']) = explode("-", $date);
	
	return mktime(0, 0, 0, $_mktime['m'], $_mktime['d'], $_mktime['Y']); 
}

// ------------------------------------------------------------------------

function get_time_timestamp($time)
{
	if (eregi("[0-9]{1,2}:[0-9]{2}:[0-9]{2}", $time))
	{
		list($_mktime['H'], $_mktime['i'], $_mktime['s']) = split(':',$time);
	}
	else if(eregi("[0-9]{1,2}:[0-9]{2}",$time))
	{
		list($_mktime['H'] ,$_mktime['i']) = split(":",$time);
		$_mktime['s'] = 0;
	}
	
	$_mktime['Y']	= date("d");
	$_mktime['m']	= date("m");
	$_mktime['d']	= date("Y");
	
	return mktime($_mktime['H'], $_mktime['i'], $_mktime['s'], $_mktime['m'], $_mktime['d'], $_mktime['Y']); 
}

// ------------------------------------------------------------------------

function time_diff($time1, $time2)
{
	$_time_diff = getTimeStamp($time1) - getTimeStamp($time2);
	
	return ceil(abs($_time_diff / 60));
}

// ------------------------------------------------------------------------
// String
// ------------------------------------------------------------------------

/**
  * Put 0 to $data 
  *
  * @access		public
  * @param		integer	$length
  * @param		stirng	$data
  * @return		stirng	
  */
  
function zero_fill($length, $data)
{
	while(strlen($data) < $length)
	{
		$data = '0'.$data;
	}
	
	return $data;
}

// ------------------------------------------------------------------------

/**
  * Remove comma form string
  *
  * @access		public
  * @param		string	$number
  * @param		integer	$decimal
  * @return		stirng	
  */
  
function remove_comma($number, $decimal = 0) 
{
	$_int		= 0;
	$_decimal	= '';
	
	if(count(explode (".", $number)) > 1)
	{
		list($_int, $_decimal) = explode (".", $number);
	}
	else
	{
		$_int = ($number == '') ? 0 : $number;
	}
	
	if(($_decimal == '' && $decimal > 0) || ($_decimal != '')) 
	{
		while(strlen ($_decimal) < 2) 
		{
			$_decimal = '0'.$_decimal;
		}
		
		$_decimal = '.'.$_decimal;
	}
	
	$_int = explode (',', $_int);
	$_int = implode ($_int);
	
	$_new_number = $_int.$_decimal;
	
	return $_new_number;
}

// ------------------------------------------------------------------------

function add_comma($number, $decimal = 0) 
{	
	$_sign		= '';
	$_int		= 0;
	$_decimal	= '';

	if(count(explode (".", $number)) > 1)
	{
		list($_int, $_decimal) = explode (".", $number);
	}
	else
	{
		$_int = ($number == '') ? 0 : $number;
	}
	
	$_int = remove_comma($_int);
	
	if(($_decimal == '' && $decimal > 0) || ($_decimal != '')) 
	{
		while(strlen ($_decimal) < 2) 
		{
			$_decimal = '0'.$_decimal;
		}
		
		$_decimal = '.'.$_decimal;
	}
	else if(strlen($_decimal) > 0) 
	{		
		$_decimal = '.'.$_decimal;
	}
	
	if($_int < 0) 
	{
		$_sign = '-';
		$_int = str_replace('-', '', $_int);
	} 
	else 
	{
		$_sign = '';
	}	
	
	$_total_loop = (strlen($_int) > 3) ? floor(strlen($_int) / 3) : 0;
	
	for($_loop = $_total_loop; $_loop > 0; $_loop--)
	{
		$_length = (3 * $_loop) * -1;
		$_int = substr_replace($_int, ',', $_length, 0 );
	}
	
	$_new_number = $_sign.$_int.$_decimal;
	
	return $_new_number;
}

// ------------------------------------------------------------------------
// Form object
// ------------------------------------------------------------------------

/**
  * Genarate numeric selectbox
  *
  * @access		public
  *
  * @param		int		$start
  * @param		int		$end
  * @param		int		$selected
  * @param		array	$attribute
  *
  * @return		mixed	$_selectbox
  */
  
function get_numeric_selectbox($start, $end, $selected, $attribute)
{		
	// Generate attribute
	$_attr = '';
	
	foreach($attribute as $key => $value)
	{
		$_attr .= ' '.$key.'="'.$value.'"';
	}
	
	// Generate selectbox
	$_selectbox = '<select'.$_attr.'>';

	for($_loop = $start; $_loop <= $end; $_loop++)
	{
		// Check selected
		$_selected = ($selected == $_loop) ? 'selected = "selected"' : '';
		
		// Generate option value
		$_selectbox .= '<option value="'.$_loop.'" '.$_selected.'>'.$_loop.'</option>';
	}
	
	$_selectbox .= '</select>';
	
	return $_selectbox;
}

// ------------------------------------------------------------------------


/* End of file iic_utilities_helper.php */
/* Location: ./iic_tools/helpers/iic_utilities_helper.php */