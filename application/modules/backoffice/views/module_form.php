<form>
	<label for="name">Code : </label>
	<input id="code" name="code" type="text" value="<?php echo $code ?>" />
	<label for="name">Name : </label>
	<input id="name" name="name" type="text" value="<?php echo $name ?>" />
	<label for="label">Name : </label>
	<input id="label" name="label" type="text" value="<?php echo $label ?>" />
	<label for="description">Description : </label>
	<input id="description" name="description" type="text" value="<?php echo $description ?>" />
	<label for="uri">URI : </label>
	<input id="uri" name="uri" type="text" value="<?php echo $uri ?>" />
	<label>Status :</label>
	<label for="enable" class="normal">
		<input id="enable" name="is_enable" type="radio" value="1" <?php if($is_enable == 1){ echo 'checked="checked"'; } ?> />
		Enable </label>
	<label for="disable" class="normal">
		<input id="disable" name="is_enable" type="radio" value="0" <?php if($is_enable == 0){ echo 'checked="checked"'; } ?> />
		Disable </label>
	<input id="id" name="id" type="hidden" value="<?php echo $id ?>" />
</form>