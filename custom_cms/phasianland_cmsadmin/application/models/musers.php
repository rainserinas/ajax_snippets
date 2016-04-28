<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class musers extends CI_Model {

	public function __construct() {
		parent::__construct();
		session_start();

		$this->load->library('user_agent');
	}
	
	public function access() {
		if(isset($_SESSION['sessionID'])) {
			$query = $this->db->select('SessionID')->where('SessionID',$_SESSION['sessionID'])->get('tbl_account');

			if($query->num_rows <= 0) {
				unset($_SESSION['sessionID']);
				redirect(base_url());
			}
		} else {
			$this->session->set_userdata('redirect_back', $this->uri->uri_string());
			redirect(base_url());
		}
	}
	
	/*
	  1 - Developer - No Restriction
	  2 - Administrator - Add, Edit, Delete Content
	  3 - Advertiser - Track Advertisement Views
	  4 - Publisher - Track Movie Views
	*/
	  
	public function usertype() {
		$this->db->select('account_type_id');
		$this->db->where('session_id',$_SESSION['sessionID']);

		$query = $this->db->get('tbl_account');

		return $query->row()->account_type_id;
	}


}