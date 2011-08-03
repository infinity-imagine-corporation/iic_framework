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
		$data['module']		= 'Backoffice';
		$data['controller']	= 'Backoffice';
		$data['page']		= 'dashboard';
		$data['title']		= 'หน้าหลัก';
		
		// Display
		$this->load->view('main', $data);
	}
	
	/**
	  * Login page
	  *
	  * @access	public
	  */
	  
	function modules()
	{	
		// Check permission
		Modules::run('backoffice/login/check_permission');	
		
		// Load theme
		$data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$data['module']		= 'backoffice';
		$data['controller']	= 'Backoffice';
		$data['page']		= 'modules_index';
		$data['title']		= 'Modules';
		
		// Set table haed
		$data['th'] = array();
		array_push($data['th'], array('axis'=>'name',		'label'=>'Name'));
		array_push($data['th'], array('axis'=>'description','label'=>'Description'));
		array_push($data['th'], array('axis'=>'uri',		'label'=>'URI'));
		array_push($data['th'], array('axis'=>'is_enable',	'label'=>'Status'));
		
		// Set other content
		
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