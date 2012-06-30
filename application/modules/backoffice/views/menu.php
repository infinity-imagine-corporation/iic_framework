<ul class="menu_main">
	<li id="home"><?php echo anchor('backoffice', $this->lang->line('home')) ?></li>
	
	<!-- Institute modules -->
	<?php //echo Modules::run('institute/get_menu'); ?>
	
	<!-- Backoffice module -->
	<li id="logout" class="float_r"><?php echo anchor('backoffice/auth/logout', $this->lang->line('logout')) ?></li>
	<li id="option" class="float_r"><a href="#"><?php echo $this->lang->line('administration') ?><span class="text_9">&#x25BC;</span></a>
		<ul>
			<li><?php echo anchor('backoffice/user', $this->lang->line('page_user')) ?></li>
			<li><?php echo anchor('backoffice/user/group', $this->lang->line('page_group')) ?></li>
			<li><?php echo anchor('backoffice/user/role', $this->lang->line('page_role')) ?></li>
			<!--<li><?php echo anchor('backoffice/log', $this->lang->line('page_log')) ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/config/system_module/', 'Module') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/config/permission/', 'Module Permission') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/config/upload/', 'Configuration') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/config/theme/', 'Theme') ?></li>-->
		</ul>
	</li>
</ul>