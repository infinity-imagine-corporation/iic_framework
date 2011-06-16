<?php
class Backoffice extends MX_Controller 
{	
	function index()
	{	
		Modules::run('backoffice/login/check_permission');
		
		$this->load->model('theme_model');
		
		$data['title'] = 'Dash Board';
		$data['theme'] = $this->theme_model->get_theme();
		$data['theme']['head_text1'] = $this->session->userdata('name');
		$data['theme']['head_text2'] = 'IIC Framework';
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