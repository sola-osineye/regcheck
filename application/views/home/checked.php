<div id="topmost">

     <img src="<?php echo base_url(); ?>img/regcheckr_logo__reverse1.png" />
	<div class="row">
	   <div class="col-xs-12">
	     <hgroup>
          <h5>
            Check Nafdac Drug Registration Number.
          </h5>
          <h4 class="free">For Free</h4>
         </hgroup>
       </div>
     </div>
     <div class="row">
	   <div class="well col-xs-12 col-sm-4 col-sm-offset-4">
	   <?php echo form_open('register/search', 'id="drugs_description"'); ?>
	    <input type="text" name="registration_no" id="registration_no" value="<?php echo set_value('registration_no'); ?>" class="form-control" /><br />
	    <input type="submit" name ="search" value="Search" class="btn btn-primary btn-block" />
         <div id="product_description" class="product_describe"></div>
	    <?php echo form_close(); ?>
	   </div>
     </div>
     <div class="row">
       <div id="output_description" class="col-xs-12 col-sm-4 col-sm-offset-4">
		<?php echo $search_results;  ?>
		<small class="promise"><em>Protect yourself and family members from fake medicine.</em></small>
		<h5><?php echo anchor('applications/index','Check Drug Manufacturer details using Drug\'s Registration Number'); ?></h5>
	  </div>
     </div>

     <div class="row">
	     <div class="col-xs-12 col-sm-4 col-sm-offset-4">
	         <div class="row">
	            <div class="col-xs-6"><a href="https://www.facebook.com/regcheckr" target="_blank"><img src="<?php echo base_url(); ?>img/facebookLogo.jpg" /></a></div>
	            <div class="col-xs-6"><a href="https://twitter.com/Regcheckr" target="_blank"><img src="<?php echo base_url(); ?>img/twitterLogo.jpg" /></a></div>
	          </div>
	     </div>
	 </div>


</div>