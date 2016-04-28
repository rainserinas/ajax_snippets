<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mhome extends CI_Model {
	private $params;
	
	public function __construct() {
		parent::__construct();

		$this->load->helper('security');
	}
	
	public function getNumberOfRegisteredUsers() {
		$sql = 'SELECT
					*
				FROM
					users
				';

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getNumberOfNewUsers() {
		$sql = 'SELECT
					*
				FROM
					users
				WHERE
					users.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
				';

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getNumberOfActiveUsers() {
		$sql = 'SELECT
					*
				FROM
					users
				WHERE
					users.last_login BETWEEN "'.date('Y-m-d H:m:s',strtotime('-24 hours')).'" AND "'.date("Y-m-d H:i:s").'"
				';

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getNumberOfMovies() {
		$sql = 'SELECT
					*
				FROM
					movies
				';

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getNumberOfNewMovies() {
		$sql = 'SELECT
					*
				FROM
					movies
				WHERE
					movies.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
				';

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getNumberOfWatchedMovies() {
		$sql = 'SELECT
					*
				FROM
					tbl_movies_track as movies_track
				WHERE
					movies_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-24 hours')).'" AND "'.date("Y-m-d H:i:s").'"
				';

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getNumberOfVideoAds() {
		$sql = 'SELECT
					*
				FROM
					video_ads
				';

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getNumberOfNewVideoAds() {
		$sql = 'SELECT
					*
				FROM
					video_ads
				WHERE
					video_ads.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
				';

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getNumberOfViewedVideoAds() {
		$sql = 'SELECT
					*
				FROM
					tbl_video_ads_track as video_ads_track
				WHERE
					video_ads_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-24 hours')).'" AND "'.date("Y-m-d H:i:s").'"
				';

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getNumberOfBannerAds() {
		$sql = 'SELECT
					*
				FROM
					banner_ads
				';

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getNumberOfNewBannerAds() {
		$sql = 'SELECT
					*
				FROM
					banner_ads
				WHERE
					banner_ads.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
				';

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getNumberOfClickedBannerAds() {
		$sql = 'SELECT
					*
				FROM
					tbl_banner_ads_track as banner_ads_track
				WHERE
					banner_ads_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-24 hours')).'" AND "'.date("Y-m-d H:i:s").'"
				';

		$query = $this->db->query($sql);

		return $query->num_rows();
	}
	
}