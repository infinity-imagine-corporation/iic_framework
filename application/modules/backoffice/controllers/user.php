<?php
class User extends MX_Controller 
{
	// ------------------------------------------------------------------------
	// Constructor
	// ------------------------------------------------------------------------
	
	function __construct()
	{
		parent::__construct();
		
		// Check permission
		Modules::run('backoffice/login/check_permission');
		
		// Load model
		$this->load->model('user_model');
	}
	
	// ------------------------------------------------------------------------
	// Page
	// ------------------------------------------------------------------------
	
	/**
	  * User 
	  *
	  * @access	public
	  */
	
	function user()
	{		
		// Check permission
		Modules::run('backoffice/login/check_permission');	
		
		// Load theme
		$data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$data['module']		= 'backoffice';
		$data['controller']	= 'user';
		$data['page']		= 'user_index';
		$data['title']		= 'User';
		
		// Set table haed
		$data['th'] = array();
		array_push($data['th'], array('axis'=>'name',		'label'=>'Name'));
		array_push($data['th'], array('axis'=>'username',	'label'=>'User Name'));
		array_push($data['th'], array('axis'=>'id_group',	'label'=>'Group'));
		array_push($data['th'], array('axis'=>'id_role',	'label'=>'Role'));
		
		// Set other content
		
		// Display
		$this->load->view('main', $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * User group
	  *
	  * @access	public
	  */
	
	function group()
	{		
		// Check permission
		Modules::run('backoffice/login/check_permission');	
		
		// Load theme
		$data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$data['module']		= 'backoffice';
		$data['controller']	= 'user';
		$data['page']		= 'user_group_index';
		$data['title']		= 'User Group';
		
		// Set table haed
		$data['th'] = array();
		array_push($data['th'], array('axis'=>'name', 'label'=>'Name'));
		
		// Set other content
		
		// Display
		$this->load->view('main', $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * User role
	  *
	  * @access	public
	  */
	
	function role()
	{		
		// Check permission
		Modules::run('backoffice/login/check_permission');	
		
		// Load theme
		$data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$data['module']		= 'backoffice';
		$data['controller']	= 'user';
		$data['page']		= 'user_role_index';
		$data['title']		= 'User Role';
		
		// Set table haed
		$data['th'] = array();
		array_push($data['th'], array('axis'=>'name', 'label'=>'Name'));
		
		// Set other content
		
		// Display
		$this->load->view('main', $data);
	}
	
	// ------------------------------------------------------------------------
	// Function - User
	// ------------------------------------------------------------------------
	
	/**
	 * Get user list
	 *
	 * @access	public
	 * @return	json
	 */
	  
	function get_user_list()
	{		
		echo json_encode($this->user_model->get_user_list());	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Search user list
	 *
	 * @access	public
	 * @return	json
	 */
	  
	function search_user()
	{		
		$data = $this->input->post();
		
		echo json_encode($this->user_model->search_user($data['keyword'], $data['criteria']));	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user form
	 *
	 * @access	public
	 * @param 	integer	$id
	 * @return	json
	 */
	
	function get_user_form($id = NULL)
	{
		if($id != NULL)
		{
			$data = $this->user_model->get_user_detail($id);	
		} 
		else
		{
			$data = array(
							'id'		=> '',
							'name'		=> '',
							'username'	=> '',
							'password'	=> '',
							'id_group'		=> NULL,
							'id_role'		=> NULL,
					 	 );	
		}
		
		$this->load->view('user_form', $data);	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Create user 
	 *
	 * @access	public
	 */
	
	function create_user()
	{		
		$data = $this->input->post();
		
		unset($data['id']);
				 
		$this->user_model->create_user($data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update user 
	 *
	 * @access	public
	 */
	
	function update_user()
	{
		$data = $this->input->post();
		$id = $data['id'];
		
		unset($data['id']);
				 
		$this->user_model->update_user($id, $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Delete user 
	 *
	 * @access	public
	 */
	 
	function delete_user()
	{
		$this->user_model->delete_user($this->input->post('id'));
	}
	
	// ------------------------------------------------------------------------
	// Function - User group
	// ------------------------------------------------------------------------
	
	/**
	 * Get user group list
	 *
	 * @access	public
	 * @return	json
	 */
	  
	function get_group_list()
	{		
		echo json_encode($this->user_model->get_group_list());	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Search user group list
	 *
	 * @access	public
	 * @return	json
	 */
	  
	function search_group()
	{		
		$data = $this->input->post();
		
		echo json_encode($this->user_model->search_group($data['keyword'], $data['criteria']));	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user group form
	 *
	 * @access	public
	 * @param 	integer	$id
	 * @return	json
	 */
	
	function get_group_form($id = NULL)
	{
		if($id != NULL)
		{
			$data = $this->user_model->get_group_detail($id);	
		} 
		else
		{
			$data = array(
							'id'	=> '',
							'name'	=> ''
					 	 );	
		}
		
		$this->load->view('user_group_form', $data);	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Create user group 
	 *
	 * @access	public
	 */
	
	function create_group()
	{		
		$data = $this->input->post();
		
		unset($data['id']);
				 
		$this->user_model->create_group($data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update user group 
	 *
	 * @access	public
	 */
	
	function update_group()
	{
		$data = $this->input->post();
		$id = $data['id'];
		
		unset($data['id']);
				 
		$this->user_model->update_group($id, $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Delete user group 
	 *
	 * @access	public
	 */
	 
	function delete_group()
	{
		$this->user_model->delete_group($this->input->post('id'));
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user group selecbox option 
	 *
	 * @access	public
	 * @param 	string	$selected	
	 * @return	mixed
	 */
	
	function get_group_selectbox_option($selected = NULL)
	{
		$_option = '';
		$_group = $this->user_model->get_group_list();
		
		foreach($_group as $data)
		{
			$_selected = ($data->id == $selected) ? ' selected="selected"' : '';
			$_option .= '<option value="'. $data->id.'"'.$_selected.'>'.$data->name.'</option>';
		}
		
		return $_option;
	}
	
	// ------------------------------------------------------------------------
	// Function - User role
	// ------------------------------------------------------------------------
	
	/**
	 * Get user role list
	 *
	 * @access	public
	 * @return	json
	 */
	  
	function get_role_list()
	{		
		echo json_encode($this->user_model->get_role_list());	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Search user role list
	 *
	 * @access	public
	 * @return	json
	 */
	  
	function search_role()
	{		
		$data = $this->input->post();
		
		echo json_encode($this->user_model->search_role($data['keyword'], $data['criteria']));	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user role form
	 *
	 * @access	public
	 * @param 	integer	$id
	 * @return	json
	 */
	
	function get_role_form($id = NULL)
	{
		if($id != NULL)
		{
			$data = $this->user_model->get_role_detail($id);	
		} 
		else
		{
			$data = array(
							'id'	=> '',
							'name'	=> ''
					 	 );	
		}
		
		$this->load->view('user_role_form', $data);	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Create user role 
	 *
	 * @access	public
	 */
	
	function create_role()
	{		
		$data = $this->input->post();
		
		unset($data['id']);
				 
		$this->user_model->create_role($data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update user role 
	 *
	 * @access	public
	 */
	
	function update_role()
	{
		$data = $this->input->post();
		$id = $data['id'];
		
		unset($data['id']);
				 
		$this->user_model->update_role($id, $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Delete user role 
	 *
	 * @access	public
	 */
	 
	function delete_role()
	{
		$this->user_model->delete_role($this->input->post('id'));
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user role selecbox option 
	 *
	 * @access	public
	 * @param 	string	$selected	
	 * @return	mixed
	 */
	
	function get_role_selectbox_option($selected = NULL)
	{
		$_option = '';
		$_group = $this->user_model->get_role_list();
		
		foreach($_group as $data)
		{
			$_selected = ($data->id == $selected) ? ' selected="selected"' : '';
			$_option .= '<option value="'. $data->id.'"'.$_selected.'>'.$data->name.'</option>';
		}
		
		return $_option;
	}
	
	// ------------------------------------------------------------------------
}


/* End of file user.php */
/* Location: ./application/modules/backoffice/controllers/user.php */