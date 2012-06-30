<?php
class User_group extends IIC_Controller 
{
	// ------------------------------------------------------------------------
	// Constructor
	// ------------------------------------------------------------------------
	
	function __construct()
	{
		parent::__construct();
		
		// Load model
		$this->load->model('user_group_model');
		
		// Set variable
		$this->content_form = 'user_group_form';
		$this->content_model = $this->user_group_model;
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
		Modules::run('backoffice/login/check_permission');	
		
		// Set module
		$_data['module']		= 'backoffice';
		$_data['controller']	= 'user_group';
		$_data['ajax_uri']		= 'content';
		$_data['page']			= 'user_group';
		$_data['template']		= 'backoffice/tpl_module_index';
		$_data['title']			= $this->lang->line('page_group');
		
		// Set navigator
		$_data['navigator'] = array();
		array_push($_data['navigator'], array('label' => $this->lang->line('home'),			'link' => 'backoffice'));
		array_push($_data['navigator'], array('label' => $this->lang->line('page_user'),	'link' => 'backoffice/user'));
		array_push($_data['navigator'], array('label' => $this->lang->line('page_group'),	'link' => 'backoffice/user/group'));
		
		// Set table haed
		$_data['th'] = array();
		array_push($_data['th'], array('axis'=>'name',	'label' => $this->lang->line('page_group'),	'is_criteria' => TRUE));
		
		// Display
		$this->load->view('main', $_data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user group selecbox option 
	 *
	 * @access	public
	 * @param 	string	$selected	
	 * @return	mixed
	 */
	
	function get_group_selectbox_option($selected = NULL)
	{
		$_option = '';
		$_group = $this->content_model->list_content();
		
		foreach($_group as $_data)
		{
			$_selected = ($_data['id'] == $selected) ? ' selected="selected"' : '';
			$_option .= '<option value="'. $_data['id'].'"'.$_selected.'>'.$_data['name'].'</option>';
		}
		
		return $_option;
	}
	
	// ------------------------------------------------------------------------
}


/* End of file user_grop.php */
/* Location: ./application/modules/backoffice/controllers/user_group.php */