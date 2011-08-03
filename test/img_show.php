<?php

$serverName = "(local)";
$connectionInfo = array( 
							"Database"	=> "iic_framework", 
							"UID"		=> "nsm", 
							"PWD"		=> "Admin@2008"
						);
$conn = sqlsrv_connect($serverName, $connectionInfo);

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
	
$sql = "SELECT * FROM Images";
$Query = sqlsrv_query($conn, $sql) or die ("Error Query [".$sql."]");

?>
<a href="img_add.php">Add</a>
<hr />

<table width="100%" border="1" cellpadding="5" cellspacing="0">
  <tr> 
    <th> <div align="center">Img_Id</div></th>
    <th> <div align="center">Image</div></th>
    <th> <div align="center">Img_Name</div></th>
    <th>Img_Size</th>
    <th>Img_Type</th>
    <th>Download</th>
  </tr>
  <?php  while($objResult = sqlsrv_fetch_array($Query))  { ?>
  <tr> 
    <td><div align="center"><?php echo $objResult["Img_Id"];?></div></td>
    <td><center><img src="img_view.php?Img_Id=<?php echo $objResult["Img_Id"];?>"></center></td>
    <td><center><?php echo $objResult["Img_Name"];?></center></td>
    <td><div align="center"><?php echo $objResult["Img_Size"];?></div></td>
    <td><div align="center"> <?php echo $objResult["Img_Type"];?></div></td>
    <td><div align="center"><a href="img_view.php?Img_Id=<?php echo $objResult["Img_Id"];?>">Download</a></div></td>
  </tr>
  <?php } ?>
</table>

<?php sqlsrv_close($conn);?>