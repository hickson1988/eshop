<?php 
class Cart extends CI_Controller {
	
	function __construct()  
    {  
        parent::__construct(); 
		$this->load->model('cart_model');
    }  
	
	function index()
	{
		$data['title'] = "Cart";
		$data['main_content'] = 'cart_view';  
    	$this->load->view('includes/template', $data);	
	}
	
    function add_cart_item()
	{  
        if($this->cart_model->validate_add_cart_item() == TRUE)    
		{
			redirect('cart');     	
		}
    }  	
	
	function update_cart()
	{  
        $this->cart_model->validate_update_cart();  
		
       redirect('cart');
    }  
	
	function empty_cart()
	{  
        $this->cart->destroy(); 
       redirect('cart');
    }  
  
}

?>