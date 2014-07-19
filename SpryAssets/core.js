// JavaScript Document

    $(document).ready(function() {  
       
        var link = "http://localhost/eshop/"; // Url to your application (including index.php/)  
        $("ul#feat_list").submit(function() {  
            // Get the product ID and the quantity  
            var id = $(this).find('input[name=product_id]').val();  
            var qty = $(this).find('input[name=quantity]').val();  
            $.post(link + "products/show", { product_id: id, quantity: qty, ajax: '1' },  
                    function(data){  
                        // Interact with returned data  
                 });  
            return false; // Stop the browser of loading the page defined in the form "action" parameter.  
        });  
    });  