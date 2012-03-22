<?php 
// ------------------------------------------------------------------------

function iic_query($sql)
{
	$_query = mysql_query($sql);
	
	if(! $_query)
	{
		// report
		$title = 'Error in: iic_query()';
		$message = '<h5>MySql Error: '.mysql_errno().'</h5>';
		$message .= '<p class="red">'.mysql_error().'</p>';
		$message .= '<h5>Your SQL syntax is:</h5>';
		$message .= '<p><pre>'.$sql.'</pre></p>';
		
		require_once("iic_notification.php");
		exit();
	}
	else
	{
		return $_query;
	}
}

// ------------------------------------------------------------------------

function check_query_error($query, $sql = NULL)
{
	if(!$query)
	{
		echo "<p>";
		echo $sql;
		echo "<hr />";
		echo (mysql_errno() ? "Error no. ".mysql_errno()." : " : "").mysql_error();
		echo "</p>";
		exit();
	}
	else
	{
		return $query;
	}
}

// ------------------------------------------------------------------------

/* End of file iic_db_helper.php */
/* Location: ./iic_tools/helpers/iic_db_helper.php */