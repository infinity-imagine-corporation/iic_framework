<?php
class User extends MX_Controller 
{
	// ------------------------------------------------------------------------
	
	/**
	  * Login page
	  *
	  * @access	public
	  */
	  
	function index($error_msg = NULL)
	{	
		$this->load->model('theme_model');
		$data['theme'] = $this->theme_model->get_theme();
		$data['theme']['header_text1'] = 'Member Login';
		
		$data['title'] = 'Login';
		$data['error_msg'] = $error_msg;
		
		$this->load->view('login_dialog', $data);	
	}
	
	// ------------------------------------------------------------------------
	
	function user_group()
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
		array_push($data['th'], array('axis'=>'name',		'label'=>'Name'));
		
		// Set other content
		
		// Display
		$this->load->view('main', $data);
	}
	
	// ------------------------------------------------------------------------	
}


/* End of file user.php */
/* Location: ./application/modules/backoffice/controllers/user.php */