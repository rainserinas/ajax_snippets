<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct() {
    	parent::__construct();
        
        $this->load->model('musers');
        $this->load->model('mgeneral');
        $this->load->model('mhome');
        $this->load->model('mtables');
        $this->load->library('breadcrumbs');

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
        $this->modifyBanner();
    }

    public function modifyBanner($error="") {
        $this->load->model("my_model", "check");
        $this->check->set_up_table('tbl_pages', '', array('*'));
        $contact_info = $this->check->select(array('Page'=>'Contact'));

        if(empty($contact_info)) redirect($this->cur_class);

        $results = $this->flatten_array($contact_info);

        $page = (object)array('title'=>'cPanel - Contact','header'=>'Modify Banner','code'=>'modify_banner');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support, 'results'=>$results);

        if(!empty($error['contact_banner'])) {
            $data['contact_banner']['error_upload'] = $error['contact_banner']; 
        }

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Modify Banner', '/contact/modifyBanner');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function saveBanner() {
        $image_path = realpath(APPPATH . '../../img/uploads/site/pages/');

        $config['upload_path'] = $image_path;
        $config['allowed_types'] = 'jpg|JPG';
        $config['min_width']  = '2000';
        $config['min_height']  = '1004';
        $config['max_width']  = '2000';
        $config['max_height']  = '1004';
        $config['file_name'] = 'contact-img' . uniqid();
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('contact_banner')) {
            $error = array('contact_banner' => $this->upload->display_errors());
            $this->modifyBanner($error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $this->load->model("my_model", "update_tbl");
            $this->update_tbl->set_up_table('tbl_pages',array('Image', 'DateModified'));
            $this->update_tbl->set_Image($data['upload_data']['file_name']);
            $this->update_tbl->set_DateModified(date('Y-m-d G:i:s'));

            if($this->update_tbl->update(array('PageID'=>$this->uri_segments['id']))) {
                $_SESSION['actionMessage'] = 'Contact Banner has been modified successfully!';
                redirect(base_url('contact/modifyBanner'));
            } else {
                $_SESSION['actionMessage'] = 'An Error occurred while updating contact banner. Please try again.';
                redirect(base_url('contact/modifyBanner'));
            }
        }
    }

    public function contents() {
        $page = (object)array('title'=>'cPanel - Careers','header'=>'Contents', 'code'=>'contents');
        $data = array('pageInfo'=>$page, 'userInfo'=>$this->userinfo, 'support'=>$this->support);
        
        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Contents', '/careers/contents');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function saveContent() {
        $error_update = null;

        /* Contact Content */
        $this->load->model("my_model", "update_tbl");
        $this->update_tbl->set_up_table('tbl_contents',array('Content', 'DateModified'));
        $this->update_tbl->set_Content($this->input->post('contact_content'));
        $this->update_tbl->set_DateModified(date('Y-m-d G:i:s'));

        if(!$this->update_tbl->update(array('ContentCode'=>'contact_content'))) {
            $error_update .= "An Error occurred while updating Contact Content.";
        }
        /* End Contact Content */

        /* Bulacan Content */
        $this->load->model("my_model", "update_tbl");
        $this->update_tbl->set_up_table('tbl_contents',array('Content', 'DateModified'));
        $this->update_tbl->set_Content($this->input->post('bulacan_content'));
        $this->update_tbl->set_DateModified(date('Y-m-d G:i:s'));

        if(!$this->update_tbl->update(array('ContentCode'=>'bulacan_content'))) {
            $error_update .= "An Error occurred while updating Bulacan Content.";
        }
        /* End Bulacan Content */

        /* Caloocan Content */
        $this->load->model("my_model", "update_tbl");
        $this->update_tbl->set_up_table('tbl_contents',array('Content', 'DateModified'));
        $this->update_tbl->set_Content($this->input->post('caloocan_content'));
        $this->update_tbl->set_DateModified(date('Y-m-d G:i:s'));

        if(!$this->update_tbl->update(array('ContentCode'=>'caloocan_content'))) {
            $error_update .= "An Error occurred while updating Caloocan Content.";
        }
        /* End Caloocan Content */

        if(empty($error_update)) {
            $_SESSION['actionMessage'] = 'Changes has been modified successfully!';
            redirect(base_url('contact/contents'));
        } else {
            $_SESSION['actionMessage'] = "An Error occurred while updating.";
            redirect(base_url('contact/contents'));
        }
    }

    private function flatten_array($multi_array) {
        foreach ($multi_array as $flatten) {
            return $flatten;
        }
    }
}