<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletters extends CI_Controller {

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
        $this->lists();
    }

    public function lists() {
        $page = (object)array('title'=>'cPanel - Newsletters','header'=>'Newsletters','code'=>'list');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support, 'results'=>$this->mtables->getNewsLetters());
        
        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Newsletters', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function create() {
        $page = (object)array('title'=>'cPanel - Create Newsletter','header'=>'Create Newsletter','code'=>'create');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support);

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Newsletters', '/newsletters/lists');
        $this->breadcrumbs->push('Create Newsletter', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function modify() {
        $this->load->model("my_model", "check");
        $this->check->set_up_table('tbl_newsletters', '', array('*'));
        $newsletter_info = $this->check->select(array('NewsletterID'=>$this->uri_segments['id']));

        if(empty($newsletter_info)) redirect($this->cur_class);

        $results = $this->flatten_array($newsletter_info);

        $page = (object)array('title'=>'cPanel - Modify Newsletter','header'=>'Modify Newsletter','code'=>'modify');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support,'results'=>$results);

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Newsletters', '/newsletters/lists');
        $this->breadcrumbs->push('Modify Newsletter', '#');
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function save() {
        if(empty($this->uri_segments['id'])) {
            $this->load->model("my_model", "insert_tbl");
            $this->insert_tbl->set_up_table('tbl_newsletters',array('Subject', 'Message', 'DateCreated', 'DateModified'));
            $this->insert_tbl->set_Subject($this->input->post('subject'));
            $this->insert_tbl->set_Message($this->input->post('message'));
            $this->insert_tbl->set_DateCreated(date('Y-m-d G:i:s'));
            $this->insert_tbl->set_DateModified(date('Y-m-d G:i:s'));

            if($this->insert_tbl->insert()) {
                $_SESSION['actionMessage'] = 'Newsletter has been created successfully and is ready to use!';
                redirect(base_url('newsletters/lists'));
            } else {
                $_SESSION['actionMessage'] = 'An Error occurred while creating newsletter. Please try again.';
                redirect(base_url('newsletters/listss'));
            }
        } else {
            $this->load->model("my_model", "update_tbl");
            $this->update_tbl->set_up_table('tbl_newsletters',array('Subject', 'Message', 'DateModified'));
            $this->update_tbl->set_Subject($this->input->post('subject'));
            $this->update_tbl->set_Message($this->input->post('message'));
            $this->update_tbl->set_DateModified(date('Y-m-d G:i:s'));

            if($this->update_tbl->update(array('NewsletterID'=>$this->uri_segments['id']))) {
                $_SESSION['actionMessage'] = 'Newsletter has been modified successfully!';
                redirect(base_url('newsletters/lists'));
            } else {
                $_SESSION['actionMessage'] = 'An Error occurred while updating newsletter. Please try again.';
                redirect(base_url('newsletters/lists'));
            }
        }
    }

    public function remove() {
        $data['remove_header'] = 'Newsletters';
        $data['remove_body'] = 'Newsletter: '. urldecode($this->uri_segments['subject']);
        $data['remove_submit'] = base_url('newsletters/confirmRemove/id/'.$this->uri_segments['id']);
        $this->load->view('modal/remove', $data);
    }

    public function confirmRemove() {
        $this->load->model("my_model", "remove_tbl");
        $this->remove_tbl->set_up_table('tbl_newsletters');

        if($this->remove_tbl->remove(array('NewsletterID'=>$this->uri_segments['id']))) {
            $_SESSION['actionMessage'] = 'You have successfully removed a newsletter!';
            redirect(base_url('newsletters/lists'));
        } else {
            $_SESSION['actionMessage'] = 'An Error occurred while removing newsletter. Please try again.';
            redirect(base_url('newsletters/lists'));
        }
    }

    public function send () {
        $this->load->model("my_model", "update_tbl");
        $this->update_tbl->set_up_table('tbl_newsletters',array('Status', 'DateSent'));
        $this->update_tbl->set_Status(1);
        $this->update_tbl->set_DateSent(date('Y-m-d G:i:s'));
        $this->update_tbl->update(array('NewsletterID'=>$this->uri_segments['id']));

        if($this->update_tbl->update(array('NewsletterID'=>$this->uri_segments['id']))) {
            $_SESSION['actionMessage'] = 'Newsletter will be sent to all subscribers!';
            redirect(base_url('newsletters/lists'));
        } else {
            $_SESSION['actionMessage'] = 'An Error occurred while trying to send newsletter. Please try again.';
            redirect(base_url('newsletters/lists'));
        }
    }

    public function resetSubscribers() {
        $this->mtables->resetSubscribers();
    }

    public function processSend() {
        $newsletter_info = $this->mtables->getNewsLettersToSend();
        $results = $this->flatten_array($newsletter_info);

        print_r($results);

        if(!empty($results)) {
            $subscribers = $this->mtables->getSubscribers();

            $param['subject'] = $results->Subject;
            $param['message'] = $results->Message;

            if(!empty($subscribers)) {
                foreach ($subscribers as $key => $value) {
                    $param['email'] = $value->Email;
                    $param['id'] = $value->SubscriberID;

                    $this->sendEmail($param);
                }
            }
        }
    }

    public function sendEmail($param) {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => EMAIL_CONTACT,
            'smtp_pass' => EMAIL_PASSWORD, 
            'mailtype' => 'html', 
        );
        
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from(EMAIL_CONTACT, 'Asianland Newsletter');
        $this->email->to($param['email']);
        $this->email->subject($param['subject']);
        $this->email->message("
            <html>
            <body>
             " . $param['message'] . "
             <div style='border-top: 1px solid #000; margin: 20px 0 0 0; padding: 10px 0; line-height: 25px;'>
                To unsubscribe please visit: <br/>
                <a href=" . base_url('../home/unsubscribe/' . $param['id']) . ">Unsubscribe</a> <br/>
                Your email will unsubscribe automatically.
             </div>
            </body>
            </html>
        ");
        
        if($this->email->send()) {
            $this->load->model("my_model", "update_tbl");
            $this->update_tbl->set_up_table('tbl_subscribers',array('Status'));
            $this->update_tbl->set_Status(1);
            $this->update_tbl->update(array('SubscriberID'=>$param['id']));
        }
    }

    public function modifyBanner($error="") {
        $this->load->model("my_model", "check");
        $this->check->set_up_table('tbl_pages', '', array('*'));
        $banner_info = $this->check->select(array('Page'=>'Newsletters'));

        if(empty($banner_info)) redirect($this->cur_class);

        $results = $this->flatten_array($banner_info);

        $page = (object)array('title'=>'cPanel - Newsletters','header'=>'Modify Banner','code'=>'modify_banner');
        $data = array('pageInfo'=>$page,'userInfo'=>$this->userinfo,'support'=>$this->support, 'results'=>$results);

        if(isset($_SESSION['errorUpload']) && !empty($_SESSION['errorUpload'])) {
            $error_upload = $_SESSION['errorUpload'];
            $data = array_merge($data, $error_upload);
            unset($_SESSION['errorUpload']);
        }

        /*$this->breadcrumbs->push('Dashboard', '/home');*/
        $this->breadcrumbs->push('Modify Banner', '/newsletters/modifyBanner');
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
        if (!empty($_FILES['newsletter_banner']['name'])) {
            $config['newsletter_banner']['upload_path'] = $image_path;
            $config['newsletter_banner']['allowed_types'] = 'jpg|JPG';
            $config['newsletter_banner']['min_width'] = '800';
            $config['newsletter_banner']['min_height'] = '1000';
            $config['newsletter_banner']['max_width'] = '800';
            $config['newsletter_banner']['max_height'] = '1000';
            $config['newsletter_banner']['file_name'] = 'newsletter-img' . uniqid();
            $config['newsletter_banner']['overwrite'] = TRUE;

            $newsletter_banner = $this->doupload('newsletter_banner', $config['newsletter_banner']);
            if(!array_key_exists('upload_error', $newsletter_banner)) {
                $this->load->model("my_model", "update_tbl");
                $this->update_tbl->set_up_table('tbl_pages',array('Image', 'DateModified'));
                $this->update_tbl->set_Image($newsletter_banner['upload_data']['file_name']);
                $this->update_tbl->set_DateModified(date('Y-m-d G:i:s'));

                if(!$this->update_tbl->update(array('PageID'=>$this->uri_segments['id']))) {
                    $error_update .= "An Error occurred while updating banner.";
                }
            } else {
                $error_upload['newsletter_banner']['error_upload'] = $newsletter_banner['upload_error'];
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
        redirect(base_url('newsletters/modifyBanner'));
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