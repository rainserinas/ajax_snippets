<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Careers extends CI_Controller {

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
        $this->vacancies();
    }

    public function vacancies() {
        $page = (object)array('title'=>'cPanel - Careers','header'=>'Vacancies','code'=>'list');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support, 'results'=>$this->mtables->getCareersList());
        
        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Vacancies', 'careers/vacancies');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function create() {
        $page = (object)array('title'=>'cPanel - Create Position','header'=>'Create Position','code'=>'create');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support);

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Vacancies', '/careers/vacancies');
        $this->breadcrumbs->push('Create Position', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function modify() {
        $this->load->model("my_model", "check");
        $this->check->set_up_table('tbl_careers', '', array('*'));
        $career_info = $this->check->select(array('CareerID'=>$this->uri_segments['id']));

        if(empty($career_info)) redirect($this->cur_class);

        $results = $this->flatten_array($career_info);

        $page = (object)array('title'=>'cPanel - Modify Position','header'=>'Modify Position','code'=>'modify');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support,'results'=>$results);

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Vacancies', '/careers/vacancies');
        $this->breadcrumbs->push('Modify Position', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function save() {
        if(empty($this->uri_segments['id'])) {
            $this->load->model("my_model", "insert_tbl");
            $this->insert_tbl->set_up_table('tbl_careers',array('Position', 'Requirements', 'Responsibilities', 'Status', 'DateCreated', 'DateModified'));
            $this->insert_tbl->set_Position($this->input->post('position'));
            $this->insert_tbl->set_Requirements($this->input->post('requirements'));
            $this->insert_tbl->set_Responsibilities($this->input->post('responsibilities'));
            $this->insert_tbl->set_Status($this->input->post('status'));
            $this->insert_tbl->set_DateCreated(date('Y-m-d G:i:s'));
            $this->insert_tbl->set_DateModified(date('Y-m-d G:i:s'));

            if($this->insert_tbl->insert()) {
                $_SESSION['actionMessage'] = 'Career has been created successfully and is ready to use!';
                redirect(base_url('careers'));
            } else {
                $_SESSION['actionMessage'] = 'An Error occurred while creating career. Please try again.';
                redirect(base_url('careers'));
            }
        } else {
            $this->load->model("my_model", "update_tbl");
            $this->update_tbl->set_up_table('tbl_careers',array('Position', 'Requirements','Responsibilities', 'Status', 'DateModified'));
            $this->update_tbl->set_Position($this->input->post('position'));
            $this->update_tbl->set_Requirements($this->input->post('requirements'));
            $this->update_tbl->set_Responsibilities($this->input->post('responsibilities'));
            $this->update_tbl->set_Status($this->input->post('status'));
            $this->update_tbl->set_DateModified(date('Y-m-d G:i:s'));

            if($this->update_tbl->update(array('CareerID'=>$this->uri_segments['id']))) {
                $_SESSION['actionMessage'] = 'Career has been modified successfully!';
                redirect(base_url('careers'));
            } else {
                $_SESSION['actionMessage'] = 'An Error occurred while updating career details. Please try again.';
                redirect(base_url('careers'));
            }
        }
    }

    public function modifyBanner($error="") {
        $this->load->model("my_model", "check");
        $this->check->set_up_table('tbl_pages', '', array('*'));
        $career_info = $this->check->select(array('Page'=>'Careers'));

        if(empty($career_info)) redirect($this->cur_class);

        $results = $this->flatten_array($career_info);

        $page = (object)array('title'=>'cPanel - Careers','header'=>'Modify Banner','code'=>'modify_banner');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support, 'results'=>$results);

        if(!empty($error['career_banner'])) {
            $data['career_banner']['error_upload'] = $error['career_banner']; 
        }

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Modify Banner', '/careers/modifyBanner');
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
        $config['file_name'] = 'career-img' . uniqid();
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('career_banner')) {
            $error = array('career_banner' => $this->upload->display_errors());
            $this->modifyBanner($error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $this->load->model("my_model", "update_tbl");
            $this->update_tbl->set_up_table('tbl_pages',array('Image', 'DateModified'));
            $this->update_tbl->set_Image($data['upload_data']['file_name']);
            $this->update_tbl->set_DateModified(date('Y-m-d G:i:s'));

            if($this->update_tbl->update(array('PageID'=>$this->uri_segments['id']))) {
                $_SESSION['actionMessage'] = 'Career Banner has been modified successfully!';
                redirect(base_url('careers/modifyBanner'));
            } else {
                $_SESSION['actionMessage'] = 'An Error occurred while updating career banner. Please try again.';
                redirect(base_url('careers/modifyBanner'));
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

        /* Careers Content */
        $this->load->model("my_model", "update_tbl");
        $this->update_tbl->set_up_table('tbl_contents',array('Content', 'DateModified'));
        $this->update_tbl->set_Content($this->input->post('careers_content'));
        $this->update_tbl->set_DateModified(date('Y-m-d G:i:s'));

        if(!$this->update_tbl->update(array('ContentCode'=>'careers_content'))) {
            $error_update .= "An Error occurred while updating Careers Content.";
        }
        /* End Careers Content */

        if(empty($error_update)) {
            $_SESSION['actionMessage'] = 'Changes has been modified successfully!';
            redirect(base_url('careers/contents'));
        } else {
            $_SESSION['actionMessage'] = "An Error occurred while updating.";
            redirect(base_url('careers/contents'));
        }
    }

    public function remove() {
        $data['remove_header'] = 'Careers';
        $data['remove_body'] = 'Position: '. urldecode($this->uri_segments['position']);
        $data['remove_submit'] = base_url('careers/confirmRemove/id/'.$this->uri_segments['id']);
        $this->load->view('modal/remove', $data);
    }

    public function confirmRemove() {
        $this->load->model("my_model", "remove_tbl");
        $this->remove_tbl->set_up_table('tbl_careers');

        if($this->remove_tbl->remove(array('CareerID'=>$this->uri_segments['id']))) {
            $_SESSION['actionMessage'] = 'You have successfully removed a career!';
            redirect(base_url('careers'));
        } else {
            $_SESSION['actionMessage'] = 'An Error occurred while removing career. Please try again.';
            redirect(base_url('careers'));
        }
    }

    private function flatten_array($multi_array) {
        foreach ($multi_array as $flatten) {
            return $flatten;
        }
    }
}