<?php

// Registry Controller - List of wedding registries

class Registry extends Controller {
	function Registry(){
		parent::Controller();
		// load registry model
		$this->load->model('registry_model');
	}
	function index(){
		$data['registry_list'] = $this->registry_model->get_registries();

		$data['title'] = "Wedding Registries";
		$this->load->view('common/header', $data);
		$this->load->view('registry_view', $data);
		$this->load->view('common/footer');
	}
}

?>