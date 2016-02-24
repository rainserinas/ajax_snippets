<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fileupload extends CI_Controller
{


    public function index()
    {
        $this->load->view('upload');
    }

    public function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|txt|doc';
        $config['max_size'] = '10000';
//        $config['max_width'] = '1024';
//        $config['max_height'] = '768';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            //$this->load->view('upload', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $file = $this->upload->data();

            //Get file name of upload
            echo $file['file_name'];

            echo "Success!";
            //$this->load->view('upload_success', $data);
        }
    }

    public function load_html()
    {
        $this->load->view('login.html');
    }

    public function encrypt()
    {
        $this->load->library('encrypt');

        $msg = 'raineir';
        $key = 'super-secret-key';

        $encrypted_string = $this->encrypt->encode($msg, $key);

        echo $encrypted_string . "<br/>" . "<-- End";

        $dec_string = $this->encrypt->decode($encrypted_string, $key);
        echo $dec_string;
    }
}
