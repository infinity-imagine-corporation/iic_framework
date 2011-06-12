<?php
class Category extends MX_Controller 
{
	// ------------------------------------------------------------------------
	
	/**
	  * Mian page
	  *
	  * @access	public
	  */
	  
	function index()
	{
		$this->load->model('category_model');
		print_array($this->category_model->get_category_and_item());
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get all category select box
	  *
	  * @access	public
	  * @param 	int		$selected		selected value
	  * @return	mixed
	  */
	  
	function get_category_select_box($selected = NULL)
	{		
		$this->load->model('category_model');
		$_category_list = $this->category_model->get_category();
		
		$_select_box = '<select id="id_category" name="id_category">';
		$_select_box .= $this->_get_category_select_option($_category_list, $selected);
		$_select_box .= '</select>';
		
		return $_select_box;
	}
	
	function get_parent_select_box($selected = NULL)
	{
		$this->load->model('category_model');
		$_category_list = $this->category_model->get_category();
		
		$_select_box = '<select id="id_parent" name="id_parent">';
		$_select = ($selected == 0) ? 'selected' : '';
		$_select_box .= '<option value="0"' . $_select . '>root</option>';
		$_select_box .= $this->_get_category_select_option($_category_list, $selected);
		$_select_box .= '</select>';
		
		return $_select_box;
	}
	
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
	
	function get_category_form($id_category)
	{
		$this->load->model('category_model');
		$data = $this->category_model->get_detail($id_category);	
		$this->load->view('category_form', $data);	
	}
	
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
}

/* End of file category.php */
/* Location: ./application/modules/category/controllers/category.php */