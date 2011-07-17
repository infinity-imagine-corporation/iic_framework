<?php
class User extends MX_Controller 
{
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
	 * Get group list
	 *
	 * @access	public
	 * @return	json
	 */
	  
	function get_group_list()
	{		
		echo json_encode($this->category_model->get_group());	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get content form
	 *
	 * @access	public
	 * @param 	integer	$id_group
	 * @return	json
	 */
	
	function get_form($id_group = NULL)
	{
		if($id_content != NULL)
		{
			$data = $this->user_model->get_group_detail($id_group);	
		} 
		else
		{
			$data = array(
							'id_category'	=> 0,
							'id_parent'		=> 0,
							'name'			=> '',
							'description'	=> '',
							'is_enable'		=> 1
					 	 );	
		}
		
		$this->load->view('user_group_form', $data);	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Create category 
	 *
	 * @access	public
	 */
	
	function create_category()
	{		
		$data = $this->input->post();
		
		// Get lastet ordering
		$data['ordering'] = $this->category_model->get_new_ordering($data['id_parent']);
				 
		$this->category_model->create_category($data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update category 
	 *
	 * @access	public
	 */
	
	function update_category()
	{
		$data = $this->input->post();
		
		if($data['id_parent_old'] != $data['id_parent'])
		{
			// Get lastet ordering
			$data['ordering'] = $this->category_model->get_new_ordering($data['id_parent']);
		}
		
		unset($data['id_parent_old']);
				 
		$this->category_model->update_category($data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Delete category 
	 *
	 * @access	public
	 */
	 
	function delete_content()
	{
		$this->category_model->delete_category($this->input->post('id'));
	}
	
	// ------------------------------------------------------------------------
}


/* End of file user.php */
/* Location: ./application/modules/backoffice/controllers/user.php */