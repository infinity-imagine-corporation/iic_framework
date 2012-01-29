<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// RSS 0.90  Officially obsoleted by 1.0
// RSS 0.91, 0.92, 0.93 and 0.94  Officially obsoleted by 2.0
// So, define constants for RSS 1.0, RSS 2.0 and ATOM 	

define('RSS1', 'RSS 1.0', true);
define('RSS2', 'RSS 2.0', true);
define('ATOM', 'ATOM', true);

/**
* Univarsel Feed Writer class
*
* Genarate RSS 1.0, RSS2.0 and ATOM Feed
*                             
* @package     UnivarselFeedWriter
* @author      Anis uddin Ahmad <anisniit@gmail.com>
* @link        http://www.ajaxray.com/projects/rss
*/
class Feed_writer
{
	private $channels		= array();  // Collection of channel elements
	private $items			= array();  // Collection of items as object of Feed_item class.
	private $data			= array();  // Store some other version wise data
	private $CDATA_encoding	= array();  // The tag names which have to encoded as CDATA
	private $version  		= NULL; 
	
	/**
	* Constructor
	* 
	* @param    constant    the version constant (RSS1/RSS2/ATOM).       
	*/ 
	function __construct($version = RSS2)
	{	
		$this->version = $version;
			
		// Setting default value for assential channel elements
		$this->channels['title']	= $version.' Feed';
		$this->channels['link']		= 'http://www.ajaxray.com/blog';
				
		//Tag names to encode in CDATA
		$this->CDATA_encoding = array('description', 'content:encoded', 'summary');
	}
	
	// Start # public functions ---------------------------------------------
	
	/**
	* Set a channel element
	* @access   public
	* @param    srting  name of the channel tag
	* @param    string  content of the channel tag
	* @return   void
	*/
	public function set_channel_element($element_name, $content)
	{
		$this->channels[$element_name] = $content;
	}
	
	/**
	* Set multiple channel elements from an array. Array elements 
	* should be 'channelName' => 'channelContent' format.
	* 
	* @access   public
	* @param    array   array of channels
	* @return   void
	*/
	public function set_channel_elements_from_array($element_array)
	{
		if(! is_array($element_array)) return;
		
		foreach($element_array as $element_name => $content) 
		{
			$this->set_channel_element($element_name, $content);
		}
	}
	
	/**
	* Genarate the actual RSS/ATOM file
	* 
	* @access   public
	* @return   void
	*/ 
	public function genarate_feed()
	{
		header("Content-type: text/xml");
		
		$this->print_head();
		$this->print_channels();
		$this->print_items();
		$this->print_tale();
	}
	
	/**
	* Create a new Feed_item.
	* 
	* @access   public
	* @return   object  instance of Feed_item class
	*/
	public function create_new_item()
	{
		$item = new Feed_item($this->version);
		return $item;
	}
	
	/**
	* Add a Feed_item to the main class
	* 
	* @access   public
	* @param    object  instance of Feed_item class
	* @return   void
	*/
	public function add_item($feed_item)
	{
		$this->items[] = $feed_item;    
	}
	
	// Wrapper functions -------------------------------------------------------------------
	
	/**
	* Set the 'title' channel element
	* 
	* @access   public
	* @param    srting  value of 'title' channel tag
	* @return   void
	*/
	public function set_title($title)
	{
		$this->set_channel_element('title', $title);
	}
	
	/**
	* Set the 'description' channel element
	* 
	* @access   public
	* @param    srting  value of 'description' channel tag
	* @return   void
	*/
	public function set_description($desciption)
	{
		$this->set_channel_element('description', $desciption);
	}
	
	/**
	* Set the 'link' channel element
	* 
	* @access   public
	* @param    srting  value of 'link' channel tag
	* @return   void
	*/
	public function set_link($link)
	{
		$this->set_channel_element('link', $link);
	}
	
	/**
	* Set the 'image' channel element
	* 
	* @access   public
	* @param    srting  title of image
	* @param    srting  link url of the imahe
	* @param    srting  path url of the image
	* @return   void
	*/
	public function set_image($title, $link, $url)
	{
		$this->set_channel_element('image', array('title'=>$title, 'link'=>$link, 'url'=>$url));
	}
	
	/**
	* Set the 'about' channel element. Only for RSS 1.0
	* 
	* @access   public
	* @param    srting  value of 'about' channel tag
	* @return   void
	*/
	public function set_channel_about($url)
	{
		$this->data['channel_about'] = $url;    
	}
	
	/**
	* Genarates an UUID
	* @author     Anis uddin Ahmad <admin@ajaxray.com>
	* @param      string  an optional prefix
	* @return     string  the formated uuid
	*/
	public function uuid($key = null, $prefix = '') 
	{
		$key = ($key == null)? uniqid(rand()) : $key;
		$chars = md5($key);
		$uuid  = substr($chars,0,8).'-';
		$uuid .= substr($chars,8,4).'-';
		$uuid .= substr($chars,12,4).'-';
		$uuid .= substr($chars,16,4).'-';
		$uuid .= substr($chars,20,12);
		
		return $prefix.$uuid;
	}
	
	// End # public functions -------------------------------------------------
	
	// Start # private functions ----------------------------------------------
	
	/**
	* Prints the xml and rss namespace
	* 
	* @access   private
	* @return   void
	*/
	private function print_head()
	{
		$out  = '<?xml version="1.0" encoding="utf-8" ?>'."\n";
		
		if($this->version == RSS2)
		{
			$out .= '<rss version="2.0">'.PHP_EOL;
		}    
		else if($this->version == RSS1)
		{
			$out .= '<rdf:RDF 
					 xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
					 xmlns="http://purl.org/rss/1.0/"
					 xmlns:dc="http://purl.org/dc/elements/1.1/"
					>'.PHP_EOL;;
		}
		else if($this->version == ATOM)
		{
			$out .= '<feed xmlns="http://www.w3.org/2005/Atom">'.PHP_EOL;;
		}
		
		echo $out;
	}
	
	/**
	* Closes the open tags at the end of file
	* 
	* @access   private
	* @return   void
	*/
	private function print_tale()
	{
		if($this->version == RSS2)
		{
			echo '</channel>'.PHP_EOL.'</rss>'; 
		}    
		elseif($this->version == RSS1)
		{
			echo '</rdf:RDF>';
		}
		else if($this->version == ATOM)
		{
			echo '</feed>';
		}
	  
	}
	
	/**
	* Creates a single node as xml format
	* 
	* @access   private
	* @param    srting  name of the tag
	* @param    mixed   tag value as string or array of nested tags in 'tag_name' => 'tagValue' format
	* @param    array   Attributes(if any) in 'attrName' => 'attrValue' format
	* @return   string  formatted xml tag
	*/
	private function make_node($tag_name, $tag_content, $attributes = null)
	{        
		$node_text = '';
		$attr_text = '';
	
		if(is_array($attributes))
		{
			foreach ($attributes as $key => $value) 
			{
				$attr_text .= " $key=\"$value\" ";
			}
		}
		
		if(is_array($tag_content) && $this->version == RSS1)
		{
			$attr_text = ' rdf:parseType="Resource"';
		}
		
		
		$attr_text .= (in_array($tag_name, $this->CDATA_encoding) && $this->version == ATOM) ? ' type="html" ' : '';
		$node_text .= (in_array($tag_name, $this->CDATA_encoding)) ? "<{$tag_name}{$attr_text}><![CDATA[" : "<{$tag_name}{$attr_text}>";
		 
		if(is_array($tag_content))
		{ 
			foreach($tag_content as $key => $value) 
			{
				$node_text .= $this->make_node($key, $value);
			}
		}
		else
		{
			$node_text .= (in_array($tag_name, $this->CDATA_encoding)) ? $tag_content : htmlentities($tag_content, ENT_COMPAT, 'UTF-8');
		}           
			
		$node_text .= (in_array($tag_name, $this->CDATA_encoding)) ? "]]></$tag_name>" : "</$tag_name>";
	
		return $node_text.PHP_EOL;
	}
	
	/**
	* @desc     Print channels
	* @access   private
	* @return   void
	*/
	private function print_channels()
	{
		//Start channel tag
		switch($this->version) 
		{
		   case RSS2: 
				echo '<channel>'.PHP_EOL;        
				break;
		   case RSS1: 
				echo (isset($this->data['channel_about'])) ? "<channel rdf:about=\"{$this->data['channel_about']}\">" : "<channel rdf:about=\"{$this->channels['link']}\">";
				break;
		}
		
		//Print Items of channel
		foreach($this->channels as $key => $value) 
		{
			if($this->version == ATOM && $key == 'link') 
			{
				// ATOM prints link element as href attribute
				echo $this->make_node($key,'',array('href'=>$value));
				
				//Add the id for ATOM
				echo $this->make_node('id',$this->uuid($value,'urn:uuid:'));
			}
			else
			{
				echo $this->make_node($key, $value);
			}    
			
		}
		
		//RSS 1.0 have special tag <rdf:Seq> with channel 
		if($this->version == RSS1)
		{
			echo "<items>".PHP_EOL."<rdf:Seq>".PHP_EOL;
			
			foreach($this->items as $item) 
			{
				$this_items = $item->get_elements();
				echo "<rdf:li resource=\"{$this_items['link']['content']}\"/>".PHP_EOL;
			}
			
			echo "</rdf:Seq>".PHP_EOL."</items>".PHP_EOL."</channel>".PHP_EOL;
		}
	}
	
	/**
	* Prints formatted feed items
	* 
	* @access   private
	* @return   void
	*/
	private function print_items()
	{    
		foreach($this->items as $item) 
		{
			$this_items = $item->get_elements();
			
			//the argument is printed as rdf:about attribute of item in rss 1.0 
			echo $this->start_item($this_items['link']['content']);
			
			foreach($this_items as $feed_item ) 
			{
				echo $this->make_node($feed_item['name'], $feed_item['content'], $feed_item['attributes']); 
			}
			
			echo $this->end_item();
		}
	}
	
	/**
	* Make the starting tag of channels
	* 
	* @access   private
	* @param    srting  The vale of about tag which is used for only RSS 1.0
	* @return   void
	*/
	private function start_item($about = false)
	{
		if($this->version == RSS2)
		{
			echo '<item>'.PHP_EOL; 
		}    
		else if($this->version == RSS1)
		{
			if($about)
			{
				echo "<item rdf:about=\"$about\">".PHP_EOL;
			}
			else
			{
				die('link element is not set .\n It\'s required for RSS 1.0 to be used as about attribute of item');
			}
		}
		else if($this->version == ATOM)
		{
			echo "<entry>".PHP_EOL;
		}    
	}
	
	/**
	* Closes feed item tag
	* 
	* @access   private
	* @return   void
	*/
	private function end_item()
	{
		if($this->version == RSS2 || $this->version == RSS1)
		{
			echo '</item>'.PHP_EOL; 
		}    
		else if($this->version == ATOM)
		{
			echo "</entry>".PHP_EOL;
		}
	}
	// End # private functions ----------------------------------------------
}
 
// autoload classes
function __autoload($class_name) 
{
	require_once $class_name.'.php';
}


/* End of file Feed_writer.php */
/* Location: ./application/libraries/Feed_writer.php */