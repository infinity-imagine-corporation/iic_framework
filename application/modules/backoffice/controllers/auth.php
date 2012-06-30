<?php
class Auth extends IIC_Controller 
{
	// ------------------------------------------------------------------------
	// PAGE
	// ------------------------------------------------------------------------
	
	/**
	 * Main page
	 *
	 * @access	public
	 */
	  
	function index($error_msg = NULL)
	{	
		$this->login($error_msg);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Login page
	 *
	 * @access	public
	 */
	  
	function login($error_msg = NULL)
	{	
		$this->load->model('theme_model');
		
		$_data['theme'] = $this->theme_model->get_theme();
		$_data['theme']['header_text1'] = 'Member Login';
		
		$_data['module'] = 'backoffice';
		$_data['controller'] = 'login';
		$_data['page'] = 'login';
		
		$_data['title'] = 'Login';
		$_data['error_msg'] = $error_msg;
		$_data['form_target'] = 'backoffice/auth/validate';
		
		$this->load->view('login', $_data);	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Logout page
	 *
	 * @access	public
	 */
	  
	function logout()
	{
		$this->session->sess_destroy();
		
		// Set module
		$_data['module'] = 'backoffice';
		$_data['controller'] = 'login';
		$_data['page'] = 'logout';
		
		// Set content
		$_data['title']	= $this->lang->line('dialog_security_system');
		$_data['message'] = '<li>'.$this->lang->line('dialog_logout_success').'</li>';
		$_data['url_target'] = index_page().'/backoffice/auth/login';
		$_data['button_text'] = $this->lang->line('ok');
		
		$this->load->view('report_dialog', $_data);
	}
	
	// ------------------------------------------------------------------------
	// FUNCTION
	// ------------------------------------------------------------------------
	
	/**
	 * Validating login
	 *
	 * @access	public
	 */
  
	function validate()
	{
		$this->load->model('user_model');
		$_validation = $this->user_model->validate($this->input->post('username'), $this->input->post('password'));
		
		if($_validation)
		{
			// Get user data
			$_user = $this->user_model->get_detail_by_username($this->input->post('username'));		
			
			//print_array($_user);
			//exit();
			
			// Set user session
			$this->set_session($_user);		
			
			redirect('backoffice');
		}
		else
		{
			$_error_msg = $this->lang->line('dialog_login_error');
			$this->index($_error_msg);
		}
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
		$_session = array(
							'id'			=> $data['id'],
							'name'			=> $data['name'],
							'username'		=> $data['username'],
							'id_group'		=> $data['id_group'],
							'group'			=> $data['group'],
							'id_role'		=> $data['id_role'],
							'role'			=> $data['role'],
							'login_status'	=> TRUE
						 );
					 
		$this->session->set_userdata($_session);
	}

	// ------------------------------------------------------------------------
	
	/**
	 * Check page access permission
	 *
	 * @access	public
	 */
	 
	function check_permission()
	{
		$this->check_session();
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Check login session
	 *
	 * @access	public
	 */
	  
	function check_session()
	{
		$_login_status = $this->session->userdata('login_status');
		
		if((!isset($_login_status)) || $_login_status != TRUE)
		{
			// Set module
			$_data['module'] = 'backoffice';
			$_data['controller'] = 'login';
			$_data['page'] = 'report_dialog';
		
			$_data['title'] = $this->lang->line('dialog_security_system');
			$_data['message'] = '<li>'.$this->lang->line('dialog_session_expire').'</li>'.
								'<li>'.$this->lang->line('dialog_please_login_again').'</li>';
			$_data['url_target'] = index_page().'/backoffice/auth/login';
			$_data['button_text'] = $this->lang->line('button_ok');
			
			$this->load->view('report_dialog.php', $_data);	
			
			exit();
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Show user session 
	 *
	 * @access	public
	 */
	
	function show_session()
	{
		print_array($this->session->userdata);
	}
	
	// ------------------------------------------------------------------------
}


/* End of file auth.php */
/* Location: ./application/modules/backoffice/controllers/auth.php */