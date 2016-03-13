<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller
{

    public function index()
    {
        $this->load->view('login');
    }

    public function signup()
    {
        $this->load->view('signup');
    }

    public function signup_process()
    {

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        //Check if username exist
        $table = "user_tbl";
        $data = array(
            "username" => $username
        );
        $check = $this->Dat->select_where($table, $data);
        if (empty($check)) {
            //encrypt password
            $encrypted_pass = $this->encryption->encrypt($password);

            $table = "user_tbl";
            $data = array(
                "username" => $username,
                "password" => $encrypted_pass
            );

            $query = $this->Dat->insert($table, $data);

            if ($query) {
                //if successful
                redirect(base_url('main/signup?status=1'));
            } else {
                //if failed
                redirect(base_url('main/signup?status=0'));
            }
        } else {
            redirect(base_url('main/signup?status=2'));
        }


    }

    public function authentication()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $table = "user_tbl";
        $data = array(
            "username" => $username
        );
        $query = $this->Dat->select_where($table, $data);

        //Decrypt password base on username
        $decrypted_pass = $this->encryption->decrypt($query['0']['password']);

        //Check if password decrypted is equal to password entered
        if ($password === $decrypted_pass) {
            $this->session->set_userdata("session_username", $query['0']['username']);
            $this->session->set_userdata("session_id", $query['0']['id']);
            redirect(base_url('main/dashboard'));
        } else {
            redirect(base_url());
        }

    }

    public function dashboard()
    {
        $id = $this->session->userdata("session_id");
        $query = "SELECT id,content,type,datetimestamp FROM contents_tbl WHERE user_id='$id' AND status = '1' ORDER BY datetimestamp desc";
        $result['result'] = $this->Dat->execute($query);


        $this->check_session('dashboard', $result);
    }

    private function check_session($view, $data)
    {
        //Will check session dynamically then load page if there's any
        if ($this->session->userdata("session_id") != "" || $this->session->userdata("session_id") != null) {
            $this->load->view($view, $data);
        } else {
            redirect(base_url());
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('session_id');
        $this->session->unset_userdata('session_username');
        redirect(base_url());
    }

    public function save()
    {

        $message = $this->input->post('message');
        $type = $this->input->post('type');
        $user_id = $this->session->userdata("session_id");

        $table = "contents_tbl";
        $data = array(
            "user_id" => $user_id,
            "content" => $message,
            "type" => $type
        );

        $result = $this->Dat->insert($table, $data);

        if (!empty($result)) {
            redirect(base_url('main/dashboard'));
        }

    }

    public function delete($id)
    {
        $table = "contents_tbl";
        $result = $this->Dat->delete($id, $table);
        redirect(base_url('main/dashboard'));
    }

}