<?php
	
class Category_model extends CI_Model
{
	function add_category($data)
	{
		$this->db->insert('category', $data);
		return TRUE;
	}
	
	function edit_category($id_category, $data)
	{
		$this->db->where('id_category', $id_category);
		$this->db->update('category', $data);
		return TRUE;
	}
	
	function add_category_item($data)
	{
		$this->db->insert('category_item', $data);
		return TRUE;
	}
	
	function edit_category_item($old_category, $new_category)
	{
		$this->db->where($old_category);
		$this->db->update('category_item', $new_category);
		return TRUE;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get category detail
	  *
	  * @access	public
	  * @param 	int		$id_category		
	  * @return	array
	  */
	
	function get_detail($id_category)
	{
		$_sql = 'SELECT * FROM category WHERE id_category = "' . $id_category . '"';
		$_result = $this->db->query($_sql);
		return $_result->row_array();
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get category detail by id_item
	  *
	  * @access	public
	  * @param 	int		$id_item		
	  * @param 	int		$id_item_type	
	  * @return	array
	  */
	
	function get_detail_by_item($id_item, $id_item_type)
	{
		$_sql = 'SELECT * 
				 FROM category 
		
				 LEFT JOIN category_item 
				 ON category.id_category = category_item.id_category
				 
				 WHERE id_item = "' . $id_item . '" AND id_item_type = "' . $id_item_type . '"';
		$_result = $this->db->query($_sql);
		return $_result->row_array();
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get full list of category with subcategory and item
	  *
	  * @access	public
	  * @param 	int		$id_parent		id of parent category
	  * @return	array
	  */
	
	function get_category_and_item($id_parent = 0)
	{
		$_sql = 'SELECT *
				 FROM category 
				 WHERE id_parent = ' . $id_parent;
		$_result = $this->db->query($_sql);
		
		$_category_list = array();
		
		if($_result->num_rows() > 0)
		{
			foreach($_result->result_array() as $_data)
			{
				// count category
				$_sql_category = 'SELECT *
								  FROM category 
								  WHERE id_parent = ' . $_data['id_category'];
				$_result_category = $this->db->query($_sql_category);
				$_data['total_category'] = $_result_category->num_rows();
				
				// count item
				$_sql_item = 'SELECT *
							  FROM category_item
							  WHERE id_category = ' .$_data['id_category'];
				$_result_item = $this->db->query($_sql_item);
				$_data['total_item'] = $_result_item->num_rows();
				
				
				$_data['category'] = $this->get_category_and_item($_data['id_category']);
				$_data['item'] = $this->get_category_item($_data['id_category']);
				
				array_push($_category_list, $_data);
			}
			
			return $_category_list;
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get list of category
	  *
	  * @access	public
	  * @param 	int		$id_parent		id of parent category
	  * @return	array
	  */
	
	function get_category($id_parent = 0)
	{
		$_sql = 'SELECT *
				 FROM category 
				 WHERE id_parent = ' . $id_parent;
		$_result = $this->db->query($_sql);
		
		$_category_list = array();
		
		if($_result->num_rows() > 0)
		{
			foreach($_result->result_array() as $_data)
			{
				$_data['category'] = $this->get_category($_data['id_category']);
				array_push($_category_list, $_data);
			}
			
			return $_category_list;
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get list of item in category
	  *
	  * @access	public
	  * @param 	int		$id_parent		id of parent category
	  * @return	array
	  */
	
	function get_category_item($id_category)
	{
		$_sql = 'SELECT category_item.id_item, name, priority, important, story.release_in_version, status_name
				FROM category_item
				
			 	LEFT JOIN story 
				ON category_item.id_item = story.id_story
				
			 	LEFT JOIN working_status 
				ON story.id_working_status = working_status.id_working_status
				
			 	WHERE id_category = ' . $id_category;
		$_result = $this->db->query($_sql);
				 
		return $_result->result_array();
	}
	
	// ------------------------------------------------------------------------
}

/* End of file category_model.php */
/* Location: ./application/modules/category/model/category_model.php */