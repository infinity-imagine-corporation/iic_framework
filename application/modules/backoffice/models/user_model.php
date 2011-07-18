<?php
class User_model extends CI_Model 
{
	// ------------------------------------------------------------------------
	// Setup database
	// ------------------------------------------------------------------------
	
	var $table_user 		= 'backoffice_user';
	var $table_user_group 	= 'backoffice_user_group';
	var $table_user_role	= 'backoffice_user_role';
	
	// ------------------------------------------------------------------------
	// Function - User
	// ------------------------------------------------------------------------
	
	/**
	 * Create user
	 *
	 * @access	public
	 */
	  
	/*function create_member()
	{
		$new_member_insert_data = array(
			'first_name' 	=> $this->input->post('first_name'),
			'last_name' 	=> $this->input->post('last_name'),
			'email_address' => $this->input->post('email_address'),			
			'username' 		=> $this->input->post('username'),
			'password' 		=> $this->input->post('password')						
		);
		
		$insert = $this->db->insert($this->table, $new_member_insert_data);
		return $insert;
	}*/
			
	// ------------------------------------------------------------------------
	// Function - User group
	// ------------------------------------------------------------------------
	
	/**
	 * Create new user group
	 *
	 * @access	public
	 * @param 	array		$data		
	 */
	
	function create_group($data)
	{
		$this->db->insert($this->table_user_group, $data);
		
		return TRUE;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user group list
	 *
	 * @access	public
	 * @param 	integer		$limit
	 * @param 	integer		$offset		
	 * @return	array
	 */
	
	function get_group_list($limit = '', $offset = '')
	{		
		if($limit != '' && $offset != '')
		{
			$_query = $this->db->get($this->table_user_group, $limit, $offset);
		}
		else if($limit != '')
		{
			$_query = $this->db->get($this->table_user_group, $limit, 0);
		}
		else
		{
			$_query = $this->db->get($this->table_user_group);
		}
		
		return $_query->result();
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Search user group
	 *
	 * @access	public
	 * @param 	string		$keyword		
	 * @param 	string		$criteria	
	 * @return	array
	 */
	
	function search_group($keyword, $criteria)
	{				
		$this->db->like($criteria, $keyword);
		$_query = $this->db->get($this->table_user_group);
		
		return $_query->result();
	}	
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user group detail
	 *
	 * @access	public
	 * @param 	int		$id		
	 * @return	array
	 */
	
	function get_group_detail($id)
	{		
		$this->db->where('id', $id);
		$_query = $this->db->get($this->table_user_group);
		
		return $_query->row_array();
	}	
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update user group content
	 *
	 * @access	public
	 * @param 	integer		$id		
	 * @param 	array		$data	
	 * @return	bool
	 */
	
	function update_group($id, $data)
	{		
		$this->db->where('id', $id);
		$this->db->update($this->table_user_group, $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Delete user group
	 *
	 * @access	public
	 * @param 	array		$id		
	 */
	
	function delete_group($id)
	{		
		for($loop = 0; $loop < count($id); $loop++)
		{
			$this->db->where('id', $id[$loop]);
			$this->db->delete($this->table_user_group);
		}
	}// ------------------------------------------------------------------------
	// Function - User role
	// ------------------------------------------------------------------------
	
	/**
	 * Create new user role
	 *
	 * @access	public
	 * @param 	array		$data		
	 */
	
	function create_role($data)
	{
		$this->db->insert($this->table_user_role, $data);
		
		return TRUE;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user role list
	 *
	 * @access	public
	 * @param 	integer		$limit
	 * @param 	integer		$offset		
	 * @return	array
	 */
	
	function get_role_list($limit = '', $offset = '')
	{		
		if($limit != '' && $offset != '')
		{
			$_query = $this->db->get($this->table_user_role, $limit, $offset);
		}
		else if($limit != '')
		{
			$_query = $this->db->get($this->table_user_role, $limit, 0);
		}
		else
		{
			$_query = $this->db->get($this->table_user_role);
		}
		
		return $_query->result();
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Search user role
	 *
	 * @access	public
	 * @param 	string		$keyword		
	 * @param 	string		$criteria	
	 * @return	array
	 */
	
	function search_role($keyword, $criteria)
	{				
		$this->db->like($criteria, $keyword);
		$_query = $this->db->get($this->table_user_role);
		
		return $_query->result();
	}	
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user role detail
	 *
	 * @access	public
	 * @param 	int		$id		
	 * @return	array
	 */
	
	function get_role_detail($id)
	{		
		$this->db->where('id', $id);
		$_query = $this->db->get($this->table_user_role);
		
		return $_query->row_array();
	}	
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update user role content
	 *
	 * @access	public
	 * @param 	integer		$id		
	 * @param 	array		$data	
	 * @return	bool
	 */
	
	function update_role($id, $data)
	{		
		$this->db->where('id', $id);
		$this->db->update($this->table_user_role, $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Delete user role
	 *
	 * @access	public
	 * @param 	array		$id		
	 */
	
	function delete_role($id)
	{		
		for($loop = 0; $loop < count($id); $loop++)
		{
			$this->db->where('id', $id[$loop]);
			$this->db->delete($this->table_user_role);
		}
	}
	
	// ------------------------------------------------------------------------
	// Function - Login
	// ------------------------------------------------------------------------
	
	/**
	 * Login page
	 *
	 * @access	public
	 */
	  
	function validate()
	{
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', $this->input->post('password'));
		$_query = $this->db->get($this->table_user);
		$validation = ($_query->num_rows == 1) ? TRUE : FALSE;
		
		return $validation;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Login page
	 *
	 * @access	public
	 */
	  
	function get_detail($id = NULL)  
	{  
		if($id != NULL)  
		{  
			$this->db->where('id', $id); 
			$query = $this->db->get($this->table_user);
			
			return $query->row_array();  
		} 
		else 
		{ 
			return FALSE;  
		} 
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user detail by username
	 *
	 * @access	public
	 * @param 	sting	$username
	 * @return	array
	 */
	  
	function get_detail_by_username($username)  
	{  
		$this->db->where('username', $username); 
		$query = $this->db->get($this->table_user);
		
		return $query->row_array();  
	}
	
	// ------------------------------------------------------------------------
}


/* End of file user_model.php */
/* Location: ./application/modules/backoffice/model/user_model.php */