<?php
	
class Category_model extends CI_Model
{
	// ------------------------------------------------------------------------
	
	/**
	 * Setup database
	 *
	 */
	  
	var $table_category = 'catalog_category';
	var $table_category_item = 'catalog_category_item';
	var $table_item = 'catalog_item';
	
	// ------------------------------------------------------------------------
	
	function add_category($data)
	{
		$this->db->insert($this->table_category, $data);
		return TRUE;
	}
	
	// ------------------------------------------------------------------------
	
	function edit_category($data)
	{
		$this->db->where('id_category', $data['id_category']);
		$this->db->update($this->table_category, $data);
		return TRUE;
	}
	
	// ------------------------------------------------------------------------
	
	function add_category_item($data)
	{
		$this->db->insert($this->table_category_item, $data);
		return TRUE;
	}
	
	// ------------------------------------------------------------------------
	
	function edit_category_item($old_category, $new_category)
	{
		$this->db->where($old_category);
		$this->db->update($this->table_category_item, $new_category);
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
		$_sql = 'SELECT * FROM '.$this->table_category.' WHERE id_category = "' . $id_category . '"';
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
				 FROM '.$this->table_category.' 
		
				 LEFT JOIN '.$this->table_category_item.' 
				 ON '.$this->table_category.'.id_category = '.$this->table_category_item.'.id_category
				 
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
				 FROM '.$this->table_category.' 
				 WHERE id_parent = ' . $id_parent;
		$_result = $this->db->query($_sql);
		
		$_category_list = array();
		
		if($_result->num_rows() > 0)
		{
			foreach($_result->result_array() as $_data)
			{
				// count category
				$_sql_category = 'SELECT *
								  FROM '.$this->table_category.' 
								  WHERE id_parent = ' . $_data['id_category'];
				$_result_category = $this->db->query($_sql_category);
				$_data['total_category'] = $_result_category->num_rows();
				
				// count item
				$_sql_item = 'SELECT *
							  FROM '.$this->table_category_item.'
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
	 * Get list of all child category (all level)
	 *
	 * @access	public
	 * @param 	int		$id_parent		id of parent category
	 * @return	array
	 */
	
	function get_all_category($id_parent = 0)
	{
		$_sql = 'SELECT *
				 FROM '.$this->table_category.' 
				 WHERE id_parent = ' . $id_parent;
		$_query = $this->db->query($_sql);
		
		$_category_list = array();
		
		if($_query->num_rows() > 0)
		{
			foreach($_query->result_array() as $_data)
			{
				$_data['category'] = $this->get_all_category($_data['id_category']);
				array_push($_category_list, $_data);
			}
			
			return $_category_list;
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get child category (single level)
	 *
	 * @access	public
	 * @param 	int		$id_parent		id of parent category
	 * @return	array
	 */
	
	function get_category($id_parent = 0)
	{
		$_sql = 'SELECT *
				 FROM '.$this->table_category.' 
				 WHERE id_parent = ' . $id_parent;
		$_query = $this->db->query($_sql);
		
		$_category_list = array();
		
		if($_query->num_rows() > 0)
		{
			foreach($_query->result_array() as $_data)
			{
				array_push($_category_list, $_data);
			}
			
			return $_category_list;
		}
		else
		{
			return FALSE;
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
		$_sql = 'SELECT '.$this->table_category_item.'.id_item, name, priority, important, story.release_in_version, status_name
				FROM '.$this->table_category_item.'
				
			 	LEFT JOIN '.$this->table_item.' 
				ON category_item.id_item = story.id_story
				
			 	WHERE id_category = ' . $id_category;
		$_result = $this->db->query($_sql);
				 
		return $_result->result_array();
	}
	
	// ------------------------------------------------------------------------
}


/* End of file category_model.php */
/* Location: ./application/modules/category/model/category_model.php */