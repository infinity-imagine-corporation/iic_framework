<div id="user_info"> 
	<b>Name : </b><?php echo $this->session->userdata('name'); ?>&nbsp;&nbsp; 
	<b>Group : </b><?php echo $this->session->userdata('group'); ?>&nbsp;&nbsp; 
	<b>Role : </b><?php echo $this->session->userdata('role'); ?>&nbsp;&nbsp; 
	<b>Date : </b><?php echo date('d / m / ').(date('Y')); ?> 
</div>
<div id="address">
	<?php
	//$address = anchor('backoffice/', 'หน้าหลัก');
	$address = '&nbsp;';
	
	if(isset($navigator))
	{
		foreach($navigator as $data)
		{
			$address .= '&nbsp;&nbsp;&#x25B6;&nbsp;&nbsp;'.$data['link'];
		}
	}
	
	echo $address;
	?>
</div>
