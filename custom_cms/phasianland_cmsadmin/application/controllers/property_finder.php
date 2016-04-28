<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Property_finder extends CI_Controller {

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
        $this->modifyBanner();
    }

    public function modifyBanner($error="") {
        $this->load->model("my_model", "check");
        $this->check->set_up_table('tbl_pages', '', array('*'));
        $banner_info = $this->check->select(array('Page'=>'Property Finder'));

        if(empty($banner_info)) redirect($this->cur_class);

        $results = $this->flatten_array($banner_info);

        $page = (object)array('title'=>'cPanel - Property Finder','header'=>'Modify Banner','code'=>'modify_banner');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support, 'results'=>$results);

        if(isset($_SESSION['errorUpload']) && !empty($_SESSION['errorUpload'])) {
            $error_upload = $_SESSION['errorUpload'];
            $data = array_merge($data, $error_upload);
            unset($_SESSION['errorUpload']);
        }

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Modify Banner', '/property_finder/modifyBanner');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function saveBanner() {
        $error_update = null;
        $error_upload = null;

        /* Description */
        $this->load->model("my_model", "update_data");
        $this->update_data->set_up_table('tbl_pages',array('Description', 'DateModified'));
        $this->update_data->set_Description($this->input->post('description'));
        $this->update_data->set_DateModified(date('Y-m-d G:i:s'));

        if(!$this->update_data->update(array('PageID'=>$this->uri_segments['id']))) {
            $error_update .= "An Error occurred while updating banner.";
        }
        /* End Description */

        $image_path = realpath(APPPATH . '../../img/uploads/site/pages/');
        /* Property Banner */
        if (!empty($_FILES['property_banner']['name'])) {
            $config['property_banner']['upload_path'] = $image_path;
            $config['property_banner']['allowed_types'] = 'jpg|JPG';
            $config['property_banner']['min_width'] = '2000';
            $config['property_banner']['min_height'] = '1004';
            $config['property_banner']['max_width'] = '2000';
            $config['property_banner']['max_height'] = '1004';
            $config['property_banner']['file_name'] = 'property-img' . uniqid();
            $config['property_banner']['overwrite'] = TRUE;

            $property_banner = $this->doupload('property_banner', $config['property_banner']);
            if(!array_key_exists('upload_error', $property_banner)) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_pages',array('Image', 'DateModified'));
                $this->update_tbl->set_Image($property_banner['upload_data']['file_name']);
                $this->update_tbl->set_DateModified(date('Y-m-d G:i:s'));

                if(!$this->update_tbl->update(array('PageID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating banner.";
                }
            } else {
                $error_upload['property_banner']['error_upload'] = $property_banner['upload_error'];
            }
        }
        /* End Property Banner */

        if(!empty($error_upload)) :
            $_SESSION['errorUpload'] = $error_upload;
        endif;

        if(empty($error_update) && empty($error_upload)) {
            $_SESSION['actionMessage'] = 'Banner has been modified successfully!';
        } else {
            $_SESSION['actionMessage'] = "An Error occurred while updating banner.";
        }
        redirect(base_url('property_finder/modifyBanner'));
    }

    private function doupload($name, $config) {
        $this->upload->initialize($config);

        $data = array('upload_error', 'upload_data');

        if (!$this->upload->do_upload($name)) {
            $data['upload_error'] = $this->upload->display_errors();
        } else {
            $data['upload_data'] = $this->upload->data();
        }

        return $data;
    }

    private function flatten_array($multi_array) {
        foreach ($multi_array as $flatten) {
            return $flatten;
        }
    }
}