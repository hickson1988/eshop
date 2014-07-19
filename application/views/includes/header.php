<!DOCTYPE html>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">-->
<!--<html xmlns="http://www.w3.org/1999/xhtml">-->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()."css/default.css"; ?>" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url()."css/navigation.css"; ?>" rel="stylesheet" type="text/css" media="all" />

<?php if(isset($validation)){ ?>
<link href="<?php echo base_url()."SpryAssets/SpryValidationTextField.css"; ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()."SpryAssets/SpryValidationPassword.css"; ?>" rel="stylesheet" type="text/css">

<script src="<?php echo base_url()."SpryAssets/SpryValidationTextField.js"; ?>" type="text/javascript"></script>
<script src="<?php echo base_url()."SpryAssets/SpryValidationPassword.js"; ?>" type="text/javascript"></script>
<?php } ?>

<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body>
<div id="header" class="container">
	<div id="login">
    <?php 
	
	$is_logged_in = $this->session->userdata('is_logged_in');
	if(isset($is_logged_in) && ($is_logged_in == true))
	{?>
    	<h4>Welcome Back, <?php echo $this->session->userdata('username'); ?>!</h4>
		<?php echo anchor('members_area/logout', 'Logout'); echo anchor('cart','View Cart','class="cartlink2"');
	}	
    else{	
	$attrib= array('id'=> 'forms');
	echo anchor('cart','View Cart','class="cartlink"');
	echo form_open('login/validate',$attrib); ?>
    <table width="300" cellspacing="5" cellpadding="5">
  <tr>
    <td>User name: </td>
    <td><input name="username" type="text" /></td>
  </tr>
  <tr>
    <td>Password: </td>
    <td><input name="password" type="password" /></td>
  </tr>
  <tr> 
    <td> <?php echo anchor('signup','Create account'); ?></td>
    <td><input name="login_submit" class="link-style2" type="submit" value="Login" /></td>
  </tr>
</table>

    <?php echo form_close(); 
	}?>
	</div>
	<div id="logo">
		<h1><a href="<?php echo base_url(); ?>">Shopiteasy.com</a></h1>
		<p>Because we love technology</p>
	</div>
</div>
<nav>
	<ul>
		<li><?php echo anchor(base_url(),'Home'); ?></li>
		<li><a href="#">Computers</a>
			<ul>
				<li><?php echo anchor('products/show/category/2/reset/1','Desktops'); ?></li>
				<li><?php echo anchor('products/show/category/1/reset/1','Laptops'); ?></li>
				<!--<li><a href="#">Web Design</a>
					<ul>
						<li><a href="#">HTML</a></li>
						<li><a href="#">CSS</a></li>
					</ul>
				</li>-->
			</ul>
		</li>
		<li><a href="#">Cameras</a>
			<ul>
				<li><?php echo anchor('products/show/category/3/reset/1','Dslr'); ?></li>
				<li><?php echo anchor('products/show/category/4/reset/1','Compact'); ?></li>
			</ul>
		</li>
	</ul>
</nav>

<!--<div id="menu" class="container">
	<ul>
		<li class="current_page_item"><a href="#" accesskey="1" title="">Homepage</a></li>
		<li><a href="#" accesskey="1" title="">Services</a></li>
		<li><a href="#" accesskey="2" title="">Our Clients</a></li>
		<li><a href="#" accesskey="3" title="">About Us</a></li>
		<li><a href="#" accesskey="4" title="">Careers</a></li>
		<li><a href="#" accesskey="5" title="">Contact Us</a></li>
	</ul>
</div>
-->

<div id="page" class="container">