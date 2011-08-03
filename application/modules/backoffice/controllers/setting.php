<?php
class Setting extends MX_Controller 
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
		$this->load->model('module_model');
		$this->load->model('setting_model');
	}
	
	// ------------------------------------------------------------------------
	// Page
	// ------------------------------------------------------------------------
	
	/**
	  * System module management
	  *
	  * @access	public
	  */
	  
	function system_module()
	{	
		// Check permission
		Modules::run('backoffice/login/check_permission');	
		
		// Load theme
		$data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$data['module']		= 'Backoffice';
		$data['controller']	= 'Setting';
		$data['page']		= 'module_index';
		$data['title']		= 'Module';
		
		// Set table haed
		$data['th'] = array();
		array_push($data['th'], array('axis'=>'id',			'label'=>'ID'));
		array_push($data['th'], array('axis'=>'name',		'label'=>'Name'));
		array_push($data['th'], array('axis'=>'description','label'=>'Description'));
		array_push($data['th'], array('axis'=>'uri',		'label'=>'URI'));
		array_push($data['th'], array('axis'=>'is_enable',	'label'=>'Status'));
		
		// Display
		$this->load->view('main', $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Module permission
	  *
	  * @access	public
	  */
	  
	function permission()
	{	
		// Check permission
		Modules::run('backoffice/login/check_permission');	
		
		// Load theme
		$data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$data['module']		= 'Backoffice';
		$data['controller']	= 'Setting';
		$data['page']		= 'permission_index';
		$data['title']		= 'Permission';
		
		// Set table haed
		$data['th'] = array();
		array_push($data['th'], array('axis'=>'name',		'label'=>'Name'));
		array_push($data['th'], array('axis'=>'is_enable',	'label'=>'Full Control'));
		array_push($data['th'], array('axis'=>'description','label'=>'Read'));
		array_push($data['th'], array('axis'=>'uri',		'label'=>'Create'));
		array_push($data['th'], array('axis'=>'is_enable',	'label'=>'Update'));
		array_push($data['th'], array('axis'=>'is_enable',	'label'=>'Delete'));
		
		// Display
		$this->load->view('main', $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Upload
	  *
	  * @access	public
	  */
	  
	function upload()
	{	
		// Check permission
		Modules::run('backoffice/login/check_permission');	
		
		// Load theme
		$data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$data['module']		= 'Backoffice';
		$data['controller']	= 'Setting';
		$data['page']		= 'upload_index';
		$data['title']		= 'ประเภทและขนาดไฟล์ อัพโหลด';
		
		// Set table haed
		$data['th'] = array();
		array_push($data['th'], array('axis'=>'name',		'label'=>'Name'));
		array_push($data['th'], array('axis'=>'is_enable',	'label'=>'Full Control'));
		array_push($data['th'], array('axis'=>'description','label'=>'Read'));
		array_push($data['th'], array('axis'=>'uri',		'label'=>'Create'));
		array_push($data['th'], array('axis'=>'is_enable',	'label'=>'Update'));
		array_push($data['th'], array('axis'=>'is_enable',	'label'=>'Delete'));
		
		// Get data
		$data['upload'] = $this->setting_model->get_upload_setting();	
		
		// Display
		$this->load->view('main', $data);
	}
	
	// ------------------------------------------------------------------------
	// Function - Mudule
	// ------------------------------------------------------------------------
	
	/**
	 * Get module list
	 *
	 * @access	public
	 * @return	json
	 */
	  
	function get_module_list()
	{		
		echo json_encode($this->module_model->get_module_list());	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Search module list
	 *
	 * @access	public
	 * @return	json
	 */
	  
	function search_module()
	{		
		$data = $this->input->post();
		
		echo json_encode($this->module_model->search_module($data['keyword'], $data['criteria']));	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get module form
	 *
	 * @access	public
	 * @param 	integer	$id
	 * @return	json
	 */
	
	function get_module_form($id = NULL)
	{
		if($id != NULL)
		{
			$data = $this->module_model->get_module_detail($id);	
		} 
		else
		{
			$data = array(
							'id'			=> '',
							'name'			=> '',
							'description'	=> '',
							'uri'			=> '',
							'is_enable'		=> ''
					 	 );	
		}
		
		$this->load->view('module_form', $data);	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Create module 
	 *
	 * @access	public
	 */
	
	function create_module()
	{		
		$data = $this->input->post();
		
		unset($data['id']);
				 
		$this->module_model->create_module($data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update module 
	 *
	 * @access	public
	 */
	
	function update_module()
	{
		$data = $this->input->post();
		$id = $data['id'];
		
		unset($data['id']);
				 
		$this->module_model->update_module($id, $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Delete module 
	 *
	 * @access	public
	 */
	 
	function delete_module()
	{
		$this->module_model->delete_module($this->input->post('id'));
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get module selecbox option 
	 *
	 * @access	public
	 * @param 	string	$selected	
	 * @return	HTML
	 */
	
	function get_module_selectbox_option($selected = NULL)
	{
		$_option = '';
		$_module = $this->module_model->get_module_list();
		
		foreach($_module as $data)
		{
			$_selected = ($data->id == $selected) ? ' selected="selected"' : '';
			$_option .= '<option value="'. $data->id.'"'.$_selected.'>'.$data->name.'</option>';
		}
		
		return $_option;
	}
	
	// ------------------------------------------------------------------------
	// Function - Upload
	// ------------------------------------------------------------------------
	
	/**
	 * Update upload_setting
	 *
	 * @access	public
	 */
	
	function update_upload_setting()
	{
		$data = $this->input->post();
				 
		$this->setting_model->update_upload_setting($data);
	}
	
	// ------------------------------------------------------------------------
	
}


/* End of file permission.php */
/* Location: ./application/modules/backoffice/controllers/permission.php */