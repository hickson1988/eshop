	<div id="sidebar1">
		<div id="box1_home">
			<h2>Welcome</h2>
			 Shopiteasy.com is a virtual website and dows not actually exist. This website is made for demonstration purposes only. The products used and the information concerning them were partially taken from third-party websites and thereby they might not be correct or up-to-date.
		</div>
	</div>
	<div id="content">
    <h2>Featured products</h2>
		<?php 
		if ($query->num_rows() > 0){ ?>
			<ul id="featured">
			<?php 
			foreach ($query->result() as $row)
			{ ?>
				<li>
				<h5><?php echo $row->p_name;?></h5>
				<img src="<?php echo base_url()."images/thumbs/".$row->image;?>" alt="">                
                <div id="price">Price: <?php echo $row->f_descr; ?>&euro;</div>			
                <div id="more"><?php $atts['class']='link-style'; echo anchor('products/details/'.$row->p_id,'More...',$atts); ?></div>	
				</li>
				<?php
			}
			?>
			</ul> 
		<?php }else{ ?>
			<?php echo "No results.";}?>
	</div>