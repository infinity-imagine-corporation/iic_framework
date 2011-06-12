<?php
	//$host = "192.168.9.51";
	//$host = "192.168.9.44";
	$host = "127.0.0.1";
	$username = "root";
	$password = "";
	$db = "lifecycle_production";
	mysql_connect($host, $username, $password);
	mysql_select_db($db);
	mysql_query("SET NAMES UTF8");
?>