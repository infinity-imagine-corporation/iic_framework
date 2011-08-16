<ul class="menu_main">
	<li id="Home"><?php echo anchor('backoffice', $title) ?></li>
	
	<!-- User modules -->
	
	
	<!-- Backoffice module -->
	<li class="float_r"><?php echo anchor('backoffice/module/backoffice/login/logout', 'Logout') ?></li>
	<li class="float_r"><a href="#">Option<span class="text_9">&#x25BC;</span></a>
		<ul>
			<li><?php echo anchor('backoffice/module/backoffice/user/log/', 'Theme') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/user/user/', 'User') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/user/group/', 'User Group') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/user/role/', 'Rser Role') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/user/log/', 'System Log') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/setting/system_module/', 'Module') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/setting/permission/', 'Module Permission') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/setting/upload/', 'Upload Setting') ?></li>
			<!--<li><a href="#">Theme</a></li>-->
		</ul>
	</li>
</ul>
