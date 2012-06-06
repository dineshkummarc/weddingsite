<?php

class Rsvp_model extends Model {
    
	function Rsvp_model(){
        // Call the Model constructor
        parent::Model();
    }
    function get_invitee_info_by_passcode($pass_code){
        $query = $this->db->query("SELECT * FROM tblinvitees WHERE Passcode = '$pass_code'");
		if ($query->num_rows() > 0){
			foreach ($query->result() as $row){
				$passcode = $row->passcode;
				$firstname = $row->firstName;
				$lastname = $row->lastName;
				$invitedby = $row->invitedBy;
				$guestname = $row->guestName;
				$streetaddress = $row->streetAddress;
				$city = $row->city;
				$state = $row->state;
				$zip = $row->zip;
				$phone = $row->phone;
				$email = $row->email;
				switch($row->rsvpCode){
					case 1:
						$rsvp_area = '<td align="center" class="yes"><input type="radio" name="rsvp" value="100"><br /><b>YES</b>, I will be attending.</td>';
						$rsvp_area .= '<td align="center" class="no"><input type="radio" name="rsvp" value="010"><br /><b>NO</b>, I am not able to attend.</td>';
						$rsvp_area .= '<td align="center"><input type="radio" name="rsvp" value="001" checked="yes"><br />I am as yet <b>UNDECIDED</b>.</td>';
						break;
					case 10:
						$rsvp_area = '<td align="center" class="yes"><input type="radio" name="rsvp" value="100"><br /><b>YES</b>, I will be attending.</td>';
						$rsvp_area .= '<td align="center" class="no"><input type="radio" name="rsvp" value="010" checked="yes"><br /><b>NO</b>, I am not able to attend.</td>';
						$rsvp_area .= '<td align="center"><input type="radio" name="rsvp" value="001"><br />I am as yet <b>UNDECIDED</b>.</td>';
						break;
					case 100:
						$rsvp_area = '<td align="center" class="yes"><input type="radio" name="rsvp" value="100" checked="yes"><br /><b>YES</b>, I will be attending.</td>';
						$rsvp_area .= '<td align="center" class="no"><input type="radio" name="rsvp" value="010"><br /><b>NO</b>, I am not able to attend.</td>';
						$rsvp_area .= '<td align="center"><input type="radio" name="rsvp" value="001"><br />I am as yet <b>UNDECIDED</b>.</td>';
						break;
				}
				$output = <<<RSVPFORM
			<div align="center">
			<table class="rsvp" width="500">
			<tr>
				<td align="center">
					<font style="font-size:25px;">Welcome, $firstname $lastname!</font>
				</td>
			</tr>
			<tr><td><p>You were invited to the wedding by the <b>$invitedby</b>. Even if you know both the Bride and Groom, please be
			         sure to tell the usher to seat you on the <b>$invitedby's</b> side at the ceremony!</p></td></tr>
			<tr>
				<td>
					<p>Use the form below to RSVP to our wedding. You can also update the information we have
					for you in our database, and update your Guest's name. (If there's something filled in
					there already, we may have made our best guess as to your guest's name, you may change
					or update it as you please!)</p>
				</td>
			</tr>
			<tr>
				<td>
					<form method="POST" action="/rsvp/respond">
					<input type="hidden" name="pass_code" value="$passcode" />
					<table width="100%">
						<tr>
							<td width="30%">Your First Name</td>
							<td width="70%" colspan="2"><input type="text" name="firstname" value="$firstname" style="width:100%;" /></td>
						</tr>
						<tr>
							<td width="30%">Your Last Name</td>
							<td width="70%" colspan="2"><input type="text" name="lastname" value="$lastname" style="width:100%;" /></td>
						</tr>
						<tr>
							<td width="30%">Guest Name</td>
							<td width="70%" colspan="2"><input type="text" name="guestname" value="$guestname" style="width:100%;" /></td>
						</tr>
						<tr>
							<td width="30%">Street Address</td>
							<td width="70%" colspan="2"><input type="text" name="streetaddress" value="$streetaddress" style="width:100%;" /></td>
						</tr>
						<tr>
							<td width="30%">City</td>
							<td width="70%" colspan="2"><input type="text" name="city" value="$city" /></td>
						</tr>
						<tr>
							<td width="30%">State</td>
							<td width="70%" colspan="2"><input type="text" name="state" value="$state" size="2" maxlength="2" /></td>
						</tr>
						<tr>
							<td width="30%">Zip</td>
							<td width="70%" colspan="2"><input type="text" name="zip" value="$zip" size="5" maxlength="5"/></td>
						</tr>
						<tr>
							<td width="30%">Phone</td>
							<td width="70%" colspan="2"><input type="text" name="phone" value="$phone" size="15" maxlength="15" /></td>
						</tr>
						<tr>
							<td width="30%">Email Address</td>
							<td width="70%" colspan="2"><input type="text" name="email" value="$email" style="width:100%;" /></td>
						</tr>
						<tr>
						$rsvp_area
						</tr>
						<tr>
							<td colspan="3" align="right"><input type="submit" name="submit" value="Submit" /></td>
						</tr>
					</table>
				</td>
			</tr>
			</table>
			</div>
RSVPFORM;
			}
		}
		else{
			$output = "<h3>I'm sorry, I couldn't find your code in my database. Please <a href=\"/rsvp\">try again</a>, or use the contact form.</h3>";
		}
		return $output;
	}
	function process_response($pass_code, $firstname, $lastname, $guestname, $streetaddress, $city, $state, $zip, $phone, $email, $rsvpcode){
	
		$data = array(
			'firstName' => $firstname,
			'lastName' => $lastname,
			'guestName' => $guestname,
			'streetAddress' => $streetaddress,
			'city' => $city,
			'state' => $state,
			'zip' => $zip,
			'phone' => $phone,
			'email' => $email,
			'rsvpcode' => $rsvpcode,
            );

		$this->db->where('passcode', $pass_code);
		$this->db->update('tblinvitees', $data);
		
		if($this->db->affected_rows() == 1){
			return TRUE;
		} 
		else{
			return FALSE;
		}
	}
}

?>