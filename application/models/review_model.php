<?php 

class Review_model extends CI_Model {

	function addReview()
	{		
		$new_review_data = array(
			'title' => $this->input->post('title'),
			'score' => $this->input->post('score'),
			'duration' => $this->input->post('duration'),		
			'positive' => $this->input->post('p_asp'),	
			'negative' => $this->input->post('n_asp'),	
			'comment' => $this->input->post('comments'),
			'User_idUser' => $this->uri->segment(3),
			'Product_idProduct' => $this->uri->segment(4)
		);
		
		$insert = $this->db->insert('review', $new_review_data);
		return $insert;
	}
	
	function isFirstReview()
	{
		$query = $this->db->query('SELECT * FROM review where User_idUser="'.$this->uri->segment(3).'" and Product_idProduct="'.$this->uri->segment(4).'"');
		if($query->num_rows >= 1)
		{
			return false;
		}
		else
		{
			return true;
		}
		
	}
	
	
}

?>