<?php 
class Reviews extends CI_Controller {

	
	function newReview()
	{
		$this->is_logged_in();
		
		$this->load->model('review_model');
		
		if($this->review_model->isFirstReview())
		{
			if($this->review_model->addReview())
				redirect($this->input->post('product_url'));
		}
		redirect($this->input->post('product_url'));
	}
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			echo 'You don\'t have permission to access this page.';
			echo anchor('site','Login');
			die();		
		}		
	}	
	
}
?>