<?php
class User_model extends IIC_Model 
{
	// ------------------------------------------------------------------------
	// Setup database
	// ------------------------------------------------------------------------
	
	protected $table = array(
						       'main'	=> 'backoffice_user',
						       'group'	=> 'backoffice_user_group',
						       'role'	=> 'backoffice_user_role'
						  	);
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user list
	 *
	 * @access	public
	 * @param 	integer		$limit
	 * @param 	integer		$offset		
	 * @return	array
	 */
	
	function list_content($limit = '', $offset = '')
	{		
		if($limit != '' && $offset != '')
		{
			$_query = $this->db->get($this->table['main'], $limit, $offset);
		}
		else if($limit != '')
		{
			$_query = $this->db->get($this->table['main'], $limit, 0);
		}
		else
		{
			$this->db->select(
								$this->table['main'].'.id, '.
								$this->table['main'].'.name, '.
								$this->table['main'].'.username, '.
								$this->table['group'].'.name as "group", '.
								$this->table['role'].'.name as "role"'
							 );
							 
			$this->db->join(
								$this->table['group'], 
								$this->table['main'].'.id_group = '.$this->table['group'].'.id'
						   );
			
			$this->db->join(
								$this->table['role'],
								$this->table['main'].'.id_role = '.$this->table['role'].'.id'
						   );
						   
			$_query = $this->db->get($this->table['main']);
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
							$this->table['main'].'.id, '.
							$this->table['main'].'.name, '.
							$this->table['main'].'.username, '.
							$this->table['group'].'.name as "group", '.
							$this->table['role'].'.name as "role"'
						 );
						 
		$this->db->join(
							$this->table['group'], 
							$this->table['main'].'."id_group" = '.$this->table['group'].'.id'
						);
		
		$this->db->join(
							$this->table['role'], 
							$this->table['main'].'.id_role = '.$this->table['role'].'.id'
						);			
		
		$this->db->like($_criteria, $keyword);
		
		$_query = $this->db->get($this->table['main']);
		
		return $_query->result();
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
							$this->table['main'].'.*, '.
							$this->table['group'].'.name as "group", '.
							$this->table['role'].'.name as "role"'
						 );
						 
 		$this->db->join(
							$this->table['group'], 
							$this->table['main'].'.id_group = '.$this->table['group'].'.id'
					   );
						
 		$this->db->join(
							$this->table['role'],
							$this->table['main'].'.id_role = '.$this->table['role'].'.id'
					   );
							
		$this->db->where($this->table['main'].'.username', $username); 
		
		$_query = $this->db->get($this->table['main']);
		
		return $_query->row_array();  
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Login page
 	 *
 	 * @access	public
 	 */
 	function validate($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		
		$_query = $this->db->get($this->table['main']);
		
		$_validation = (count($_query->row_array()) > 0) ? TRUE : FALSE;
		
		return $_validation;
	}
	
	// ------------------------------------------------------------------------
}


/* End of file user_model.php */
/* Location: ./application/modules/backoffice/model/user_model.php */