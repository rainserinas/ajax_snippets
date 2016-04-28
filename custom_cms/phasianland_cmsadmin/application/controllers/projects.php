<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {

    public function __construct() {
    	parent::__construct();
        
        $this->load->model('musers');
        $this->load->model('mgeneral');
        $this->load->model('mhome');
        $this->load->model('mtables');
        $this->load->library(array('breadcrumbs', 'upload'));

        $this->load->helper(array('form', 'url', 'file'));

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
        $page = (object)array('title'=>'cPanel - Projects','header'=>'Contents', 'code'=>'contents');
        $data = array('pageInfo'=>$page, 'userInfo'=>$this->userinfo, 'support'=>$this->support);
        
        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Contents', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function saveContent() {
        $error_update = null;

        /* Project Content */
        $this->load->model("my_model", "update_tbl");
        $this->update_tbl->set_up_table('tbl_contents',array('Content', 'DateModified'));
        $this->update_tbl->set_Content($this->input->post('project_content'));
        $this->update_tbl->set_DateModified(date('Y-m-d G:i:s'));

        if(!$this->update_tbl->update(array('ContentCode'=>'project_content'))) {
            $error_update .= "An Error occurred while updating Project Content.";
        }
        /* End Project Content */

        if(empty($error_update)) {
            $_SESSION['actionMessage'] = 'Changes has been modified successfully!';
            redirect(base_url('projects'));
        } else {
            $_SESSION['actionMessage'] = "An Error occurred while updating.";
            redirect(base_url('projects'));
        }
    }
}