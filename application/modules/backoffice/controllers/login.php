<?php
class Login extends MX_Controller 
{
	// ------------------------------------------------------------------------
	// Constructor
	// ------------------------------------------------------------------------
	
	function __construct()
	{
		parent::__construct();
		
		// Load language
		$this->config->load('../../modules/backoffice/config/config');
		$this->lang->load(
							'../../../modules/backoffice/language/'.
							$this->config->item('backoffice_language').'/backoffice', 
							$this->config->item('backoffice_language')
						  );
		
		// Load model
		$this->load->model('theme_model');
	}
	
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
		
		$_data['theme'] = $this->theme_model->get_theme();
		$_data['theme']['header_text1'] = 'Member Login';
		
		$_data['module'] = 'backoffice';
		$_data['controller'] = 'login';
		$_data['page'] = 'login';
		
		$_data['title'] = 'Login';
		$_data['error_msg'] = $error_msg;
		
		$this->load->view('login_dialog', $_data);	
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
		$_data['url_target'] = index_page().'/backoffice/login';
		$_data['button_text'] = '';
		
		$this->load->view('report_dialog', $_data);
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
		$_validation = $this->user_model->validate();
		
		if($_validation)
		{
			// Get user data
			$_user = $this->user_model->get_detail_by_username($this->input->post('username'));		
			
			// Set user session
			$this->user_model->set_session($_user);		
			
			redirect('backoffice');
		}
		else
		{
			$_error_msg = 'Incorrect Username or Password';
			$this->index($_error_msg);
		}
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
		
			$_data['title'] = 'Access denide';
			$_data['message'] = '<li>'.$this->lang->line('dialog_permission_denied').'</li>'.
								'<li>'.$this->lang->line('dialog_please_login').'</li>';
			$_data['url_target'] = index_page().'/backoffice/login';
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


/* End of file login.php */
/* Location: ./application/modules/backoffice/controllers/login.php */