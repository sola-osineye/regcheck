<div class="container">
<div class="row">
<div class="col-xs-12">
<?php if($this->form_validation->run() == TRUE){ echo '<p class="error_info">'.$display_message.'</p>' ;} ?>

<h4> You can get in touch with us by completing the form below </h4>
        <div>
		<?php echo validation_errors("<p class='error_info'>") ; ?>
		</div>
		<?php echo form_open('register/contact'); ?>
		<div>
		    <label for="firstName" class="description">First Name:</label>
	        <input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>" size="40" />
		</div> <br />
		<div>
		    <label for="lastName" class="description">Surname:</label>
	        <input type="text" name="lastname" value="<?php echo set_value('lastname'); ?>" size="40" />
		</div> <br />

		<div>
		    <label for="email" class="description">Email:</label>
	        <input type="text" name="email" value="<?php echo set_value('email'); ?>" size="40" />
		</div> <br />

		<div>
		    <label for="message" class="description">Message:</label>
	        <textarea name="message" value="<?php echo set_value('message'); ?>" cols="42" rows="6"></textarea>
		</div> <br />
		<div>
	       <input type="submit" name ="submit" value="Submit" />
      	</div>

	    <?php echo form_close(); ?>
	   	<hr />
</div>
</div>
</div>

