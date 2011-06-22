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
		array_push($data['th'], array('axis'=>'description','label'=>'Description'));
		array_push($data['th'], array('axis'=>'is_enable',	'label'=>'Status'));
		array_push($data['th'], array('axis'=>'',			'label'=>'Action'));
		
		$this->load->model('backoffice/theme_model');
		$data['theme'] = $this->theme_model->get_theme();
		
		$data['module'] = 'catalog';
		$data['page'] = 'category_index';
		$data['title'] = 'Category';
		
		$this->load->view('backoffice/main', $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get category list
	 *
	 * @access	public
	 * @param 	int		$id_paraent
	 * @return	json
	 */
	  
	function get_category_list($id_parent = 0)
	{		
		$_result['status'] = 1;
		
		$this->load->model('category_model');
		$_category_list = $this->category_model->get_category($id_parent);
		
		if($_category_list)
		{	
			$_result['data'] = $_category_list;
			echo json_encode($_result);
		}
		else
		{
			$_result['status'] = 0;
			echo json_encode($_result);	
		}
		
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get selectbox opion
	 *
	 * @access	public
	 * @param 	array	$category		id of category
	 * @param 	int		$selected		selected value
	 * @param 	string	$space			text to indent subcategory
	 * @return	mixed
	 */
	
	function get_category_select_option($category, $selected = NULL, $space = NULL)
	{
		$_option = '';
		
		//echo count($category);
		
		for($loop = 0; $loop < count($category); $loop++)
		{
			$_selected = ($category[$loop]['id_category'] == $selected) ? 'selected' : '';
			$_option .= '<option value="' .  $category[$loop]['id_category'] . '" ' . $_selected . '>. . ' . $space . $category[$loop]['name'] . '</option>';
			
			$_space_new = $space . '. . ';
			$_option .= $this->get_category_select_option($category[$loop]['category'], $selected, $_space_new);
		}
		
		return $_option;
	}
	
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
		$this->load->model('category_model');
		$_category_list = $this->category_model->get_all_category();
		
		//$_category_list = array();
		
		$_selectbox = '<select id="id_category" name="id_category">';
		$_selectbox .= '<option value="0">Root</option>';
		$_selectbox .= $this->get_category_select_option($_category_list, $selected);
		$_selectbox .= '</select>';
		
		return $_selectbox;
	}
	
	// ------------------------------------------------------------------------
	  
	function get_category_selectbox_option($selected = NULL)
	{		
		$this->load->model('category_model');
		$_category_list = $this->category_model->get_all_category();
		
		$_selectbox = '<option value="0">Root</option>';
		$_selectbox .= $this->get_category_select_option($_category_list, $selected);
		
		echo $_selectbox;
	}
	
	
	// ------------------------------------------------------------------------
	
	function get_parent_selectbox($selected = NULL)
	{
		$this->load->model('category_model');
		$_category_list = $this->category_model->get_all_category();
		
		$_select = ($selected == 0) ? 'selected' : '';
		
		$_selectbox = '<select id="id_parent" name="id_parent">';
		$_selectbox .= '<option value="0"' . $_select . '>Root</option>';
		$_selectbox .= $this->get_category_select_option($_category_list, $selected);
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
	
	function add_category()
	{
		$this->load->model('category_model');
		$this->category_model->add_category($this->input->post());
	}
	
	// ------------------------------------------------------------------------
	
	function edit_category($id_category)
	{
		$this->load->model('category_model');
		$this->category_model->edit_category($this->input->post());
	}
	
	// ------------------------------------------------------------------------
}


/* End of file category.php */
/* Location: ./application/modules/catalog/controllers/category.php */