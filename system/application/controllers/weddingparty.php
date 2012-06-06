<?php

// Wedding Party Controller - Bio Pages

class Weddingparty extends Controller {

	function Weddingparty()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$data['title'] = "About the Wedding Party";
		$data['headerimg'] = "hdr-welcome.gif";
		
		$this->load->view('common/header', $data);
		$this->load->view('weddingparty/default_view', $data);
		$this->load->view('common/footer');	
	}
	function bride()
	{
		$data['title'] = "Wedding Party - The Bride";
		$this->load->view('common/header', $data);
		$this->load->view('weddingparty/bride_view');
		$this->load->view('common/footer');	
	}
	function groom()
	{
		$data['title'] = "Wedding Party - The Groom";	
		$this->load->view('common/header', $data);
		$this->load->view('weddingparty/groom_view');
		$this->load->view('common/footer');	
	}
	function maidofhonor()
	{
		$data['title'] = "Wedding Party - Maid of Honor";
		$this->load->view('common/header', $data);
		$this->load->view('weddingparty/MOH_view');
		$this->load->view('common/footer');	
	}
	function bestman()
	{
		$data['title'] = "Wedding Party - Best Man";
		$this->load->view('common/header', $data);	
		$this->load->view('weddingparty/BM_view');
		$this->load->view('common/footer');	
	}
	function motherofbride()
	{
		$data['title'] = "Wedding Party - Mother of the Bride";
		$this->load->view('common/header', $data);
		$this->load->view('weddingparty/MOB_view');
		$this->load->view('common/footer');	
	}
	function fatherofbride()
	{
		$data['title'] = "Wedding Party - Father of the Bride";
		$this->load->view('common/header', $data);
		$this->load->view('weddingparty/FOB_view');
		$this->load->view('common/footer');	
	}
	function motherofgroom()
	{
		$data['title'] = "Wedding Party - Mother of the Groom";
		$this->load->view('common/header', $data);
		$this->load->view('weddingparty/MOG_view');
		$this->load->view('common/footer');	
	}
	function fatherofgroom()
	{
		$data['title'] = "Wedding Party - Father of the Groom";
		$this->load->view('common/header', $data);
		$this->load->view('weddingparty/FOG_view');
		$this->load->view('common/footer');	
	}
}

?>