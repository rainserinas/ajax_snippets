<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('mtables');
        $this->load->library(array('upload'));

        $this->load->helper(array('form', 'url', 'file'));

        /*PHP_SAPI === 'cli' or die('not allowed');*/
    }

    public function index() {

    }

    public function resetSubscribers() {
        $this->mtables->resetSubscribers();
    }

    public function processSend() {
        $newsletter_info = $this->mtables->getNewsLettersToSend();
        $results = $this->flatten_array($newsletter_info);

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

    private function flatten_array($multi_array) {
        foreach ($multi_array as $flatten) {
            return $flatten;
        }
    }

}