<div id="content_top">
	<div id="search_section">
		<label class="inline" for="quick_access">Module: </label>
		<select name="quick_access" id="quick_access">
		<?php echo Modules::run('backoffice/setting/get_module_selectbox_option', $id_role); ?>
		</select>
	</div>
</div>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Group</a></li>
		<li><a href="#tabs-2">Role</a></li>
		<li><a href="#tabs-3">User</a></li>
	</ul>
	<div id="tabs-1">
		<table id="table_group" class="table">
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
				<?php echo'<tr><td colspan="'.count($th).'" class="center">No result found.</td></tr>'; ?>
			</tbody>
		</table>
	</div>
	<div id="tabs-2">
		<table id="table_role" class="table">
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
				<?php echo'<tr><td colspan="'.count($th).'" class="center">No result found.</td></tr>'; ?>
			</tbody>
		</table>
	</div>
	<div id="tabs-3">
		<table id="table_user" class="table">
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
				<?php echo'<tr><td colspan="'.count($th).'" class="center">No result found.</td></tr>'; ?>
			</tbody>
		</table>
	</div>
</div>

<div id="content_bottom" class="center">
	<button class="button_save" rel="<?php echo $module ?>/<?php echo $controller ?>/save_permission" >Save</button>
</div>