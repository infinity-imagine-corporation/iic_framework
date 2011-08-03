<?php

class Setting_model extends CI_Model
{
	// ------------------------------------------------------------------------
	// Setup database
	// ------------------------------------------------------------------------
	  
	private $table = array(
							'config' => 'backoffice_configuration'
						  );
	
	// ------------------------------------------------------------------------
	// Function - Upload
	// ------------------------------------------------------------------------
	
	/**
	 * Get upload setting
	 *
	 * @access	public	
	 * @return	array
	 */
	
	function get_upload_setting()
	{		
		$_query = $this->db->get($this->table['config']);
		
		return $_query->row_array();
	}	
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update upload setting
	 *
	 * @access	public
	 * @param 	array		$data	
	 */
	
	function update_upload_setting($data)
	{		
		$this->db->update($this->table['config'], $data, 'id = 1');
	}
	
	// ------------------------------------------------------------------------
}


/* End of file setting_model.php */
/* Location: ./application/modules/backoffice/model/setting_model.php */