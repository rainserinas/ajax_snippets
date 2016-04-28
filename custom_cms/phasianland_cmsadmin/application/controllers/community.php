<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class community extends CI_Controller {

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
        $page = (object)array('title'=>'cPanel - Community','header'=>'Community', 'code'=>'list');
        $data = array('pageInfo'=>$page, 'userInfo'=>$this->userinfo, 'support'=>$this->support, 'results'=>$this->mtables->getCommunityList());
        
        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Community', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function create() {
        $page = (object)array('title'=>'cPanel - Create Community','header'=>'Create Community','code'=>'create');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support, 'results'=>array());

        if(isset($_SESSION['errorUpload'])) {
            $error_upload = $_SESSION['errorUpload'];
            $data = array_merge($data, $error_upload);
            unset($_SESSION['errorUpload']);

            $this->load->model("my_model", "check");
            $this->check->set_up_table('tbl_community', '', array('*'));
            $community_info = $this->check->select(array('CommunityID'=>$this->uri_segments['id']));

            $data['results'] = $this->flatten_array($community_info);
        }

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Community', '/community');
        $this->breadcrumbs->push('Create Community', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function modify() {
        $this->load->model("my_model", "check");
        $this->check->set_up_table('tbl_community', '', array('*'));
        $community_info = $this->check->select(array('CommunityID'=>$this->uri_segments['id']));

        if(empty($community_info)) redirect($this->cur_class);

        $results = $this->flatten_array($community_info);

        $page = (object)array('title'=>'cPanel - Modify Community','header'=>'Modify Community','code'=>'modify');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support,'results'=>$results);

        if(isset($_SESSION['errorUpload']) && !empty($_SESSION['errorUpload'])) {
            $error_upload = $_SESSION['errorUpload'];
            $data = array_merge($data, $error_upload);
            unset($_SESSION['errorUpload']);
        }

        clearstatcache();

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Community', '/community');
        $this->breadcrumbs->push('Modify Community', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function add() {
        $error_update = null;
        $error_upload = array();

        /* Details */
        if(empty($this->uri_segments['id'])) {
            $this->load->model("my_model", "insert_tbl");
            $this->insert_tbl->set_up_table('tbl_community',array('Name', 'Description', 'Amenities', 'Latitude', 'Longtitude', 'Status', 'DateModified', 'DateCreated'));
            $this->insert_tbl->set_Name($this->input->post('cname'));
            $this->insert_tbl->set_Description($this->input->post('description'));
            $this->insert_tbl->set_Amenities($this->input->post('amenities'));
            $this->insert_tbl->set_Latitude($this->input->post('latitude'));
            $this->insert_tbl->set_Longtitude($this->input->post('longtitude'));
            $this->insert_tbl->set_Status($this->input->post('status'));
            $this->insert_tbl->set_DateCreated(date('Y-m-d G:i:s'));
            $this->insert_tbl->set_DateModified(date('Y-m-d G:i:s'));

            $communityId = $this->insert_tbl->insert();

            if(empty($communityId)) {
                $error_update .= "An Error occurred while updating community details. Please try again";
            }
        } else {
            $communityId = $this->uri_segments['id'];
        }
        /* End Details */

        /* Logo 1 */
        if (!empty($_FILES['logo_img']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/');
            $config['logo_img']['upload_path'] = $image_path;
            $config['logo_img']['allowed_types'] = 'png|PNG|jpg|JPG';
            $config['logo_img']['overwrite'] = TRUE;
            $config['logo_img']['min_width']  = '298';
            $config['logo_img']['min_height']  = '107';
            $config['logo_img']['file_name'] = 'logo-img-' . $communityId;

            $logo_img = $this->doupload('logo_img', $config['logo_img']);
            if(!array_key_exists('upload_error', $logo_img)) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_community',array('Logo1'));
                $this->update_tbl->set_Logo1($logo_img['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('CommunityID'=>$communityId))) {
                    $error_update .= "An Error occurred while updating logo.";
                }
            } else {
                $error_upload['logo_img']['error_upload'] = $logo_img['upload_error'];
            }
        } else {
            $error_upload['logo_img']['error_upload'] = "You did not select an image to upload.";
        }
        /* End Logo 1 */

        /* Logo 2 */
        if (!empty($_FILES['logo_img2']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/');
            $config['logo_img2']['upload_path'] = $image_path;
            $config['logo_img2']['allowed_types'] = 'png|PNG|jpg|JPG';
            $config['logo_img2']['overwrite'] = TRUE;
            $config['logo_img2']['min_width']  = '199';
            $config['logo_img2']['min_height']  = '95';
            $config['logo_img2']['file_name'] = 'logo-img2-' . $communityId;

            $logo_img2 = $this->doupload('logo_img2', $config['logo_img2']);
            if(!array_key_exists('upload_error', $logo-img2)) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_community',array('Logo2'));
                $this->update_tbl->set_Logo2($logo_img2['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('CommunityID'=>$communityId))) {
                    $error_update .= "An Error occurred while updating white logo.";
                }
            } else {
                $error_upload['logo_img2']['error_upload'] = $logo_img2['upload_error'];
            }
        } else {
            $error_upload['logo_img2']['error_upload'] = "You did not select an image to upload.";
        }
        /* End Logo 2 */

        /* Banner */
        if (!empty($_FILES['banner']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/');
            $config['banner']['upload_path'] = $image_path;
            $config['banner']['allowed_types'] = 'jpg|JPG';
            $config['banner']['overwrite'] = TRUE;
            $config['banner']['min_width']  = '2000';
            $config['banner']['min_height']  = '1500';
            $config['banner']['max_width']  = '2000';
            $config['banner']['max_height']  = '1500';
            $config['banner']['file_name'] = 'banner-img-' . $communityId;

            $banner = $this->doupload('banner', $config['banner']);
            if(!array_key_exists('upload_error', $banner)) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_community',array('Banner'));
                $this->update_tbl->set_Banner($banner['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('CommunityID'=>$communityId))) {
                    $error_update .= "An Error occurred while updating banner.";
                }
            } else {
                $error_upload['banner']['error_upload'] = $banner['upload_error'];
            }
        } else {
            $error_upload['banner']['error_upload'] = "You did not select an image to upload.";
        }
        /* End Banner */

        /* Banner Thumbnail */
        if (!empty($_FILES['thumb_banner']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/');
            $config['thumb_banner']['upload_path'] = $image_path;
            $config['thumb_banner']['allowed_types'] = 'jpg|JPG';
            $config['thumb_banner']['overwrite'] = TRUE;
            $config['thumb_banner']['min_width']  = '1000';
            $config['thumb_banner']['min_height']  = '750';
            $config['thumb_banner']['max_width']  = '1000';
            $config['thumb_banner']['max_height']  = '750';
            $config['thumb_banner']['file_name'] = 'thumb-banner-img-' . $communityId;

            $thumb_banner = $this->doupload('thumb_banner', $config['thumb_banner']);
            if(!array_key_exists('upload_error', $thumb_banner)) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_community',array('ThumbBanner'));
                $this->update_tbl->set_ThumbBanner($thumb_banner['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('CommunityID'=>$communityId))) {
                    $error_update .= "An Error occurred while updating banner thumbnail.";
                }
            } else {
                $error_upload['thumb_banner']['error_upload'] = $thumb_banner['upload_error'];
            }
        } else {
            $error_upload['thumb_banner']['error_upload'] = "You did not select an image to upload.";
        }
        /* End Banner Thumbnail */

        /* Image 1 */
        if (!empty($_FILES['image1']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/');
            $config['image1']['upload_path'] = $image_path;
            $config['image1']['allowed_types'] = 'jpg|JPG';
            $config['image1']['overwrite'] = TRUE;
            $config['image1']['min_width']  = '600';
            $config['image1']['min_height']  = '558';
            $config['image1']['max_width']  = '600';
            $config['image1']['max_height']  = '558';
            $config['image1']['file_name'] = 'sub-banner1-' . $communityId;

            $image1 = $this->doupload('image1', $config['image1']);
            if(!array_key_exists('upload_error', $image1)) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_community',array('SubBanner1'));
                $this->update_tbl->set_SubBanner1($image1['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('CommunityID'=>$communityId))) {
                    $error_update .= "An Error occurred while updating image 1.";
                }
            } else {
                $error_upload['image1']['error_upload'] = $image1['upload_error'];
            }
        } else {
            $error_upload['image1']['error_upload'] = "You did not select an image to upload.";
        }
        /* End Image 1 */

        /* Image 2 */
        if (!empty($_FILES['image2']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/');
            $config['image2']['upload_path'] = $image_path;
            $config['image2']['allowed_types'] = 'jpg|JPG';
            $config['image2']['overwrite'] = TRUE;
            $config['image2']['min_width']  = '600';
            $config['image2']['min_height']  = '558';
            $config['image2']['max_width']  = '600';
            $config['image2']['max_height']  = '558';
            $config['image2']['file_name'] = 'sub-banner2-' . $communityId;

            $image2 = $this->doupload('image2', $config['image2']);
            if(!array_key_exists('upload_error', $image2)) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_community',array('SubBanner2'));
                $this->update_tbl->set_SubBanner2($image2['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('CommunityID'=>$communityId))) {
                    $error_update .= "An Error occurred while updating image 2.";
                }
            } else {
                $error_upload['image2']['error_upload'] = $image2['upload_error'];
            }
        } else {
            $error_upload['image2']['error_upload'] = "You did not select an image to upload.";
        }
        /* End Image 2 */

        if(!empty($error_upload)) :
            $_SESSION['errorUpload'] = $error_upload;
        endif;

        if(empty($error_update) && empty($error_upload)) {
            $_SESSION['actionMessage'] = 'Community has been created successfully!';
            redirect(base_url('community'));
        } else {
            $_SESSION['actionMessage'] = "An Error occurred while creating community.";
            redirect(base_url('community/create/id/' . $communityId));
        }
    }

    public function save() {
        $error_update = null;
        $error_upload = array();

        /* Details */
        $this->load->model("my_model", "update_tbl");
        $this->update_tbl->set_up_table('tbl_community',array('Name', 'Description', 'Amenities', 'Latitude', 'Longtitude', 'ResidencesName', 'Status', 'DateModified'));
        $this->update_tbl->set_Name($this->input->post('cname'));
        $this->update_tbl->set_Description($this->input->post('description'));
        $this->update_tbl->set_Amenities($this->input->post('amenities'));
        $this->update_tbl->set_Latitude($this->input->post('latitude'));
        $this->update_tbl->set_Longtitude($this->input->post('longtitude'));
        $this->update_tbl->set_Status($this->input->post('status'));
        $this->update_tbl->set_ResidencesName($this->input->post('residences'));
        $this->update_tbl->set_DateModified(date('Y-m-d G:i:s'));

        if(!$this->update_tbl->update(array('CommunityID'=>$this->uri_segments['id']))) {
            $error_update .= "An Error occurred while updating community details. Please try again";
        }
        /* End Details */

        /* Logo 1 */
        if (!empty($_FILES['logo_img']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/');
            $config['logo_img']['upload_path'] = $image_path;
            $config['logo_img']['allowed_types'] = 'png|PNG|jpg|JPG';
            $config['logo_img']['overwrite'] = TRUE;
            $config['logo_img']['min_width']  = '298';
            $config['logo_img']['min_height']  = '107';
            $config['logo_img']['file_name'] = 'logo-img-' . $this->uri_segments['id'];

            $logo_img = $this->doupload('logo_img', $config['logo_img']);
            if(!array_key_exists('upload_error', $logo_img)) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_community',array('Logo1'));
                $this->update_tbl->set_Logo1($logo_img['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('CommunityID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating logo.";
                }
            } else {
                $error_upload['logo_img']['error_upload'] = $logo_img['upload_error'];
            }
        }
        /* End Logo 1 */

        /* Logo 2 */
        if (!empty($_FILES['logo_img2']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/');
            $config['logo_img2']['upload_path'] = $image_path;
            $config['logo_img2']['allowed_types'] = 'png|PNG|jpg|JPG';
            $config['logo_img2']['overwrite'] = TRUE;
            $config['logo_img2']['min_width']  = '199';
            $config['logo_img2']['min_height']  = '95';
            $config['logo_img2']['file_name'] = 'logo-img2-' . $this->uri_segments['id'];

            $logo_img2 = $this->doupload('logo_img2', $config['logo_img2']);
            if(!array_key_exists('upload_error', $logo_img2)) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_community',array('Logo2'));
                $this->update_tbl->set_Logo2($logo_img2['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('CommunityID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating white logo.";
                }
            } else {
                $error_upload['logo_img2']['error_upload'] = $logo_img2['upload_error'];
            }
        }
        /* End Logo 2 */

        /* Banner */
        if (!empty($_FILES['banner']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/');
            $config['banner']['upload_path'] = $image_path;
            $config['banner']['allowed_types'] = 'jpg|JPG';
            $config['banner']['overwrite'] = TRUE;
            $config['banner']['min_width']  = '2000';
            $config['banner']['min_height']  = '1500';
            $config['banner']['max_width']  = '2000';
            $config['banner']['max_height']  = '1500';
            $config['banner']['file_name'] = 'banner-img-' . $this->uri_segments['id'];

            $banner = $this->doupload('banner', $config['banner']);
            if(!array_key_exists('upload_error', $banner)) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_community',array('Banner'));
                $this->update_tbl->set_Banner($banner['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('CommunityID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating banner.";
                }
            } else {
                $error_upload['banner']['error_upload'] = $banner['upload_error'];
            }
        }
        /* End Banner */

        /* Banner Thumbnail */
        if (!empty($_FILES['thumb_banner']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/');
            $config['thumb_banner']['upload_path'] = $image_path;
            $config['thumb_banner']['allowed_types'] = 'jpg|JPG';
            $config['thumb_banner']['overwrite'] = TRUE;
            $config['thumb_banner']['min_width']  = '1000';
            $config['thumb_banner']['min_height']  = '750';
            $config['thumb_banner']['max_width']  = '1000';
            $config['thumb_banner']['max_height']  = '750';
            $config['thumb_banner']['file_name'] = 'thumb-banner-img-' . $this->uri_segments['id'];

            $thumb_banner = $this->doupload('thumb_banner', $config['thumb_banner']);
            if(!array_key_exists('upload_error', $thumb_banner)) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_community',array('ThumbBanner'));
                $this->update_tbl->set_ThumbBanner($thumb_banner['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('CommunityID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating banner thumbnail.";
                }
            } else {
                $error_upload['thumb_banner']['error_upload'] = $thumb_banner['upload_error'];
            }
        }
        /* End Banner Thumbnail */

        /* Image 1 */
        if (!empty($_FILES['image1']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/');
            $config['image1']['upload_path'] = $image_path;
            $config['image1']['allowed_types'] = 'jpg|JPG';
            $config['image1']['overwrite'] = TRUE;
            $config['image1']['min_width']  = '600';
            $config['image1']['min_height']  = '558';
            $config['image1']['max_width']  = '600';
            $config['image1']['max_height']  = '558';
            $config['image1']['file_name'] = 'sub-banner1-' . $this->uri_segments['id'];

            $image1 = $this->doupload('image1', $config['image1']);
            if(!array_key_exists('upload_error', $image1)) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_community',array('SubBanner1'));
                $this->update_tbl->set_SubBanner1($image1['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('CommunityID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating image 1.";
                }
            } else {
                $error_upload['image1']['error_upload'] = $image1['upload_error'];
            }
        }
        /* End Image 1 */

        /* Image 2 */
        if (!empty($_FILES['image2']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/');
            $config['image2']['upload_path'] = $image_path;
            $config['image2']['allowed_types'] = 'jpg|JPG';
            $config['image2']['overwrite'] = TRUE;
            $config['image2']['min_width']  = '600';
            $config['image2']['min_height']  = '558';
            $config['image2']['max_width']  = '600';
            $config['image2']['max_height']  = '558';
            $config['image2']['file_name'] = 'sub-banner2-' . $this->uri_segments['id'];

            $image2 = $this->doupload('image2', $config['image2']);
            if(!array_key_exists('upload_error', $image2)) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_community',array('SubBanner2'));
                $this->update_tbl->set_SubBanner2($image2['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('CommunityID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating image 2.";
                }
            } else {
                $error_upload['image2']['error_upload'] = $image2['upload_error'];
            }
        }
        /* End Image 2 */

        if(!empty($error_upload)) :
            $_SESSION['errorUpload'] = $error_upload;
        endif;

        if(empty($error_update) && empty($error_upload)) {
            $_SESSION['actionMessage'] = 'Community has been modified successfully!';
            redirect(base_url('community'));
        } else {
            $_SESSION['actionMessage'] = "An Error occurred while updating community.";
            redirect(base_url('community/modify/id/' . $this->uri_segments['id']));
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

    public function remove() {
        $data['remove_header'] = 'Community';
        $data['remove_body'] = 'Community: '. urldecode($this->uri_segments['cname']) . ', and all the houses under it';
        $data['remove_submit'] = base_url('community/confirmRemove/id/'.$this->uri_segments['id']);
        $this->load->view('modal/remove', $data);
    }

    public function confirmRemove() {
        $this->load->model("my_model", "remove_tbl1");
        $this->remove_tbl1->set_up_table('tbl_houses');

        $this->load->model("my_model", "remove_tbl2");
        $this->remove_tbl2->set_up_table('tbl_community');

        if($this->remove_tbl1->remove(array('CommunityID'=>$this->uri_segments['id'])) && $this->remove_tbl2->remove(array('CommunityID'=>$this->uri_segments['id']))) {
            $_SESSION['actionMessage'] = 'You have successfully removed a community!';
            redirect(base_url('community'));
        } else {
            $_SESSION['actionMessage'] = 'An Error occurred while removing community. Please try again.';
            redirect(base_url('community'));
        }
    }

    public function houses() {
        $community = $this->mtables->getCommunityInfo($this->uri_segments['id']);

        $page = (object)array('title'=>'cPanel - Houses','header'=>'Houses: <b>' . $community[0]->Name . "</b>", 'code'=>'houses');
        $data = array('pageInfo'=>$page, 'userInfo'=>$this->userinfo, 'support'=>$this->support, 'results'=>$this->mtables->getHouses($community[0]->CommunityID),'communityId'=>$community[0]->CommunityID);
        
        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Community', '/community');
        $this->breadcrumbs->push('Houses', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function createHouses() {
        $page = (object)array('title'=>'cPanel - Create House','header'=>'Create House','code'=>'createHouses');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support);

        if(isset($_SESSION['errorUpload']) && !empty($_SESSION['errorUpload'])) {
            $error_upload = $_SESSION['errorUpload'];
            $data = array_merge($data, $error_upload);
            unset($_SESSION['errorUpload']);

            $this->load->model("my_model", "check");
            $this->check->set_up_table('tbl_houses', '', array('*'));
            $house_info = $this->check->select(array('HouseID'=>$this->uri_segments['id']));

            $data['results'] = $this->flatten_array($house_info);
        }

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Community', '/community');
        $this->breadcrumbs->push('Houses', '/community/houses/id/' . $this->uri_segments['comid']);
        $this->breadcrumbs->push('Create House', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function modifyHouses() {
        $this->load->model("my_model", "check");
        $this->check->set_up_table('tbl_houses', '', array('*'));
        $house_info = $this->check->select(array('HouseID'=>$this->uri_segments['id']));

        if(empty($house_info)) redirect($this->cur_class);

        $results = $this->flatten_array($house_info);

        $page = (object)array('title'=>'cPanel - Modify House','header'=>'Modify House','code'=>'modifyHouses');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support,'results'=>$results);

        if(isset($_SESSION['errorUpload']) && !empty($_SESSION['errorUpload'])) {
            $error_upload = $_SESSION['errorUpload'];
            $data = array_merge($data, $error_upload);
            unset($_SESSION['errorUpload']);
        }

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Community', '/community');
        $this->breadcrumbs->push('Houses', '/community/houses/id/' . $this->uri_segments['comid']);
        $this->breadcrumbs->push('Modify House', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function addHouses() {
        $error_update = null;
        $error_upload = array();
        $communityId = $this->uri_segments['comid'];

        /* Details */
        if(empty($this->uri_segments['id'])) {
            $this->load->model("my_model", "insert_tbl");
            $this->insert_tbl->set_up_table('tbl_houses',array('CommunityID', 'Type', 'ModelName', 'ModelDescription','Location', 'EstimatedPrice', 'Classification', 'FloorArea', 'LotArea', 'Bedroom', 'Bath', 'Status', 'DateModified', 'DateCreated'));
            $this->insert_tbl->set_CommunityID($communityId);
            $this->insert_tbl->set_Type($this->input->post('type'));
            $this->insert_tbl->set_ModelName($this->input->post('model_name'));
            $this->insert_tbl->set_ModelDescription($this->input->post('description'));
            $this->insert_tbl->set_Location($this->input->post('location'));
            $this->insert_tbl->set_EstimatedPrice(str_replace(",", "", $this->input->post('estimated_price')));
            $this->insert_tbl->set_Classification($this->input->post('classification'));
            $this->insert_tbl->set_FloorArea($this->input->post('floor_area'));
            $this->insert_tbl->set_LotArea($this->input->post('lot_area'));
            $this->insert_tbl->set_Bedroom($this->input->post('bedroom'));
            $this->insert_tbl->set_Bath($this->input->post('bath'));
            $this->insert_tbl->set_Status($this->input->post('status'));
            $this->insert_tbl->set_DateCreated(date('Y-m-d G:i:s'));
            $this->insert_tbl->set_DateModified(date('Y-m-d G:i:s'));

            $houseId = $this->insert_tbl->insert();

            if(empty($houseId)) {
                $error_update .= "An Error occurred while updating house details. Please try again";
            }
        } else {
            $houseId = $this->uri_segments['id'];
        }
        /* End Details */

        /* Image 1 */
        if (!empty($_FILES['image1']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/houses');
            $config['image1']['upload_path'] = $image_path;
            $config['image1']['allowed_types'] = 'jpg|JPG';
            $config['image1']['overwrite'] = TRUE;
            $config['image1']['min_width']  = '1000';
            $config['image1']['min_height']  = '750';
            $config['image1']['max_width']  = '1000';
            $config['image1']['max_height']  = '750';
            $config['image1']['file_name'] = 'house-img1-' . $houseId;

            $image1 = $this->doupload('image1', $config['image1']);
            if(empty($image1['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_houses',array('Image1'));
                $this->update_tbl->set_Image1($image1['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('HouseID'=>$houseId))) {
                    $error_update .= "An Error occurred while updating image 1.";
                }
            } else {
                $error_upload['image1']['error_upload'] = $image1['upload_error'];
            }
        } else {
            $error_upload['image1']['error_upload'] = "You did not select an image to upload.";
        }
        /* End Image 1 */

        /* Image 2 */
        if (!empty($_FILES['image2']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/houses');
            $config['image2']['upload_path'] = $image_path;
            $config['image2']['allowed_types'] = 'jpg|JPG';
            $config['image2']['overwrite'] = TRUE;
            $config['image2']['min_width']  = '1000';
            $config['image2']['min_height']  = '750';
            $config['image2']['max_width']  = '1000';
            $config['image2']['max_height']  = '750';
            $config['image2']['file_name'] = 'house-img2-' . $houseId;

            $image2 = $this->doupload('image2', $config['image2']);
            if(empty($image2['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_houses',array('Image2'));
                $this->update_tbl->set_Image2($image2['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('HouseID'=>$houseId))) {
                    $error_update .= "An Error occurred while updating image 2.";
                }
            } else {
                $error_upload['image2']['error_upload'] = $image2['upload_error'];
            }
        } else {
            $error_upload['image2']['error_upload'] = "You did not select an image to upload.";
        }
        /* End Image 2 */

        /* Image 3 */
        if (!empty($_FILES['image3']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/houses');
            $config['image3']['upload_path'] = $image_path;
            $config['image3']['allowed_types'] = 'jpg|JPG';
            $config['image3']['overwrite'] = TRUE;
            $config['image3']['min_width']  = '1000';
            $config['image3']['min_height']  = '750';
            $config['image3']['max_width']  = '1000';
            $config['image3']['max_height']  = '750';
            $config['image3']['file_name'] = 'house-img3-' . $houseId;

            $image3 = $this->doupload('image3', $config['image3']);
            if(empty($image3['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_houses',array('Image3'));
                $this->update_tbl->set_Image3($image3['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('HouseID'=>$houseId))) {
                    $error_update .= "An Error occurred while updating image 3.";
                }
            } else {
                $error_upload['image3']['error_upload'] = $image3['upload_error'];
            }
        } else {
            $error_upload['image3']['error_upload'] = "You did not select an image to upload.";
        }
        /* End Image 3 */

        /* Image 4 */
        if (!empty($_FILES['image4']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/houses');
            $config['image4']['upload_path'] = $image_path;
            $config['image4']['allowed_types'] = 'jpg|JPG';
            $config['image4']['overwrite'] = TRUE;
            $config['image4']['min_width']  = '1000';
            $config['image4']['min_height']  = '750';
            $config['image4']['max_width']  = '1000';
            $config['image4']['max_height']  = '750';
            $config['image4']['file_name'] = 'house-img4-' . $houseId;

            $image4 = $this->doupload('image4', $config['image4']);
            if(empty($image4['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_houses',array('Image4'));
                $this->update_tbl->set_Image4($image4['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('HouseID'=>$houseId))) {
                    $error_update .= "An Error occurred while updating image 4.";
                }
            } else {
                $error_upload['image4']['error_upload'] = $image4['upload_error'];
            }
        } else {
            $error_upload['image4']['error_upload'] = "You did not select an image to upload.";
        }
        /* End Image 4 */

        /* Image 5 */
        if (!empty($_FILES['image5']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/houses');
            $config['image5']['upload_path'] = $image_path;
            $config['image5']['allowed_types'] = 'jpg|JPG';
            $config['image5']['overwrite'] = TRUE;
            $config['image5']['min_width']  = '1000';
            $config['image5']['min_height']  = '750';
            $config['image5']['max_width']  = '1000';
            $config['image5']['max_height']  = '750';
            $config['image5']['file_name'] = 'house-img5-' . $houseId;

            $image5 = $this->doupload('image5', $config['image5']);
            if(empty($image5['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_houses',array('Image5'));
                $this->update_tbl->set_Image5($image5['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('HouseID'=>$houseId))) {
                    $error_update .= "An Error occurred while updating image 5.";
                }
            } else {
                $error_upload['image5']['error_upload'] = $image5['upload_error'];
            }
        } else {
            $error_upload['image5']['error_upload'] = "You did not select an image to upload.";
        }
        /* End Image 5 */

        /* Image 6 */
        if (!empty($_FILES['image6']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/houses');
            $config['image6']['upload_path'] = $image_path;
            $config['image6']['allowed_types'] = 'jpg|JPG';
            $config['image6']['overwrite'] = TRUE;
            $config['image6']['min_width']  = '1000';
            $config['image6']['min_height']  = '750';
            $config['image6']['max_width']  = '1000';
            $config['image6']['max_height']  = '750';
            $config['image6']['file_name'] = 'house-img6-' . $houseId;

            $image6 = $this->doupload('image6', $config['image6']);
            if(empty($image6['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_houses',array('Image6'));
                $this->update_tbl->set_Image6($image6['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('HouseID'=>$houseId))) {
                    $error_update .= "An Error occurred while updating image 6.";
                }
            } else {
                $error_upload['image6']['error_upload'] = $image6['upload_error'];
            }
        } else {
            $error_upload['image6']['error_upload'] = "You did not select an image to upload.";
        }
        /* End Image 6 */

        if(!empty($error_upload)) :
            $_SESSION['errorUpload'] = $error_upload;
        endif;

        if(empty($error_update) && empty($error_upload)) {
            $_SESSION['actionMessage'] = 'Houses has been created successfully!';
            redirect(base_url('community/houses/id/' . $communityId));
        } else {
            $_SESSION['actionMessage'] = "An Error occurred while creating houses.";
            redirect(base_url('community/createHouses/comid/' . $communityId . '/id/' . $houseId));
        }
    }

    public function saveHouses() {
        $error_update = null;
        $communityId = $this->uri_segments['comid'];

        /* Details */
        $this->load->model("my_model", "update_tbl");
        $this->update_tbl->set_up_table('tbl_houses',array('CommunityID', 'Type', 'ModelName', 'ModelDescription', 'Location', 'EstimatedPrice', 'Classification', 'FloorArea', 'LotArea', 'Bedroom', 'Bath', 'Status', 'DateModified'));
        $this->update_tbl->set_CommunityID($communityId);
        $this->update_tbl->set_Type($this->input->post('type'));
        $this->update_tbl->set_ModelName($this->input->post('model_name'));
        $this->update_tbl->set_ModelDescription($this->input->post('description'));
        $this->update_tbl->set_Location($this->input->post('location'));
        $this->update_tbl->set_EstimatedPrice(str_replace(",", "", $this->input->post('estimated_price')));
        $this->update_tbl->set_Classification($this->input->post('classification'));
        $this->update_tbl->set_FloorArea($this->input->post('floor_area'));
        $this->update_tbl->set_LotArea($this->input->post('lot_area'));
        $this->update_tbl->set_Bedroom($this->input->post('bedroom'));
        $this->update_tbl->set_Bath($this->input->post('bath'));
        $this->update_tbl->set_Status($this->input->post('status'));
        $this->update_tbl->set_DateModified(date('Y-m-d G:i:s'));

        if(!$this->update_tbl->update(array('HouseID'=>$this->uri_segments['id']))) {
            $error_update .= "An Error occurred while updating house details. Please try again";
        }
        /* End Details */

        /* Image 1 */
        if (!empty($_FILES['image1']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/houses');
            $config['image1']['upload_path'] = $image_path;
            $config['image1']['allowed_types'] = 'jpg|JPG';
            $config['image1']['overwrite'] = TRUE;
            $config['image1']['min_width']  = '898';
            $config['image1']['min_height']  = '500';
            $config['image1']['file_name'] = 'house-img1-' . $this->uri_segments['id'];

            $image1 = $this->doupload('image1', $config['image1']);
            if(empty($image1['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_houses',array('Image1'));
                $this->update_tbl->set_Image1($image1['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('HouseID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating image 1.";
                }
            } else {
                $error_upload['image1']['error_upload'] = $image1['upload_error'];
            }
        }
        /* End Image 1 */

        /* Image 2 */
        if (!empty($_FILES['image2']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/houses');
            $config['image2']['upload_path'] = $image_path;
            $config['image2']['allowed_types'] = 'jpg|JPG';
            $config['image2']['overwrite'] = TRUE;
            $config['image2']['min_width']  = '898';
            $config['image2']['min_height']  = '500';
            $config['image2']['file_name'] = 'house-img2-' . $this->uri_segments['id'];

            $image2 = $this->doupload('image2', $config['image2']);
            if(empty($image2['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_houses',array('Image2'));
                $this->update_tbl->set_Image2($image2['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('HouseID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating image 2.";
                }
            } else {
                $error_upload['image2']['error_upload'] = $image2['upload_error'];
            }
        }
        /* End Image 2 */

        /* Image 3 */
        if (!empty($_FILES['image3']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/houses');
            $config['image3']['upload_path'] = $image_path;
            $config['image3']['allowed_types'] = 'jpg|JPG';
            $config['image3']['overwrite'] = TRUE;
            $config['image3']['min_width']  = '898';
            $config['image3']['min_height']  = '500';
            $config['image3']['file_name'] = 'house-img3-' . $this->uri_segments['id'];

            $image3 = $this->doupload('image3', $config['image3']);
            if(empty($image3['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_houses',array('Image3'));
                $this->update_tbl->set_Image3($image3['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('HouseID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating image 3.";
                }
            } else {
                $error_upload['image3']['error_upload'] = $image3['upload_error'];
            }
        }
        /* End Image 3 */

        /* Image 4 */
        if (!empty($_FILES['image4']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/houses');
            $config['image4']['upload_path'] = $image_path;
            $config['image4']['allowed_types'] = 'jpg|JPG';
            $config['image4']['overwrite'] = TRUE;
            $config['image4']['min_width']  = '898';
            $config['image4']['min_height']  = '500';
            $config['image4']['file_name'] = 'house-img4-' . $this->uri_segments['id'];

            $image4 = $this->doupload('image4', $config['image4']);
            if(empty($image4['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_houses',array('Image4'));
                $this->update_tbl->set_Image4($image4['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('HouseID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating image 3.";
                }
            } else {
                $error_upload['image4']['error_upload'] = $image4['upload_error'];
            }
        }
        /* End Image 4 */

        /* Image 5 */
        if (!empty($_FILES['image5']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/houses');
            $config['image5']['upload_path'] = $image_path;
            $config['image5']['allowed_types'] = 'jpg|JPG';
            $config['image5']['overwrite'] = TRUE;
            $config['image5']['min_width']  = '898';
            $config['image5']['min_height']  = '500';
            $config['image5']['file_name'] = 'house-img5-' . $this->uri_segments['id'];

            $image5 = $this->doupload('image5', $config['image5']);
            if(empty($image5['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_houses',array('Image5'));
                $this->update_tbl->set_Image5($image5['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('HouseID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating image 5.";
                }
            } else {
                $error_upload['image5']['error_upload'] = $image5['upload_error'];
            }
        }
        /* End Image 5 */

        /* Image 6 */
        if (!empty($_FILES['image6']['name'])) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/houses');
            $config['image6']['upload_path'] = $image_path;
            $config['image6']['allowed_types'] = 'jpg|JPG';
            $config['image6']['overwrite'] = TRUE;
            $config['image6']['min_width']  = '898';
            $config['image6']['min_height']  = '500';
            $config['image6']['file_name'] = 'house-img6-' . $this->uri_segments['id'];

            $image6 = $this->doupload('image6', $config['image6']);
            if(empty($image6['upload_error'])) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_houses',array('Image6'));
                $this->update_tbl->set_Image6($image6['upload_data']['file_name']);

                if(!$this->update_tbl->update(array('HouseID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating image 6.";
                }
            } else {
                $error_upload['image6']['error_upload'] = $image6['upload_error'];
            }
        }
        /* End Image 6 */

        if(!empty($error_upload)) :
            $_SESSION['errorUpload'] = $error_upload;
        endif;

        if(empty($error_update) && empty($error_upload)) {
            $_SESSION['actionMessage'] = 'Houses has been updated successfully!';
            redirect(base_url('community/houses/id/' . $communityId));
        } else {
            $_SESSION['actionMessage'] = "An Error occurred while updating houses.";
            redirect(base_url('community/modifyHouses/comid/' . $communityId . '/id/' . $houseId));
        }
    }

    public function removeHouse() {
        $data['remove_header'] = 'House';
        $data['remove_body'] = 'House: '. urldecode($this->uri_segments['model']);
        $data['remove_submit'] = base_url('community/confirmRemoveHouse/id/'.$this->uri_segments['id']);
        $this->load->view('modal/remove', $data);
    }

    public function confirmRemoveHouse() {
        $house_info = $this->mtables->getHouseInfo($this->uri_segments['id']);

        $this->load->model("my_model", "remove_tbl");
        $this->remove_tbl->set_up_table('tbl_houses');

        if($this->remove_tbl->remove(array('HouseID'=>$this->uri_segments['id']))) {
            $_SESSION['actionMessage'] = 'You have successfully removed a house!';
            redirect(base_url('community/houses/id/' . $house_info[0]->CommunityID));
        } else {
            $_SESSION['actionMessage'] = 'An Error occurred while removing house. Please try again.';
            redirect(base_url('community/houses/id/' . $house_info[0]->CommunityID));
        }
    }

    private function flatten_array($multi_array) {
        foreach ($multi_array as $flatten) {
            return $flatten;
        }
    }

    public function gallery() {
        $page = (object)array('title'=>'cPanel - Gallery','header'=>'Gallery','code'=>'gallery');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support, 'results'=>$this->mtables->getGallery($this->uri_segments['id']));

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Community', '/community');
        $this->breadcrumbs->push('Gallery', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function uploadGallery() {
        $communityId = $this->uri_segments['id'];

        if(!empty($_FILES)) {
            $image_path = realpath(APPPATH . '../../img/uploads/site/community/gallery');
            $config['image']['upload_path'] = $image_path;
            $config['image']['allowed_types'] = 'png|PNG|jpg|JPG';
            $config['image']['overwrite'] = FALSE;
            $config['image']['min_width']  = '1000';
            $config['image']['min_height']  = '750';
            $config['image']['max_width']  = '1000';
            $config['image']['max_height']  = '750';

            $image = $this->doupload('file', $config['image']);
            if(!array_key_exists('upload_error', $image)) {
                $this->load->model("my_model", "insert_tbl");
                $this->insert_tbl->set_up_table('tbl_gallery', array('Name', 'CommunityID', 'DateCreated'));
                $this->insert_tbl->set_Name($image['upload_data']['file_name']);
                $this->insert_tbl->set_CommunityID($communityId);
                $this->insert_tbl->set_DateCreated(date('Y-m-d G:i:s'));

                if($this->insert_tbl->insert()) {
                    http_response_code(200);
                    echo 'Upload Image successfully!';
                    exit();
                    /*redirect(base_url('community/gallery/id/' . $communityId));*/
                } else {
                    http_response_code(500);
                    echo 'An Error occurred while uploading image. Please try again.';
                    exit();
                }
            } else {
                http_response_code(500);
                echo strip_tags($image['upload_error']); exit();
            }  
        }
    }

    public function galleryRemove() {
        if(isset($this->uri_segments['id'])) { 
            $name = urldecode($this->uri_segments['name']);
            $data['remove_header'] = 'Image';
            $data['remove_body'] = $name;
            $data['remove_submit'] = base_url('community/confirmGalleryRemove/comid/' . $this->uri_segments["comid"] . '/name/'.$name.'/id/'.$this->uri_segments['id']);
        } else {
            $data['remove_header'] = 'Image';
            $data['remove_body'] = 'multiple image';
            $data['remove_submit'] = base_url('community/confirmGalleryRemove/comid/' . $this->uri_segments["comid"] . '/gallery_id/'.$this->uri_segments['gallery_id']);
        }

        $this->load->view('modal/remove',$data);
    }

    public function confirmGalleryRemove() {
        $this->load->model("my_model", "remove");
        $this->remove->set_up_table('tbl_gallery');

        if(!isset($this->uri_segments['gallery_id'])) {
            if($this->remove->remove(array('GalleryID'=>$this->uri_segments['id']))) {
                $fileName =  $this->uri_segments['name'];
                $targetPath = realpath(APPPATH . '../../img/uploads/site/community/gallery');
                $targetFile = $targetPath . $fileName;
                /*unlink($targetFile);*/

                $_SESSION['action_message'] = 'Image has been removed successfully!';
                redirect(base_url('community/gallery/id/'.$this->uri_segments['comid']));
            } else {
                $_SESSION['action_message'] = 'An Error occurred while removing image. Please try again.';
                redirect(base_url('community/gallery/id/'.$this->uri_segments['comid']));
            }
        } else {
            $gallery_string = explode(",", $this->uri_segments['gallery_id']);

            for($i = 0; $i < sizeof($gallery_string); $i++) {
                $gallery_string[$i] = trim($gallery_string[$i]);
            }

            foreach($gallery_string as $gallery_id) {
                /*$this->load->model("my_model", "select");
                $this->select->set_up_table('tbl_gallery', '', array('*'));
                $gallery = $this->select->select(array('GalleryID'=>$gallery_id));

                foreach($gallery as $gallery_name) {
                    $fileName =  $gallery_name->name;
                    $targetPath = realpath(APPPATH . '../../img/uploads/site/community/gallery');
                    $targetFile = $targetPath . $fileName;
                    unlink($targetFile);
                }*/

                $this->remove->remove(array('GalleryID'=>$gallery_id));
                $_SESSION['action_message'] = 'Image(s) has been removed successfully!';
            }

            redirect(base_url('community/gallery/id/'.$this->uri_segments['comid']));
        }
    }

}