<form action="" method="post">
    <label for="id_parent">Parent : </label>
    <?php echo modules::run('category/get_parent_select_box', $id_parent); ?>
    <label for="name">Name : </label>
    <input id="name" name="name" type="text" value="<?php echo $name ?>" />
    <label for="description">Description : </label>
    <textarea name="description" rows="5" id="description"><?php echo $description ?></textarea>
	<label for="enable">Status :
    	<label for="enable" class="normal"><input id="enable" name="is_enable" type="radio" value="1" <?php if($is_enable == 1){ echo 'checked'; } ?> /> enable </label>
    	<label for="disable" class="normal"><input id="disable" name="is_enable" type="radio" value="0" <?php if($is_enable == 0){ echo 'checked'; } ?> /> disable </label>
    </label>
    <input id="id_category" name="id_category" type="hidden" value="<?php echo $id_category ?>" />
</form>