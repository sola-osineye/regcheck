<div class="container">
<?php echo form_open('applications/manufacturersSearch', 'id="drug_description"'); ?>
<div class="row container">
<div class="col-sm-4 well">
<h4>Check for Drug's Manufacturer</h4>

    <input type="text" name="registration_no" class="form-control" id="registration_no" placeholder="Drug's Registration No"><br />
    <button type="submit" name="search" class="btn btn-primary form-control">Search</button>
</div>
</div>

<?php if(isset($_POST['search'])): ?>
<p class="error_info"><?php echo $error_message; ?></p>
<?php endif; ?>
<div id="product_description" class="product_describe"></div>
<?php echo form_close(); ?>

<div class="row" style="border:transparent">
	     <div class="col-sm-4">
	     <div id="output_description" style="display:none"></div><br />

		 <small class="promise"><em>Protect yourself and family members from fake medicine.</em></small>
		 <h5><?php echo anchor('register/index','Check Drug Manufacturer details using Drug\'s Registration Number'); ?></h5>
	     </div>
</div>


</div>