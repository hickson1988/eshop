<?php 

class Membership extends CI_Model {

	function validate()
	{
		$query = $this->db->query('SELECT * FROM user where username="'.$this->input->post('username').'" and password="'.md5($this->input->post('password')).'"');
		if($query->num_rows == 1)
		{
			$row = $query->row();
   			return $row->idUser;
		}
		else
			return -1;
		
	}
	
	function create_member()
	{		
		$new_member_insert_data = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'fullname' => $this->input->post('name'),		
			'email' => $this->input->post('email'),	
			'address'=> $this->input->post('address'),	
			'phone'=> $this->input->post('phone'),	
			'sex'=> $this->input->post('sex')
		);
		
		$insert = $this->db->insert('user', $new_member_insert_data);
		return $insert;
	}
	
}

?>