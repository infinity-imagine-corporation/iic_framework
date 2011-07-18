<?php
class User extends MX_Controller 
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
		$this->load->model('user_model');
	}
	
	// ------------------------------------------------------------------------
	// Page
	// ------------------------------------------------------------------------
	
	/**
	  * User group index page
	  *
	  * @access	public
	  */
	
	function user_group()
	{		
		// Check permission
		Modules::run('backoffice/login/check_permission');	
		
		// Load theme
		$data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$data['module']		= 'backoffice';
		$data['controller']	= 'user';
		$data['page']		= 'user_group_index';
		$data['title']		= 'User Group';
		
		// Set table haed
		$data['th'] = array();
		array_push($data['th'], array('axis'=>'name', 'label'=>'Name'));
		
		// Set other content
		
		// Display
		$this->load->view('main', $data);
	}
	
	// ------------------------------------------------------------------------
	// Function - User group
	// ------------------------------------------------------------------------
	
	/**
	 * Get user group list
	 *
	 * @access	public
	 * @return	json
	 */
	  
	function get_group_list()
	{		
		echo json_encode($this->user_model->get_group_list());	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Search user group list
	 *
	 * @access	public
	 * @return	json
	 */
	  
	function search_group()
	{		
		$data = $this->input->post();
		
		echo json_encode($this->user_model->search_group($data['keyword'], $data['criteria']));	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user group form
	 *
	 * @access	public
	 * @param 	integer	$id
	 * @return	json
	 */
	
	function get_group_form($id = NULL)
	{
		if($id != NULL)
		{
			$data = $this->user_model->get_group_detail($id);	
		} 
		else
		{
			$data = array(
							'id'	=> '',
							'name'	=> ''
					 	 );	
		}
		
		$this->load->view('user_group_form', $data);	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Create user group 
	 *
	 * @access	public
	 */
	
	function create_group()
	{		
		$data = $this->input->post();
		
		unset($data['id']);
				 
		$this->user_model->create_group($data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update user group 
	 *
	 * @access	public
	 */
	
	function update_group()
	{
		$data = $this->input->post();
		$id = $data['id'];
		
		unset($data['id']);
				 
		$this->user_model->update_group($id, $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Delete user group 
	 *
	 * @access	public
	 */
	 
	function delete_group()
	{
		$this->user_model->delete_group($this->input->post('id'));
	}
	
	// ------------------------------------------------------------------------
}


/* End of file user.php */
/* Location: ./application/modules/backoffice/controllers/user.php */