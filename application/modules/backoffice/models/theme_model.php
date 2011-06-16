<?php

class Theme_model extends CI_Model
{
	function get_theme()
	{	
		$theme = array();
		$theme['head_bg_color'] = '#79C342';
		$theme['head_text1'] = 'Member Login';
		$theme['head_text2'] = 'IIC Framework';
		$theme['head_text_color'] = '#FFF';
		$theme['head_text_size'] = '24';
		$theme['foot_bg_color'] = '#79C342';
		$theme['foot_text'] = 'All support and powered by NextGen Sulution Co.,Ltd.';
		$theme['foot_text_color'] = '#FFF';
		$theme['foot_text_size'] = '10';
	
		return $theme;
	}
	
	function gen_css()
	{
		$theme = $this->get_theme();
		
		echo '
				#head_section
				{
					background: ' . $theme['head_bg_color'] . ';	
					color: ' . $theme['head_text_color'] . ';
					text-align: right;
					padding: 10px;
				}
				
				#head_section h1
				{
					font-size: ' . $theme['head_text_size'] . 'px;
					margin: 0px;
					font-weight: normal;
				}
				
				#head_section h2
				{
					font-size: ' . ($theme['head_text_size'] * 3 / 4) . 'px;
					margin: 0px;
					font-weight: normal;
				}
				
				#head_section img
				{
					height: 5px;
					margin: 5px 0px;
				}
				
				#foot_section
				{
					background: ' . $theme['foot_bg_color'] . ';	
					color: ' . $theme['foot_text_color'] . ';
					font-size: ' . $theme['foot_text_size'] . 'px;
					padding: 3px;
					text-align: center;
				}	
			';
	}
}