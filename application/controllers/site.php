<?php 
class Site extends CI_Controller {

	public function index()
	{
		$this->load->model('products_model');
		$query=$this->products_model->getFeatProd();
		
		$data['title'] = "Home";
		$data['main_content'] = 'homepage';
		$data['query'] = $query;
		$this->load->view('includes/template', $data);		
	}
	
}
?>