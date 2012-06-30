<?php
class Log extends IIC_Controller 
{
	// ------------------------------------------------------------------------
	// Constructor
	// ------------------------------------------------------------------------
	
	function __construct()
	{
		parent::__construct();
		
		// Check permission
		Modules::run('backoffice/login/check_permission');
		
		// Load model
		$this->load->model('backoffice/theme_model');
		$this->load->model('log_model');
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * User log
	  *
	  * @access	public
	  */
	
	function log()
	{		
		// Check permission
		Modules::run('backoffice/login/check_permission');	
		
		// Load theme
		$_data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$_data['module']		= 'backoffice';
		$_data['controller']	= 'User';
		$_data['page']			= 'user_log_index';
		$_data['title']			= 'บันทึกการใช้งานระบบ (Site log)';
		
		// Set table haed
		$_data['th'] = array();
		array_push($_data['th'], array('axis'=>'name', 'label'=>'Date'));
		array_push($_data['th'], array('axis'=>'name', 'label'=>'User'));
		array_push($_data['th'], array('axis'=>'name', 'label'=>'Action'));
		array_push($_data['th'], array('axis'=>'name', 'label'=>'Module'));
		array_push($_data['th'], array('axis'=>'name', 'label'=>'Note'));
		
		// Display
		$this->load->view('main', $_data);
	}
	
	// ------------------------------------------------------------------------
}


/* End of file user.php */
/* Location: ./application/modules/backoffice/controllers/user.php */