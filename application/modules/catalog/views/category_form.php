<form>
	<label for="id_parent">Parent : </label>
	<?php echo Modules::run('catalog/category/get_parent_selectbox', $id_parent); ?>
	<input id="id_parent_old" name="id_parent_old" type="hidden" value="<?php echo $id_parent ?>" />
	<label for="name">Name : </label>
	<input id="name" name="name" type="text" value="<?php echo $name ?>" />
	<label for="description">Description : </label>
	<textarea name="description" rows="5" id="description"><?php echo $description ?></textarea>
	<label>Status :</label>
	<label for="enable" class="normal">
		<input id="enable" name="is_enable" type="radio" value="1" <?php if($is_enable == 1){ echo 'checked="checked"'; } ?> />
		Enable 
	</label>
	<label for="disable" class="normal">
		<input id="disable" name="is_enable" type="radio" value="0" <?php if($is_enable == 0){ echo 'checked="checked"'; } ?> />
		Disable 
	</label>
	<input id="id_category" name="id_category" type="hidden" value="<?php echo $id_category ?>" />
</form>
