<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	public function index()
	{
    	$data['title'] ="Drugs Search Application";
        $data['mainContent'] = "about/about-view";
		$data['extraContent'] ='<script type="text/javascript" src="' . base_url() . 'js/drugs_search.js"></script>';
	    $this->load->view('includes/template_second', $data);
	}


}
?>