<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class madsreport extends CI_Model {
	private $params;
	
	public function __construct() {
		parent::__construct();

		$this->load->helper('security');
	}

	public function checkVideoAdUser($params = array()) {
		$sql = 'SELECT
					*
				FROM
					video_ads
				WHERE
					video_ads.ad_ID = '.$params['ad_ID'].'
				';

		$query = $this->db->query($sql);

		return $query->result();
	}

	public function getVideoAdViews($params = array()) {
		if(empty($params['start_date']) && empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						tbl_video_ads_track as video_ads_track
					LEFT JOIN
						movies
					ON
						video_ads_track.movie_ID = movies.movie_ID
					WHERE
						ad_ID = '.$params['ad_ID'].'
					AND
						video_ads_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';
		} else {
			$sql = 'SELECT
						*
					FROM
						tbl_video_ads_track as video_ads_track
					LEFT JOIN
						movies
					ON
						video_ads_track.movie_ID = movies.movie_ID
					WHERE
						ad_ID = '.$params['ad_ID'].'
					AND
						video_ads_track.date_created BETWEEN "'.$params['start_date'].'" AND "'.$params['end_date'].'"
					';
		}

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getVideoAdTotalViews($params = array()) {
		if(!empty($params['account_id']) && empty($params['start_date']) && empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						tbl_video_ads_track as video_ads_track
					LEFT JOIN
						video_ads
					ON
						video_ads_track.ad_ID = video_ads.ad_ID
					WHERE
						video_ads.account_id = '.$params['account_id'].'
					AND
						video_ads_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';
		} else if(empty($params['account_id']) && empty($params['start_date']) && empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						tbl_video_ads_track as video_ads_track
					LEFT JOIN
						video_ads
					ON
						video_ads_track.ad_ID = video_ads.ad_ID
					WHERE
						video_ads_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';
		} else if(empty($params['account_id']) && !empty($params['start_date']) && !empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						tbl_video_ads_track as video_ads_track
					WHERE
						video_ads_track.date_created BETWEEN "'.$params['start_date'].'" AND "'.$params['end_date'].'"
					';
		} else {
			$sql = 'SELECT
						*
					FROM
						tbl_video_ads_track as video_ads_track
					LEFT JOIN
						video_ads
					ON
						video_ads_track.ad_ID = video_ads.ad_ID
					WHERE
						video_ads.account_id = '.$params['account_id'].'
					AND
						video_ads_track.date_created BETWEEN "'.$params['start_date'].'" AND "'.$params['end_date'].'"
					';
		}

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getVideoAdTotalPrice($params = array()) {
		if(!empty($params['account_id']) && empty($params['genre_ID']) && empty($params['start_date']) && empty($params['end_date'])) {
			$sql = 'SELECT
						SUM(ads_price.amount) as total_ad_price
					FROM
						tbl_video_ads_track as video_ads_track
					LEFT JOIN
						video_ads
					ON
						video_ads_track.ad_ID = video_ads.ad_ID
					LEFT JOIN
						tbl_ads_price as ads_price
					ON
						video_ads.video_time = ads_price.value
					WHERE
						video_ads.account_id = '.$params['account_id'].'
					AND
						video_ads_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';
		} else if(!empty($params['genre_ID']) && !empty($params['account_id']) && empty($params['start_date']) && empty($params['end_date'])) {
			$sql = 'SELECT
						SUM(ads_price.amount) as total_ad_price
					FROM
						tbl_video_ads_track as video_ads_track
					LEFT JOIN
						video_ads
					ON
						video_ads_track.ad_ID = video_ads.ad_ID
					LEFT JOIN
						tbl_ads_price as ads_price
					ON
						video_ads.video_time = ads_price.value
					LEFT JOIN
						movies
					ON
						video_ads_track.movie_ID = movies.movie_ID
					WHERE
						video_ads.account_id = '.$params['account_id'].'
					AND
						movies.genre = '.$params['genre_ID'].'
					AND
						video_ads_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';
		} else if(!empty($params['genre_ID']) && empty($params['account_id']) && empty($params['start_date']) && empty($params['end_date'])) {
			$sql = 'SELECT
						SUM(ads_price.amount) as total_ad_price
					FROM
						tbl_video_ads_track as video_ads_track
					LEFT JOIN
						video_ads
					ON
						video_ads_track.ad_ID = video_ads.ad_ID
					LEFT JOIN
						tbl_ads_price as ads_price
					ON
						video_ads.video_time = ads_price.value
					LEFT JOIN
						movies
					ON
						video_ads_track.movie_ID = movies.movie_ID
					WHERE
						movies.genre = '.$params['genre_ID'].'
					AND
						video_ads_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';
		} else if(!empty($params['account_id']) && empty($params['genre_ID']) && !empty($params['start_date']) && !empty($params['end_date'])) {
			$sql = 'SELECT
						SUM(ads_price.amount) as total_ad_price
					FROM
						tbl_video_ads_track as video_ads_track
					LEFT JOIN
						video_ads
					ON
						video_ads_track.ad_ID = video_ads.ad_ID
					LEFT JOIN
						tbl_ads_price as ads_price
					ON
						video_ads.video_time = ads_price.value
					WHERE
						video_ads.account_id = '.$params['account_id'].'
					AND
						video_ads_track.date_created BETWEEN "'.$params['start_date'].'" AND "'.$params['end_date'].'"
					';
		} else if(!empty($params['genre_ID']) && !empty($params['account_id']) && !empty($params['start_date']) && !empty($params['end_date'])) {
			$sql = 'SELECT
						SUM(ads_price.amount) as total_ad_price
					FROM
						tbl_video_ads_track as video_ads_track
					LEFT JOIN
						video_ads
					ON
						video_ads_track.ad_ID = video_ads.ad_ID
					LEFT JOIN
						tbl_ads_price as ads_price
					ON
						video_ads.video_time = ads_price.value
					LEFT JOIN
						movies
					ON
						video_ads_track.movie_ID = movies.movie_ID
					WHERE
						video_ads.account_id = '.$params['account_id'].'
					AND
						movies.genre = '.$params['genre_ID'].'
					AND
						video_ads_track.date_created BETWEEN "'.$params['start_date'].'" AND "'.$params['end_date'].'"
					';
		} else if(!empty($params['genre_ID']) && empty($params['account_id']) && !empty($params['start_date']) && !empty($params['end_date'])) {
			$sql = 'SELECT
						SUM(ads_price.amount) as total_ad_price
					FROM
						tbl_video_ads_track as video_ads_track
					LEFT JOIN
						video_ads
					ON
						video_ads_track.ad_ID = video_ads.ad_ID
					LEFT JOIN
						tbl_ads_price as ads_price
					ON
						video_ads.video_time = ads_price.value
					LEFT JOIN
						movies
					ON
						video_ads_track.movie_ID = movies.movie_ID
					WHERE
						movies.genre = '.$params['genre_ID'].'
					AND
						video_ads_track.date_created BETWEEN "'.$params['start_date'].'" AND "'.$params['end_date'].'"
					';
		} else {
			$sql = 'SELECT
						SUM(ads_price.amount) as total_ad_price
					FROM
						tbl_video_ads_track as video_ads_track
					LEFT JOIN
						video_ads
					ON
						video_ads_track.ad_ID = video_ads.ad_ID
					LEFT JOIN
						tbl_ads_price as ads_price
					ON
						video_ads.video_time = ads_price.value
					WHERE
						video_ads_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';
		}

		$query = $this->db->query($sql);

		foreach($query->result() as $row) {
			$result = $row->total_ad_price;
		}

		if($result == NULL) {
			return 0;
		} else {
			return $result;
		}
		
	}

	public function getVideoAdGenreViews($params = array()) {
		if(empty($params['start_date']) && empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						movies
					LEFT JOIN
						tbl_video_ads_track as video_ads_track
					ON
						movies.movie_ID = video_ads_track.movie_ID
					WHERE
						ad_ID = '.$params['ad_ID'].'
					AND
						movies.genre =  '.$params['genre_ID'].'
					AND
						video_ads_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';
		} else {
			$sql = 'SELECT
						*
					FROM
						movies
					LEFT JOIN
						tbl_video_ads_track as video_ads_track
					ON
						movies.movie_ID = video_ads_track.movie_ID
					WHERE
						ad_ID = '.$params['ad_ID'].'
					AND
						movies.genre =  '.$params['genre_ID'].'
					AND
						video_ads_track.date_created BETWEEN "'.$params['start_date'].'" AND "'.$params['end_date'].'"
					';
		}

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getVideoAdGenreTotalViews($params = array()) {
		if(!empty($params['account_id']) && empty($params['start_date']) && empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						movies
					LEFT JOIN
						tbl_video_ads_track as video_ads_track
					ON
						movies.movie_ID = video_ads_track.movie_ID
					LEFT JOIN
						video_ads
					ON
						video_ads_track.ad_ID = video_ads.ad_ID
					WHERE
						movies.genre =  '.$params['genre_ID'].'
					AND
						video_ads.account_id = '.$params['account_id'].'
					AND
						video_ads_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';
		} else if(empty($params['account_id']) && empty($params['start_date']) && empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						movies
					JOIN
						tbl_video_ads_track as video_ads_track
					ON
						movies.movie_ID = video_ads_track.movie_ID
					JOIN
						video_ads
					ON
						video_ads_track.ad_ID = video_ads.ad_ID
					WHERE
						movies.genre =  '.$params['genre_ID'].'
					AND
						video_ads_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';
		} else if(empty($params['account_id']) && !empty($params['start_date']) && !empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						movies
					JOIN
						tbl_video_ads_track as video_ads_track
					ON
						movies.movie_ID = video_ads_track.movie_ID
					JOIN
						video_ads
					ON
						video_ads_track.ad_ID = video_ads.ad_ID
					WHERE
						movies.genre =  '.$params['genre_ID'].'
					AND
						video_ads_track.date_created BETWEEN "'.$params['start_date'].'" AND "'.$params['end_date'].'"
					';
		} else {
			$sql = 'SELECT
						*
					FROM   
						movies
					LEFT JOIN
						tbl_video_ads_track as video_ads_track
					ON
						movies.movie_ID = video_ads_track.movie_ID
					LEFT JOIN
						video_ads
					ON
						video_ads_track.ad_ID = video_ads.ad_ID
					WHERE
						movies.genre =  '.$params['genre_ID'].'
					AND
						video_ads.account_id = '.$params['account_id'].'
					AND
						video_ads_track.date_created BETWEEN "'.$params['start_date'].'" AND "'.$params['end_date'].'"
					';
		}

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getVideoAdFilterViews($params) {
		$sql = 'SELECT
					*, video_ads_track.date_created
				FROM
					tbl_video_ads_track as video_ads_track
				LEFT JOIN
					movies
				ON
					video_ads_track.movie_ID = movies.movie_ID
				LEFT JOIN
					users
				ON
					video_ads_track.user_Id = users.user_ID
				LEFT JOIN
					movie_genre
				ON
					movie_genre.genre_ID = movies.genre
				WHERE
					ad_ID = '.$params.'
				';
		$query = $this->db->query($sql);

		if($query->num_rows > 0) {
			foreach($query->result() as $row) {
				$result[] = array(
									'video_ads_track_id' => $row->video_ads_track_id,
									'title' => $row->title,
									'genre_name' => $row->genre_name,
									'user_id' => $row->user_ID,
									'user_fname_lname' => (empty($row->user_fname) && empty($row->user_lname) ? NULL : $row->user_fname.' '.$row->user_lname),
									'user_name' => $row->user_name,
									'device' => $row->device,
									'ip_address' => $row->ip_address,
									'city' => $row->city,
									'isp' => $row->isp,
									'date_created' => $row->date_created
								);
			}
			return $result;
		} else {
			return NULL;
		}
	}

	public function getVideoAdFilterGenre($params = array()) {
		$sql = 'SELECT
					*, video_ads_track.date_created
				FROM
					tbl_video_ads_track as video_ads_track
				LEFT JOIN
					movies
				ON
					video_ads_track.movie_ID = movies.movie_ID
				LEFT JOIN
					users
				ON
					video_ads_track.user_Id = users.user_ID
				WHERE
					ad_ID = '.$params['ad_ID'].'
				AND
					movies.genre =  '.$params['genre_ID'].'
				';
		$query = $this->db->query($sql);

		if($query->num_rows > 0) {
			foreach($query->result() as $row) {
				$result[] = array(
									'video_ads_track_id' => $row->video_ads_track_id,
									'title' => $row->title,
									'user_id' => $row->user_ID,
									'user_fname_lname' => (empty($row->user_fname) && empty($row->user_lname) ? NULL : $row->user_fname.' '.$row->user_lname),
									'device' => $row->device,
									'ip_address' => $row->ip_address,
									'city' => $row->city,
									'isp' => $row->isp,
									'date_created' => $row->date_created
								);
			}
			return $result;
		} else {
			return NULL;
		}
	}

	public function getVideoAdsLinked($params) {
		$sql = 'SELECT
					*
				FROM
					video_ads
				WHERE
					video_time = '.$params.'
				';
				
		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	/* Banner Ads */

	// public function checkBannerAdUser($params = array()) {
	// 	$sql = 'SELECT
	// 				*
	// 			FROM
	// 				tbl_banner_ads_track as banner_ads_track
	// 			LEFT JOIN
	// 				banner_ads
	// 			ON
	// 				banner_ads_track.ad_ID = banner_ads.ad_ID
	// 			WHERE
	// 				banner_ads_track.ad_ID = '.$params['ad_ID'].'
	// 			AND
	// 				banner_ads.account_id = '.$params['account_id'].'
	// 			';

	// 	$query = $this->db->query($sql);

	// 	return $query->result();
	// }

	public function checkBannerAdUser($params = array()) {
		$sql = 'SELECT
					*
				FROM
					banner_ads
				WHERE
					banner_ads.ad_ID = '.$params['ad_ID'].'
				';

		$query = $this->db->query($sql);

		return $query->result();
	}

	public function getBannerAds($params = array()) {
		if(!empty($params['account_id'])) {
			$sql = 'SELECT
						*
					FROM
						banner_ads
					JOIN
						banner_ads_sizes
					ON
						banner_ads.size = banner_ads_sizes.banner_ad_size_ID
					JOIN
						device_type
					ON
						device_type.device_ID = banner_ads.device_type
					WHERE
						banner_ads.account_id = '.$params['account_id'].'
					';
		} else {
			$sql = 'SELECT
						*
					FROM
						banner_ads
					JOIN
						banner_ads_sizes
					ON
						banner_ads.size = banner_ads_sizes.banner_ad_size_ID
					JOIN
						device_type
					ON
						device_type.device_ID = banner_ads.device_type
					LEFT JOIN
						ref_account_info as account_info
					ON
						banner_ads.account_id = account_info.account_id
					';
		}

		$query = $this->db->query($sql);

		if($query->num_rows > 0) {
			foreach ($query->result() as $row) {
			   $result[] = $row;
			}

			return $result;
		} else {
			return null;
		}

	}

	public function getBannerAdViews($params) {
		$sql = 'SELECT
					*
				FROM
					tbl_banner_ads_track as banner_ads_track
				LEFT JOIN
					banner_ads
				ON
					banner_ads_track.ad_ID = banner_ads.ad_ID
				WHERE
					banner_ads_track.ad_ID = '.$params.'
				';

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getBannerAdTotalViews($params = array()) {
		if(!empty($params['account_id'])) {
			$sql = 'SELECT
						*
					FROM
						tbl_banner_ads_track as banner_ads_track
					LEFT JOIN
						banner_ads
					ON
						banner_ads_track.ad_ID = banner_ads.ad_ID
					WHERE
						banner_ads.account_id = '.$params['account_id'].'
					';
		} else {
			$sql = 'SELECT
						*
					FROM
						tbl_banner_ads_track as banner_ads_track
					LEFT JOIN
						banner_ads
					ON
						banner_ads_track.ad_ID = banner_ads.ad_ID
					';
		}

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getBannerAdTotalDisplaysCount($params = array()) {
		if(!empty($params['account_id'])) {
			$sql = 'SELECT
						SUM(displays_count) as total_displays_count
					FROM
						banner_ads
					WHERE
						banner_ads.account_id = '.$params['account_id'].'
					';
		} else {
			$sql = 'SELECT
						SUM(displays_count) as total_displays_count
					FROM
						banner_ads
					';
		}

		$query = $this->db->query($sql);

		foreach($query->result() as $row) {
			$result = $row->total_displays_count;
		}

		return $result;
	}

	public function getBannerAdTotalPrice($params = array()) {
		if(!empty($params['account_id'])) {
			$sql = 'SELECT
						SUM(ads_price.amount) as total_ad_price
					FROM
						tbl_banner_ads_track as banner_ads_track
					LEFT JOIN
						banner_ads
					ON
						banner_ads_track.ad_ID = banner_ads.ad_ID
					LEFT JOIN
						tbl_ads_price as ads_price
					ON
						banner_ads.size = ads_price.value
					WHERE
						banner_ads.account_id = '.$params['account_id'].'
					';
		} else {
			$sql = 'SELECT
						SUM(ads_price.amount) as total_ad_price
					FROM
						tbl_banner_ads_track as banner_ads_track
					LEFT JOIN
						banner_ads
					ON
						banner_ads_track.ad_ID = banner_ads.ad_ID
					LEFT JOIN
						tbl_ads_price as ads_price
					ON
						banner_ads.size = ads_price.value
					WHERE
						banner_ads.account_id != 0
					';
		}

		$query = $this->db->query($sql);

		foreach($query->result() as $row) {
			$result = $row->total_ad_price;
		}

		if($result == NULL) {
			return 0;
		} else {
			return $result;
		}
	}

	public function getBannerAdFilterViews($params) {
		$sql = 'SELECT
					*, banner_ads_track.date_created
				FROM
					tbl_banner_ads_track as banner_ads_track
				LEFT JOIN
					users
				ON
					banner_ads_track.user_id = users.user_ID
				WHERE
					ad_ID = '.$params.'
				';
		$query = $this->db->query($sql);

		if($query->num_rows > 0) {
			foreach($query->result() as $row) {
				$result[] = array(
									'banner_ads_track_id' => $row->banner_ads_track_id,
									'user_id' => $row->user_ID,
									'user_fname_lname' => (empty($row->user_fname) && empty($row->user_lname) ? NULL : $row->user_fname.' '.$row->user_lname),
									'device' => $row->device,
									'ip_address' => $row->ip_address,
									'city' => $row->city,
									'isp' => $row->isp,
									'date_created' => $row->date_created
								);
			}
			return $result;
		} else {
			return NULL;
		}
	}

	public function getBannerAdsLinked($params) {
		$sql = 'SELECT
					*
				FROM
					banner_ads
				WHERE
					size = '.$params.'
				';
				
		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getBannerAdUniqueLocation($params) {
		$sql = 'SELECT
					city
				FROM
					tbl_banner_ads_track
				WHERE
					ad_ID = '.$params.'
				GROUP 
					BY city
				';
		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getBannerAdUniqueUser($params) {
		$sql = 'SELECT
					user_ID
				FROM
					tbl_banner_ads_track
				WHERE
					ad_ID = '.$params.'
				GROUP BY 
					user_ID
				';
		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getBannerAdMaleUser($params) {
		$sql = 'SELECT
					tbl_banner_ads_track.user_ID as user_ID
				FROM
					tbl_banner_ads_track
				JOIN
					users
				ON
			   		tbl_banner_ads_track.user_ID = users.user_ID
				WHERE
					ad_ID = '.$params.' 
				AND 
					user_gender = "male"
				GROUP BY 
					user_ID
				';
		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getBannerAdFemaleUser($params) {
		$sql = 'SELECT
					tbl_banner_ads_track.user_ID as user_ID
				FROM
					tbl_banner_ads_track
				JOIN
					users
				ON
			   		tbl_banner_ads_track.user_ID = users.user_ID
				WHERE
					ad_ID = '.$params.' 
				AND 
					user_gender = "female"
				GROUP BY 
					user_ID
				';
		$query = $this->db->query($sql);

		return $query->num_rows();
	}


	public function getBannerAdAverageAge($params) {
		$sql = 'SELECT
					tbl_banner_ads_track.user_ID as user_ID,
					TIMESTAMPDIFF(YEAR, users.user_birthday, CURDATE()) AS user_age
				FROM
					tbl_banner_ads_track
				JOIN
					users
				ON
			   		tbl_banner_ads_track.user_ID = users.user_ID
				WHERE
					ad_ID = '.$params.'
				GROUP BY 
					user_ID
				';
		$query = $this->db->query($sql);

		if($query->num_rows > 0) {
			$age = 0;
			$user = 0;
			foreach($query->result() as $row) {
				$user_age = $row->user_age;
				$age = $age + $user_age;
				$user++;
			}

			$result = intval($age/$user);
		} else {
			$result = 0;
		}

		return $result;
	}

}