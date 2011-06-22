<?php

class Theme_model extends CI_Model
{
	// ------------------------------------------------------------------------
	
	/**
	 * Setup database
	 *
	 */
	  
	var $table = 'backoffice_theme';
	
	function get_theme($id = 1)
	{	
		$query = $this->db->get_where($this->table, array('id_theme' => $id));
	
		return $query->row_array();
	}
	
	// ------------------------------------------------------------------------
	
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
	
	// ------------------------------------------------------------------------
}


/* End of file theme_model.php */
/* Location: ./application/modules/category/model/theme_model.php */