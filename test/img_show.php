
<?php
$serverName = "(local)";
$connectionInfo = array( 
							"Database"	=> "iic_framework", 
							"UID"		=> "nsm", 
							"PWD"		=> "Admin@2008"
						);
$conn = sqlsrv_connect($serverName, $connectionInfo);

if(! $conn)
{
	 echo "Connection could not be established.\n";
	 echo '<hr />';
	 die(print_r( sqlsrv_errors(), true));

}
	
$sql = "SELECT * FROM Images";
$Query = sqlsrv_query($conn, $sql) or die ("Error Query [".$sql."]");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Add Image</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
img
{
	max-height: 150px;
	max-width: 150px;
}

td { white-space: pre; }
</style>
</head>

<body>
<a href="img_add.php">Add</a>
<hr />
<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
		<th>Img_Id</th>
		<th>Image</th>
		<th>Img_Name</th>
		<th>Img_Size</th>
		<th>Img_Type</th>
		<th>Download</th>
	</tr>
	<?php  while($objResult = sqlsrv_fetch_array($Query))  { ?>
	<tr>
		<td align="center"><?php echo $objResult["Img_Id"];?></td>
		<td><?php 
			if($objResult["Img_Type"] == 'image/pjpeg' || $objResult["Img_Type"] == 'image/jpeg')
			{
				echo '<img src="img_view.php?Img_Id='.$objResult["Img_Id"].'">';
			}
			else
			{
				echo '&nbsp;';
			}
			?></td>
		<td><?php echo $objResult["Img_Name"];?></td>
		<td><?php echo round($objResult["Img_Size"] / 1024 / 1024, 2) ;?> MB</td>
		<td><?php echo $objResult["Img_Type"];?></td>
		<td><a href="img_view.php?Img_Id=<?php echo $objResult["Img_Id"];?>">Download</a>
			</div></td>
	</tr>
	<?php } ?>
</table>
<?php sqlsrv_close($conn);?>
</body>
</html>
