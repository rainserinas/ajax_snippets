<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mmoviereport extends CI_Model {
	private $params;
	
	public function __construct() {
		parent::__construct();

		$this->load->helper('security');
	}

	public function checkMovieUser($params = array()) {
		if(!empty($params['movie_ID'])) {
			$sql = 'SELECT
						*
					FROM
						movies
					WHERE
						movies.movie_ID = '.$params['movie_ID'].'
					';

			$query = $this->db->query($sql);

			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function checkMovieAdUser($params = array()) {
		if(!empty($params['movie_ID']) && !empty($params['ads_price_id'])) {
			$sql = 'SELECT
						*
					FROM
						movies
					JOIN
						tbl_ads_price as ads_price
					WHERE
						movies.movie_ID = '.$params['movie_ID'].'
					AND
						ads_price.ads_price_id = '.$params['ads_price_id'].'
					';

			$query = $this->db->query($sql);

			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function getMovieViews($params = array()) {
		if(empty($params['start_date']) && empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						tbl_movies_track as movies_track
					LEFT JOIN
						movies
					ON
						movies_track.movie_ID = movies.movie_ID
					WHERE
						movies_track.movie_ID = '.$params['movie_ID'].'
					AND
						movies_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';
		} else {
			$sql = 'SELECT
						*
					FROM
						tbl_movies_track as movies_track
					LEFT JOIN
						movies
					ON
						movies_track.movie_ID = movies.movie_ID
					WHERE
						movies_track.movie_ID = '.$params['movie_ID'].'
					AND
						movies_track.date_created BETWEEN "'.$params['start_date'].'" AND "'.$params['end_date'].'"
					';
		}

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getMovieTotalViews($params = array()) {
		if(!empty($params['account_id']) && empty($params['start_date']) && empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						tbl_movies_track as movies_track
					LEFT JOIN
						movies
					ON
						movies_track.movie_ID = movies.movie_ID
					WHERE
						movies.account_id = '.$params['account_id'].'
					AND
						movies_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';
		} else if(empty($params['account_id']) && empty($params['start_date']) && empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						tbl_movies_track as movies_track
					LEFT JOIN
						movies
					ON
						movies_track.movie_ID = movies.movie_ID
					WHERE
						movies_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';
		} else if(empty($params['account_id']) && !empty($params['start_date']) && !empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						tbl_movies_track as movies_track
					WHERE
						movies_track.date_created BETWEEN "'.$params['start_date'].'" AND "'.$params['end_date'].'"
					';
		} else {
			$sql = 'SELECT
						*
					FROM
						tbl_movies_track as movies_track
					LEFT JOIN
						movies
					ON
						movies_track.movie_ID = movies.movie_ID
					WHERE
						movies.account_id = '.$params['account_id'].'
					AND
						movies_track.date_created BETWEEN "'.$params['start_date'].'" AND "'.$params['end_date'].'"
					';
		}

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getMoviesFilterViews($params) {
		$sql = 'SELECT
					*, movies_track.date_created
				FROM
					tbl_movies_track as movies_track
				LEFT JOIN
					movies
				ON
					movies_track.movie_ID = movies.movie_ID
				LEFT JOIN
					users
				ON
					movies_track.user_Id = users.user_ID
				LEFT JOIN
					movie_genre
				ON
					movie_genre.genre_ID = movies.genre
				WHERE
					movies_track.movie_ID = '.$params.'
				';
		$query = $this->db->query($sql);

		if($query->num_rows > 0) {
			foreach($query->result() as $row) {
				$result[] = array(
									'movies_track_id' => $row->movies_track_id,
									'title' => $row->title,
									'genre_name' => $row->genre_name,
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

	public function getMovieAdViews($params = array()) {
		if(empty($params['start_date']) && empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						tbl_ads_price as ads_price
					LEFT JOIN
						video_ads
					ON
						ads_price.value = video_ads.video_time
					LEFT JOIN
						tbl_video_ads_track as video_ads_track
					ON
						video_ads.ad_ID = video_ads_track.ad_ID
					LEFT JOIN
						movies
					ON
						video_ads_track.movie_ID = movies.movie_ID
					WHERE
						movies.movie_ID = '.$params['movie_ID'].'
					AND
						ads_price.ads_price_id = '.$params['ads_price_id'].'
					AND
						video_ads_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';
		} else {
			$sql = 'SELECT
						*
					FROM
						tbl_ads_price as ads_price
					LEFT JOIN
						video_ads
					ON
						ads_price.value = video_ads.video_time
					LEFT JOIN
						tbl_video_ads_track as video_ads_track
					ON
						video_ads.ad_ID = video_ads_track.ad_ID
					LEFT JOIN
						movies
					ON
						video_ads_track.movie_ID = movies.movie_ID
					WHERE
						movies.movie_ID = '.$params['movie_ID'].'
					AND
						ads_price.ads_price_id = '.$params['ads_price_id'].'
					AND
						video_ads_track.date_created BETWEEN "'.$params['start_date'].'" AND "'.$params['end_date'].'"
					';
		}

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getMovieAdTotalViews($params = array()) {
		if(!empty($params['account_id']) && empty($params['start_date']) && empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						tbl_ads_price as ads_price
					LEFT JOIN
						video_ads
					ON
						ads_price.value = video_ads.video_time
					LEFT JOIN
						tbl_video_ads_track as video_ads_track
					ON
						video_ads.ad_ID = video_ads_track.ad_ID
					LEFT JOIN
						movies
					ON
						video_ads_track.movie_ID = movies.movie_ID
					WHERE
						ads_price.ads_price_id = '.$params['ads_price_id'].'
					AND
						movies.account_id = '.$params['account_id'].'
					AND
						video_ads_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';
		} else if(empty($params['account_id']) && empty($params['start_date']) && empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						tbl_ads_price as ads_price
					JOIN
						video_ads
					ON
						ads_price.value = video_ads.video_time
					JOIN
			 			tbl_video_ads_track as video_ads_track
			 		ON
			 			video_ads.ad_ID = video_ads_track.ad_ID
					WHERE
						ads_price.ads_price_id = '.$params['ads_price_id'].'
					AND
						video_ads_track.date_created BETWEEN "'.date('Y-m-d H:m:s',strtotime('-30 days')).'" AND "'.date("Y-m-d H:i:s").'"
					';

		} else if(empty($params['account_id']) && !empty($params['start_date']) && !empty($params['end_date'])) {
			$sql = 'SELECT
						*
					FROM
						tbl_ads_price as ads_price
					LEFT JOIN
						video_ads
					ON
						ads_price.value = video_ads.video_time
					LEFT JOIN
						tbl_video_ads_track as video_ads_track
					ON
						video_ads.ad_ID = video_ads_track.ad_ID
					LEFT JOIN
						movies
					ON
						video_ads_track.movie_ID = movies.movie_ID
					WHERE
						ads_price.ads_price_id = '.$params['ads_price_id'].'
					AND
						video_ads_track.date_created BETWEEN "'.$params['start_date'].'" AND "'.$params['end_date'].'"
					';
		} else {
			$sql = 'SELECT
						*
					FROM
						tbl_ads_price as ads_price
					LEFT JOIN
						video_ads
					ON
						ads_price.value = video_ads.video_time
					LEFT JOIN
						tbl_video_ads_track as video_ads_track
					ON
						video_ads.ad_ID = video_ads_track.ad_ID
					LEFT JOIN
						movies
					ON
						video_ads_track.movie_ID = movies.movie_ID
					WHERE
						ads_price.ads_price_id = '.$params['ads_price_id'].'
					AND
						movies.account_id = '.$params['account_id'].'
					AND
						video_ads_track.date_created BETWEEN "'.$params['start_date'].'" AND "'.$params['end_date'].'"
					';
		}

		$query = $this->db->query($sql);

		return $query->num_rows();
	}

	public function getMoviesFilterAds($params = array()) {
		$sql = 'SELECT
					*, video_ads_track.date_created
				FROM
					tbl_ads_price as ads_price
				LEFT JOIN
					video_ads
				ON
					ads_price.value = video_ads.video_time
				LEFT JOIN
					tbl_video_ads_track as video_ads_track
				ON
					video_ads.ad_ID = video_ads_track.ad_ID
				LEFT JOIN
					movies
				ON
					video_ads_track.movie_ID = movies.movie_ID
				LEFT JOIN
					users
				ON
					video_ads_track.user_ID = users.user_ID
				WHERE
					movies.movie_ID = '.$params['movie_ID'].'
				AND
					ads_price.ads_price_id = '.$params['ads_price_id'].'
				';

		$query = $this->db->query($sql);

		if($query->num_rows > 0) {
			foreach($query->result() as $row) {
				$result[] = array(
									'video_ads_track_id' => $row->video_ads_track_id,
									'ad_id' => $row->ad_ID,
									'user_id' => $row->user_ID,
									'user_fname_lname' => (empty($row->user_fname) && empty($row->user_lname) ? NULL : $row->user_fname.' '.$row->user_lname),
									'device' => $row->device,
									'ip_address' => $row->ip_address,
									'city' => $row->city,
									'isp' => $row->isp,
									'date_created' => $row->date_created,
								);
			}
			return $result;
		} else {
			return NULL;
		}
	}

}