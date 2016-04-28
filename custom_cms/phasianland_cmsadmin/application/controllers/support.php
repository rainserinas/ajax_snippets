<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class support extends CI_Controller {

    public function __construct() {
		parent::__construct();
        ob_start();
        
        $this->load->model('musers');
        $this->load->model('mgeneral');
        $this->load->library('breadcrumbs');

        $this->musers->access();        
        $this->userinfo     = (object)$this->mgeneral->getUserInfo(array('account_id'=>$this->mgeneral->getCurrUserId()));
        $this->support      = (object)$this->mgeneral->getSupport();

        $this->uri_segments = $this->uri->uri_to_assoc();
        $this->cur_class    = strtolower(__CLASS__);
	}

	public function _remap($method) {
        $method = camelize($method);
        if(method_exists($this, $method))
            $this->$method();
        else
            show_error ('Page not found.');
    }

	public function index() {
        $this->load->model("my_model", "select");
        $this->select->set_up_table('tbl_support', '', array('*'));
        $results = $this->select->select('', '', array('order_by'=>'SupportID','order'=>'DESC'));

        $this->load->model("my_model", "closed");
        $this->closed->set_up_table('tbl_support', '', array('*'));
        $closed_issues = $this->closed->select(array('status'=>'Closed'), '', array('order_by'=>'SupportID','order'=>'DESC'));

        $this->load->model("my_model", "progress");
        $this->progress->set_up_table('tbl_support', '', array('*'));
        $in_progress_issues = $this->progress->select(array('status'=>'In Progress'), '', array('order_by'=>'SupportID','order'=>'DESC'));

        $page = (object)array('title'=>'cPanel - Issue List','header'=>'Issue List','code'=>'list');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support,'results'=>$results,'closed_issues'=>$closed_issues,'in_progress_issues'=>$in_progress_issues,'tableOrder'=>'asc','tableSortable'=>'1, 3');

        $this->breadcrumbs->push('Dashboard', '/home');
        $this->breadcrumbs->push('Support', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
	}

	public function report() {
        $page = (object)array('title'=>'cPanel - Report Issue','header'=>'Report Issue','code'=>'report');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support);

        $this->breadcrumbs->push('Dashboard', '/home');
        $this->breadcrumbs->push('Support', '/support');
        $this->breadcrumbs->push('Report Issue', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
	}

	public function issue() {
        $this->load->model("my_model", "check");
        $this->check->set_up_table('tbl_support', '', array('*'));
        $support = $this->flatten_array($this->check->select(array('SupportID'=>$this->uri_segments['id'])));

        if(empty($support)) redirect($this->cur_class);
        
        $selectArr = array('AccountID','SupportID','Type','Title','Description','Priority','Status','DateCreated','LastUpdate');
        $this->load->model("my_model", "select");
        $this->select->set_up_table('tbl_support', '', $selectArr);

        $selectArr = array('AccountID','Message','DateCreated');
        $tableName = "ref_support_comment";
        $this->load->model("my_model", "comment");
        $this->comment->set_up_table($tableName, '', $selectArr);

        $joinArr = array(array('table'=>'ref_account_info','id'=>'AccountID','join_id'=>'AccountID','type'=>'left','fields'=>array('AccountID','FirstName','LastName')));
        $results = array('info' => $this->flatten_array($this->select->select(array('SupportID'=>$this->uri_segments['id']), $joinArr, array('order_by'=>'SupportID','order'=>'desc'))),
                    'comments' => $this->comment->select(array('SupportID'=>$this->uri_segments['id']), $joinArr, array('order_by'=>'SupportCommentID','order'=>'desc')));

        $page = (object)array('title'=>'cPanel - View Issue','header'=>'View Issue','code'=>'view');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support,'results'=>$results);

        $this->breadcrumbs->push('Dashboard', '/home');
        $this->breadcrumbs->push('Support', '/support');
        $this->breadcrumbs->push('Issue #'.$support->SupportID, '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
	}

    public function save() {
        $this->load->model("my_model", "insert");

        if(!($this->input->post('message'))) {
            $this->insert->set_up_table('tbl_support', array('AccountID','Type','Title','Priority','Description','DateCreated'));
            $this->insert->set_AccountID($this->mgeneral->getCurrUserId());
            $this->insert->set_Type($this->input->post('type'));
            $this->insert->set_Title($this->input->post('title'));
            $this->insert->set_Priority($this->input->post('priority'));
            $this->insert->set_Description($this->input->post('description'));
            $this->insert->set_DateCreated(date('Y-m-d G:i:s'));

            if($this->insert->insert()) {
                $_SESSION['actionMessage'] = 'Your report has been submitted successfully!';
                redirect(base_url('support'));
            } else {
                $_SESSION['actionMessage'] = 'An Error occurred while creating report. Please try again.';
                redirect(base_url('support'));
            }
        } else {
            $this->insert->set_up_table('ref_support_comment', array('SupportID','AccountID','Message'));
            $this->insert->set_SupportID($this->input->post('support_id'));
            $this->insert->set_AccountID($this->mgeneral->getCurrUserId());
            $this->insert->set_Message($this->input->post('message'));
            $this->insert->insert();
        }
    }

    public function remove() {
        $data['remove_header'] = 'Issue';
        $data['remove_body'] = 'Issue #'.$this->uri_segments['id'];
        $data['remove_submit'] = base_url('support/confirm_remove/id/'.$this->uri_segments['id']);
        $this->load->view('modal/remove',$data);
    }

    public function confirmRemove() {
        $this->load->model("my_model", "remove_tbl");
        $this->remove_tbl->set_up_table('tbl_support');

        $this->load->model("my_model", "remove_ref");
        $this->remove_ref->set_up_table('ref_support_comment');

        if($this->remove_tbl->remove(array('SupportID'=>$this->uri_segments['id'])) && $this->remove_ref->remove(array('SupportID'=>$this->uri_segments['id']))) {
            $_SESSION['actionMessage'] = 'Report has been removed successfully!';
            redirect(base_url('support'));
        } else {
            $_SESSION['actionMessage'] = 'An Error occurred while removing report. Please try again.';
            redirect(base_url('support'));
        }
    }

    public function setStatus() {
        if($this->uri_segments['status']=='close') {
            $this->load->model("my_model", "update");
            $this->update->set_up_table('tbl_support', array('Status'));
            $this->update->set_Status("Closed");
        } else if($this->uri_segments['status']=='progress') {
            $this->load->model("my_model", "update");
            $this->update->set_up_table('tbl_support', array('Status'));
            $this->update->set_Status("In Progress");
        } else {
            $this->load->model("my_model", "update");
            $this->update->set_up_table('tbl_support', array('Status','LastUpdate'));
            $this->update->set_Status("Open");
            $this->update->set_LastUpdate("0000-00-00 00:00:00");
        }

        if($this->update->update(array('SupportID'=>$this->uri_segments['id']))) {
            $_SESSION['actionMessage'] = 'You have successfully updated report status!';
            redirect(base_url('support/issue/id/'.$this->uri_segments['id'].''));
        } else {
            $_SESSION['actionMessage'] = 'An Error occurred while updating report status. Please try again.';
            redirect(base_url('support/issue/id/'.$this->uri_segments['id'].''));
        }
    }

	private function flatten_array($multi_array) {
        foreach ($multi_array as $flatten) {
            return $flatten;
        }
    }

}