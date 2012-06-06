<?php	

// RSVP controller Controller - Master Controller for the RSVP system

class Rsvp extends Controller {
	function Rsvp(){
		parent::Controller();
		$this->load->model('rsvp_model');
		$this->load->library('email');		
	}
	function index(){
		// Load the login form (one text field, for rsvp code)
		$data['title'] = "RSVP Online!";
		$data['headerimg'] = "hdr-welcome.gif";
		$this->load->view('common/header', $data);
		$this->load->view('rsvp/rsvp_mainlogin_view');
		$this->load->view('common/footer');
	}
	function respond(){
		if(!isset($_POST['submit'])){  // If the form hasn't been submitted...
			echo "I'm sorry, but this method cannot be called directly without any POST variables.
				Please <a href=\"/rsvp/\">Go Back</a> to the RSVP Page and try again.";
		}
		else{
			$pass_code = $this->input->post('pass_code');
			$firstname = $this->input->post('firstname');
			$lastname = $this->input->post('lastname');
			$guestname = $this->input->post('guestname');
			$streetaddress = $this->input->post('streetaddress');
			$city = $this->input->post('city');
			$state = $this->input->post('state');
			$zip = $this->input->post('zip');
			$phone = $this->input->post('phone');
			$email = $this->input->post('email');
			$rsvpcode = $this->input->post('rsvp');
			$dorsvp = $this->rsvp_model->process_response($pass_code,
															$firstname,
															$lastname,
															$guestname,
															$streetaddress,
															$city,
															$state,
															$zip,
															$phone,
															$email,
															$rsvpcode);
			if($dorsvp == TRUE){
				// Email Bride and Groom
				switch($rsvpcode){
					case "100":
						$rsvpcode_eng = "YES, I will be attending!";
						break;
					case "010":
						$rsvpcode_eng = "NO, I will NOT be attending.";
						break;
					case "001":
						$rsvpcode_eng = "I am, as yet, undecided.";
						break;
				}
				$baseurlforemail = substr(base_url(), 0, -1);
				$this->email->from('yourhttpd@yourweddingsite.com', 'RSVP Robot');  // CHANGE THIS
				$this->email->to('brideandgroom@yourweddingsite.com');  // CHANGE THIS
				$this->email->subject('New RSVP (or Database Change)');
				$this->email->message("
$firstname $lastname has just updated their DB record:\n\n
Name: $firstname $lastname\n
Guest Name: $guestname\n
Street Address: $streetaddress\n
City: $city\n
State: $state\n
Zip: $zip\n
Phone: $phone\n
Email: $email\n
RSVP Response: $rsvpcode_eng\n\n
--------------------\n
Log into CENTCOM at $baseurlforemail/centcom to see your guest's changes.
--------------------\n
Thanks!\n
--The RSVP Robot on your Web Server");
				$this->email->send();

				$data['title'] = "RSVP Online!";
				$data['headerimg'] = "hdr-welcome.gif";
				$this->load->view('common/header', $data);
				$this->load->view('rsvp/rsvp_thanks_view');
				$this->load->view('common/footer');
			}
			else{
				$data['title'] = "RSVP Online!";
				$data['headerimg'] = "hdr-welcome.gif";
				$this->load->view('common/header', $data);
				$this->load->view('rsvp/rsvp_error_view');
				$this->load->view('common/footer');
			}
		}
	}
	function view(){
		if(isset($_POST['submit'])){
			$pass_code = strtolower($this->input->post('pass_code'));
			$data['results'] = $this->rsvp_model->get_invitee_info_by_passcode($pass_code);
			$data['title'] = "RSVP Online!";
			$data['headerimg'] = "hdr-welcome.gif";
			$this->load->view('common/header', $data);
			$this->load->view('rsvp/rsvp_viewrecord_view', $data);
			$this->load->view('common/footer');
		}
		else{ header("Location: " . base_url() . "rsvp"); }
	}
}

?>