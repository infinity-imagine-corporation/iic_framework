<?php
if($_FILES["upfile"]["name"] != "Please Insert Images")
{
	$serverName = "(local)";
	$connectionInfo = array( 
								"Database"	=> "iic_framework", 
								"UID"		=> "nsm", 
								"PWD"		=> "Admin@2008"
							);
							
	$conn = sqlsrv_connect($serverName, $connectionInfo);
	
	if(!$conn)
	{
		 echo "Connection could not be established.\n";
		 echo '<hr />';
		 die(print_r( sqlsrv_errors(), true));
	}
	
	$FileName	= $_FILES['upfile']['tmp_name']; 
	$Name		= $_FILES["upfile"]["name"]; 
	$Size		= $_FILES["upfile"]["size"]; 
	$Type		= $_FILES["upfile"]["type"]; 
	
	echo '<pre>';
	print_r($_FILES);
	echo '</pre>';
	echo '<hr />';	
	
	$dataString = fopen($FileName, 'r');
	
	$sql = "INSERT INTO dbo.Images 
			(
				Img_Data,
				Img_Name,
				Img_Size,
				Img_Type
			) 
		    VALUES (?, ?, ?, ?)";
	
	$params = array(
						array(
								& $dataString,
								SQLSRV_PARAM_IN,
								SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_BINARY),
								SQLSRV_SQLTYPE_VARBINARY('max')
							 ),
						& $Name,
						& $Size,
						& $Type
						
				    );
	
	echo '<pre>';				
	print_r($params);
	echo '<hr />';
	
	//$uploadPic = sqlsrv_prepare($conn, $sql, $params);
	//$stmt = sqlsrv_execute($uploadPic);
	
	$stmt = sqlsrv_query($conn, $sql, $params);

	if(! $stmt) 
	{
		 echo "sqlsrv_query error.\n";
		 echo '<hr />';
		 echo '<pre>';
		 die(print_r( sqlsrv_errors(), true));
	}	
	
	echo "Upload Complete<br>";
	echo '<hr />';
	echo "<a href='Img_show.php'>View_img</a> ";
}
?>