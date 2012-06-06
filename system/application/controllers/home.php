<?php

// Home Controller - Landing page for the site

class Home extends Controller {

	function Home()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$data['title'] = "Welcome";
		$data['headerimg'] = "hdr-welcome.gif";
		
		$this->load->view('common/header', $data);
		$this->load->view('home_view', $data);
		$this->load->view('common/footer');
	}
}

?>