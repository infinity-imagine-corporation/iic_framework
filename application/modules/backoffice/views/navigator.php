<div id="user_info"> 
	<b>Name : </b><?php echo $this->session->userdata('name'); ?>&nbsp;&nbsp; 
	<b>Group : </b><?php echo $this->session->userdata('group'); ?>&nbsp;&nbsp; 
	<b>Role : </b><?php echo $this->session->userdata('role'); ?>&nbsp;&nbsp; 
	<b>Date : </b><?php echo date('d / m / ').(date('Y')); ?> 
</div>
<div id="address">
	<?php 
	if($module !=  'Backoffice')
	{
		 echo  'Backoffice&nbsp;&nbsp;&#x25B6;&nbsp;&nbsp;';
	}
	
	if($module !=  $controller)
	{
		 echo  $module . '&nbsp;&nbsp;&#x25B6;&nbsp;&nbsp;';
	}
	
	if($controller !=  $title)
	{
		 echo  $controller . '&nbsp;&nbsp;&#x25B6;&nbsp;&nbsp;';
	}
	
	echo $title 
	?>
</div>
