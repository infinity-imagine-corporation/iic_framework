<?php
class Backoffice extends MX_Controller 
{	
	function index()
	{	
		Modules::run('backoffice/login/check_permission');
		
		$this->load->model('theme_model');
		$data['theme']	= $this->theme_model->get_theme();
		
		$data['module']		= 'backoffice';
		$data['controller']	= 'backoffice';
		$data['page']		= 'dashboard';
		$data['title']		= 'Home';
		
		$this->load->view('main', $data);
	}
	
	function module($module, $controller, $page = '')
	{	
		Modules::run('backoffice/login/check_permission');
		echo Modules::run($module.'/'.$controller.'/'.$page);
	}
	
	function dashboard()
	{
		$this->load->view('dashboard');
	}
}

/* End of file backoffice.php */
/* Location: application/modules/backoffice/controllers/backoffice.php */