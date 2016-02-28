<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller
{


    public function index()
    {
        $this->load->view('template_up');
        $this->load->view('admin/dashboard');
        $this->load->view('template_down');
    }

    public function do_upload()
    {


        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];


            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload();
        }

        //input fields

        $heading_text = $this->input->post('heading_text');
        $news1_title = $this->input->post('news_1_title');
        $new1_text = $this->input->post('news_1_text');
        $news2_title = $this->input->post('news_2_title');
        $news2_text = $this->input->post('news_2_text');
        $news3_title = $this->input->post('news_3_title');
        $news3_text = $this->input->post('news_3_text');
        $description = $this->input->post('description');
        $description_text = $this->input->post('description_text');

        $data = array(
            "heading_img_url" => $_FILES['userfile']['name'] = $files['userfile']['name'][0],
            "heading_text" => $heading_text,
            "news_one_title" => $news1_title,
            "news_one_text" => $new1_text,
            "news_img_url" => $_FILES['userfile']['name'] = $files['userfile']['name'][1],
            "news_two_title" => $news2_title,
            "news_two_text" => $news2_text,
            "news_two_img_url" => $_FILES['userfile']['name'] = $files['userfile']['name'][1],
            "news_three_title" => $news3_title,
            "news_three_text" => $news3_text,
            "news_three_img_url" => $_FILES['userfile']['name'] = $files['userfile']['name'][2],
            "description" => $description,
            "description_text" => $description_text
        );
        $table = "home_tbl";
        $result = $this->Dat->insert($table, $data);


    }

    //Handle upload request

    private function set_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/home';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;

        return $config;
    }

}
