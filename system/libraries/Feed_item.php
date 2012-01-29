<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Univarsel Feed Writer
* 
* FeedItem class - Used as feed element in Feed_writer class
*
* @package         UnivarselFeedWriter
* @author          Anis uddin Ahmad <anisniit@gmail.com>
* @link            http://www.ajaxray.com/projects/rss
*/
class Feed_item
{
	private $elements = array();    //Collection of feed elements
	private $version;
	
	/**
	* Constructor 
	* 
	* @param    contant     (RSS1/RSS2/ATOM) RSS2 is default. 
	*/ 
	function __construct($version = RSS2)
	{    
		$this->version = $version;
	}
	
	/**
	* Add an element to elements array
	* 
	* @access   public
	* @param    srting  The tag name of an element
	* @param    srting  The content of tag
	* @param    array   Attributes(if any) in 'attrName' => 'attrValue' format
	* @return   void
	*/
	public function add_element($element_name, $content, $attributes = null)
	{
		$this->elements[$element_name]['name']       = $element_name;
		$this->elements[$element_name]['content']    = $content;
		$this->elements[$element_name]['attributes'] = $attributes;
	}
	
	/**
	* Set multiple feed elements from an array. 
	* Elements which have attributes cannot be added by this method
	* 
	* @access   public
	* @param    array   array of elements in 'tagName' => 'tagContent' format.
	* @return   void
	*/
	public function add_element_array($element_array)
	{
		if(! is_array($element_array)) return;
		
		foreach ($element_array as $element_name => $content) 
		{
			$this->add_element($element_name, $content);
		}
	}
	
	/**
	* Return the collection of elements in this feed item
	* 
	* @access   public
	* @return   array
	*/
	public function get_elements()
	{
		return $this->elements;
	}
	
	// Wrapper functions ------------------------------------------------------
	
	/**
	* Set the 'dscription' element of feed item
	* 
	* @access   public
	* @param    string  The content of 'description' element
	* @return   void
	*/
	public function set_description($description) 
	{
		$tag = ($this->version == ATOM)? 'summary' : 'description'; 
		$this->add_element($tag, $description);
	}
	
	/**
	* @desc     Set the 'title' element of feed item
	* @access   public
	* @param    string  The content of 'title' element
	* @return   void
	*/
	public function set_title($title) 
	{
		$this->add_element('title', $title);  	
	}
	
	/**
	* Set the 'date' element of feed item
	* 
	* @access   public
	* @param    string  The content of 'date' element
	* @return   void
	*/
	public function set_date($date) 
	{
		if(! is_numeric($date))
		{
			$date = strtotime($date);
		}
		
		if($this->version == ATOM)
		{
			$tag    = 'updated';
			$value  = date(DATE_ATOM, $date);
		}        
		else if($this->version == RSS2) 
		{
			$tag    = 'pubDate';
			$value  = date(DATE_RSS, $date);
		}
		else                                
		{
			$tag    = 'dc:date';
			$value  = date("Y-m-d", $date);
		}
		
		$this->add_element($tag, $value);    
	}
	
	/**
	* Set the 'link' element of feed item
	* 
	* @access   public
	* @param    string  The content of 'link' element
	* @return   void
	*/
	public function set_link($link) 
	{
		if($this->version == RSS2 || $this->version == RSS1)
		{
			$this->add_element('link', $link);
		}
		else
		{
			$this->add_element('link', '', array('href' => $link));
			$this->add_element('id', Feed_writer::uuid($link, 'urn:uuid:'));
		} 
	}
	
	/**
	* Set the 'encloser' element of feed item
	* For RSS 2.0 only
	* 
	* @access   public
	* @param    string  The url attribute of encloser tag
	* @param    string  The length attribute of encloser tag
	* @param    string  The type attribute of encloser tag
	* @return   void
	*/
	public function set_encloser($url, $length, $type)
	{
		$attributes = array('url' => $url, 'length' => $length, 'type' => $type);
		$this->add_element('enclosure', '', $attributes);
	}
}


/* End of file Feed_item.php */
/* Location: ./application/libraries/Feed_item.php */