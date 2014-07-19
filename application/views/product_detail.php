	<div id="content">
    	<?php $row=$query->row();?>
		<h2><?php echo $row->p_name; ?></h2>   
        <div id="p_detail"><?php echo $row->p_descr; ?><br><br>
        <?php foreach ($query->result() as $row){ 
				if($row->f_name=='Price'){?>
        			<span>Price: <?php echo $row->f_descr; ?>&euro;</span><br><br>
                    <?php break; ?>
        	<?php }
			} 
			
		  /*************Cart********/
		  echo form_open('cart/add_cart_item'); ?>  
          <fieldset>  
          <label>Quantity</label>  
          <?php echo form_input('quantity', '1','size="2"'); ?>  
          <?php echo form_hidden('product_id', $row->p_id); ?>  
          <?php echo form_submit('add', 'Add to cart'); ?>  
          </fieldset>  
          <?php echo form_close();  
		 /*************Cart********/
		 ?> 
         
        Category: <?php echo $row->c_name;?><br /><br />
        </div>
		<img src="<?php echo base_url()."images/thumbs/".$row->image;?>">
        <div id="reviews">
        <?php
        $is_logged_in = $this->session->userdata('is_logged_in');
		if(isset($is_logged_in) && ($is_logged_in == true))
		{ ?>
            <fieldset id="signup_field">
            <legend>New Review</legend>
            <?php
            $form_atts=array('id'=>'forms');
            echo form_open('reviews/newReview/'.$this->session->userdata('uid').'/'.$row->p_id,$form_atts);
            ?>
            <table width="" cellspacing="3" cellpadding="3">
            <tr><td>Title: </td><td><?php echo form_input('title'); ?></td></tr>
            <?php 		
            $score = array(
                      '1'	=> '1',
                      '2'	=> '2',      
                      '3'	=> '3', 
                      '4'    => '4', 
                      '5'    => '5' 
                    ); 
            
            $duration = array(
                      '1-7 days'	=> '1-7 days',
                      '1-4 weeks'	=> '1-4 weeks',     
                      '1-12 months'	=> '1-12 months', 
                      'more than a year'    => 'more than a year' 
                    );
            ?>
            <tr><td>Score: </td><td><?php echo form_dropdown('score', $score, 'one'); ?></td></tr>
            <tr><td>Duration: </td><td><?php echo form_dropdown('duration', $duration, 'day'); ?></td></tr>
            <?php 
            $p_asp = array(
                      'name'	=> 'p_asp',
                      'maxlength'   => '200',
                      'rows'        => '2'       		  
                    );
            $n_asp = array(
                      'name'	=> 'n_asp',
                      'maxlength'   => '200',
                      'rows'        => '2'       		  
                    );
            $comments = array(
                      'name'	=> 'comments',
                      'maxlength'   => '200',
                      'rows'        => '2'       		  
                    );
            ?>
            <tr><td>Positive aspects: </td><td><?php echo form_textarea($p_asp); ?></td></tr>
            <tr><td>Negative aspects: </td><td><?php echo form_textarea($n_asp); ?></td></tr>
            <tr><td>Other comments: </td><td><?php echo form_textarea($comments); ?></td></tr>
            <?php echo form_hidden('product_url',uri_string()); ?>
            <tr><td></td><td><?php 
            $submit_signup=array('name'=>'submit_review',
                          'value'=>'Submit',
                          'class'=>'link-style2'
                          );
            echo form_submit($submit_signup); ?></td></tr>      
            </table>
            <?php echo form_close(); ?>
            </fieldset>
		<?php }
	
			if($reviews->num_rows > 0)
			{ ?>
            	<h4>Reviews</h4>
                <ul id="review_list">            
                <?php foreach ($reviews->result() as $review){ ?>
                : <span><?php echo $review->username; ?></span>
                <li>
                <table width="" cellspacing="2" cellpadding="2">
                <tr><td><b>Title: </b></td><td><?php echo $review->title; ?></td></tr>
                <tr><td><b>Score: </b></td><td><?php echo $review->score; ?> out of 5</td></tr>
                <tr><td><b>Duration: </b></td><td><?php echo $review->duration; ?></td></tr>
                <tr><td><b>Positive: </b></td><td><?php echo $review->positive; ?></td></tr>
                <tr><td><b>Negative: </b></td><td><?php echo $review->negative; ?></td></tr>
                <tr><td><b>Comments: </b></td><td><?php echo $review->comment; ?></td></tr>
    			</table>              
                </li>
                <?php } ?>
                </ul>
            <?php } ?>
        </div>
        <h4>Features</h4>
        <p id="features">
        <ul id="features_list">
        <?php 
        foreach ($query->result() as $row)
		{ 
			if($row->f_name!='Price'){?>
			<li>
            <span><b><?php echo $row->f_name;?></b>: <?php echo $row->f_descr;?></span><br><br>      
            </li>
			<?php }
		}
	?>
    	</ul>
	</div>