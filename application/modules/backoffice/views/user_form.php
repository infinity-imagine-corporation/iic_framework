<label for="name">Name : </label>
<input id="name" name="name" type="text" value="<?php echo $name ?>" />
<label for="username">Username : </label>
<input id="username" name="username" type="text" value="<?php echo $username ?>" />
<label for="password">Password : </label>
<input id="password" name="password" type="password" value="<?php echo $password ?>" />
<label for="id_group">Group : </label>
<select id="id_group" name="id_group">
<?php echo Modules::run('backoffice/user/get_group_selectbox_option', $id_group); ?>
</select>
<label for="id_role">Role : </label>
<select id="id_role" name="id_role">
<?php echo Modules::run('backoffice/user/get_role_selectbox_option', $id_role); ?>
</select>
<input id="id" name="id" type="hidden" value="<?php echo $id ?>" />