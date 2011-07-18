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
	 * Create new user 
	 *
	 * @access	public
	 * @param 	array		$data		
	 */
	
	function create_user($data)
	{
		$this->db->insert($this->table_user, $data);
		
		return TRUE;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user list
	 *
	 * @access	public
	 * @param 	integer		$limit
	 * @param 	integer		$offset		
	 * @return	array
	 */
	
	function get_user_list($limit = '', $offset = '')
	{		
		if($limit != '' && $offset != '')
		{
			$_query = $this->db->get($this->table_user, $limit, $offset);
		}
		else if($limit != '')
		{
			$_query = $this->db->get($this->table_user, $limit, 0);
		}
		else
		{
			$this->db->select(
								$this->table_user.'.id, '.
								$this->table_user.'.name, '.
								$this->table_user.'.username, '.
								$this->table_user_group.'.name as "group", '.
								$this->table_user_role.'.name as "role"'
							 );
 			$this->db->join($this->table_user_group, $this->table_user.'.id_group = '.$this->table_user_group.'.id');
 			$this->db->join($this->table_user_role, $this->table_user.'.id_role = '.$this->table_user_role.'.id');
			$_query = $this->db->get($this->table_user);
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
	
	function search_user($keyword, $criteria)
	{	
		if($criteria == 'id_group')
		{
			$_criteria = $this->table_user_group.'.name';
		}
		else if($criteria == 'id_role')
		{
			$_criteria= $this->table_user_role.'.name';
		}
		else
		{
			$_criteria = $this->table_user.'.'.$criteria;
		}
	
		$this->db->select(
							$this->table_user.'.id, '.
							$this->table_user.'.name, '.
							$this->table_user.'.username, '.
							$this->table_user_group.'.name as "group", '.
							$this->table_user_role.'.name as "role"'
						 );
		$this->db->join($this->table_user_group, $this->table_user.'."id_group" = '.$this->table_user_group.'.id');
		$this->db->join($this->table_user_role, $this->table_user.'.id_role = '.$this->table_user_role.'.id');			
		$this->db->like($_criteria, $keyword);
		$_query = $this->db->get($this->table_user);
		
		return $_query->result();
	}	
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user detail
	 *
	 * @access	public
	 * @param 	int		$id		
	 * @return	array
	 */
	
	function get_user_detail($id)
	{		
		$this->db->where('id', $id);
		$_query = $this->db->get($this->table_user);
		
		return $_query->row_array();
	}	
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update user content
	 *
	 * @access	public
	 * @param 	integer		$id		
	 * @param 	array		$data	
	 * @return	bool
	 */
	
	function update_user($id, $data)
	{		
		$this->db->where('id', $id);
		$this->db->update($this->table_user, $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Delete user
	 *
	 * @access	public
	 * @param 	array		$id		
	 */
	
	function delete_user($id)
	{		
		for($loop = 0; $loop < count($id); $loop++)
		{
			$this->db->where('id', $id[$loop]);
			$this->db->delete($this->table_user);
		}
	}
			
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
	}
	
	// ------------------------------------------------------------------------
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
		$this->db->select(
							$this->table_user.'.id, '.
							$this->table_user.'.name, '.
							$this->table_user.'.username, '.
							$this->table_user.'.password, '.
							$this->table_user_group.'.name as "group", '.
							$this->table_user_role.'.name as "role"'
						 );
 		$this->db->join($this->table_user_group, $this->table_user.'.id_group = '.$this->table_user_group.'.id');
 		$this->db->join($this->table_user_role, $this->table_user.'.id_role = '.$this->table_user_role.'.id');
		$this->db->where($this->table_user.'.username', $username); 
		$_query = $this->db->get($this->table_user);
		
		return $_query->row_array();  
	}
	
	// ------------------------------------------------------------------------
}


/* End of file user_model.php */
/* Location: ./application/modules/backoffice/model/user_model.php */