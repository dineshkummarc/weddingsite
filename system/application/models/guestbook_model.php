<?php

class Guestbook_model extends Model {
    
	function Guestbook_model(){
        // Call the Model constructor
        parent::Model();
    }
	function get_entries($num, $offset) {
		$query = $this->db->query("SELECT name, entry FROM tblguestbook ORDER BY id DESC LIMIT $offset, $num");
		return $query;
	}

	function insert($name, $entry, $ipaddy){
	
		$data = array(
			'name' => $name,
			'entry' => $entry,
			'ipaddress' => $ipaddy
            );

		$this->db->insert('tblguestbook', $data);
		
		if($this->db->affected_rows() == 1){
			return TRUE;
		} 
		else{
			return FALSE;
		}
	}
}

?>