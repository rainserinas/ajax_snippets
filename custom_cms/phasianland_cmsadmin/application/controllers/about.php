<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

    public function __construct() {
    	parent::__construct();
        
        $this->load->model('musers');
        $this->load->model('mgeneral');
        $this->load->model('mhome');
        $this->load->model('mtables');
        $this->load->library(array('upload', 'breadcrumbs'));

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
        $this->contents();
    }

    public function modifyBanner($error="") {
        $this->load->model("my_model", "check");
        $this->check->set_up_table('tbl_pages', '', array('*'));
        $banner_info = $this->check->select(array('Page'=>'About'));

        $this->load->model("my_model", "page");
        $this->page->set_up_table('tbl_about', '', array('*'));
        $about_info = $this->page->select(array('AboutID'=>1));

        if(empty($banner_info) || empty($about_info)) redirect($this->cur_class);

        $results = $this->flatten_array($banner_info);
        $about = $this->flatten_array($about_info);

        $page = (object)array('title'=>'cPanel - About','header'=>'Modify Banner','code'=>'modify_banner');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support, 'results'=>$results, 'about_page'=>$about);

        if(isset($_SESSION['errorUpload']) && !empty($_SESSION['errorUpload'])) {
            $error_upload = $_SESSION['errorUpload'];
            $data = array_merge($data, $error_upload);
            unset($_SESSION['errorUpload']);
        }

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Modify Banner', '/about/modifyBanner');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function saveBanner() {
        $error_update = null;
        $error_upload = null;

        /* Title */
        $this->load->model("my_model", "update_data");
        $this->update_data->set_up_table('tbl_about',array('MainTitle', 'DateModified'));
        $this->update_data->set_MainTitle($this->input->post('title'));
        $this->update_data->set_DateModified(date('Y-m-d G:i:s'));

        if(!$this->update_data->update(array('AboutID'=>$this->uri_segments['aboutid']))) {
            $error_update .= "An Error occurred while updating main banner.";
        }
        /* End Title */

        $image_path = realpath(APPPATH . '../../img/uploads/site/pages/');
        /* About Banner */
        if (!empty($_FILES['about_banner']['name'])) {
            $config['about_banner']['upload_path'] = $image_path;
            $config['about_banner']['allowed_types'] = 'jpg|JPG';
            $config['about_banner']['min_width'] = '2000';
            $config['about_banner']['min_height'] = '1004';
            $config['about_banner']['max_width'] = '2000';
            $config['about_banner']['max_height'] = '1004';
            $config['about_banner']['file_name'] = 'about-img' . uniqid();
            $config['about_banner']['overwrite'] = TRUE;

            $about_banner = $this->doupload('about_banner', $config['about_banner']);
            if(!array_key_exists('upload_error', $about_banner)) {
                $this->load->model("my_model", "update_about");
                $this->update_about->set_up_table('tbl_pages',array('Image', 'DateModified'));
                $this->update_about->set_Image($about_banner['upload_data']['file_name']);
                $this->update_about->set_DateModified(date('Y-m-d G:i:s'));

                if(!$this->update_about->update(array('PageID'=>$this->uri_segments['pageid']))) {
                    $error_update .= "An Error occurred while updating banner.";
                }
            } else {
                $error_upload['about_banner']['error_upload'] = $about_banner['upload_error'];
            }
        }
        /* End About Banner */

        if(!empty($error_upload)) :
            $_SESSION['errorUpload'] = $error_upload;
        endif;

        if(empty($error_update) && empty($error_upload)) {
            $_SESSION['actionMessage'] = 'About Page has been modified successfully!';
        } else {
            $_SESSION['actionMessage'] = "An Error occurred while updating About Page.";
        }
        redirect(base_url('about/modifyBanner'));
    }

    public function contents() {
        $this->load->model("my_model", "page");
        $this->page->set_up_table('tbl_about', '', array('*'));
        $about_info = $this->page->select(array('AboutID'=>1));

        if(empty($about_info)) redirect($this->cur_class);

        $about_info = $this->flatten_array($about_info);

        $page = (object)array('title'=>'cPanel - About','header'=>'Contents','code'=>'modify');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support, 'about_page'=>$about_info);

        if(isset($_SESSION['errorUpload'])) {
            $error_upload = $_SESSION['errorUpload'];
            $data = array_merge($data, $error_upload);
            unset($_SESSION['errorUpload']);
        }

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Contents', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function save() {
        $error_update = null;
        $error_upload = NULL;

        /* Description */
        $this->load->model("my_model", "update_data");
        $this->update_data->set_up_table('tbl_about',array('Description', 'DateModified'));
        $this->update_data->set_Description($this->input->post('description'));
        $this->update_data->set_DateModified(date('Y-m-d G:i:s'));

        if(!$this->update_data->update(array('AboutID'=>$this->uri_segments['aboutid']))) {
            $error_update .= "An Error occurred while updating main banner.";
        }
        /* End Description */

        $image_path = realpath(APPPATH . '../../img/uploads/site/about/');
        /* Image 1 */
        if (!empty($_FILES['image1']['name'])) {
            $config['image1']['upload_path'] = $image_path;
            $config['image1']['allowed_types'] = 'jpg|JPG';
            $config['image1']['overwrite'] = TRUE;
            $config['image1']['min_width']  = '600';
            $config['image1']['min_height']  = '400';
            $config['image1']['max_width']  = '600';
            $config['image1']['max_height']  = '400';
            $config['image1']['file_name'] = 'image-01' . uniqid();

            $image1 = $this->doupload('image1', $config['image1']);
            var_dump($image1);
            if(empty($image1['upload_error'])) {
                $this->load->model("my_model", "update_about");
                $this->update_about->set_up_table('tbl_about',array('Image1', 'DateModified'));
                $this->update_about->set_Image1($image1['upload_data']['file_name']);
                $this->update_about->set_DateModified(date('Y-m-d G:i:s'));

                if(!$this->update_about->update(array('AboutID'=>$this->uri_segments['aboutid']))) {
                    $error_update .= "An Error occurred while updating Image 1.";
                }
            } else {
                $error_upload['image1']['error_upload'] = $image1['upload_error'];
            }
        }
        /* End Image 1 */

        /* Image 2 */
        if (!empty($_FILES['image2']['name'])) {
            $config['image2']['upload_path'] = $image_path;
            $config['image2']['allowed_types'] = 'jpg|JPG';
            $config['image2']['overwrite'] = TRUE;
            $config['image2']['min_width']  = '600';
            $config['image2']['min_height']  = '400';
            $config['image2']['max_width']  = '600';
            $config['image2']['max_height']  = '400';
            $config['image2']['file_name'] = 'image-02' . uniqid();

            $image2 = $this->doupload('image2', $config['image2']);
            if(empty($image2['upload_error'])) {
                $this->load->model("my_model", "update_about");
                $this->update_about->set_up_table('tbl_about',array('Image2', 'DateModified'));
                $this->update_about->set_Image2($image2['upload_data']['file_name']);
                $this->update_about->set_DateModified(date('Y-m-d G:i:s'));

                if(!$this->update_about->update(array('AboutID'=>$this->uri_segments['aboutid']))) {
                    $error_update .= "An Error occurred while updating Image 2.";
                }
            } else {
                $error_upload['image2']['error_upload'] = $image2['upload_error'];
            }
        }
        /* End Image 2 */

        /* Image 3 */
        if (!empty($_FILES['image3']['name'])) {
            $config['image3']['upload_path'] = $image_path;
            $config['image3']['allowed_types'] = 'jpg|JPG';
            $config['image3']['overwrite'] = TRUE;
            $config['image3']['min_width']  = '600';
            $config['image3']['min_height']  = '400';
            $config['image3']['max_width']  = '600';
            $config['image3']['max_height']  = '400';
            $config['image3']['file_name'] = 'image-03' . uniqid();

            $image3 = $this->doupload('image3', $config['image3']);
            if(empty($image3['upload_error'])) {
                $this->load->model("my_model", "update_about");
                $this->update_about->set_up_table('tbl_about',array('Image3', 'DateModified'));
                $this->update_about->set_Image3($image3['upload_data']['file_name']);
                $this->update_about->set_DateModified(date('Y-m-d G:i:s'));

                if(!$this->update_about->update(array('AboutID'=>$this->uri_segments['aboutid']))) {
                    $error_update .= "An Error occurred while updating Image 3.";
                }
            } else {
                $error_upload['image3']['error_upload'] = $image3['upload_error'];
            }
        }
        /* End Image 3 */

        /* Image 4 */
        if (!empty($_FILES['image4']['name'])) {
            $config['image4']['upload_path'] = $image_path;
            $config['image4']['allowed_types'] = 'jpg|JPG';
            $config['image4']['overwrite'] = TRUE;
            $config['image4']['min_width']  = '600';
            $config['image4']['min_height']  = '400';
            $config['image4']['max_width']  = '600';
            $config['image4']['max_height']  = '400';
            $config['image4']['file_name'] = 'image-04' . uniqid();

            $image4 = $this->doupload('image4', $config['image4']);
            if(empty($image4['upload_error'])) {
                $this->load->model("my_model", "update_about");
                $this->update_about->set_up_table('tbl_about',array('Image4', 'DateModified'));
                $this->update_about->set_Image4($image4['upload_data']['file_name']);
                $this->update_about->set_DateModified(date('Y-m-d G:i:s'));

                if(!$this->update_about->update(array('AboutID'=>$this->uri_segments['aboutid']))) {
                    $error_update .= "An Error occurred while updating Image 4.";
                }
            } else {
                $error_upload['image4']['error_upload'] = $image4['upload_error'];
            }
        }
        /* End Image 4 */

        /* Image 5 */
        if (!empty($_FILES['image5']['name'])) {
            $config['image5']['upload_path'] = $image_path;
            $config['image5']['allowed_types'] = 'jpg|JPG';
            $config['image5']['overwrite'] = TRUE;
            $config['image5']['min_width']  = '600';
            $config['image5']['min_height']  = '800';
            $config['image5']['max_width']  = '600';
            $config['image5']['max_height']  = '800';
            $config['image5']['file_name'] = 'image-05' . uniqid();

            $image5 = $this->doupload('image5', $config['image5']);
            if(empty($image5['upload_error'])) {
                $this->load->model("my_model", "update_about");
                $this->update_about->set_up_table('tbl_about',array('Image5', 'DateModified'));
                $this->update_about->set_Image5($image5['upload_data']['file_name']);
                $this->update_about->set_DateModified(date('Y-m-d G:i:s'));

                if(!$this->update_about->update(array('AboutID'=>$this->uri_segments['aboutid']))) {
                    $error_update .= "An Error occurred while updating Image 5.";
                }
            } else {
                $error_upload['image5']['error_upload'] = $image5['upload_error'];
            }
        }
        /* End Image 5 */

        if(!empty($error_upload)) :
            $_SESSION['errorUpload'] = $error_upload;
        endif;

        if(empty($error_update) && empty($error_upload)) {
            $_SESSION['actionMessage'] = 'About Page has been modified successfully!';
        } else {
            $_SESSION['actionMessage'] = "An Error occurred while updating About Page.";
        }
        redirect(base_url('about/contents'));
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