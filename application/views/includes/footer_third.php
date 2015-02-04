      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.2.0/prototype.js"></script>
	  <script type="text/javascript" src="<?php echo base_url(); ?>js/scriptaculous.js"> </script>
	  <script type="text/javascript" src="<?php echo base_url(); ?>js/effects.js"></script>
	  <script type="text/javascript" src="<?php echo base_url(); ?>js/controls.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.8.3.min.js"></script>

	<!--  <script type="text/javascript">
	  var $j = jQuery.noConflict();
	  $j(document).ready(function() {
       $j( "div" ).hide();
      });
	  window.onload = function() {
      var mainDiv = $( "main" );
      }
	 </script> -->
      <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

      <script type="text/javascript">
	   $.noConflict();
	   jQuery(document).ready(function($) {
	   $("#menu-close").click(function(e) {
       e.preventDefault();
       $("#sidebar-wrapper").toggleClass("active");
       });
       $("#menu-toggle").click(function(e) {
       e.preventDefault();
       $("#sidebar-wrapper").toggleClass("active");
      });
	  });
	 </script>
	  <?php if($extraContent) {
	   echo $extraContent ;} ?>

</body>
</html>