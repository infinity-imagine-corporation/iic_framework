<div id="content_top">
	<a href="#" class="button_add">New Category</a>
	<div id="search_section">
		<label class="inline" for="quick_access">Quick access:</label>
		<select name="quick_access" id="quick_access"></select>
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
			echo'<tr><td colspan="'.count($th).'" class="center">No result found.</td></tr>';
	 	?>
	</tbody>
</table>
<div id="content_bottom">
	<?php echo anchor('backoffice/category/delete', 'Delete', 'class="button_delete"') ?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php echo anchor('backoffice/category/move_up', 'Move Up', 'class="button_move_up"') ?> 
	<?php echo anchor('backoffice/category/move_down', 'Move Down', 'class="button_move_down"') ?> 
</div>

<div id="dialog_add" class="dialog"></div>
<div id="dialog_edit" class="dialog"></div>