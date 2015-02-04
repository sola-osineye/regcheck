<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FILTER extends CI_Model {

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
     //retrieves the registration nos and product number of drugs.
	      function drugsFilter($drug_no, $product_name=TRUE)
	 {
	 	    $this->db->select('registration_no,product_name');
	        $this->db->like('registration_no', $drug_no);
			$this->db->order_by('product_name');
			$this->db->limit(5);
	        $query = $this->db->get('registeredDrugs');

		     if($query->num_rows()>0){
			     $output = '<ul>';
			     foreach($query->result() as $rows){
				    if($product_name){
					 $output.='<li><strong>' . $rows->registration_no . '</strong><br />';
					 $output.= $rows->product_name . '</li>';
					}else{
					  $output.= '<li>' . $rows->registration_no . '</li>';
					}
				 }
				 $output.='</ul>';
				 return $output;
			 }else{
			       return "<p>Sorry, drug registration number not found! </p>";
			 }


	}

     //retrieves drug manufacturers's address from database
	       function manufacturersFilter($drug_no, $manufacturers = TRUE)
	 {
	 	    $this->db->select('registration_no,manufacturers');
	        $this->db->like('registration_no', $drug_no);
			$this->db->order_by('product_name');
            $this->db->limit(5);
	        $query = $this->db->get('registeredDrugs');
	        if($query->num_rows()>0){
	        	$output = '<ul>';
	        	foreach($query->result() as $rows){
	        		if($manufacturers){
	        		$output.= '<li><strong>' . $rows->registration_no . '</strong><br />';
	        		$output.= $rows->manufacturers . '</li>';
	        		}else{
	        			$output.='<li>' . $rows->registration_no . '</li>';
	        		}
	        	}
	        	$output.='</ul>';
	        	return $output;
	        }else{
	        	return '<p class="error_info">This registration number cannot be matched to any drug manufacturer.</p>';
	        }

	 }

    //inserts contacts information into database
	     function create_user()
	{
		$new_user_info = array(
		 'first-name' => $this->input->post('firstname'),
		 'surname' => $this->input->post('lastname'),
		 'email' => $this->input->post('email')
		);
		$insert = $this->db->insert('users-info', $new_user_info);
			return $insert;
	}

	 //inserts job applicants information into database
	      function create_applicants()
	{
		$new_applicants_info = array(
		 'first-name' => $this->input->post('firstname'),
		 'surname' => $this->input->post('lastname'),
		 'email' => $this->input->post('email'),
		 'phone-no' => $this->input->post('phone')
		);
		$insert_applicant = $this->db->insert('applicants-info', $new_applicants_info);
			return $insert_applicant;

	}


}