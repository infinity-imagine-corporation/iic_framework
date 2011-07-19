<ul class="menu_main">
	<li id="Home"><?php echo anchor('backoffice', 'Home') ?></li>
	
	<!-- modules -->
	<li id="Category"><?php echo anchor('backoffice/module/catalog/category/index', 'Category') ?></li>
	
	<!-- system -->
	<li class="float_r"><?php echo anchor('backoffice/module/backoffice/login/logout', 'Logout') ?></li>
	<li class="float_r"><a href="#">Option&nbsp;&nbsp;<span class="text_9">&#x25BC;</span></a>
		<ul>
			<li><?php echo anchor('backoffice/module/backoffice/user/user/', 'User') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/user/group/', 'User Group') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/user/role/', 'User Role') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/user/log/', 'User Logs') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/setting/system_module/', 'Module') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/setting/permission/', 'Module Permission') ?></li>
			<!--<li><a href="#">Theme</a></li>-->
			<!--<li><a href="#">Module</a></li>-->
		</ul>
	</li>
</ul>
