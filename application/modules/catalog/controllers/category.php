<?php

class Category extends MX_Controller 
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
		$this->load->model('category_model');
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
		// Load theme
		$this->load->model('backoffice/theme_model');
		$data['theme'] = $this->theme_model->get_theme();
		
		// Set module
		$data['module']		= 'catalog';
		$data['controller']	= 'category';
		$data['page']		= 'category_index';
		$data['title']		= 'Category';
		
		// Set table haed
		$data['th'] = array();
		array_push($data['th'], array('axis'=>'name',		'label'=>'Name'));
		array_push($data['th'], array('axis'=>'description','label'=>'Description'));
		array_push($data['th'], array('axis'=>'is_enable',	'label'=>'Status'));
		array_push($data['th'], array('axis'=>'',			'label'=>'Action'));
		
		// Set other content
		$data['category'] = $this->category_model->get_category();
		
		// Display
		$this->load->view('backoffice/main', $data);
	}
	
	// ------------------------------------------------------------------------
	// function - content
	// ------------------------------------------------------------------------
	
	/**
	 * Get category list
	 *
	 * @access	public
	 * @param 	integer	$id_paraent
	 * @return	json
	 */
	  
	function get_category_list($id_parent = 0)
	{		
		echo json_encode($this->category_model->get_category($id_parent));	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Mian page
	 *
	 * @access	public
	 * @param 	integer	$id_content
	 * @return	json
	 */
	
	function get_form($id_content = NULL)
	{
		if($id_content != NULL)
		{
			$data = $this->category_model->get_detail($id_content);	
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
		
		$this->load->view('category_form', $data);	
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
	
	/**
	 * Move category 
	 *
	 * @access	public
	 */
	 
	function move_category()
	{
		$data = array(
						'id_category'	=> $this->input->post('id_1'),
						'ordering'		=> $this->input->post('ordering_2')
					 );
		$this->category_model->update_category($data);
		
		$data = array(
						'id_category'	=> $this->input->post('id_2'),
						'ordering'		=> $this->input->post('ordering_1')
					 );
					 
		$this->category_model->update_category($data);
	}
	
	// ------------------------------------------------------------------------
	// function - selectbox
	// ------------------------------------------------------------------------
	
	/**
	 * Get all category selectbox
	 *
	 * @access	public
	 * @param 	int		$selected		selected value
	 * @return	mixed
	 */
	  
	function get_category_selectbox($selected = NULL)
	{		
		$_category_list = $this->category_model->get_all_category();
		
		$_selectbox = '<select id="id_category" name="id_category">';
		$_selectbox .= '<option value="0">Root</option>';
		$_selectbox .= $this->get_category_selectbox_option($_category_list, $selected);
		$_selectbox .= '</select>';
		
		return $_selectbox;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get parent categoty selectbox
	 *
	 * @access	public
	 * @param 	int		$selected		selected value
	 * @return	mixed
	 */
	
	function get_parent_selectbox($selected = 0)
	{
		$_category_list = $this->category_model->get_all_category();
		
		$_selected = ($selected == 0) ? 'selected' : '';
		
		$_selectbox = '<select id="id_parent" name="id_parent">';
		$_selectbox .= '<option value="0"' . $_selected . '>Root</option>';
		$_selectbox .= $this->get_category_selectbox_option($_category_list, $selected);
		$_selectbox .= '</select>';
		
		return $_selectbox;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get selectbox opion
	 *
	 * @access	public
	 * @param 	array	$category		id of category
	 * @param 	integer	$selected		selected value
	 * @param 	string	$space			text to indent subcategory
	 * @return	mixed
	 */
	
	function get_category_selectbox_option($category, $selected = NULL, $space = NULL)
	{
		$_option = '';
		
		for($loop = 0; $loop < count($category); $loop++)
		{
			$_selected = ($category[$loop]['id_category'] == $selected) ? 'selected' : '';
			$_option .= '<option value="' .  $category[$loop]['id_category'] . '" ' . $_selected . '>' . $space . '- -&raquo; </span>' .$category[$loop]['name'] . '</option>';
			
			$_space_new = $space . '- - ';
			$_option .= $this->get_category_selectbox_option($category[$loop]['category'], $selected, $_space_new);
		}
		
		return $_option;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update parent selectbox option
	 *
	 * @access	public
	 * @param 	integer	$selected
	 * @return	json
	 */
	  
	function update_selectbox_option($selected = NULL)
	{		
		$_category_list = $this->category_model->get_all_category();
		
		$_option = '<option value="0">Root</option>';
		$_option .= $this->get_category_selectbox_option($_category_list, $selected);
		
		echo $_option;
	}
	
	// ------------------------------------------------------------------------
}


/* End of file category.php */
/* Location: ./application/modules/catalog/controllers/category.php */