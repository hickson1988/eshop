<?php
class Signup extends CI_Controller{
	
	function index()
	{
		$data['title'] = "Signup";
		$data['main_content'] = 'signup_form';
		$data['validation']='1';
		$this->load->view('includes/template', $data);		
	}
	
	function newUser()
	{
		$this->load->model('membership');
			
		if($this->membership->create_member())
		{
			$data['title'] = "Succesfull Signup";
			$data['main_content'] = 'signup_success';
			$this->load->view('includes/template', $data);		
		}
		else
		{
			$data['title'] = "Signup";
			$data['main_content'] = 'signup_form';			
			$this->load->view('includes/template', $data);			
		}
	}
}
?>