<?php
class User_model extends CI_Model 
{
	// ------------------------------------------------------------------------
	// Setup database
	// ------------------------------------------------------------------------
	
	private $table = array(
						       'user'	=> 'backoffice_user',
						       'group'	=> 'backoffice_user_group',
						       'role'	=> 'backoffice_user_role',
						       'log'	=> 'backoffice_user_log',
						  );
	
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
		$this->db->insert($this->table['user'], $data);
		
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
			$_query = $this->db->get($this->table['user'], $limit, $offset);
		}
		else if($limit != '')
		{
			$_query = $this->db->get($this->table['user'], $limit, 0);
		}
		else
		{
			$this->db->select(
								$this->table['user'].'.id, '.
								$this->table['user'].'.name, '.
								$this->table['user'].'.username, '.
								$this->table['group'].'.name as "group", '.
								$this->table['role'].'.name as "role"'
							 );
							 
 			$this->db->join(
								$this->table['group'], 
								$this->table['user'].'.id_group = '.$this->table['group'].'.id'
						   );
			
 			$this->db->join(
								$this->table['role'],
								$this->table['user'].'.id_role = '.$this->table['role'].'.id'
						   );
						   
			$_query = $this->db->get($this->table['user']);
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
			$_criteria = $this->table['group'].'.name';
		}
		else if($criteria == 'id_role')
		{
			$_criteria= $this->table['role'].'.name';
		}
		else
		{
			$_criteria = $this->table['user'].'.'.$criteria;
		}
	
		$this->db->select(
							$this->table['user'].'.id, '.
							$this->table['user'].'.name, '.
							$this->table['user'].'.username, '.
							$this->table['group'].'.name as "group", '.
							$this->table['role'].'.name as "role"'
						 );
						 
		$this->db->join(
							$this->table['group'], 
							$this->table['user'].'."id_group" = '.$this->table['group'].'.id'
						);
		
		$this->db->join(
							$this->table['role'], 
							$this->table['user'].'.id_role = '.$this->table['role'].'.id'
						);			
		
		$this->db->like($_criteria, $keyword);
		
		$_query = $this->db->get($this->table['user']);
		
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
		$_query = $this->db->get($this->table['user']);
		
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
		$this->db->update($this->table['user'], $data);
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
			$this->db->delete($this->table['user']);
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
		$this->db->insert($this->table['group'], $data);
		
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
		$this->db->where('id !=', 0);
		
		if($limit != '' && $offset != '')
		{
			$_query = $this->db->get($this->table['group'], $limit, $offset);
		}
		else if($limit != '')
		{
			$_query = $this->db->get($this->table['group'], $limit, 0);
		}
		else
		{
			$_query = $this->db->get($this->table['group']);
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
		$_query = $this->db->get($this->table['group']);
		
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
		$_query = $this->db->get($this->table['group']);
		
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
		$this->db->update($this->table['group'], $data);
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
			$this->db->delete($this->table['group']);
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
		$this->db->insert($this->table['role'], $data);
		
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
		$this->db->where('id !=', 0);
		
		if($limit != '' && $offset != '')
		{
			$_query = $this->db->get($this->table['role'], $limit, $offset);
		}
		else if($limit != '')
		{
			$_query = $this->db->get($this->table['role'], $limit, 0);
		}
		else
		{
			$_query = $this->db->get($this->table['role']);
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
		$_query = $this->db->get($this->table['role']);
		
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
		$_query = $this->db->get($this->table['role']);
		
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
		$this->db->update($this->table['role'], $data);
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
			$this->db->delete($this->table['role']);
		}
	}
	
	// ------------------------------------------------------------------------
	// Function - User log
	// ------------------------------------------------------------------------
	
	/**
	 * Get user log list
	 *
	 * @access	public
	 * @param 	integer		$limit
	 * @param 	integer		$offset		
	 * @return	array
	 */
	
	function get_log_list($limit = '', $offset = '')
	{		
		if($limit != '' && $offset != '')
		{
			$_query = $this->db->get($this->table['log'], $limit, $offset);
		}
		else if($limit != '')
		{
			$_query = $this->db->get($this->table['log'], $limit, 0);
		}
		else
		{
			$_query = $this->db->get($this->table['log']);
		}
		
		return $_query->result();
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
		$_query = $this->db->get($this->table['user']);
		$validation = (count($_query->row_array()) != 0) ? TRUE : FALSE;
		
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
			$query = $this->db->get($this->table['user']);
			
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
							$this->table['user'].'.* ,'.
							$this->table['group'].'.name as "group", '.
							$this->table['role'].'.name as "role"'
						 );
						 
 		$this->db->join(
							$this->table['group'], 
							$this->table['user'].'.id_group = '.$this->table['group'].'.id'
					   );
						
 		$this->db->join(
							$this->table['role'],
							$this->table['user'].'.id_role = '.$this->table['role'].'.id'
					   );
							
		$this->db->where($this->table['user'].'.username', $username); 
		
		$_query = $this->db->get($this->table['user']);
		
		return $_query->row_array();  
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Set user session
	 *
	 * @access	public
	 * @param 	array	$data
	 */
	  
	function set_session($data)  
	{  	
		$session = array(
							'id'			=> $data['id'],
							'name'			=> $data['name'],
							'username'		=> $data['username'],
							'id_group'		=> $data['id_group'],
							'group'			=> $data['group'],
							'id_role'		=> $data['id_role'],
							'role'			=> $data['role'],
							'login_status'	=> TRUE
						 );
					 
		$this->session->set_userdata($session);
	}
	
	// ------------------------------------------------------------------------
}


/* End of file user_model.php */
/* Location: ./application/modules/backoffice/model/user_model.php */