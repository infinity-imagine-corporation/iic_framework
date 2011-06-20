<?php
class Backoffice extends MX_Controller 
{	
	function index()
	{	
		Modules::run('backoffice/login/check_permission');
		
		$this->load->model('theme_model');
		$data['theme'] = $this->theme_model->get_theme();
		
		$data['title'] = 'Home';
		$data['main_content'] = 'dashboard';
		
		$this->load->view('main', $data);
	}
	
	function dashboard()
	{
		$this->load->view('dashboard');
	}
}

/* End of file backoffice.php */
/* Location: application/modules/backoffice/controllers/backoffice.php */