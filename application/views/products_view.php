<div id="sidebar1">
		<div id="box1">
			<h2>Filters</h2>
       
			<ul id="feat_list">
			<?php //print_r($features);
			$attributes = array('name'=>'filter_form');
			echo form_open('products/show/category/'.$category,$attributes);		
            foreach ($features as $feat){ ?>
			<li>
            <h4><?php echo $feat['feat_name']; ?></h4>
            <h5><?php //echo $feat['feat_id']; ?></h5>
            <?php foreach ($feat['feat_opt'] as $option){ 	
			$ischecked=FALSE;
			if($remember_filters!=FALSE){
				if(in_array($feat['feat_id'].",".$option, $remember_filters))	
					$ischecked=TRUE;
			}
			?>
            <h5><?php echo $option; ?>: <?php echo form_checkbox('options[]', $feat['feat_id'].",".$option, $ischecked); ?></h5>
            <?php 

			} ?>
            </li>
            <?php } 
			$apply=array('name'=>'filter','value'=>'Apply','class'=>'link-style2');
		
			echo form_submit($apply);
            echo form_close(); ?>
            </ul>
		</div>
	</div>
	<div id="content">
    	
		<h2><?php 
		if ($query->num_rows() > 0){
			$row=$query->row(); echo $row->c_name; ?></h2>
			<?php echo $this->pagination->create_links(); ?>
			<ul id="product_list">
			<?php 
			foreach ($query->result() as $row)
			{ ?>
				<li>
				<h3><?php echo $row->p_name;?></h3>
				<p><?php echo $row->p_descr; ?><br><br>
				<span>Price: <?php echo $row->f_descr; ?>&euro;</span><br><br>
				<?php $atts['class']='link-style'; echo anchor('products/details/'.$row->p_id,'More...',$atts); ?></p>
				<img src="<?php echo base_url()."images/thumbs/".$row->image;?>">
				
				</li>
				<?php
			}
			?>
			</ul>
			<?php echo $this->pagination->create_links(); 
		}else{ ?>
			
			<h2><?php echo $title; ?></h2>
			<?php echo "No results.";}?>
        
	</div>