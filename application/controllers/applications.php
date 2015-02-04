<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Applications extends CI_Controller {

	 public function __construct()
       {
            parent::__construct();
            $this->load->model('filter');

       }

	public function index()
	{
    	$data['title'] ="Drugs Search Application";
    	$data['error_message'] = "Please enter the drug's registration number";
        $data['mainContent'] = "applications/manufacturers";
		$data['extraContent'] ='<script type="text/javascript" src="' . base_url() . 'js/drugs_search.js"></script>';
	    $this->load->view('includes/template_second', $data);
	}


	public function ajaxsearch()
	{
		 $registrationNum = $this->input->post('registration_no');
		 if(strlen($registrationNum)==0){
	     	echo  '<h4 class="error_info">You have not entered any drug\'s registration Number</h4>';
	     }else{
		 //$manufacturers = $this->input->post('manufacturers');
		 $manufacturers = FALSE;
		 echo $this->filter->manufacturersFilter($registrationNum, $manufacturers);
    	}
	}
	public function manufacturersSearch()
	  {
	  	    $registrationNum = $this->input->post('registration_no');
            if(strlen($registrationNum)==0)
            {
             $data['title'] ="Drugs Search Application";
             $data['error_message'] = "Please enter the drug's registration number";
             $data['mainContent'] = "applications/manufacturers";
		     $data['extraContent'] ='<script type="text/javascript" src="' . base_url() . 'js/drugs_search.js"></script>';
	         $this->load->view('includes/template_second', $data);
            }else{
	  	    $this->filter->manufacturersFilter($registrationNum);
	  	    $data['title'] ="Drug's Manufacturers Search";
	  	    $data['mainContent'] = "applications/manufacturers2";
	  	    $data['extraContent'] ='<script type="text/javascript" src="' . base_url() . 'js/drugs_search.js"></script>';
	  	    $data['search_result'] = $this->filter->manufacturersFilter($registrationNum);
	        $this->load->view("includes/template_second", $data);
            }
	  }

}


