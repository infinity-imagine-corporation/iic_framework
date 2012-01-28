<ul class="menu_main">
	<li id="home"><?php echo anchor('backoffice', 'หน้าหลัก') ?></li>
	
	<!-- Another modules -->
	<li id="kingdom"><a href="#">อาณาจักร<span class="text_9">&#x25BC;</span></a>
		<ul>
			<li><?php echo anchor('kingdom', 'ก๊ก') ?></li>
			<li><?php echo anchor('kingdom/map', 'แผนที่') ?></li>
		</ul>
	</li>
	<li id="character"><a href="#">ตัวละคร<span class="text_9">&#x25BC;</span></a>
		<ul>
			<li><?php echo anchor('character/stats', 'ค่าพลัง') ?></li>
			<li><?php echo anchor('character/status', 'สถานะพิเศษ') ?></li>
			<li><?php echo anchor('character/skill', 'ทักษะ (Skill)') ?></li>
			<li><?php echo anchor('hero', 'ขุนพล') ?></li>
			<li><?php echo anchor('enemy', 'ข้าศึก') ?></li>
			<li><?php echo anchor('army', 'กองกำลังข้าศึก') ?></li>
		</ul>
	</li>
	<li id="job"><a href="#">อาชีพ<span class="text_9">&#x25BC;</span></a>
		<ul>
			<li><?php echo anchor('job/job', 'สายอาชีพ (Job)') ?></li>
			<li><?php echo anchor('job/job_class', 'ระดับขั้นของอาชีพ (Class)') ?></li>
		</ul>
	</li>
	<li id="item"><a href="#">สิ่งของ<span class="text_9">&#x25BC;</span></a>
		<ul>
			<li><?php echo anchor('item/type', 'ประเภท (Item Type)') ?></li>
			<li><?php echo anchor('item', 'สิ่งของ (Item)') ?></li>
		</ul>
	</li>
	
	<!-- Backoffice module -->
	<li id="logout" class="float_r"><?php echo anchor('backoffice/module/backoffice/login/logout', 'ออกจากระบบ') ?></li>
	<!--<li id="option" class="float_r"><a href="#">Option<span class="text_9">&#x25BC;</span></a>
		<ul>
			<li><?php echo anchor('backoffice/module/backoffice/user/user/', 'User') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/user/group/', 'User Group') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/user/role/', 'User Role') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/user/log/', 'System Log') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/config/system_module/', 'Module') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/config/permission/', 'Module Permission') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/config/upload/', 'Configuration') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/config/theme/', 'Theme') ?></li>
		</ul>
	</li>-->
</ul>
