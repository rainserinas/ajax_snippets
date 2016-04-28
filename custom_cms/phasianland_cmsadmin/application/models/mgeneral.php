<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mgeneral extends CI_Model {
	private $params;
	
	public function __construct() {
		parent::__construct();

		$this->load->helper('security');
	}
	
	public function checkUserCredentials($params = array()) {
		$args = (object)$params;
		$query = $this->db->select('AccountID, EmailAddress, Password, SessionID')->where(array('EmailAddress'=>$args->email,'Password'=>do_hash($args->password,'MD5')))->get('tbl_account');

		if(!($this->db->affected_rows() == 0)) {
			if($query->num_rows() > 0){
				if($this->db->update('tbl_account',array('SessionID'=>$args->session),array('AccountID'=>$query->row()->AccountID))) { 
					return true;
				} else {
					return false;
				}
			}	
		}
	}

	/*
	  1 - Developer - No Restriction
	  2 - Administrator - Add, Edit, Delete Content
	  3 - Advertiser - Track Advertisement Views
	  4 - Publisher - Track Movie Views
	*/

	public function getUserInfo($params = array()) {
		$args = (object)$params;
		$query = $this->db->select('info.AccountPicture, info.FirstName,info.LastName,CONCAT(info.FirstName,(" "),info.LastName) AS FullName,info.AccountID,access.EmailAddress,access.AccountID,type.AccountTypeID,type.AccountType',FALSE)
				->join('tbl_account access','access.AccountID=info.AccountID','left')->join('ref_account_type type','access.AccountTypeID=type.AccountTypeID','left')
				->where(array('access.AccountID'=>$args->account_id))->get('ref_account_info info');
		
		foreach($query->result() as $row) {
			$result = $row;
		}
		return $result;

	}

	public function getSupport() {
		$result = null;

		$query = $this->db->select('support.SupportID,support.Title,support.Priority,account.AccountID,account.AccountTypeID,info.FirstName,info.LastName,CONCAT(info.FirstName,(" "),info.LastName) AS FullName',FALSE)
				->join('ref_account_info info','support.AccountID=info.AccountID')->join('tbl_account account','support.AccountID=account.AccountID')
				->where(array('Status'=>'Open'))->order_by('supportID','DESC')->limit(10)->get('tbl_support support');
		
		foreach($query->result() as $row) {
			$result[] = $row;
		}

		return array('total'=>$query->num_rows(),'details'=>$result);
	}
	
	public function getCurrUserId() {
		if(isset($_SESSION['sessionID'])){
			$query = $this->db->where('SessionID',$_SESSION['sessionID'])->limit(1)->get('tbl_account');

			if($query->num_rows > 0){
				$result = $query->row();
				return $result->AccountID;
			}
		}
		return NULL;
	}

	public function timeAgo($time_ago) {
	    $time_ago = strtotime($time_ago);
	    $cur_time   = time();
	    $time_elapsed   = $cur_time - $time_ago;
	    $seconds    = $time_elapsed ;
	    $minutes    = round($time_elapsed / 60 );
	    $hours      = round($time_elapsed / 3600);
	    $days       = round($time_elapsed / 86400 );
	    $weeks      = round($time_elapsed / 604800);
	    $months     = round($time_elapsed / 2600640 );
	    $years      = round($time_elapsed / 31207680 );
	    
	    if($seconds <= 60){
	        return "Just now";
	    }
	   
	    else if($minutes <= 60){
	        if($minutes==1) {
	            return "one minute ago";
	        } else {
	            return "$minutes minutes ago";
	        }
	    }
	   
	    else if($hours <= 24){
	        if($hours==1) {
	            return "an hour ago";
	        } else {
	            return "$hours hrs ago";
	        }
	    }
	    
	    else if($days <= 7){
	        if($days==1) {
	            return "Yesterday";
	        } else {
	            return "$days days ago";
	        }
	    }
	    
	    else if($weeks <= 4.3) {
	        if($weeks==1) {
	            return "a week ago";
	        } else {
	            return "$weeks weeks ago";
	        }
	    }
	    
	    else if($months <= 12){
	        if($months==1) {
	            return "a month ago";
	        } else {
	            return "$months months ago";
	        }
	    }
	    
	    else{
	        if($years==1) {
	            return "one year ago";
	        } else if($years==46) {
	        	return "no activity yet";
	        } else {
	            return "$years years ago";
	        }
	    }
	}

	public function dateTimeFormat($params) {
		$date_time = date("M j, Y g:i A", strtotime($params));

		if($date_time == 'Jan 1, 1970 8:00 AM') {
			return 'No update yet';
		} else {
			return $date_time;
		}
	}

	public function dateFormat($str) {
        $month = array(" ", "Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec");
        $y = explode(' ', $str);
        $x = explode('-', $y[0]);
        $date = "";    
        $m = (int)$x[1];
        $m = $month[$m];
        $st = array(1, 21, 31);
        $nd = array(2, 22);
        $rd = array(3, 23);
        if(in_array( $x[2], $st)) {
        	$date = $x[2].'st';
        }
        else if(in_array( $x[2], $nd)) {
        	$date .= $x[2].'nd';
        }
        else if(in_array( $x[2], $rd)) {
        	$date .= $x[2].'rd';
        }
        else {
        	$date .= $x[2].'th';
        }
        $date .= ' ' . $m . ', ' . $x[0];

        if($str == '0000-00-00 00:00:00') {
        	return '<span class="text-danger">no activity yet</span>';
        } else {
        	return $date;
        }
        
	}

	public function ageFormat($datetime) {
		$birth_date = strtotime($datetime);
		$now = time();
		$age = $now-$birth_date;
		$a = $age/60/60/24/365.25;
  	
		return floor($a);
	}

	public function timeElapsed($datetime, $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
	
}