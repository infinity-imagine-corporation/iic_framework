<div id="content_top">
	<div id="search_section">
		<input type="text" name="keyword" id="keyword" class="search_left" />
		<label class="inline" for="criteria">in:</label>
		<select name="criteria" id="criteria">
			<?php			
			foreach($th as $data)
			{
				echo '<option value="'.$data['axis'].'">'.$data['label'].'</option>';
			}
			?>
		</select>
	</div>
</div>
<table class="table">
	<thead>
		<tr>
			<th><input type="checkbox" id="select_all" /></th>
			<?php
			foreach($th as $data)
			{
				echo '<th axis="'.$data['axis'].'">'.$data['label'].'</th>';
			}
			?>
		</tr>
	</thead>
	<tbody>
		<?php echo'<tr><td colspan="'.(count($th) + 1).'" class="center">No result found.</td></tr>'; ?>
	</tbody>
</table>