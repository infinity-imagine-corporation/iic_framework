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
		$_data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$_data['module']		= 'backoffice';
		$_data['controller']	= 'bckoffice';
		$_data['page']			= 'dashboard';
		$_data['template']		= '';
		$_data['title']			= 'Home';
		
		// Display
		$this->load->view('main', $_data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Modules index page
	  *
	  * @access	public
	  */
	  
	function modules()
	{	
		// Check permission
		Modules::run('backoffice/login/check_permission');	
		
		// Load theme
		$_data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$_data['module']		= 'backoffice';
		$_data['controller']	= 'Backoffice';
		$_data['page']			= 'modules_index';
		$_data['title']			= 'Modules';
		
		// Set table haed
		$_data['th'] = array();
		array_push($_data['th'], array('axis' => 'name',		'label' => 'Name'));
		array_push($_data['th'], array('axis' => 'description',	'label' => 'Description'));
		array_push($_data['th'], array('axis' => 'uri',			'label' => 'URI'));
		array_push($_data['th'], array('axis' => 'is_enable',	'label' => 'Status'));
		
		// Display
		$this->load->view('main', $_data);
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