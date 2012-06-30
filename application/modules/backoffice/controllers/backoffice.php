<?php
class Backoffice extends MX_Controller 
{	
	// ------------------------------------------------------------------------
	// Constructor
	// ------------------------------------------------------------------------
	
	function __construct()
	{
		parent::__construct();
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
		Modules::run('backoffice/auth/check_permission');
		
		// Set module
		$_data['module'] = 'backoffice';
		$_data['controller'] = 'bckoffice';
		$_data['page'] = 'dashboard';
		$_data['template'] = '';
		$_data['title']	= $this->lang->line('home');
		
		// Set navigator
		$_data['navigator'] = array();
		array_push($_data['navigator'], array('label' => $this->lang->line('home'),	'link' => 'backoffice'));
		
		
		// Display
		$this->load->view('main', $_data);
	}
	
	// ------------------------------------------------------------------------
}


/* End of file backoffice.php */
/* Location: application/modules/backoffice/controllers/backoffice.php */