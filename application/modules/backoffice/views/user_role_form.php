<?php 
if(! isset($id))
{
	$id = '';
	$name = '';
} 
?>

<form>
	<label for="name"><?php echo $this->lang->line('page_role') ?></label>
	<input id="name" name="name" type="text" value="<?php echo $name ?>" />
	<input id="id" name="id" type="hidden" value="<?php echo $id ?>" />
</form>