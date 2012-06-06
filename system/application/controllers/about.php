<?php

// About Controller - Info about/directions to Ceremony/Reception

class About extends Controller {

	function About()
	{
		parent::Controller();	
	}
	
	function ceremony()
	{
		$this->load->view('ceremony_view');
	}
	function reception()
	{
		$this->load->view('reception_view');
	}
}

?>