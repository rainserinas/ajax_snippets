<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class accounts extends CI_Controller {

    public function __construct() {
		parent::__construct();
        $this->load->model('musers');
        $this->load->model('mgeneral');
        $this->load->library('breadcrumbs');

        $this->musers->access();
        $this->userinfo     = (object)$this->mgeneral->getUserInfo(array('account_id'=>$this->mgeneral->getCurrUserId()));
        $this->support      = (object)$this->mgeneral->getSupport();

        $this->uri_segments = $this->uri->uri_to_assoc();
        $this->cur_class    = strtolower(__CLASS__);

        if($this->userinfo->AccountTypeID != 1 && $this->userinfo->AccountTypeID != 2) redirect(base_url());
	}

	public function _remap($method) {
        $method = camelize($method);
        if(method_exists($this, $method))
            $this->$method();
        else
            show_error ('Page not found.');
    }

	public function index() {
        $selectArr = array('AccountID','AccountTypeID','DateModified','EmailAddress','DateCreated');
        $this->load->model("my_model", "select");
        $this->select->set_up_table('tbl_account', '', $selectArr);

        $joinArr = array(array('table'=>'ref_account_info','id'=>'AccountID','join_id'=>'AccountID','type'=>'left','fields'=>array('FirstName','LastName')),   
                    array('table'=>'ref_account_type','id'=>'AccountTypeID','join_id'=>'AccountTypeID','type'=>'left','fields'=>array('AccountTypeID','AccountType')));
        $results = $this->select->select('', $joinArr);

        $page = (object)array('title'=>'cPanel - Admin Accounts','header'=>'Admin Accounts','code'=>'list');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support,'results'=>$results,'tableOrder'=>'asc','tableSortable'=>'1, 3');

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Admin Accounts', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
	}

    public function create() {
        $page = (object)array('title'=>'cPanel - Create Account','header'=>'Create Account','code'=>'create');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support);

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Admin Accounts', '/accounts');
        $this->breadcrumbs->push('Create Account', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function modify() {
        $this->load->model("my_model", "check");
        $this->check->set_up_table('tbl_account', '', array('*'));
        $user_info = $this->check->select(array('AccountID'=>$this->uri_segments['id']));

        if(empty($user_info)) redirect($this->cur_class);

        $selectArr = array('AccountID','AccountTypeID','EmailAddress');
        $this->load->model("my_model", "select");
        $this->select->set_up_table('tbl_account', '', $selectArr);
        $joinArr = array(array('table'=>'ref_account_info','id'=>'AccountID','join_id'=>'AccountID','type'=>'left','fields'=>array('Firstname','Lastname')));
        $results = $this->flatten_array($this->select->select(array('AccountID'=>$this->uri_segments['id']), $joinArr));

        $page = (object)array('title'=>'cPanel - Modify Account','header'=>'Modify Account','code'=>'modify');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support,'results'=>$results);

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Admin Accounts', '/accounts');
        $this->breadcrumbs->push('Modify Account', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function save() {
        if(empty($this->uri_segments['id'])) {
            $this->load->model("my_model", "insert_tbl");
            $this->insert_tbl->set_up_table('tbl_account',array('AccountTypeID','EmailAddress','Password','SessionID','DateCreated'));
            $this->insert_tbl->set_AccountTypeID($this->input->post('account_type_id'));
            $this->insert_tbl->set_EmailAddress($this->input->post('email'));
            $this->insert_tbl->set_Password(do_hash($this->input->post('password'), 'MD5'));
            $this->insert_tbl->set_SessionID(do_hash($this->input->post('email').date('l jS \of F Y h:i:s A'), 'MD5'));
            $this->insert_tbl->set_DateCreated(date('Y-m-d G:i:s'));

            $this->load->model("my_model", "insert_ref");
            $this->insert_ref->set_up_table('ref_account_info',array('AccountID','AccountPicture','FirstName','LastName'));
            $this->insert_ref->set_AccountID($this->insert_tbl->insert());
            $this->insert_ref->set_AccountPicture($this->input->post('account_type_id').'.jpg');
            $this->insert_ref->set_FirstName($this->input->post('firstname'));
            $this->insert_ref->set_LastName($this->input->post('lastname'));

            if($this->insert_ref->insert()) {
                $_SESSION['actionMessage'] = 'Account has been created successfully and is ready to use!';
                redirect(base_url('accounts'));
            } else {
                $_SESSION['actionMessage'] = 'An Error occurred while creating account. Please try again.';
                redirect(base_url('accounts'));
            }
        } else {
            $this->load->model("my_model", "update_tbl");
            $this->update_tbl->set_up_table('tbl_account',array('AccountTypeID','EmailAddress'));
            $this->update_tbl->set_AccountTypeID($this->input->post('account_type_id'));
            $this->update_tbl->set_EmailAddress($this->input->post('email'));

            $this->load->model("my_model", "update_ref");
            $this->update_ref->set_up_table('ref_account_info',array('AccountPicture','FirstName','LastName'));
            $this->update_ref->set_AccountPicture($this->input->post('account_type_id').'.jpg');
            $this->update_ref->set_FirstName($this->input->post('firstname'));
            $this->update_ref->set_LastName($this->input->post('lastname'));

            if($this->update_tbl->update(array('AccountID'=>$this->uri_segments['id'])) && $this->update_ref->update(array('AccountID'=>$this->uri_segments['id']))) {
                $_SESSION['actionMessage'] = 'Account has been modified successfully!';
                redirect(base_url('accounts'));
            } else {
                $_SESSION['actionMessage'] = 'An Error occurred while updating account details. Please try again.';
                redirect(base_url('accounts'));
            }
        }
    }

    public function remove() {
        $data['remove_header'] = 'Account';
        $data['remove_body'] = 'User #'.$this->uri_segments['id'];
        $data['remove_submit'] = base_url('accounts/confirm_remove/id/'.$this->uri_segments['id']);
        $this->load->view('modal/remove',$data);
    }

    public function confirmRemove() {
        $this->load->model("my_model", "remove_tbl");
        $this->remove_tbl->set_up_table('tbl_account');

        $this->load->model("my_model", "remove_ref");
        $this->remove_ref->set_up_table('ref_account_info');

        if($this->remove_tbl->remove(array('AccountID'=>$this->uri_segments['id'])) && $this->remove_ref->remove(array('AccountID'=>$this->uri_segments['id']))) {
            $_SESSION['actionMessage'] = 'You have successfully removed an account!';
            redirect(base_url('accounts'));
        } else {
            $_SESSION['actionMessage'] = 'An Error occurred while removing account. Please try again.';
            redirect(base_url('accounts'));
        }
    }

    private function flatten_array($multi_array) {
        foreach ($multi_array as $flatten) {
            return $flatten;
        }
    }

}