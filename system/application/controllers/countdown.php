<?php

// Countdown Controller - Wedding date countdown

class Countdown extends Controller {

	function Countdown()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('countdown_view');
	}
}

?>