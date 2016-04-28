<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_events extends CI_Controller {

    public function __construct() {
    	parent::__construct();
        
        $this->load->model('musers');
        $this->load->model('mgeneral');
        $this->load->model('mhome');
        $this->load->model('mtables');
        $this->load->library(array('breadcrumbs', 'upload'));

        $this->load->helper('form');
        $this->load->helper('url');

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
        $this->lists();
    }

    public function lists() {
        $page = (object)array('title'=>'cPanel - News & Events','header'=>'News & Events','code'=>'list');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support, 'results'=>$this->mtables->getNewsList());
        
        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('News & Events', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function create() {
        $page = (object)array('title'=>'cPanel - Create News & Events','header'=>'Create News & Events','code'=>'create');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support);

        if(isset($_SESSION['errorUpload'])) {
            $error_upload = $_SESSION['errorUpload'];
            $data = array_merge($data, $error_upload);
            unset($_SESSION['errorUpload']);

            $this->load->model("my_model", "check");
            $this->check->set_up_table('tbl_news_events', '', array('*'));
            $news_info = $this->check->select(array('NewsID'=>$this->uri_segments['id']));

            $data['results'] = $this->flatten_array($news_info);
        }

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('News & Events', '/news_events');
        $this->breadcrumbs->push('Create News & Events', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function modify() {
        $this->load->model("my_model", "check");
        $this->check->set_up_table('tbl_news_events', '', array('*'));
        $news_info = $this->check->select(array('NewsID'=>$this->uri_segments['id']));

        if(empty($news_info)) redirect($this->cur_class);

        $results = $this->flatten_array($news_info);

        $page = (object)array('title'=>'cPanel - Modify News & Events','header'=>'Modify News & Events','code'=>'modify');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support,'results'=>$results);

        if(isset($_SESSION['errorUpload']) && !empty($_SESSION['errorUpload'])) {
            $error_upload = $_SESSION['errorUpload'];
            $data = array_merge($data, $error_upload);
            unset($_SESSION['errorUpload']);
        }

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('News & Events', '/news_events');
        $this->breadcrumbs->push('Modify News & Events', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function add() {
        $error_update = null;
        $error_upload = array();

        /* Details */
        if(empty($this->uri_segments['id'])) {
            $this->load->model("my_model", "insert_tbl");
            $this->insert_tbl->set_up_table('tbl_news_events',array('Title', 'Description', /*'Schedule',*/ 'Location', 'Status', 'DateCreated', 'DateModified'));
            $this->insert_tbl->set_Title($this->input->post('title'));
            $this->insert_tbl->set_Description($this->input->post('description'));
            /*$this->insert_tbl->set_Schedule($this->input->post('schedule'));*/
            $this->insert_tbl->set_Location($this->input->post('location'));
            $this->insert_tbl->set_Status($this->input->post('status'));
            $this->insert_tbl->set_DateCreated(date('Y-m-d G:i:s'));
            $this->insert_tbl->set_DateModified(date('Y-m-d G:i:s'));

            $newsId = $this->insert_tbl->insert();

            if(empty($newsId)) {
                $error_update .= "An Error occurred while updating community details. Please try again";
            }
        } else {
            $newsId = $this->uri_segments['id'];
        }
        /* End Details */

        /* Banner */
        if (!empty($_FILES['banner']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/news/');
            $config['banner']['upload_path'] = $image_path;
            $config['banner']['allowed_types'] = 'png|PNG|jpg|JPG';
            $config['banner']['overwrite'] = TRUE;
            $config['banner']['min_width']  = '1000';
            $config['banner']['min_height']  = '800';
            $config['banner']['max_width']  = '1000';
            $config['banner']['max_height']  = '800';
            $config['banner']['file_name'] = 'banner-img-' . $newsId;

            $banner = $this->doupload('banner', $config['banner']);
            if(empty($banner['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_news_events',array('Banner'));
                $this->update_tbl->set_Banner($banner['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('NewsID'=>$newsId))) {
                    $error_update .= "An Error occurred while adding banner.";
                }
            } else {
                $error_upload['banner']['error_upload'] = $banner['upload_error'];
            }
        } else {
            $error_upload['banner']['error_upload'] = "You did not select an image to upload.";
        }
        /* End Banner */

        /* Thumbnail Banner */
        if (!empty($_FILES['thumb_banner']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/news/');
            $config['thumb_banner']['upload_path'] = $image_path;
            $config['thumb_banner']['allowed_types'] = 'png|PNG|jpg|JPG';
            $config['thumb_banner']['overwrite'] = TRUE;
            $config['thumb_banner']['min_width']  = '310';
            $config['thumb_banner']['min_height']  = '310';
            $config['thumb_banner']['max_width']  = '310';
            $config['thumb_banner']['max_height']  = '310';
            $config['thumb_banner']['file_name'] = 'thumb-banner-img-' . $newsId;

            $thumb_banner = $this->doupload('thumb_banner', $config['thumb_banner']);
            if(empty($thumb_banner['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_news_events',array('ThumbBanner'));
                $this->update_tbl->set_ThumbBanner($thumb_banner['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('NewsID'=>$newsId))) {
                    $error_update .= "An Error occurred while adding thumbnail banner.";
                }
            } else {
                $error_upload['thumb_banner']['error_upload'] = $thumb_banner['upload_error'];
            }
        } else {
            $error_upload['thumb_banner']['error_upload'] = "You did not select an image to upload.";
        }
        /* End Thumbnail Banner */

        if(!empty($error_upload)) :
            $_SESSION['errorUpload'] = $error_upload;
        endif;

        if(empty($error_update) && empty($error_upload)) {
            $_SESSION['actionMessage'] = 'News has been created successfully!';
            redirect(base_url('news_events/lists'));
        } else {
            $_SESSION['actionMessage'] = "An Error occurred while creating news.";
            redirect(base_url('news_events/create/id/' . $newsId));
        }
    }

    public function save() {
        $error_update = null;

        /* Details */
        $this->load->model("my_model", "update_tbl");
        $this->update_tbl->set_up_table('tbl_news_events',array('Title', 'Description', /*'Schedule',*/ 'Location', 'Status', 'DateModified'));
        $this->update_tbl->set_Title($this->input->post('title'));
        $this->update_tbl->set_Description($this->input->post('description'));
        /*$this->update_tbl->set_Schedule($this->input->post('schedule'));*/
        $this->update_tbl->set_Location($this->input->post('location'));
        $this->update_tbl->set_Status($this->input->post('status'));
        $this->update_tbl->set_DateModified(date('Y-m-d G:i:s'));

        if(!$this->update_tbl->update(array('NewsID'=>$this->uri_segments['id']))) {
            $error_update .= "An Error occurred while updating news details. Please try again";
        }
        /* End Details */

        /* Banner */
        if (!empty($_FILES['banner']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/news/');
            $config['banner']['upload_path'] = $image_path;
            $config['banner']['allowed_types'] = 'png|PNG|jpg|JPG';
            $config['banner']['overwrite'] = TRUE;
            $config['banner']['min_width']  = '1000';
            $config['banner']['min_height']  = '800';
            $config['banner']['max_width']  = '1000';
            $config['banner']['max_height']  = '800';
            $config['banner']['file_name'] = 'banner-img-' . $this->uri_segments['id'];

            $banner = $this->doupload('banner', $config['banner']);
            if(empty($banner['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_news_events',array('Banner'));
                $this->update_tbl->set_Banner($banner['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('NewsID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating banner.";
                }
            } else {
                $error_upload['banner']['error_upload'] = $banner['upload_error'];
            }
        }
        /* End Banner */

        /* Thumbnail Banner */
        if (!empty($_FILES['thumb_banner']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/news/');
            $config['thumb_banner']['upload_path'] = $image_path;
            $config['thumb_banner']['allowed_types'] = 'png|PNG|jpg|JPG';
            $config['thumb_banner']['overwrite'] = TRUE;
            $config['thumb_banner']['min_width']  = '310';
            $config['thumb_banner']['min_height']  = '310';
            $config['thumb_banner']['max_width']  = '310';
            $config['thumb_banner']['max_height']  = '310';
            $config['thumb_banner']['file_name'] = 'thumb-banner-img-' . $this->uri_segments['id'];

            $thumb_banner = $this->doupload('thumb_banner', $config['thumb_banner']);
            if(empty($thumb_banner['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_news_events',array('ThumbBanner'));
                $this->update_tbl->set_ThumbBanner($thumb_banner['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('NewsID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating thumbnail banner.";
                }
            } else {
                $error_upload['thumb_banner']['error_upload'] = $thumb_banner['upload_error'];
            }
        }
        /* End Thumbnail Banner */

        if(!empty($error_upload)) :
            $_SESSION['errorUpload'] = $error_upload;
        endif;

        if(empty($error_update) && empty($error_upload)) {
            $_SESSION['actionMessage'] = 'News has been modified successfully!';
            redirect(base_url('news_events/lists'));
        } else {
            $_SESSION['actionMessage'] = "An Error occurred while updating news.";
            redirect(base_url('news_events/modify/id/' . $this->uri_segments['id']));
        }
    }

    public function modifyBanner($error="") {
        $this->load->model("my_model", "check");
        $this->check->set_up_table('tbl_pages', '', array('*'));
        $news_info = $this->check->select(array('Page'=>'News'));

        if(empty($news_info)) redirect($this->cur_class);

        $results = $this->flatten_array($news_info);

        $page = (object)array('title'=>'cPanel - News & Events','header'=>'Modify Banner','code'=>'modify_banner');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support, 'results'=>$results);

        if(!empty($error['news_banner'])) {
            $data['news_banner']['error_upload'] = $error['news_banner']; 
        }

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Modify Banner', '/news_events/modifyBanner');
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
        $config['file_name'] = 'news-img' . uniqid();
        $config['overwrite'] = TRUE;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('news_banner')) {
            $error = array('news_banner' => $this->upload->display_errors());
            $this->modifyBanner($error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $this->load->model("my_model", "update_tbl");
            $this->update_tbl->set_up_table('tbl_pages',array('Image', 'DateModified'));
            $this->update_tbl->set_Image($data['upload_data']['file_name']);
            $this->update_tbl->set_DateModified(date('Y-m-d G:i:s'));

            if($this->update_tbl->update(array('PageID'=>$this->uri_segments['id']))) {
                $_SESSION['actionMessage'] = 'News Banner has been modified successfully!';
                redirect(base_url('news_events/modifyBanner'));
            } else {
                $_SESSION['actionMessage'] = 'An Error occurred while updating news banner. Please try again.';
                redirect(base_url('news_events/modifyBanner'));
            }
        }
    }

    public function remove() {
        $data['remove_header'] = 'News & Events';
        $data['remove_body'] = 'News: '. urldecode($this->uri_segments['title']);
        $data['remove_submit'] = base_url('news_events/confirmRemove/id/'.$this->uri_segments['id']);
        $this->load->view('modal/remove', $data);
    }

    public function confirmRemove() {
        $this->load->model("my_model", "remove_tbl");
        $this->remove_tbl->set_up_table('tbl_news_events');

        if($this->remove_tbl->remove(array('NewsID'=>$this->uri_segments['id']))) {
            $_SESSION['actionMessage'] = 'You have successfully removed a news!';
            redirect(base_url('news_events'));
        } else {
            $_SESSION['actionMessage'] = 'An Error occurred while removing news. Please try again.';
            redirect(base_url('news_events'));
        }
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