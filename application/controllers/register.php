<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

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

    public function __construct()
       {
            parent::__construct();
            $this->load->model('filter');

       }

	 public function index()
	{
		$data['title'] ="Drugs Search Application";
        $data['error_message'] = "You have not entered any drug's registration Number";
        $data['mainContent'] = "home/checker";
		$data['extraContent'] ='<script type="text/javascript" src="' . base_url() . 'js/drugs_search.js"></script>';
	    $this->load->view('includes/template', $data);

	}

	 public function ajaxsearch()
	{
	     $registration_no = $this->input->post('registration_no');
	     //$product_name = $this->input->post('product_name');
		 $product_name = FALSE;
		 echo $this->filter->drugsFilter($registration_no, $product_name);
	}


	  public function search()
	 {

	        $registration_no = $this->input->post('registration_no');
            if(strlen($registration_no)==0) {
            $data['title'] ="Drugs Search Application";
		    $data['mainContent'] = "home/checker";
            $data['error_message'] = "Please enter a valid drug's registration number";
		    $data['extraContent'] ='<script type="text/javascript" src="' . base_url() . 'js/drugs_search.js/"></script>';
		    $this->load->view('includes/template', $data);
		  }else{

		  $results['rows'] = $this->filter->drugsFilter($registration_no);
		  $data['error_message'] = "Please enter a valid drug's registration number";
	      $data['search_results'] = $results['rows'];
	      $data['title'] = "Drugs Search Application";
	      $data['mainContent'] = "home/checked";
	      $data['extraContent'] ='<script type="text/javascript" src="' . base_url() . 'js/drugs_search.js/"></script>';
	      $this->load->view('includes/template', $data);
            }
	 }




	  public function contact()
	{

		$this->load->library("form_validation");

		$this->form_validation->set_rules("firstname", "First Name", "trim|required|min_length[3]|max_length[14]|alpha|xss_clean");
		$this->form_validation->set_rules("lastname", "Surname", "trim|required|min_length[3]|max_length[14]|alpha|xss_clean");
		$this->form_validation->set_rules("email", "Email", "trim|required|min_length[6]|max_length[50]|valid_email|is_xss_clean");
		$this->form_validation->set_rules("message", "Message", "required|xss_clean");

		if($this->form_validation->run() == FALSE){
	     $data['display_message'] ="";
		 $data['title'] ="Contact Us";
		 $data['mainContent'] = "contact_us/contact";
		 $data['extraContent'] ='<script type="text/javascript" src="' . base_url() . 'js/drugs_search.js"></script>';
	     $this->load->view("includes/template_second", $data);
	    }else{
	    	$this->load->library("email");
	    	$this->email->from(set_value("email"),set_value("firstname"));
	     	$this->email->to("solaosineye@hotmail.com");
	     	$this->email->subject("Message From Regcheckr Contact Page");
	     	$this->email->message(set_value("message"));
	     	$this->email->send();

	    	 $this->load->model('filter');
	         if($query = $this->filter->create_user()==FALSE){
		     $data['mainContent'] = "exceptional/except";
		     $data['extraContent'] ='<script type="text/javascript" src="' . base_url() . 'js/drugs_search.js"></script>';
		     $this->load->view("includes/template_second", $data);
		     }else{
			  $data['display_message'] = "Your message has been sent, we will contact you as soon as possible. Thank you!";
		      $data['title'] ="Contact Us";
	          $data['mainContent'] = "contact_us/contact";
	          $data['extraContent'] ='<script type="text/javascript" src="' . base_url() . 'js/drugs_search.js"></script>';
	          $this->load->view("includes/template_second", $data);
			 }
		 }
	}

}
