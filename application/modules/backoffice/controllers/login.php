<?php
class Login extends MX_Controller 
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
		
		$data['title'] = 'Login';
		$data['error_msg'] = $error_msg;
		
		$this->load->view('login', $data);	
	}
	
	// ------------------------------------------------------------------------
	
	function validate()
	{
		$this->load->model('user_model');
		$validation = $this->user_model->validate();
		
		if($validation)
		{
			$user = $this->user_model->get_detail_by_username($this->input->post('username'));			
			
			$data = array(
				'name' => $user['name'],
				'id' => $user['id_user'],
				'login_status' => TRUE
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
	
	function check_permission()
	{
		$login_status = $this->session->userdata('login_status');
		if(!isset($login_status) || $login_status != TRUE)
		{
			echo 'You don\'t have permission to access this page.';
			echo anchor('backoffice/login', 'Login');
			die();		
		}
	}
	
	// ------------------------------------------------------------------------
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('backoffice/login');
	}
	
	// ------------------------------------------------------------------------
}

/* End of file login.php */
/* Location: ./application/modules/backoffice/controllers/login.php */