<?php

function get_id($url)
{
	$_id = substr($url, strpos($url, 'v=')+2,11);
	
	return $_id;
}

function get_thumbnail($url, $thumbnail_no = 0)
{
	$_id = get_id($url);	
	$_thumbnail = '<img src="http://img.youtube.com/vi/'.$_id.'/'.$thumbnail_no.'.jpg" />';
	
	return $_thumbnail;
}

function get_thumbnail_url($url, $thumbnail_no = 0)
{
	$_id = get_id($url);
	$_thumbnail_url = 'http://img.youtube.com/vi/'.$_id.'/'.$thumbnail_no.'.jpg';
	
	return $_thumbnail_url;
}

function get_player_url($url)
{
	$_id = get_id($url);
	$_player = 'http://www.youtube.com/v/'.$_id;
	
	return $_player;
}

function get_embed($url, $set_ratio=NULL, $value=NULL)
{
	$_player_ratio = 1.78;
	
	if($set_ratio != NULL && $value != NULL)
	{
		if($set_ratio == 'width')
		{
			$_width = $value;
			$_height = round($value / $_player_ratio) + 25;
		}
		else
		{
			$_width = round($value * $_player_ratio) + 25;
			$_height = $value;
		}
	}
	else
	{
		$_width = 640;
		$_height = 385;
	}
	
	//echo $_width.'<br />' .$_height;
	//exit();
	
	$_id = get_id($url);
	$_embed = '<object width="'.$_width.'" height="'.$_height.'">
					<param name="movie" value="http://www.youtube.com/v/'.$_id.'?fs=1&amp;hl=en_US"></param>
					<param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param>
					<embed src="http://www.youtube.com/v/'.$_id.'?fs=1&amp;hl=en_US" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$_width.'" height="'.$_height.'"></embed>
				</object>';
	
	return $_embed;
}

/* End of file iic_youtube_helper.php */
/* Location: ./application/helpers/iic_youtube_helper.php */