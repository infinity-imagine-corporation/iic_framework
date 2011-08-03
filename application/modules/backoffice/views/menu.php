<ul class="menu_main">
	<li id="Home"><?php echo anchor('backoffice', 'หน้าหลัก') ?></li>
	
	<!-- User modules -->
	<li id="material"><?php echo anchor('backoffice/module/material/material/material/', 'วัสดุตัวอย่าง') ?></li>
	<li><a href="#">รายงาน<span class="text_9">&#x25BC;</span></a>
		<ul>
			<li><?php echo anchor('backoffice', 'บัตรประจำตัวชิ้นงาน') ?></li>
			<li><?php echo anchor('backoffice', 'สมุดทะเบียนวัสดุตัวอย่าง') ?></li>
			<li><?php echo anchor('backoffice', 'สรุปการดำเนินงานรายไตรมาส') ?></li>
			<li><?php echo anchor('backoffice', 'วัสดุตัวอย่างวัสดุตามปี') ?></li>
			<li><?php echo anchor('backoffice', 'วัสดุตัวอย่างตามประเภท') ?></li>
			<li><?php echo anchor('backoffice', 'วัสดุตัวอย่างตามสาขาวิชา') ?></li>
			<li><?php echo anchor('backoffice', 'วัสดุตัวอย่างตามผู้บริจาค') ?></li>
			<li><?php echo anchor('backoffice', 'วัสดุตัวอย่างตามสถานที่จัดเก็บ') ?></li>
			<li><?php echo anchor('backoffice', 'วัสดุตัวอย่างตามสถานะ') ?></li>
			<li><?php echo anchor('backoffice', 'บันทึกการใช้งานระบบ') ?></li>
		</ul>
	</li>
	
	<!-- Backoffice module -->
	<li class="float_r"><?php echo anchor('backoffice/module/backoffice/login/logout', 'ออกจากระบบ') ?></li>
	<li class="float_r"><a href="#">ผู้ดูแลระบบ<span class="text_9">&#x25BC;</span></a>
		<ul>
			<li><?php echo anchor('backoffice/module/backoffice/user/user/', 'บัญชีผู้ใช้ระบบ') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/user/group/', 'หน่วยงาน / สังกัด ผู้ใช้ระบบ') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/user/role/', 'ตำแหน่ง / หน้าที่ ผู้ใช้ระบบ') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/setting/upload/', 'ประเภทและขนาดไฟล์ อัพโหลด') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/user/log/', 'บันทึกการใช้งานระบบ (Site log)') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/setting/system_module/', 'Module') ?></li>
			<li><?php echo anchor('backoffice/module/backoffice/setting/permission/', 'Module Permission') ?></li>
			<!--<li><a href="#">Theme</a></li>-->
		</ul>
	</li>
	
	<!-- Admin modules -->
	<li class="float_r">
		<a href="#">ข้อมูลการตั้งค่า<span class="text_9">&#x25BC;</span></a>
		<ul class="sub_menu">
			<li><?php echo anchor('backoffice/module/material/category/category/', 'ประเภทวัสดุ') ?></li>
			<li><?php echo anchor('backoffice/module/material/group/group/', 'กลุ่มวัสดุ') ?></li>
			<li><?php echo anchor('backoffice/module/material/department/department/', 'กลุ่มสาขาวิชา') ?></li>
			<li><?php echo anchor('backoffice/module/material/acquisition/acquisition/', 'วิธีการได้มา') ?></li>
			<li><?php echo anchor('backoffice/module/material/status/status/', 'สถานะของวัสดุ') ?></li>
			<li>
				<span class="text_9 float_r">&#x25BA;</span><a href="#">สถานที่เก็บ</a>
				<ul>
					<li><?php echo anchor('backoffice/module/location/building/building/', 'อาคาร') ?></li>
					<li><?php echo anchor('backoffice/module/location/floor/floor/', 'ชั้น') ?></li>
					<li><?php echo anchor('backoffice/module/location/zone/zone/', 'พื้นที่') ?></li>
					<li><?php echo anchor('backoffice/module/location/shelf/shelf/', 'ชั้นวาง') ?></li>
				</ul>
			</li>
			<li>
				<span class="text_9 float_r">&#x25BA;</span><a href="#">บันทึกการใช้งานระบบ (Site log)</a>
				<ul>
					<li><?php echo anchor('backoffice/module/unit/unit/quantity/', 'หน่วยนับ') ?></li>
					<li><?php echo anchor('backoffice/module/unit/unit/size/', 'หน่วยวัด') ?></li>
				</ul>
			</li>			
			<li>
				<span class="text_9 float_r">&#x25BA;</span><a href="#">การบริจาค</a>
				<ul>
					<li><?php echo anchor('backoffice/module/donation/donator/type/', 'ประเภทผู้บริจาค') ?></li>
					<li><?php echo anchor('backoffice/module/donation/donator/name/', 'ราขขื่อผู้บริจาค') ?></li>
					<li><?php echo anchor('backoffice/module/donation/donatee/name/', 'รายชื่อหน่วยงานผู้รับมอบ') ?></li>
				</ul>
			</li>	
		</ul>
	</li>
</ul>
