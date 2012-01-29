<?php

class Config_model extends CI_Model
{
	// ------------------------------------------------------------------------
	// Setup database
	// ------------------------------------------------------------------------
	  
	private $table = array(
							'config' => 'backoffice_config'
						  );
	
	// ------------------------------------------------------------------------
	// Function - Upload
	// ------------------------------------------------------------------------
	
	/**
	 * Get upload config
	 *
	 * @access	public	
	 * @return	array
	 */
	
	function get_upload_config()
	{		
		$_query = $this->db->get($this->table['config']);
		
		return $_query->row_array();
	}	
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update upload config
	 *
	 * @access	public
	 * @param 	array		$data	
	 */
	
	function update_upload_config($data)
	{		
		$this->db->update($this->table['config'], $data, 'id = 1');
	}
	
	// ------------------------------------------------------------------------
}


/* End of file config_model.php */
/* Location: ./application/modules/backoffice/model/config_model.php */