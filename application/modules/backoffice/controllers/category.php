<?php

class Category extends MX_Controller 
{
	// ------------------------------------------------------------------------
	
	function __construct()
	{
		parent::__construct();
		
		// Check permission
		Modules::run('backoffice/login/check_permission');
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Mian page
	 *
	 * @access	public
	 */
	  
	function index()
	{
		$this->load->model('category_model');
		$data['category'] = $this->category_model->get_category();
		
		$data['th'] = array();
		array_push($data['th'], array('axis'=>'',			'label'=>'&nbsp;'));
		array_push($data['th'], array('axis'=>'name',		'label'=>'Name'));
		array_push($data['th'], array('axis'=>'is_enable',	'label'=>'Status'));
		array_push($data['th'], array('axis'=>'',			'label'=>'Action'));
		
		$this->load->model('theme_model');
		$data['theme'] = $this->theme_model->get_theme();
		
		$data['title'] = 'Category';
		$data['main_content'] = 'category_index';
		
		$this->load->view('main', $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get all category select box
	 *
	 * @access	public
	 * @param 	int		$selected		selected value
	 * @return	mixed
	 */
	  
	function get_category_selectbox($selected = NULL)
	{		
		$this->load->model('category_model');
		$_category_list = $this->category_model->get_category();
		
		$_selectbox = '<select id="id_category" name="id_category">';
		$_selectbox .= $this->_get_category_select_option($_category_list, $selected);
		$_selectbox .= '</select>';
		
		return $_selectbox;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get select box option
	 *
	 * @access	private
	 * @param 	array	$category		id of category
	 * @param 	int		$selected		selected value
	 * @param 	string	$space			text to indent subcategory
	 * @return	mixed
	 */
	
	function _get_category_select_option($category, $selected = NULL, $space = NULL)
	{
		$_option = '';
		
		//echo count($category);
		
		for($loop = 0; $loop < count($category); $loop++)
		{
			$_selected = ($category[$loop]['id_category'] == $selected) ? 'selected' : '';
			$_option .= '<option value="' .  $category[$loop]['id_category'] . '" ' . $_selected . '>' . $space . $category[$loop]['name'] . '</option>';
			
			$_space_new = $space . '. . ';
			$_option .= $this->_get_category_select_option($category[$loop]['category'], $selected, $_space_new);
		}
		
		return $_option;
	}
	
	// ------------------------------------------------------------------------
	
	function get_parent_selectbox($selected = NULL)
	{
		$this->load->model('category_model');
		$_category_list = $this->category_model->get_category();
		
		$_selectbox = '<select id="id_parent" name="id_parent">';
		$_select = ($selected == 0) ? 'selected' : '';
		$_selectbox .= '<option value="0"' . $_select . '>root</option>';
		$_selectbox .= $this->_get_category_select_option($_category_list, $selected);
		$_selectbox .= '</select>';
		
		return $_selectbox;
	}
	
	// ------------------------------------------------------------------------
	
	function add_category_form()
	{
		$data = array(
			'id_category'	=> 0,
			'id_parent'		=> 0,
			'name'			=> '',
			'description'	=> '',
			'is_enable'		=> 1
		);
		$this->load->view('category_form', $data);	
	}
	
	// ------------------------------------------------------------------------
	
	function get_category_form($id_category)
	{
		$this->load->model('category_model');
		$data = $this->category_model->get_detail($id_category);	
		$this->load->view('category_form', $data);	
	}
	
	// ------------------------------------------------------------------------
	
	function edit_category($id_category)
	{
		$data = array(
			'id_category' 	=> $this->input->post('id_category'),
			'id_parent' 	=> $this->input->post('id_parent'),
			'name' 			=> $this->input->post('name'),
			'description' 	=> $this->input->post('description'),
			'is_enable'		=> $this->input->post('is_enable')
		);
		$this->load->model('category_model');
		$this->category_model->edit_category($id_category, $data);
	}
	
	// ------------------------------------------------------------------------
	
	function add_category()
	{
		$data = array(
			'id_parent' 	=> $this->input->post('id_parent'),
			'name' 			=> $this->input->post('name'),
			'description' 	=> $this->input->post('description'),
			'is_enable'		=> $this->input->post('is_enable')
		);
		$this->load->model('category_model');
		$this->category_model->add_category($data);
	}
	
	// ------------------------------------------------------------------------
}


/* End of file category.php */
/* Location: ./application/modules/category/controllers/category.php */