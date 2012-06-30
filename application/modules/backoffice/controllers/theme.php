<?php
class Theme extends IIC_Controller {
	
	function get_theme()
	{
		// Load model
		$this->load->model('backoffice/theme_model');
		
		return $this->theme_model->get_theme();
	}
}


/* End of file theme.php */
/* Location: ./application/modules/backoffice/controllers/theme.php */
