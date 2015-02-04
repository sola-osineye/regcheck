<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo_newmodel extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 public function drugsSearch($registration, $manufacturer=True )
	 {
	 
	     $this ->db-> like('registration_no', $registration);
		 $this ->db->order_by('registration_no');
		 $q = $this->db->get('registeredDrugs');
		    
		 if($q ->num_rows() >0){
		     $output = '';
		     foreach($q->result() as $rows){
			    if($manufacturer){
		          $output.= $rows->registration_no . '<br />';
				  $output.= $rows->manufacturers;
			    }else{
				     $output.= $rows->registration_no; 
				}
			}
			return $output;
		 }else{
		  echo 'There are no results';
		 }
		 			
	}    
	 
	 
	 
	 
}
