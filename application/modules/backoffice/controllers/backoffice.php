<?php
class Backoffice extends MX_Controller 
{	
	// ------------------------------------------------------------------------
	// Constructor
	// ------------------------------------------------------------------------
	
	function __construct()
	{
		parent::__construct();
		
		// Load model
		$this->load->model('theme_model');
	}
	
	// ------------------------------------------------------------------------
	// Page
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
		
		// Set content
		$data['title']		= 'Home';
		
		// Display
		$this->load->view('main', $data);
	}
	
	// ------------------------------------------------------------------------
	// Function
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
}


/* End of file backoffice.php */
/* Location: application/modules/backoffice/controllers/backoffice.php */