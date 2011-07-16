<?php
class Backoffice extends MX_Controller 
{	
	// ------------------------------------------------------------------------
	
	function __construct()
	{
		parent::__construct();
		
		// Load model
		$this->load->model('theme_model');
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Mian page
	 *
	 * @access	public
	 */
	
	function index()
	{	
		// Check permission
		Modules::run('backoffice/login/check_permission');
		
		// Load theme
		$data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$data['module']		= 'backoffice';
		$data['controller']	= 'backoffice';
		$data['page']		= 'dashboard';
		$data['title']		= 'Home';
		
		// Display
		$this->load->view('main', $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Module page for display backoffice module
	 *
	 * @access	public
	 */
	
	function module($module, $controller, $page = '')
	{
		// Display
		echo Modules::run($module.'/'.$controller.'/'.$page);
	}
	
	// ------------------------------------------------------------------------
	
	function dashboard()
	{
		$this->load->view('dashboard');
	}
	
	// ------------------------------------------------------------------------
}


/* End of file backoffice.php */
/* Location: application/modules/backoffice/controllers/backoffice.php */