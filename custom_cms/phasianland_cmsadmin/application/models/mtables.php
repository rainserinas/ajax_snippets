<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mtables extends CI_Model {
	private $params;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function getCareersList() {
		$query = $this->db->select('*',FALSE)
				->get('tbl_careers');

		$result = $query->result();
		
		return $result;
	}	
	
	public function getNewsList() {
		$query = $this->db->select('*',FALSE)
				->get('tbl_news_events');

		$result = $query->result();
		
		return $result;
	}	
	
	public function getNewsLetters() {
		$query = $this->db->select('*',FALSE)
				->get('tbl_newsletters');

		$result = $query->result();
		
		return $result;
	}
	
	public function getSubscribers() {
		$query = $this->db->query("SELECT * FROM tbl_subscribers
			WHERE Status = 0
		");

		$result = $query->result();
		
		return $result;
	}
	
	public function resetSubscribers() {
        $this->db->update('tbl_subscribers', array('Status'=>0));
	}
	
	public function getNewsLettersToSend() {
		$query = $this->db->query("SELECT * FROM tbl_newsletters
			WHERE DateSent BETWEEN '" . date('Y-m-d') . " 00:00:00' AND '" . date('Y-m-d') . " 23:59:59'
			AND Status = 1
		");

		$result = $query->result();
		
		return $result;
	}
	
	public function getCommunityList() {
		$query = $this->db->select('*', FALSE)
				->get('tbl_community');

		$result = $query->result();
		
		return $result;
	}	
	
	public function getCommunityInfo($communityId) {
		$query = $this->db->query("SELECT * FROM tbl_community
			WHERE CommunityID = " . $communityId . "
		");

		$result = $query->result();
		
		return $result;
	}
	
	public function getHouses($communityId) {
		$query = $this->db->query("SELECT th.*, tc.Name FROM tbl_houses as th 
			LEFT JOIN tbl_community as tc
			ON tc.CommunityID = th.CommunityID
			WHERE tc.CommunityID = " . $communityId . "
		");

		$result = $query->result();
		
		return $result;
	}	
	
	public function getHouseInfo($houseId) {
		$query = $this->db->query("SELECT * FROM tbl_houses
			WHERE HouseID = " . $houseId . "
		");

		$result = $query->result();
		
		return $result;
	}
	
	public function getGallery($communityId) {
		$query = $this->db->query("SELECT * FROM tbl_gallery
			WHERE CommunityID = " . $communityId . "
		");

		$result = $query->result();
		
		return $result;
	}
	
	public function getContents($code) {
		$query = $this->db->select('*',FALSE)
				->get_where('tbl_contents', array('ContentCode'=>$code));

		$result = $query->result();
		
		return $result;
	}	

    public function flatten_array($multi_array) {
        foreach ($multi_array as $flatten) {
            return $flatten;
        }
    }
}