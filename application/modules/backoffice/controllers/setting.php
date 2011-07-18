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
		$data['module']		= 'backoffice';
		$data['controller']	= 'setting';
		$data['page']		= 'module_index';
		$data['title']		= 'Module';
		
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
	
}


/* End of file permission.php */
/* Location: ./application/modules/backoffice/controllers/permission.php */