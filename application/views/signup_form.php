<div id="content">
		<h2>Create an account</h2>
      <fieldset id="signup_field">
		<legend>Personal Information</legend>
		<?php
		$form_atts=array('id'=>'forms');
		echo form_open('signup/newUser',$form_atts);
		?>
        <table width="" cellspacing="5" cellpadding="5">
        <tr><td>User name: </td><td> <span id="sprytextfield1"><?php echo form_input('username').'*'; ?> <span class="textfieldRequiredMsg">A value is required.</span></span></td></tr>
		<tr><td>Password: </td><td><span id="sprypassword1"><?php echo form_password('password').'*'; ?> <span class="passwordRequiredMsg">A value is required.</span><span class="passwordMaxCharsMsg">Exceeded maximum number of characters.</span></span></td></tr>
        <tr><td>Full name: </td><td><?php echo form_input('name'); ?></td></tr>
        <tr><td>Email: </td><td><span id="sprytextfield2"><?php echo form_input('email').'*'; ?><span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td></tr>
		<tr><td>Address: </td><td><?php echo form_input('address'); 
		
		$sex_options = array(
                  'male'  => 'Male',
                  'female'    => 'Female'              
                ); ?></td></tr>
		<tr><td>Sex: </td><td><?php echo form_dropdown('sex', $sex_options, 'male'); ?></td></tr>
		<tr><td>Phone: </td><td><?php echo form_input('phone');  ?></td></tr>	
		<tr><td></td><td><?php 
		$submit_signup=array('name'=>'submit_signup',
					  'value'=>'Create',
					  'class'=>'link-style2'
					  );
		echo form_submit($submit_signup); ?></td></tr>      
        </table>
        <p>* Required fields</p>
      </fieldset>
        <?php echo form_close(); ?>
        
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {maxChars:15});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email");
//-->
</script>
