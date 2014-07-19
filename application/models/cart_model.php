<?php 

class Cart_model extends CI_Model {

	function retrieve_products()
	{  
    	$query = $this->db->get('product');   
    	return $query->result();  
    }  
	
	function validate_add_cart_item()
	{  
		$id = $this->input->post('product_id'); 
		$cty = $this->input->post('quantity'); 
		
		$this->load->model('products_model');
		$catid=$this->products_model->getProductCat($id);
		$price_id=$this->products_model->getPriceOptId($catid);
		
		$query = $this->db->query("SELECT * FROM product p,product_features pf WHERE idProduct=$id and idProduct_feat=idProduct GROUP BY idFeatures_feat HAVING idFeatures_feat=$price_id");
		
		if($query->num_rows > 0)
		{   
			foreach ($query->result() as $row)  
			{  
				$data = array(  
						'id'      => $id,  
						'qty'     => $cty,  
						'price'   => $row->feature_descr,  
						'name'    => $row->name  
				);  
				
				$this->cart->insert($data);  
	
				return TRUE;
			}  
		}else{  
			return FALSE;  
		}  
	}  
	
	function validate_update_cart()
	{  
		//$total = $this->cart->total_items();  
	
		$item = $this->input->post('rowid');  
		$qty = $this->input->post('qty');  
		
		for($i=0;$i < count($item);$i++)  
		{    
			  $data = array(  
				  'rowid' => $item[$i], 
				  'qty'   => $qty[$i]  
			   );  
			$this->cart->update($data);  
		}  
	}  
}

?>