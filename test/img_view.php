<?php
	$serverName = "(local)";
	$connectionInfo = array( 
								"Database"	=> "iic_framework", 
								"UID"		=> "nsm", 
								"PWD"		=> "Admin@2008"
							);
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
	
	if(! $conn)
	{
		 echo "Connection could not be established.\n";
		 echo '<hr />';
		 die(print_r( sqlsrv_errors(), true));

	}
	
$sql = "SELECT * FROM  Images  WHERE Img_Id = '".$_GET['Img_Id']."'";
$Query = sqlsrv_query($conn, $sql) or die ("Error Query [".$sql."]");
$Result = sqlsrv_fetch_array($Query);
$Type = $Result["Img_Type"];

header("Content-type: $Type "); 
echo $Result["Img_Data"];
?>