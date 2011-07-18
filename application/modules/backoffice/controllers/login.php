<?php
class Login extends MX_Controller 
{
	
	// ------------------------------------------------------------------------
	// Page
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
	
	/**
	  * Logout page
	  *
	  * @access	public
	  */
	  
	function logout()
	{
		$this->session->sess_destroy();
		
		// Set module
		$data['module']		= 'backoffice';
		$data['controller']	= 'login';
		$data['page']		= 'logout';
		
		$data['title'] = 'Security System';
		$data['message'] = '<li>Logout success</li>';
		$data['url_target'] = index_page().'/backoffice/login';
		$data['button_text'] = '';
		
		$this->load->view('report_dialog', $data);
	}
	
	// ------------------------------------------------------------------------
	// Function
	// ------------------------------------------------------------------------
	
	/**
	  * Validating login
	  *
	  * @access	public
	  */
	  
	function validate()
	{
		$this->load->model('user_model');
		$validation = $this->user_model->validate();
		
		if($validation)
		{
			$user = $this->user_model->get_detail_by_username($this->input->post('username'));			
			
			$data = array(
				'id'			=> $user['id'],
				'name'			=> $user['name'],
				'username'		=> $user['username'],
				'group'			=> $user['group'],
				'role'			=> $user['role'],
				'login_status'	=> TRUE
			);
			$this->session->set_userdata($data);
			
			redirect('backoffice');
		}
		else
		{
			$error_msg = 'Incorrect Username or Password';
			$this->index($error_msg);
		}
		
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Check access permission 
	  *
	  * @access	public
	  */
	  
	function check_permission()
	{
		$login_status = $this->session->userdata('login_status');
		if(!isset($login_status) || $login_status != TRUE)
		{
			$data['title'] = 'Security System';
			$data['message'] = '<li>You don\'t have permission to access this page.</li>
								<li>or your session has expire, please login again.</li>';
			$data['url_target'] = index_page().'/backoffice/login';
			$data['button_text'] = '';
			$this->load->view('report_dialog.php', $data);	
			exit();
		}
	}
	
	// ------------------------------------------------------------------------
}


/* End of file login.php */
/* Location: ./application/modules/backoffice/controllers/login.php */