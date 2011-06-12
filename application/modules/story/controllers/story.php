<?php

class Story extends MX_Controller 
{
	function index()
	{
		//$this->load->view('index');
		$this->load->view('master_story_list');
	}
	
	function master_story_list()
	{
		$this->load->view('master_story_list');
	}
	
	function get_detail($id_story)
	{
		$this->load->model('story_model');
		return $this->story_model->get_detail($id_story);	
	}
	
	function get_story_form($id_story)
	{
		if(isset($id_story))
		{
			$this->load->model('story_model');
			$data = $this->story_model->get_detail($id_story);
			$this->load->model('category/category_model');
			$data['category'] = $this->category_model->get_detail_by_item($data['id_story'], 1);
			$this->load->view('story_form', $data);	
		}
	}
	
	function add_story_form()
	{
		$category['id_category']= 86;
		$data = array(
			'category'			=> $category['id_category'],
			'name'				=> '',
			'as'				=> '',
			'description'		=> '',
			'i_want_to' 		=> '',
			'so_that'			=> '',
			'priority'			=> 0,
			'important' 		=> 0,
			'point'				=> 0,
			'id_working_status'	=> 1,
			'id_game_version'	=> 1,
			'id_iteration'		=> 1,
			'old_category'		=> 1
            
		);
		$this->load->view('story_form', $data);	
	}
	
	function get_working_status_select_box($id_working_status)
	{
		$this->load->model('story_model');
		$_data_working_status = $this->story_model->get_working_status();	
		$_select_box = '<select id="id_working_status" name="id_working_status">';
		foreach($_data_working_status as $row)
		{
			$_selected = ($row['id_working_status'] == $id_working_status) ? 'selected' : '';
			$_select_box .=	'<option value="' . $row['id_working_status'] . '" ' . $_selected . '>' . $row['status_name'] . '</option>';
		}
		$_select_box .= '</select>';
		return $_select_box;
	}
	
	function get_game_version_select_box($id_game_version)
	{	
		$this->load->model('story_model');
		$_data_game_version = $this->story_model->get_game_version();
		$_select_box = '<select id="id_game_version" name="id_game_version">';
		foreach($_data_game_version as $row)
		{
			$_selected = ($row['id_game_version'] == $id_game_version) ? 'selected' : '';
			$_select_box .=	'<option value="' . $row['id_game_version'] . '" ' . $_selected . '>' . $row['name'] . '</option>';
		}
		$_select_box .= '</select>';
		return $_select_box;
	}
	
	function get_iteration_select_box($id_iteration)
	{
		$this->load->model('story_model');
		$_data_iteration = $this->story_model->get_iteration();
		$_select_box = '<select id="id_iteration" name="id_iteration">';
		foreach($_data_iteration as $row)
		{
			$_selected = ($row['id_iteration'] == $id_iteration) ? 'selected' : '';
			$_select_box .=	'<option value="' . $row['id_iteration'] . '" ' . $_selected . '>' . $row['id_iteration'] . '</option>';
		}
		$_select_box .= '</select>';
		return $_select_box;	
	}
	
	function add_story()
	{
		$data = array(
			'name' 						=> $this->input->post('name'),
			'description' 				=> $this->input->post('description'),
			'as' 						=> $this->input->post('as'),
			'i_want_to' 				=> $this->input->post('i_want_to'),
			'so_that' 					=> $this->input->post('so_that'),
			'priority' 					=> $this->input->post('priority'),
			'important'					=> $this->input->post('important'),
			'point' 					=> $this->input->post('point'),
			'id_working_status' 		=> $this->input->post('id_working_status'),
			'id_game_version'			=> $this->input->post('id_game_version'),
			'id_iteration' 		        => $this->input->post('id_iteration')
		);
		$this->load->model('story_model');
		$this->story_model->add_story($data);
		
		$current_id_story = $this->story_model->get_current_id_story();
		$id_story = (int)$current_id_story['id_story'];
		
		$category = array(
			'id_category'	=> $this->input->post('id_category'),
			'id_item'		=> $id_story,
			'id_item_type'	=> 1
		);
		$this->load->model('category/category_model');
		$this->category_model->add_category_item($category);
	}
	
	function edit_story($id_story)
	{
		$data = array(
			'name' 						=> $this->input->post('name'),
			'description' 				=> $this->input->post('description'),
			'as' 						=> $this->input->post('as'),
			'i_want_to' 				=> $this->input->post('i_want_to'),
			'so_that' 					=> $this->input->post('so_that'),
			'priority' 					=> $this->input->post('priority'),
			'important'					=> $this->input->post('important'),
			'point' 					=> $this->input->post('point'),
			'id_working_status' 		=> $this->input->post('id_working_status'),
			'id_game_version'			=> $this->input->post('id_game_version'),
			'id_iteration' 		        => $this->input->post('id_iteration')
		);
		$this->load->model('story_model');
		$this->story_model->edit_story($id_story, $data);

		$new_category = array(
			'id_category'	=> $this->input->post('id_category')
		);
		$old_category = array(
			'id_category'	=> $this->input->post('old_category'),
			'id_item'		=> $id_story,
			'id_item_type'	=> 1
		);
		$this->load->model('category/category_model');
		$this->category_model->edit_category_item($old_category, $new_category);
	}
}

/* End of file story.php */
/* Location: ./application/modules/story/controllers/story.php */