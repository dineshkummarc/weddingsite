<?php

// Directions Controller - Directions to the reception

class Directions extends Controller {

	function Directions()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$data['title'] = "Driving Directions";
		
		$this->load->view('common/header', $data);
		$this->load->view('directions_view');
		$this->load->view('common/footer');
	}
}

?>