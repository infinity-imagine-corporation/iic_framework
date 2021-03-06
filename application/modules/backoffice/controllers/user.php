<?php
class User extends IIC_Controller 
{
	// ------------------------------------------------------------------------
	// Constructor
	// ------------------------------------------------------------------------
	
	function __construct()
	{
		parent::__construct();
		
		// Load model
		$this->load->model('user_model');
		
		// Set variable
		$this->content_form = 'user_form';
		$this->content_model = $this->user_model;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * User 
	 *
	 * @access	public
	 */
	
	function index()
	{		
		// Check permission
		Modules::run('backoffice/auth/check_permission');	
		
		// Set module
		$_data['module']		= 'backoffice';
		$_data['controller']	= 'user';
		$_data['ajax_uri']		= 'content';
		$_data['page']			= 'user';
		$_data['template']		= 'backoffice/tpl_module_index';
		$_data['title']			= $this->lang->line('page_user');
		
		// Set navigator
		$_data['navigator'] = array();
		array_push($_data['navigator'], array('label' => $this->lang->line('home'),			'link' => 'backoffice'));
		array_push($_data['navigator'], array('label' => $this->lang->line('page_user'),	'link' => 'backoffice/user'));
		
		// Set table haed
		$_data['th'] = array();
		array_push($_data['th'], array('axis'=>'name',		'label' => $this->lang->line('name'),		'is_criteria' => TRUE));
		array_push($_data['th'], array('axis'=>'username',	'label' => $this->lang->line('username'),	'is_criteria' => TRUE));
		array_push($_data['th'], array('axis'=>'id_group',	'label' => $this->lang->line('page_group'),	'is_criteria' => TRUE));
		array_push($_data['th'], array('axis'=>'id_role',	'label' => $this->lang->line('page_role'),	'is_criteria' => TRUE));
		
		// Display
		$this->load->view('main', $_data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * User group
	 *
	 * @access	public
	 */
	
	function group()
	{		
		echo Modules::run('backoffice/user_group/index');	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * User role
	 *
	 * @access	public
	 */
	
	function role()
	{		
		echo Modules::run('backoffice/user_role/index');	
	}
	
	// ------------------------------------------------------------------------
}


/* End of file user.php */
/* Location: ./application/modules/backoffice/controllers/user.php */