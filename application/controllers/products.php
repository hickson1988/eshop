<?php

class Products extends CI_Controller {
	
	function index()
	{
	}
	
	function show()
	{
		
		$this->load->library('pagination');
		$this->load->model('products_model');

		$default = array('category','reset');
		$array = $this->uri->uri_to_assoc(3, $default);	
		
		$options='';

		if($array['reset']!=1)		//an den erxomaste apo to menu alla eimaste mesa se kapoia kathgoria
		{
			$from=$this->uri->segment(5);
			if($this->input->post('options'))	//an exoume kainourgia filters kataxorhse t
			{
				$newfilters = array(
						   'filters'  => $this->input->post('options')
					   );
				$this->session->set_userdata($newfilters);
				$options=$this->input->post('options');
			}
			else if(!$this->input->post('options') && $_POST)	//an exoume kainourgia filters me kamia epilogh
			{
				$newfilters = array(
						   'filters'  => array()
					   );
				$this->session->set_userdata($newfilters);
				$options=$this->input->post('options');			
			}
			else								//an aplos kaneis pagination me ta idia filtra krathse t
				$options = $this->session->userdata('filters');
		}
		else	//an erxomaste apo to menu kane reset ola ta filtra
		{
			$this->session->unset_userdata('filters');
			$from=$this->uri->segment(7);
		}
		
		
		$config['base_url'] = base_url().'products/show/category/'.$array['category'];
		$config['total_rows'] = $this->products_model->getCatCount($array['category'],$options);
		$config['per_page'] = 2;
		$config['num_links'] = 5;
		$config['uri_segment'] = 5;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		
		$this->pagination->initialize($config);
		
		$query=$this->products_model->getByCat($array['category'],$from,$config['per_page'],$options);
		$features=$this->products_model->getFeatures($array['category']);
		
		//print_r($this->input->post('options'));
		
		$data['title'] = $this->products_model->getCatName($array['category']);
		$data['main_content'] = 'products_view';
		$data['query'] = $query;
		$data['features'] = $features;
		$data['category'] = $array['category'];
		$data['remember_filters'] = $options;
		$this->load->view('includes/template', $data);		
	}	
	
	function details()
	{
		$pid=$this->uri->segment(3);
		$this->load->model('products_model');
		$query=$this->products_model->getProductDetails($pid);
		$reviews=$this->products_model->getProductReviews($pid);
		
		$row=$query->row();
		
		$data['title'] = $row->p_name;
		$data['main_content'] = 'product_detail';
		$data['query'] = $query;
		$data['reviews'] = $reviews;
		$this->load->view('includes/template', $data);		
	}
	
	
	/*function createThumbs($query)
	{
		 foreach ($query->result() as $row)
		{		
		 	$config['image_library'] = 'gd2';
			$config['source_image'] = 'images/'.$row->image;
			$config['new_image'] = "images/thumbs/".$row->image;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 150;
			$config['height'] = 150;
			echo $config['source_image'];
			$this->load->library('image_lib', $config);
			if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
		}
	
	}*/
	
}

?>