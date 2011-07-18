<?php

class Module_model extends CI_Model
{
	// ------------------------------------------------------------------------
	// Setup database
	// ------------------------------------------------------------------------
	  
	var $table_module = 'backoffice_module';
	
	// ------------------------------------------------------------------------
	// Function - Modules
	// ------------------------------------------------------------------------
	
	/**
	 * Create new module 
	 *
	 * @access	public
	 * @param 	array		$data		
	 */
	
	function create_module($data)
	{
		$this->db->insert($this->table_module, $data);
		
		return TRUE;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get module list
	 *
	 * @access	public
	 * @param 	integer		$limit
	 * @param 	integer		$offset		
	 * @return	array
	 */
	
	function get_module_list($limit = '', $offset = '')
	{		
		if($limit != '' && $offset != '')
		{
			$_query = $this->db->get($this->table_module, $limit, $offset);
		}
		else if($limit != '')
		{
			$_query = $this->db->get($this->table_module, $limit, 0);
		}
		else
		{
			$_query = $this->db->get($this->table_module);
		}
		
		return $_query->result();
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Search module group
	 *
	 * @access	public
	 * @param 	string		$keyword		
	 * @param 	string		$criteria	
	 * @return	array
	 */
	
	function search_module($keyword, $criteria)
	{	
	
		$this->db->like($criteria, $keyword);
		$_query = $this->db->get($this->table_module);
		
		return $_query->result();
	}	
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get module detail
	 *
	 * @access	public
	 * @param 	int		$id		
	 * @return	array
	 */
	
	function get_module_detail($id)
	{		
		$this->db->where('id', $id);
		$_query = $this->db->get($this->table_module);
		
		return $_query->row_array();
	}	
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update module content
	 *
	 * @access	public
	 * @param 	integer		$id		
	 * @param 	array		$data	
	 * @return	bool
	 */
	
	function update_module($id, $data)
	{		
		$this->db->where('id', $id);
		$this->db->update($this->table_module, $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Delete module
	 *
	 * @access	public
	 * @param 	array		$id		
	 */
	
	function delete_module($id)
	{		
		for($loop = 0; $loop < count($id); $loop++)
		{
			$this->db->where('id', $id[$loop]);
			$this->db->delete($this->table_module);
		}
	}
			
	
	// ------------------------------------------------------------------------
}


/* End of file modules_model.php */
/* Location: ./application/modules/backoffice/model/modules_model.php */