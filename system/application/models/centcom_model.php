<?php

class Centcom_model extends Model {
    
	function Centcom_model(){
        // Call the Model constructor
        parent::Model();
    }
	
	function get_registries() {
		$retval = "<table border=\"1\">\n";
		$retval .= "<tr><th width=\"30%\">Store Name</th><th width=\"50%\">URL</th><th width=\"20%\">Action</th></tr>\n";
		$query = $this->db->query("SELECT id, storename, url FROM tblregistries ORDER BY storename ASC");
		foreach ($query->result() as $row){
			$retval .= "<tr><form method=\"POST\" action=\"/centcom/registry\">\n";
			$retval .= "<td width=\"30%\"><a href=\"$row->url\">$row->storename</a></td>\n";
			$retval .= "<td width=\"50%\"><input type=\"hidden\" name=\"id\" value=\"$row->id\" />\n";
			$retval .= "<input style=\"width:98%\" type=\"text\" name=\"url\" value=\"$row->url\" /></td>\n";
			$retval .= "<td align=\"center\" width=\"20%\"><input type=\"submit\" name=\"delete\" value=\"Delete\" /></td>\n";
			$retval .= "</form></tr>\n";
		}
		$retval .= "<tr><form method=\"POST\" action=\"/centcom/registry\">\n";
		$retval .= "<td width=\"30%\"><input type=\"text\" name=\"storename\"></td>\n";
		$retval .= "<td width=\"50%\"><input style=\"width:98%\" type=\"text\" name=\"url\"></td>\n";
		$retval .= "<td align=\"center\" width=\"20%\"><input type=\"submit\" name=\"create\" value=\"Add New\" /></td>\n";
		$retval .= "</form></tr>\n";
		$retval .= "</table>\n";
		return $retval;
	}
	
	function insert_registry($storename, $url){
		$data = array(
			'storename' => $storename,
			'url' => $url
            );

		$this->db->insert('tblregistries', $data);
		
		if($this->db->affected_rows() == 1){
			return TRUE;
		} 
		else{
			return FALSE;
		}
	}
	
	function delete_registry($id){
		$this->db->where('id', $id);
		$this->db->delete('tblregistries'); 
		
		if($this->db->affected_rows() == 1){
			return TRUE;
		} 
		else{
			return FALSE;
		}
	}
	
	function get_invitees_for($who){
        $myinviteedetails = $this->db->query("SELECT * FROM tblinvitees WHERE invitedby = '$who' ORDER BY firstName ASC");
		$inviteetotal = $this->db->query("select * from wedding.tblinvitees");
		switch($who){
			case "Groom":
				$myinvitees = $myinviteedetails->num_rows() - 1;
				break;
			case "Bride":
				$myinvitees = $myinviteedetails->num_rows();
				break;
			}
		$totalinvitees = $inviteetotal->num_rows() - 1;
		//echo "<pre>" . var_dump($myinvitees) . "</pre>";
		$output = "<font style=\"font-size: 1.3em; font-family:Verdana;\">$who's Invitees...</font><br />";
		$output .= "<font style=\"font-size: 0.8em; font-family:Verdana;\">(<b>$myinvitees</b> out of <b>$totalinvitees</b> total invited peole (not incl. guests))</font><br />";
		$output .= '<table border="1" style="font-family:Verdana; font-size: 0.8em;" width="300">';
		$output .= '<tr>
				<th>Pass Code</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Guest Name(s)</th>
				<th>Street Address</th>
				<th>City</th>
				<th>State</th>
				<th>RSVP Response</th>
			</tr>';
		foreach ($myinviteedetails->result() as $row){
			if($row->passcode == ''){
				$passcode = "&nbsp;";
			}
			else{ $passcode = $row->passcode; }
			if($row->firstName == ''){
				$firstname = "&nbsp;";
			}
			else{ $firstname = $row->firstName; }
			if($row->lastName == ''){
				$lastname = "&nbsp;";
			}
			else{ $lastname = $row->lastName; }
			if($row->guestName == ''){
				$guestname = "&nbsp;";
			}
			else{ $guestname = $row->guestName; }
			if($row->streetAddress == ''){
				$streetaddress = "&nbsp;";
			}
			else{ $streetaddress = $row->streetAddress; }
			if($row->city == ''){
				$city = "&nbsp;";
			}
			else{ $city = $row->city; }
			if($row->state == ''){
				$state = "&nbsp;";
			}
			else{ $state = $row->state; }

			//$name = $row->name;
			//$guestname = $row->guestName;
			//$streetaddress = $row->streetAddress;
			//$city = $row->city;
			//$state = $row->state;
			//$zip = $row->zip;
			switch($row->rsvpCode){
				case 100:
					$rsvp_area = '<td align="center" bgcolor="green"><b>YES</b></td>';
					break;
				case 10:
					$rsvp_area = '<td align="center" bgcolor="red"><b>NO</b></td>';
					break;
				case 1:
					$rsvp_area = '<td align="center" bgcolor="yellow"><b>IDK</b></td>';
					break;
			}
			$output .= <<<GROOMSPOT
		<tr>
			<td>$passcode</td>
			<td>$firstname</td>
			<td>$lastname</td>			
			<td>$guestname</td>
			<td>$streetaddress</td>
			<td>$city</td>
			<td>$state</td>
			$rsvp_area
		</tr>
GROOMSPOT;
		}
		$output .= "</table>";	
		return $output;
		
	}
}

?>
