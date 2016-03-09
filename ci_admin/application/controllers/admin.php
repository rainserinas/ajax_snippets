<?php

/*
 * Created by Raineir John Serinas
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller
{


    public function index()
    {

        if ($this->session->userdata("session_id") != "" || $this->session->userdata("session_id") != null) {

            $table = "pageview_tbl";

            $count['pageview'] = $this->Dat->getAll($table);

            $this->load->view('template_up', $count);
            $this->load->view('admin/dashboard');
            $this->load->view('template_down');
        } else {
            $this->load->view('admin/login');
        }
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $data = array(
            "username" => $username,
            "password" => $password
        );

        $table = "login_tbl";

        $result = $this->Dat->select_where($table, $data);

        if (!empty($result)) {
            foreach ($result as $login_credentials) {

                if ($login_credentials['status'] == 1) {
                    $this->session->set_userdata("session_id", $login_credentials['id']);
                    $this->session->set_userdata("session_user", $login_credentials['username']);
                    redirect(base_url('admin'));

                }
            }
        } else {
            echo "Wrong username or password";
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('session_id');
        redirect(base_url('admin'));
    }

    public function about()
    {
        $table = "pageview_tbl";

        $count['pageview'] = $this->Dat->getAll($table);
        $this->load->view('template_up', $count);
        $this->load->view('admin/about');
        $this->load->view('template_down');
    }

    public function pas()
    {

        $data = array(
            "status" => "1"
        );

        $table = "pas_tbl";

        $result['pas'] = $this->Dat->select_where($table, $data);

        $table = "pageview_tbl";

        $count['pageview'] = $this->Dat->getAll($table);

        $this->load->view('template_up', $count);
        $this->load->view('admin/pas', $result);
        $this->load->view('template_down');
    }

    public function careers()
    {
        $data = array(
            "status" => "1"
        );

        $table = "careers_tbl";

        $result['careers'] = $this->Dat->select_where($table, $data);

        $table = "pageview_tbl";

        $count['pageview'] = $this->Dat->getAll($table);

        $this->load->view('template_up', $count);
        $this->load->view('admin/careers', $result);
        $this->load->view('template_down');
    }

    public function clients()
    {

        $table = "pageview_tbl";
        $count['pageview'] = $this->Dat->getAll($table);

        $data = array(
            "status" => "1"
        );
        $data_table = "clients_tbl";
        $result['clients'] = $this->Dat->select_where($data_table, $data);

        $this->load->view('template_up', $count);
        $this->load->view('admin/clients', $result);
        $this->load->view('template_down');
    }

    //Test for textarea editor
    public function texteditor()
    {
        $this->load->view('admin/editor');
    }

    public function editor_submit()
    {
        $text = $this->input->post('tarea');
        echo $text;
    }

    //Test for textarea editor

    public function home_upload()
    {

        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];


            $this->upload->initialize($this->set_home_upload_options());
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
            "heading_img_url" => "home/" . $_FILES['userfile']['name'] = $files['userfile']['name'][0],
            "heading_text" => $heading_text,
            "news_one_title" => $news1_title,
            "news_one_text" => $new1_text,
            "news_img_url" => "home/" . $_FILES['userfile']['name'] = $files['userfile']['name'][1],
            "news_two_title" => $news2_title,
            "news_two_text" => $news2_text,
            "news_two_img_url" => "home/" . $_FILES['userfile']['name'] = $files['userfile']['name'][2],
            "news_three_title" => $news3_title,
            "news_three_text" => $news3_text,
            "news_three_img_url" => "home/" . $_FILES['userfile']['name'] = $files['userfile']['name'][3],
            "description" => $description,
            "description_text" => $description_text
        );
        $table = "home_tbl";

        $get_id = $this->Dat->getAll($table);

        foreach ($get_id as $fetchid) {
            $id = $fetchid['id'];
        }

        $result = $this->Dat->update($id, $data, $table);

        if ($result == true) {

            $table = "pageview_tbl";

            $count['pageview'] = $this->Dat->getAll($table);

            $this->load->view('template_up', $count);
            $this->load->view('admin/dashboard');
            $this->load->view('template_down');
        } else {
            echo "Edit failed";
        }
    }

    //Handle upload request for home
    private function set_home_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/home';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;

        return $config;
    }

    public function about_upload()
    {

        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];


            $this->upload->initialize($this->set_about_upload_options());
            $this->upload->do_upload();
        }

        $title = $this->input->post('about_title');
        $about_text = $this->input->post('about_textarea');
        $tagline = $this->input->post('tagline');

        $data = array(
            "title" => $title,
            "about_text" => $about_text,
            "side_img_url" => "about/" . $_FILES['userfile']['name'] = $files['userfile']['name'][0],
            "tagline" => $tagline
        );

        $table = "about_tbl";

        $get_id = $this->Dat->getAll($table);

        foreach ($get_id as $fetchid) {
            $id = $fetchid['id'];
        }

        $result = $this->Dat->update($id, $data, $table);

        if ($result == true) {
            $this->load->view('admin/about');
        } else {
            echo "Edit failed";
        }

    }

    //Handle upload request for about
    private function set_about_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/about';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;

        return $config;
    }

    public function pas_upload()
    {
        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];


            $this->upload->initialize($this->set_pas_upload_options());
            $this->upload->do_upload();
        }

        $product_description = $this->input->post('product_description');

        $data = array(
            "product_img_url" => "pas/" . $_FILES['userfile']['name'] = $files['userfile']['name'][0],
            "product_description" => $product_description,
            "status" => "1"
        );

        $table = "pas_tbl";

        $result = $this->Dat->insert($table, $data);

        $table = "pageview_tbl";

        $count['pageview'] = $this->Dat->getAll($table);

        $this->load->view('template_up', $count);
        $this->load->view('admin/pas');
        $this->load->view('template_down');
    }

    //Handle upload request for pas
    private function set_pas_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/pas';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;

        return $config;
    }

    public function careers_upload()
    {
        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];


            $this->upload->initialize($this->set_careers_upload_options());
            $this->upload->do_upload();
        }

        $job_title = $this->input->post('job_title');

        $data = array(
            "career_img_url" => "careers/" . $_FILES['userfile']['name'] = $files['userfile']['name'][0],
            "job_title" => $job_title,
            "status" => "1"
        );

        $table = "careers_tbl";

        $result = $this->Dat->insert($table, $data);

        $table = "pageview_tbl";

        $count['pageview'] = $this->Dat->getAll($table);

        $this->load->view('template_up', $count);
        $this->load->view('admin/careers');
        $this->load->view('template_down');
    }

    //Handle upload request for careers
    private function set_careers_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/careers';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;

        return $config;
    }

    public function clients_upload()
    {
        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];


            $this->upload->initialize($this->set_clients_upload_options());
            $this->upload->do_upload();
        }

        $data = array(
            "client_img_url" => "clients/" . $_FILES['userfile']['name'] = $files['userfile']['name'][0],
            "status" => "1"
        );

        $table = "clients_tbl";

        $result = $this->Dat->insert($table, $data);

        $table = "pageview_tbl";

        $count['pageview'] = $this->Dat->getAll($table);

        $this->load->view('template_up', $count);
        $this->load->view('admin/clients');
        $this->load->view('template_down');
    }

    //Handle upload request for clients
    private function set_clients_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/clients';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;

        return $config;
    }

    public function deactivate($id, $type)
    {

        switch ($type) {
            case "pas":
                $data = array(
                    "status" => "0"
                );
                $table = "pas_tbl";
                $result = $this->Dat->update($id, $data, $table);

                if ($result == true) {
                    redirect(base_url('admin/pas'));
                }
                break;
            case "careers":
                $data = array(
                    "status" => "0"
                );
                $table = "careers_tbl";
                $result = $this->Dat->update($id, $data, $table);
                redirect(base_url('admin/careers'));
                break;
            case "clients":
                $data = array(
                    "status" => "0"
                );
                $table = "clients_tbl";
                $result = $this->Dat->update($id, $data, $table);
                redirect(base_url('admin/clients'));
                break;
            default:
                echo "Nothing happened";
        }

    }

    public function send_email()
    {

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $contact = $this->input->post('contact_num');
        $message = $this->input->post('message');

        $post = array(
            'name' => $name,
            'email' => $email,
            'contact' => $contact,
            'message' => $message
        );

        $ch = curl_init('http://mark.journeytech.com.ph/send_mail/send_email.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);

        if ($response) {
            redirect(base_url());
        }
    }

    public function reset_counter($id)
    {
        $data = array(
            "page_count" => "0"
        );
        $table = "pageview_tbl";
        $reset = $this->Dat->update($id, $data, $table);
        redirect(base_url('admin'));
    }


}
