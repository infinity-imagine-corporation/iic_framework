<?php 
if(! isset($id))
{
	$id = '';
	$name = '';
	$username = '';
	$password = '';
	$id_group = '';
	$id_role = '';
} 
?>

<form>
	<label for="name"><?php echo $this->lang->line('name') ?></label>
	<input id="name" name="name" type="text" value="<?php echo $name ?>" />
	
	<label for="username"><?php echo $this->lang->line('username') ?></label>
	<input id="username" name="username" type="text" value="<?php echo $username ?>" />
	
	<label for="password"><?php echo $this->lang->line('password') ?></label>
	<input id="password" name="password" type="password" value="<?php echo $password ?>" />
	
	<label for="id_group"><?php echo $this->lang->line('page_group') ?></label>
	<select id="id_group" name="id_group">
		<?php echo Modules::run('backoffice/user_group/get_group_selectbox_option', $id_group); ?>
	</select>
	
	<label for="id_role"><?php echo $this->lang->line('page_role') ?></label>
	<select id="id_role" name="id_role">
		<?php echo Modules::run('backoffice/user_role/get_role_selectbox_option', $id_role); ?>
	</select>
	
	<input id="id" name="id" type="hidden" value="<?php echo $id ?>" />
</form>
