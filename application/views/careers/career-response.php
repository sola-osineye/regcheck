<div class="container">
<div class="row">
<div class="col-xs-12">
<?php if($this->form_validation->run() == TRUE){ echo '<p class="error_info">'.$display_message.'</p>' ;} ?>

<h3>Your CV has been submitted.</h3>

<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>

<p> Thank you for your interest in joining us; a member of our team will review your resume and
get back to you as soon as possible</p>

<p>Go back to the <a href="#">homepage</a></p>


</div>
</div>
</div>
<br />

