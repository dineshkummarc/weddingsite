<?php

// CentCom Controller - WEDDING CENTRAL COMMAND!

class CentCom extends Controller {
	function CentCom(){
		parent::Controller();
		$this->load->model('centcom_model');
		$this->load->helper('cookie');
		$this->load->helper('url');
	}
	function index(){
	// Landing page, login form goes here.
		if(get_cookie('adminauth') == "isset"){  // Check if cookie is set already
			header("Location: " . base_url() . "centcom/manage"); // If it is, redir to /./manage
		}
		else{
			$data['title'] = "CENTCOM :: Wedding Central Command :: LOGIN";
			$data['headerimg'] = "hdr-welcome.gif";
		
			$this->load->view('centcom/centcom_header', $data);
			$this->load->view('centcom/login_view', $data);
			$this->load->view('common/footer');
		}
	}
	
	function login(){
	// Interstitially processes login requests,
	// (cannot be called directly in browser)
		if($this->input->post('pass_code') == "password"){ // *****CENTCOM LOGIN PASSWORD IS HERE*****
			$cookie = array(
                   'name'   => 'adminauth',
                   'value'  => 'isset',
				   'expire' => '3600',
				   'domain' => '.yourweddingsite.com' // CHANGE THIS
               );
			set_cookie($cookie); 
			header("Location: " . base_url() . "centcom/manage");
		}
		else{
			echo "Sorry, wrong password, please go back and try again.";
		}
	}
	
	function manage(){
	// Management area, landing area after login
		if(get_cookie('adminauth') == "isset"){
			$data['title'] = "CENTCOM :: Wedding Central Command :: MANAGEMENT";
			$data['headerimg'] = "hdr-welcome.gif";
			$data['groomlist'] = $this->centcom_model->get_invitees_for('Groom');
			$data['bridelist'] = $this->centcom_model->get_invitees_for('Bride');
			$data['registrylist'] = $this->centcom_model->get_registries();
						
			$this->load->view('centcom/centcom_header', $data);
			$this->load->view('centcom/manage_view', $data);
			$this->load->view('common/footer');
		}
		else{
			header("Location: " . base_url() . "centcom");
		}
	}
	
	function registry(){
	// Processes database changes for Registry
		$checkdelete = $this->input->post('delete');
		$checkinsert = $this->input->post('create');
		if($checkdelete == "Delete"){
			$id = $this->input->post('id');
			//process deletion here
			$delete = $this->centcom_model->delete_registry($id);
			header("Location: " . base_url() . "centcom");
		}
		elseif($checkinsert == "Add New"){
			$storename = $this->input->post('storename');
			$url = $this->input->post('url');
			//process addition here
			$insert = $this->centcom_model->insert_registry($storename, $url);
			header("Location: " . base_url() . "centcom");
		}
		else{
			header("Location: " . base_url() . "centcom");
		}
	}
	
	function logout(){
	// Interstitially processes logout requests
		$cookie = array(
           'name'   => 'adminauth',
		   'domain' => '.yourweddingsite.com'  // CHANGE THIS
		);
		delete_cookie($cookie); 
		header("Location: " . base_url() . "centcom");
	}
}

?>