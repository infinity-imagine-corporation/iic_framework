<ul class="menu_main">
	<li id="home"><?php echo anchor('backoffice', 'Home') ?></li>
	<li id="news"><?php echo anchor('backoffice/news', 'News / Promotion') ?></li>
	
	<!-- Another modules -->
	<!--<li id="kingdom"><a href="#">อาณาจักร<span class="text_9">&#x25BC;</span></a>
		<ul>
			<li><?php echo anchor('kingdom', 'ก๊ก') ?></li>
			<li><?php echo anchor('kingdom/map', 'แผนที่') ?></li>
		</ul>
	</li>-->
	
	<!-- Backoffice module -->
	<li id="logout" class="float_r"><?php echo anchor('backoffice/module/backoffice/login/logout', 'Logout') ?></li>
	<li id="option" class="float_r"><a href="#">Advance Option<span class="text_9">&#x25BC;</span></a>
		<ul>
			<li><?php echo anchor('backoffice/user', 'User') ?></li>
			<li><?php echo anchor('backoffice/user/group', 'User Group') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/user/role/', 'User Role') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/user/log/', 'System Log') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/config/system_module/', 'Module') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/config/permission/', 'Module Permission') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/config/upload/', 'Configuration') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/config/theme/', 'Theme') ?></li>
		</ul>
	</li>
</ul>
