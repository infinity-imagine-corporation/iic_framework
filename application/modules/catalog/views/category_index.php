<div id="content_top">
	<button class="button_create" rel="catalog/category/get_form">New Category</button>
	<div id="search_section">
		<label class="inline" for="quick_access">Category:</label>
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
	<button class="button_delete">Delete</button>
	<button class="button_move_up" rel="up">Move Up</button>
	<button class="button_move_down" rel="down">Move Down</button>
</div>