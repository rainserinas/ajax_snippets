<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		session_start();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('mgeneral');

		$this->cur_class = strtolower(__CLASS__);
	}

	public function index() {
		$this->form_validation->set_rules('email', '', 'valid_email|required');
		$this->form_validation->set_rules('password', '', 'required');
		
		if ($this->form_validation->run() !== false) {
			$sessionID 			= do_hash($this->input->post('email').date('l jS \of F Y h:i:s A'), 'MD5');
			$is_account_valid 	= $this->mgeneral->checkUserCredentials(array('email'=>$this->input->post('email'),'password'=>$this->input->post('password'),'session'=>$sessionID));
			
			if($is_account_valid) {
				$_SESSION['sessionID'] = $sessionID;

				$cookie = array(
				    'name'   => 'xnavigation',
				    'value'  => 0,
					'expire' => '86500'
				);
				$this->input->set_cookie($cookie);

				if($this->session->userdata('redirect_back')) {
				    $redirect_url = $this->session->userdata('redirect_back');
				    $this->session->unset_userdata('redirect_back');
				    redirect($redirect_url);
				}

			} else {
				$_SESSION['loginError'] = 'The email or password you entered is not correct, please try again.';
			}
		}

		if(isset($_SESSION['sessionID']))	redirect('accounts');
	  
		$data = array('title'=>'cPanel - Login');
	  	$this->load->view($this->cur_class.'_view', $data);
	}

	public function xnavigation() {
		if($this->input->cookie('xnavigation') == 1) {
			$cookie = array(
			    'name'   => 'xnavigation',
			    'value'  => '0',
				'expire' => '86500'
			);
		} else if($this->input->cookie('xnavigation') == 0) {
			$cookie = array(
			    'name'   => 'xnavigation',
			    'value'  => '1',
				'expire' => '86500'
			);
		} else {
			//nothing happen
		}

		$this->input->set_cookie($cookie);
	}

	public function signout() {
		unset($_SESSION['sessionID']);
		delete_cookie('xnavigation');
		redirect(base_url());
	}
}