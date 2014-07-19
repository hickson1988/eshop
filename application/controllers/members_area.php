<?php

class Members_area extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}

	function success()
	{
		$data['title'] = "Welcome";
		$data['main_content'] = 'logged_in_area';
		$this->load->view('includes/template', $data);	
	}
	
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			echo 'You don\'t have permission to access this page.';
			echo anchor('site','Login');
			die();		
			//$this->load->view('login_form');
		}		
	}	

	function logout()
	{
		$this->session->sess_destroy();
		redirect('site');
	}
}
?>