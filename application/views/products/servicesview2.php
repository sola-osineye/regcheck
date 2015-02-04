<div class="container">

<div class="row container">
<div class="col-sm-4 well">
<h4>Check for Drug's Manufacturer</h4>
    <?php echo form_open('services/manufacturersSearch'); ?>
    <input type="text" name="registration_no" class="form-control" value="<?php echo set_value('registration_no'); ?>" placeholder="Drug's Registration No"><br />
    <button type="submit" name="search" class="btn btn-primary form-control">Search</button>
    <?php echo form_close(); ?>
</div>
</div><br />
<div class="row container">
<div id="product_description" class="col-sm-4 well product_describe">

    <?php echo $search_result ;?>

</div>
</div>


</div> <!--container div -->