<?php

class Registry_model extends Model {
    
	function Registry_model(){
        // Call the Model constructor
        parent::Model();
    }
	function get_registries() {
		$retval = "<ul>";
		$query = $this->db->query("SELECT storename, url FROM tblregistries ORDER BY storename ASC");
		foreach ($query->result() as $row){
			$retval .= "<li><a href=\"$row->url\">$row->storename</a></li>";
		}
		$retval .= "</ul>";
		return $retval;
	}

	function insert($storename, $url){
	
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
}

?>