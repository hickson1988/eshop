<h2>Welcome Back, <?php echo $this->session->userdata('username'); ?>!</h2>
     <p>This section represents the area that only logged in members can access.</p>
	<?php echo anchor('members_area/logout', 'Logout'); ?>