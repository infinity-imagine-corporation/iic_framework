<div id="user_info"> 
	<b><?php echo $this->lang->line('name') ?> : </b><?php echo $this->session->userdata('name'); ?>&nbsp;&nbsp; 
	<b><?php echo $this->lang->line('page_group') ?> : </b><?php echo $this->session->userdata('group'); ?>&nbsp;&nbsp; 
	<b><?php echo $this->lang->line('page_role') ?> : </b><?php echo $this->session->userdata('role'); ?>&nbsp;&nbsp; 
	<b><?php echo $this->lang->line('date') ?> : </b><?php echo date('d / m / ').(date('Y')); ?> 
</div>
<div id="address">
	<?php
	$address = '';
	
	if(isset($navigator))
	{
		foreach($navigator as $data)
		{
			if($data['link'] == 'backoffice')
			{
				$address .= anchor($data['link'], $data['label']);
			}
			else 
			{
				$address .= '&nbsp;&nbsp;<span style="font-size: 0.4em">&#x25B6;</span>&nbsp;&nbsp;'.anchor($data['link'], $data['label']);
			}
		}
	}
	
	echo $address;
	?>
</div>
