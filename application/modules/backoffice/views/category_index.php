<div id="preload">Loading...</div>
<div id="content_top">
	<?php //echo anchor('backoffice/category/add', 'New Category', 'class="button_add float_r"') ?>
	<a href="#" class="button_add">New Category</a>
	<div id="search_section">
		<label class="inline" for="keyword">Quick access:</label>
		<?php echo Modules::run('backoffice/category/get_category_selectbox'); ?>
	</div>
	
</div>
<table class="table">
	<thead>
		<tr>
			<?php
		foreach($th as $data)
		{
			echo '<th axis="'.$data['axis'].'">'.$data['label'].'</th>';
		}
	 	?>
		</tr>
	</thead>
	<tbody>
		<?php
		if($category)
		{
			$loop = 1;
			foreach($category as $data)
			{
				$status = ($data['is_enable']) ? 'Enable' : 'Disable';
				echo '<tr>
						<td><input type="checkbox" id="id_'.$loop.'" name="id[]" value="'.$data['id_category'].'"></td>
						<td>'.$data['name'].'</td>
						<td>'.$status.'</td>
					</tr>';
			}
		}
		else
		{
			echo'<tr><td colspan="'.count($th).'" class="center">No result found.</td></tr>';
		}
	 	?>
	</tbody>
</table>
<div id="content_bottom">
	<?php echo anchor('backoffice/category/delete', 'Delete', 'class="button_delete"') ?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php echo anchor('backoffice/category/move_up', 'Move Up', 'class="button_move_up"') ?> 
	<?php echo anchor('backoffice/category/move_down', 'Move Down', 'class="button_move_down"') ?> 
</div>

<div id="dialog"></div>