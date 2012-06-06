<?php

// Venue Controller - Pictures of the venue 

class Venue extends Controller {

	function Venue()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$data['title'] = "About the Venue - ";
		
		$this->load->view('common/header', $data);
		$this->load->view('venue_view');
		$this->load->view('common/footer');
	}
}

?>