<ul class="menu_main">
	<li id="Home"><?php echo anchor('backoffice', 'Home') ?></li>
	
	<!-- modules -->
	<li id="Category"><?php echo anchor('backoffice/module/catalog/category/index', 'Category') ?></li>
	
	<!-- system -->
	<li class="float_r"><?php echo anchor('backoffice/login/logout', 'Logout') ?></li>
	<li class="float_r"><a href="#">Option&nbsp;&nbsp;<span class="text_8">▼</span></a>
		<ul>
			<li><a href="#">User</a></li>
			<li><?php echo anchor('backoffice/user_group/', 'User Group') ?></li>
			<li><a href="#">Theme</a></li>
			<li><a href="#">Module</a></li>
		</ul>
	</li>
</ul>
