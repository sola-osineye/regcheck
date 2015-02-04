<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Career extends CI_Controller {

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


	 public function index()
	{
		$this->load->library('upload');
		$data['error'] = "";
		$data['error_message'] = "";
		$data['title'] ="Drugs Search Application";
        $data['mainContent'] = "careers/career-views";
		$data['extraContent'] ='<script type="text/javascript" src="' . base_url() . 'js/drugs_search.js"></script>';
	    $this->load->view('includes/template_second', $data);
	}

     function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'doc|docx|pdf';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		//validation for applicants info.
		$this->load->library("form_validation");

		$this->form_validation->set_rules("firstname", "First Name", "trim|required|min_length[3]|max_length[14]|alpha|xss_clean");
		$this->form_validation->set_rules("lastname", "Surname", "trim|required|min_length[3]|max_length[14]|alpha|xss_clean");
		$this->form_validation->set_rules("email", "Email", "trim|required|min_length[6]|max_length[50]|valid_email|is_xss_clean");
		$this->form_validation->set_rules("phone", "Phone Number", "trim|required|is_xss_clean");
		$this->form_validation->set_rules("message", "Message", "required|xss_clean");



		if (! $this->upload->do_upload())
		{
			$data['error'] = $this->upload->display_errors();
			$data['title'] ="Drugs Search Application";
            $data['mainContent'] = "careers/career-views";
		    $data['extraContent'] ='<script type="text/javascript" src="' . base_url() . 'js/drugs_search.js"></script>';
	        $this->load->view('includes/template_second', $data);
		}elseif($this->form_validation->run()==FALSE)
		{
			$data['display_message'] ="";
			$data['error'] = $this->upload->display_errors();
			$data['title'] ="Drugs Search Application";
            $data['mainContent'] = "careers/career-views";
		    $data['extraContent'] ='<script type="text/javascript" src="' . base_url() . 'js/drugs_search.js"></script>';
	        $this->load->view('includes/template_second', $data);

		}
		else{

			    $this->load->model('filter');
			    if($query = $this->filter->create_applicants()==FALSE)
			    {
			    $data['mainContent'] = "exceptional/except";
		        $data['extraContent'] ='<script type="text/javascript" src="' . base_url() . 'js/drugs_search.js"></script>';
		        $this->load->view("includes/template_second", $data);
			    }else{

		        $this->load->library("email");
	    	    $this->email->from($this->input->post("firstname"));
	     	    $this->email->to("solaosineye@hotmail.com");
	     	    $this->email->subject("Message From Regcheckr Career Page");
	     	    $this->email->message($this->input->post("message"));
	     	    $this->email->send();

		        $data['display_message'] = "Your message has been sent, we will contact you as soon as possible. Thank you!";
			    $data['title'] ="Drugs Search Application";
			    $data['mainContent'] = "careers/career-response";
		        $data['extraContent'] ='<script type="text/javascript" src="' . base_url() . 'js/drugs_search.js"></script>';
		        $data['upload_data'] = $this->upload->data();
	            $this->load->view('includes/template_second', $data);
			    }
		}
		}


}