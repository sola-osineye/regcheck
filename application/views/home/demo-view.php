<?php $data=array('name'=>'registration_no', 'id'=>'registration_no', 'value'=>"Drug's NAFDAC No", 'class'=>'btn btn-lg'); ?>

<?php if($this->input->post('registration_no')){
	      echo $search_results; } ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>This is my demo of CodeIgniter</title>

</head>
<body>

       <div id="nav">
	     <ul>
		     <li><a href="#">Home</a></li>
			 <li><a href="#">About Us</a></li>
			 <li><a href="#">Contact</a></li>
			 
         </ul>		 
	  </div>
     
     <?php echo form_open('demo/newSearch'); ?>
	  <div>
	     <?php echo form_label('NAFDAC Registration Number:', 'registration_no' ); ?>
		 <?php echo form_input('registration_no', set_value('registration_no'), 'id="registration_no"'); ?>
	  </div>
	  
	  <div>
	     <?php echo form_label('Name of Drug:', 'product_name'); ?>
	     <?php echo form_input('product_name', set_value('product_name'), 'id="product_name"'); ?>
	  </div>
	  
	 <div>
	     <?php echo form_submit('action', 'Search'); ?>
	 </div>
	 <?php echo form_close(); ?>
     <div>
	     Found: <?php echo $num_drugs ; ?> Drugs.
	 </div>
         <!--<?php var_dump($results); ?> -->
		 <!--<?php echo $hello; ?> -->
	<table>	
	    <thead>
		     <th>Id</th>
			 <th>Manufacturer</th>
		</thead>
		
		<tbody>
		
		 <?php foreach($drugs as $r) :?> 
         <tr>
		     <td><?php echo $r->Id; ?></td>
             <td><?php echo $r->manufacturers; ?></td> 
		 </tr>
		 <?php endforeach; ?>
		</tbody>  
		  
	</table>	 
	<?php if(strlen($pagination)) : ?>
	 <div>
	 Pages: <?php echo $pagination ;?>  
	 </div>
	<?php endif; ?>
</body>   	
</html>