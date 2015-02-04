<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
	<link href="<?php echo base_url(); ?>css/bootstrap.min.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/custom.css" type="text/css" rel="stylesheet" />
   <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
     <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
	
<section>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
        <hgroup>
          <h2>
            Subscribe for
             <select class="frecuency">
                 <option value="0">daily</option>
                 <option value="1" selected>weekly</option>
                 <option value="2">monthly</option>
             </select>
            newsletter 
          </h2>
          <h1 class="free">For Free</h1>
         </hgroup>
    	 <div class="well">
             <form action="newSearch">
              <div class="input-group">
                 <input class="btn btn-lg" name="email" id="email" type="email" placeholder="Your Email" required>
                 <button class="btn btn-info btn-lg" type="submit">Submit</button>
              </div>
             </form>
    	 </div>
         <small class="promise"><em>We won't send spam.</em></small>
		</div>
	</div>
</div>
</section>
</body>   	
</html>