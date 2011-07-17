<?php
class User_model extends CI_Model 
{
	// ------------------------------------------------------------------------
	// Setup database
	// ------------------------------------------------------------------------
	
	var $fields = array();
	var $table;
	
	// ------------------------------------------------------------------------
	// Constructor
	// ------------------------------------------------------------------------
	
	function __construct()
	{
		parent::__construct();
		
		// Setting
		$this->fields['id'] = 'id_member';
		$this->fields['username'] = 'username';
		$this->fields['password'] = 'password';
		$this->table = 'backoffice_user';
	}
	
	// ------------------------------------------------------------------------
	// Function - User group
	// ------------------------------------------------------------------------
	
	
	
	
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
		$this->db->where($this->fields['username'], $this->input->post('username'));
		$this->db->where($this->fields['password'], $this->input->post('password'));
		$query = $this->db->get($this->table);
		$validation = ($query->num_rows == 1) ? TRUE : FALSE;
		
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
			$this->db->where($this->fields['id'], $id); 
			$query = $this->db->get($this->table);
			
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
		$this->db->where($this->fields['username'], $username); 
		$query = $this->db->get($this->table);
		
		return $query->row_array();  
	}
	
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
}


/* End of file user_model.php */
/* Location: ./application/modules/backoffice/model/user_model.php */