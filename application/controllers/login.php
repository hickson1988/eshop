<?php
class Login extends CI_Controller{
	
	public function validate()
	{
		$this->load->model('membership');
		$uid = $this->membership->validate();
		
		if($uid!=-1)
		{
			$data = array(
				'username' => $this->input->post('username'),
				'uid' => $uid,
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('members_area/success');
		}
		else
		{
			 redirect('site');
		}
	}
	
}


?>