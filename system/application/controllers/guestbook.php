<?php

// Guestbook controller Controller - Master Controller for the Guestbook system

class Guestbook extends Controller {
	function Guestbook(){
		parent::Controller();
		// Load URI Helper
		$this->load->helper('url');
		// load guestbook model
		$this->load->model('guestbook_model');
		// load email library
		$this->load->library('email');	
	}
	function index(){
		header("Location: " . base_url() . "guestbook/entries/");
	}
	function entries(){
		// Let's set up the entry form first...
		$ipaddy = $_SERVER['REMOTE_ADDR'];
		$entryform = <<<ENTRYFORM
		<form method="POST" action="/guestbook/submitentry">
			<input type="hidden" name="ipaddy" value="$ipaddy" />
			<table align="center" class="rsvp">
				<tr>
					<td>Your Name: </td>
					<td><input type="text" size="45" name="name" /></td>
				</tr>
				<tr>
					<td>Your Message: </td>
					<td><textarea cols="45" rows="2" name="message"> </textarea></td>
				</tr>
				<tr>
					<td align="right" colspan="2">
						<font size="-2">(<b>Note: your IP address will be recorded to try to cut down on spam</b>)</font> &nbsp; &nbsp;
						<input type="submit" value="Submit" name="submit" />
					</td>
				</tr>
			</table>
		</form>
ENTRYFORM;
		
		// load pagination class
		$this->load->library('pagination');
		// config the pagination class
		$config['base_url'] = base_url().'guestbook/entries/';
		$config['total_rows'] = $this->db->count_all('tblguestbook');
		$config['per_page'] = '10';
		// init the pagination class with config
		$this->pagination->initialize($config);

		// load the HTML Table Class
		$this->load->library('table');
		$this->table->set_heading('Name', 'Entry');
		$tbl_tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" width="90%" class="guest">');
		$this->table->set_template($tbl_tmpl); 

		if(!$this->uri->segment(3)) { $offset = "0"; }
		else{ $offset = $this->uri->segment(3); }

		$data['entries'] = $this->guestbook_model->get_entries($config['per_page'],$offset);

		$data['formspot'] = $entryform;
		$data['title'] = "Guestbook";
		$this->load->view('common/header', $data);
		$this->load->view('guestbook_view', $data);
		$this->load->view('common/footer');
	}
	function submitentry(){
		// This is the entry processor. It takes the person's entry and will 
		// update DB records as appropriate.
		if(!isset($_POST['submit'])){  // If the form hasn't been submitted...
			echo "I'm sorry, but this method cannot be called directly without any POST variables.
				Please <a href=\"/rsvp/\">Go Back</a> to the RSVP Page and try again.";
			die();
		}
		elseif(isset($_POST['submit']) && 
			isset($_POST['name']) &&
			isset($_POST['message']) &&
			!empty($_POST['name']) &&
			!empty($_POST['message'])){
			$name = $this->input->post('name');
			$entry = $this->input->post('message');	
			$ipaddy = $this->input->post('ipaddy');	
			
			// process db stuff, and send email here...
			$doentry = $this->guestbook_model->insert($name, $entry, $ipaddy);
			if($doentry == TRUE){
				// Email Bride and Groom 
				$this->email->from('yourhttpd@yourserveraddy.com', 'RSVP Robot');
				$this->email->to('brideandgroom@yourweddingsite.com');  // CHANGE THIS
				$this->email->subject('New Guestbook Entry!');
				$this->email->message("
You have a new Guestbook Message!\n\n
From: $name (at $ipaddy)\n
Entry Text:\n
$entry\n\n
--------------------
--The Guestbook Robot on your web server");
				$this->email->send();

				$endmessage = "<p class=\"succeed\"><font color=\"white\"><b>Your entry has been added to the guestbook, Thanks!</font></b></p><br /><br />";
			}
			else{
				$endmessage = "<p class=\"fail\"><font color=\"white\"><b>MESSAGE NOT ADDEDed because you probably forgot to fill something out. Try Again.</b></p><br /><br />";
			}
		}
		else{ $endmessage = "<p class=\"fail\"><font color=\"white\"><b>MESSAGE NOT ADDED because you probably forgot to fill something out. Try Again.</b></p><br /><br />"; }
		
		// load pagination class
		$this->load->library('pagination');
		// config the pagination class
		$config['base_url'] = base_url().'guestbook/entries/';
		$config['total_rows'] = $this->db->count_all('tblguestbook');
		$config['per_page'] = '10';
		// init the pagination class with config
		$this->pagination->initialize($config);

		// load the HTML Table Class
		$this->load->library('table');
		$this->table->set_heading('Name', 'Entry');
		$tbl_tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" width="90%" class="guest">');
		$this->table->set_template($tbl_tmpl); 

		if(!$this->uri->segment(3)) { $offset = "0"; }
		else{ $offset = $this->uri->segment(3); }

		$data['entries'] = $this->guestbook_model->get_entries($config['per_page'],$offset);
		
		$data['formspot'] = $endmessage;
		$data['title'] = "Guestbook";
		$this->load->view('common/header', $data);
		$this->load->view('guestbook_view', $data);
		$this->load->view('common/footer');
	}
}


?>