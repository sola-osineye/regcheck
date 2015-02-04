<div class="container">
<div class="row">
<div class="col-xs-12">

<h3>Current opportunities</h3>
We are a tight-knit team here at Regcheckr, made up of highly skilled techies, creative designers, strategic thinkers and forward-looking new businessand marketing experts.
We’re a fast paced company constantly looking for opportunities to innovate and grow. We are currently hiring for the following role in Nigeria…
<h3>Front End Developer – mid weight</h3>
<ul>
<li>Permanent/fulltime.</li>
<li>Salary dependent on experience.</li>
</ul>
<p>Find out more about this role by contacting us through our Contact Page Or...</p>
<h3>Complete the form below and send us your CV </h3>


<?php echo validation_errors("<p class='error_info'>") ; ?>
      <?php echo form_open_multipart('career/do_upload');?>
      <div>
        <input type="file" name="userfile" size="20" />
       </div>
   <h4 class="error_info"> <?php echo $error;?></h4>
       <br/>
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
		    <label for="phone" class="description">Phone Number:</label>
	        <input type="text" name="phone" value="<?php echo set_value('phone'); ?>" size="40" />
		</div> <br />

		<div>
		    <label for="message" class="description">Message:</label>
	        <textarea name="message" value="<?php echo set_value('message'); ?>" cols="42" rows="6"></textarea>
		</div> <br />

		<div>
	       <input type="submit" name ="submit" value="Submit" />
      	</div>

	    <?php echo form_close(); ?>
	   	<hr /><br />
<h4>Don’t see a relevant role above?</h4>
<p>Don’t worry, we’re always on the lookout for individuals who have the same passion for digital that we do.
So if you’re looking to develop your career in the webdevelopment/digital sector and want to join our friendly team at this
exciting point in our journey please send your CV and salary expectations to careers@regcheckr.com

<h4>Skills/experience that we often look for include:</h4>
<ul>
<li>Back End Open Source development (primarily Drupal & WordPress)</li>
<li>Front End Development</li>
<li>User Experience (desktop, tablet and mobile)</li>
<li>Graphic Design</li>
<li>Web infrastructure set-up and maintenance</li>
<li>Online Marketing</li>
<li>Account and Project Management</li>
<li>New Business Development</li>
</ul>


</div>
</div>
</div>
<br />

