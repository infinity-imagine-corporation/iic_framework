<form action="" method="post">
    <label for="id_category">Category : </label>
	<?php echo modules::run('category/get_category_select_box', $category['id_category']); ?>
    <label for="name">Name : </label>
    <input id="name" name="name" type="text" value="<?php echo $name ?>"/>
    <label for="description">Description : </label>
    <textarea name="description" rows="5" id="description"><?php echo $description ?></textarea>
    <label for="as">As : </label>
	<input name="as" type="text" id="as" value="<?php echo $as ?>">
    <label for="i_want_to">I want to : </label>
    <textarea name="i_want_to" rows="2" id="i_want_to"><?php echo $i_want_to ?></textarea>
    <label for="so_that">So that : </label>
    <textarea name="so_that" rows="2" id="so_that"><?php echo $so_that ?></textarea>
    <label for="priority">Priority : </label>
    <select id="priority" name="priority">
    	<option value="0" <?php if($priority == 0){echo 'selected';} ?>>0</option>
    	<option value="1" <?php if($priority == 1){echo 'selected';} ?>>1</option>
        <option value="2" <?php if($priority == 2){echo 'selected';} ?>>2</option>
        <option value="3" <?php if($priority == 3){echo 'selected';} ?>>3</option>
        <option value="4" <?php if($priority == 4){echo 'selected';} ?>>4</option>
    </select>
    <label for="important">Important : </label>
    <select id="important" name="important">
    	<option value="0" <?php if($important == 0){echo 'selected';} ?>>0</option>
    	<option value="1" <?php if($important == 1){echo 'selected';} ?>>1</option>
        <option value="2" <?php if($important == 2){echo 'selected';} ?>>2</option>
        <option value="3" <?php if($important == 3){echo 'selected';} ?>>3</option>
        <option value="4" <?php if($important == 4){echo 'selected';} ?>>4</option>
    </select>
    <label for="point">Point : </label>
    <select id="point" name="point">
    	<option value="0" <?php if($point == 0){echo 'selected';} ?>>0</option>
    	<option value="1" <?php if($point == 1){echo 'selected';} ?>>1</option>
        <option value="2" <?php if($point == 2){echo 'selected';} ?>>2</option>
        <option value="3" <?php if($point == 3){echo 'selected';} ?>>3</option>
        <option value="5" <?php if($point == 5){echo 'selected';} ?>>5</option>
        <option value="8" <?php if($point == 8){echo 'selected';} ?>>8</option>
        <option value="13" <?php if($point == 13){echo 'selected';} ?>>13</option>
    </select>
    <label for="id_working_status">Work status : </label>
	<?php echo modules::run('story/get_working_status_select_box', $id_working_status); ?>
    <label for="id_game_version">Release in game version : </label>
    <?php echo modules::run('story/get_game_version_select_box', $id_game_version); ?>
    <label for="id_iteration">Release in iteration : </label>
    <?php echo modules::run('story/get_iteration_select_box', $id_iteration); ?>
    <input id="old_category" name="old_category" type="hidden" value="<?php echo $category['id_category'] ?>" />
</form>