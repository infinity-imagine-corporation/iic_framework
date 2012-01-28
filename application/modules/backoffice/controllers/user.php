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
		$this->load->model('backoffice/theme_model');
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
	
	function index()
	{		
		// Check permission
		Modules::run('backoffice/login/check_permission');	
		
		// Load theme
		$_data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$_data['module']		= 'backoffice';
		$_data['controller']	= 'user';
		$_data['ajax_uri']		= 'user';
		$_data['page']			= 'user_index';
		$_data['template']		= 'backoffice/tpl_module_index';
		$_data['title']			= 'Backoffice User';
		
		// Set table haed
		$_data['th'] = array();
		array_push($_data['th'], array('axis'=>'name',		'label'=>'Name'));
		array_push($_data['th'], array('axis'=>'username',	'label'=>'User Name'));
		array_push($_data['th'], array('axis'=>'id_group',	'label'=>'Group'));
		array_push($_data['th'], array('axis'=>'id_role',	'label'=>'Role'));
		
		// Set other content
		
		// Display
		$this->load->view('main', $_data);
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
		$_data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$_data['module']		= 'backoffice';
		$_data['controller']	= 'user';
		$_data['ajax_uri']		= 'group';
		$_data['page']			= 'user_group_index';
		$_data['template']		= 'tpl_module_index';
		$_data['title']			= 'User Group';
		
		// Set table haed
		$_data['th'] = array();
		array_push($_data['th'], array('axis'=>'name', 'label'=>'Name'));
		
		// Display
		$this->load->view('main', $_data);
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
		$_data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$_data['module']		= 'backoffice';
		$_data['controller']	= 'user';
		$_data['ajax_uri']		= 'role';
		$_data['page']			= 'user_role_index';
		$_data['template']		= 'backoffice/tpl_module_index';
		$_data['title']			= 'ตำแหน่ง / หน้าที่ ผู้ใช้ระบบ';
		
		// Set table haed
		$_data['th'] = array();
		array_push($_data['th'], array('axis'=>'name', 'label'=>'ตำแหน่ง / หน้าที่'));
		
		// Set other content
		
		// Display
		$this->load->view('main', $_data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * User log
	  *
	  * @access	public
	  */
	
	function log()
	{		
		// Check permission
		Modules::run('backoffice/login/check_permission');	
		
		// Load theme
		$_data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$_data['module']		= 'backoffice';
		$_data['controller']	= 'User';
		$_data['page']		= 'user_log_index';
		$_data['title']		= 'บันทึกการใช้งานระบบ (Site log)';
		
		// Set table haed
		$_data['th'] = array();
		array_push($_data['th'], array('axis'=>'name', 'label'=>'Date'));
		array_push($_data['th'], array('axis'=>'name', 'label'=>'User'));
		array_push($_data['th'], array('axis'=>'name', 'label'=>'Action'));
		array_push($_data['th'], array('axis'=>'name', 'label'=>'Module'));
		array_push($_data['th'], array('axis'=>'name', 'label'=>'Note'));
		
		// Set other content
		
		// Display
		$this->load->view('main', $_data);
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
		$_data = $this->input->post();
		
		echo json_encode($this->user_model->search_user($_data['keyword'], $_data['criteria']));	
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
			$_data = $this->user_model->get_user_detail($id);	
		} 
		else
		{
			$_data = array(
							'id'		=> '',
							'name'		=> '',
							'username'	=> '',
							'password'	=> '',
							'id_group'		=> NULL,
							'id_role'		=> NULL,
					 	 );	
		}
		
		$this->load->view('user_form', $_data);	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Create user 
	 *
	 * @access	public
	 */
	
	function create_user()
	{		
		$_data = $this->input->post();
		
		unset($_data['id']);
				 
		$this->user_model->create_user($_data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update user 
	 *
	 * @access	public
	 */
	
	function update_user()
	{
		$_data = $this->input->post();
		$_id = $_data['id'];
		
		unset($_data['id']);
				 
		$this->user_model->update_user($_id, $_data);
		
		// Get user data for update session
		$_user = $this->user_model->get_detail_by_username($this->input->post('username'));		
		
		// Update user session
		$this->user_model->set_session($_user);	
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
		$_data = $this->input->post();
		
		echo json_encode($this->user_model->search_group($_data['keyword'], $_data['criteria']));	
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
			$_data = $this->user_model->get_group_detail($id);	
		} 
		else
		{
			$_data = array(
							'id'	=> '',
							'name'	=> '',
							'code'	=> ''
					 	 );	
		}
		
		$this->load->view('user_group_form', $_data);	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Create user group 
	 *
	 * @access	public
	 */
	
	function create_group()
	{		
		$_data = $this->input->post();
		
		unset($_data['id']);
				 
		$this->user_model->create_group($_data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update user group 
	 *
	 * @access	public
	 */
	
	function update_group()
	{
		$_data = $this->input->post();
		$id = $_data['id'];
		
		unset($_data['id']);
				 
		$this->user_model->update_group($id, $_data);
		
		// Get user data for update session
		$_user = $this->user_model->get_detail_by_username($this->session->userdata('username'));		
		
		// Update user session
		$this->user_model->set_session($_user);	
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
		
		foreach($_group as $_data)
		{
			$_selected = ($_data->id == $selected) ? ' selected="selected"' : '';
			$_option .= '<option value="'. $_data->id.'"'.$_selected.'>'.$_data->name.'</option>';
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
		$_data = $this->input->post();
		
		echo json_encode($this->user_model->search_role($_data['keyword'], $_data['criteria']));	
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
			$_data = $this->user_model->get_role_detail($id);	
		} 
		else
		{
			$_data = array(
							'id'	=> '',
							'name'	=> ''
					 	 );	
		}
		
		$this->load->view('user_role_form', $_data);	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Create user role 
	 *
	 * @access	public
	 */
	
	function create_role()
	{		
		$_data = $this->input->post();
		
		unset($_data['id']);
				 
		$this->user_model->create_role($_data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update user role 
	 *
	 * @access	public
	 */
	
	function update_role()
	{
		$_data = $this->input->post();
		$id = $_data['id'];
		
		unset($_data['id']);
				 
		$this->user_model->update_role($id, $_data);
		
		// Get user data for update session
		$_user = $this->user_model->get_detail_by_username($this->session->userdata('username'));		
		
		// Update user session
		$this->user_model->set_session($_user);	
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
		
		foreach($_group as $_data)
		{
			$_selected = ($_data->id == $selected) ? ' selected="selected"' : '';
			$_option .= '<option value="'. $_data->id.'"'.$_selected.'>'.$_data->name.'</option>';
		}
		
		return $_option;
	}
	
	// ------------------------------------------------------------------------
	// Function - User log
	// ------------------------------------------------------------------------
	
	/**
	 * Get user log list
	 *
	 * @access	public
	 * @return	json
	 */
	  
	function get_log_list()
	{		
		echo json_encode($this->user_model->get_log_list());	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Search user log list
	 *
	 * @access	public
	 * @return	json
	 */
	  
	function search_log()
	{		
		$_data = $this->input->post();
		
		echo json_encode($this->user_model->search_log($_data['keyword'], $_data['criteria']));	
	}
	
	// ------------------------------------------------------------------------
}


/* End of file user.php */
/* Location: ./application/modules/backoffice/controllers/user.php */