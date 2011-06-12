<?php

class Story_model extends CI_Model
{
	function add_story($data)
	{
		$this->db->insert('story', $data);
		return TRUE;
	}
	
	function edit_story($id_story, $data)
	{
		$this->db->where('id_story', $id_story);
		$this->db->update('story', $data);
		return TRUE;
	}
	
	function get_working_status()
	{
		$_sql = 'SELECT * FROM working_status';
		$_query = $this->db->query($_sql);
		return $_query->result_array();	
	}
	
	function get_game_version()
	{
		$_sql = 'SELECT * FROM game_version';
		$_query = $this->db->query($_sql);
		return $_query->result_array();		
	}
	
	function get_iteration()
	{
		$_sql = 'SELECT * FROM iteration';
		$_query = $this->db->query($_sql);
		return $_query->result_array();		
	}
	
	function get_current_id_story()
	{
		$_sql = 'SELECT id_story FROM story ORDER BY id_story DESC LIMIT 1';
		$_query = $this->db->query($_sql);
		return $_query->row_array();
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get story detail
	  *
	  * @access	public
	  * @param 	int		$id_story		id of story
	  * @return	json
	  */
	
	function get_detail($id_story)
	{
		$_sql = 'SELECT * FROM story WHERE id_story = "' . $id_story . '"';
		$_query = $this->db->query($_sql);
		return $_query->row_array();
	}
}

/* End of file story_model.php */
/* Location: ./application/modules/story/model/story_model.php */
