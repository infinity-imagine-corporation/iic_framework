<?php
if($_FILES["upfile"]["name"] != "Please Insert Images")
{
	$serverName = "(local)";
	$connectionInfo = array( 
								"Database"	=> "iic_framework", 
								"UID"		=> "nsm", 
								"PWD"		=> "Admin@2008"
							);
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
	
	if($conn)
	{
		 echo "Connection established.\n";
		 echo '<hr />';
	}
	else
	{
		 echo "Connection could not be established.\n";
		 echo '<hr />';
		 die(print_r( sqlsrv_errors(), true));

	}
	
	$FileName	= $_FILES['upfile']['tmp_name']; 
	$Name		= $_FILES["upfile"]["name"]; 
	$Size		= $_FILES["upfile"]["size"]; 
	$Type		= $_FILES["upfile"]["type"]; 
	
	
	/*$DataImage	= file_get_contents($FileName ); 
	$ArrData	= unpack("H*hex", $DataImage); 
	$HexData 	= "0x".$ArrData['hex']; */
	
	if(file_exists($FileName))     
	{ 
		$fp = fopen($FileName, 'r'); 
		$HexData = fread($fp, filesize($FileName)); 
		$HexData = addslashes($HexData); 
		fclose($fp); 
	} 
	else 
	{ 
		$HexData = ''; 
	} 
	
	$sql = "INSERT INTO Images 
			(
				Img_Name,
				Img_Size,
				Img_Data,
				Img_Type
			) 
		    VALUES (?, ?, ?, ?)";
			
	$params = array("$Name", "$Size", "$HexData", "$Type");
	
	$stmt = sqlsrv_query($conn, $sql, $params);
	
	if($stmt === false) 
	{
		 echo "sqlsrv_query error.\n";
		 echo '<hr />';
		 echo '<pre>';
		 die( print_r( sqlsrv_errors(), true));
	}	
	
	echo "Upload Complete<br>";
	echo "<a href='Img_show.php'>View_img</a> ";
}
?>