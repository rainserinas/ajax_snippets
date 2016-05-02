<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller
{

    public function index()
    {
        if ($this->session->userdata('user_id') !== "") {
            $this->load->view('registration');
        } else {
            redirect(base_url('MainController/login'));
        }
    }

    public function login()
    {
        $this->load->view('login');
    }

    public function register()
    {
        //Load dependencies
        $this->load->model('Dat');
        $this->load->helper('security');

        //Load dependencies

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $middlename = $this->input->post('middlename');
        $birthday = $this->input->post('birthday');
        $gender = $this->input->post('gender');
        $phonenum = $this->input->post('phonenum');

        $hash = do_hash($password, 'md5'); // MD5

        //Handle file upload
        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];
            $this->upload->initialize($this->upload_opt());
            $this->upload->do_upload();
        }

        $image = 'upload/' . $_FILES['userfile']['name'];

        //Loop through series of phone number
        foreach ($phonenum as $numbers) {
            $encap_num = $encap_num . $numbers . "|";
        }

        $bind = array("$email", "$hash", "$image", "$firstname", "$lastname", "$middlename", "$gender", "$encap_num");

        $query = "INSERT INTO tbl_user(email,password,profile_img,first_name,last_name,middle_name,sex,phone_number)";
        $query .= " VALUES(?,?,?,?,?,?,?,?)";

        $execute_query = $this->Dat->execute($query, $bind);

        if ($execute_query == true) {
            $this->sendMail($email, $firstname, $lastname, $middlename, $birthday, $gender, $encap_num);

            $data = 'Registration Successfull. Please Check your email for confirmation';


            redirect(base_url() . '?status=1');
        } else {
            redirect(base_url() . '?status=2');
        }

    }

    private function upload_opt()
    {
        $config = array();
        $config['upload_path'] = './upload';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
    }

    private function sendMail($email, $firstname, $lastname, $middlename, $birthday, $gender, $encap_num)
    {

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'raineirserinas@gmail.com', // change it to yours
            'smtp_pass' => 'raineirserinas1010', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $message = 'Good Day! Thank you for you registration' . '<br>';
        $message .= 'Here are the details for your registration' . '<br>';
        $message .= '<br>';
        $message .= 'Email: ' . $email . '<br>';
        $message .= 'First Name: ' . $firstname . '<br>';
        $message .= 'Last Name: ' . $lastname . '<br>';
        $message .= 'Middle Name: ' . $middlename . '<br>';
        $message .= 'Birthday: ' . $birthday . '<br>';
        $message .= 'Gender: ' . $gender . '<br>';

        //Loop through array of phone number
        $explode = explode("|", $encap_num);
        foreach ($explode as $key => $numbers) {
            if ($numbers != "") {
                $message .= "Phone Number #" . $key . ": " . $numbers . '<br>';
            } else {
                break;
            }
        }

        $message .= '<br>';
        $message .= 'Please click the link to confirm your registration' . '<br>';
        $message .= "<a href='#'>Confirm Link</a>";

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('raineirserinas@gmail.com'); // change it to yours
        $this->email->to($email);// change it to yours
        $this->email->subject('Registration Confirmation');
        $this->email->message($message);
        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }

    }

    public function auth()
    {
        //Load dependencies
        $this->load->model('Dat');
        $this->load->helper('security');

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $hash_password = do_hash($password, 'md5');

        $data = array("$username", "$hash_password");

        $query = 'SELECT * FROM tbl_user where email = ? AND password = ?';

        $result = $this->Dat->select($query, $data);

        if (!empty($result)) {
            $this->session->set_userdata("user_id", $result[0]['id']);
            redirect(base_url('MainController/products'));
        } else {
            redirect(base_url('MainController/login'));
        }
    }

    public function products()
    {
        //Load dependencies
        $this->load->model('Dat');

        $user_id = $this->session->userdata('user_id');

        $data_bind = array("$user_id");
        $execute = "SELECT * FROM tbl_product WHERE user_id = ?";

        $result['products'] = $this->Dat->select($execute, $data_bind);

        $this->load->view('products', $result);
    }

    public function add()
    {

        //Load dependencies
        $this->load->model('Dat');

        //For Products table
        $product_code = $this->input->post('product_code');
        $product_name = $this->input->post('product_name');
        $price = $this->input->post('price');

        $user_id = $this->session->userdata('user_id');
        $date = date('m-d-Y H:i:s');

        $data_bind = array("$product_code", "$product_name", "$price", "$date", "$user_id", "0");
        $component_name = $this->input->post('comp_name');
        $component_description = $this->input->post('comp_desc');


        $query = "INSERT INTO tbl_product(prod_code,prod_name,price,insert_date,user_id,is_deleted)";
        $query .= "VALUES(?,?,?,?,?,?)";

        $execute = $this->Dat->getLastId($query, $data_bind);

        $prod_id = $execute[0]['prod_id'];

        $data_bind2 = array("$prod_id", "$component_name", "$component_description", "$date", "$user_id");

        $query2 = "INSERT INTO tbl_product_component(prod_id,comp_name,comp_desc,insert_date,user_id)";
        $query2 .= "VALUES(?,?,?,?,?)";

        $execute2 = $this->Dat->execute($query2, $data_bind2);

        if ($execute) {
            redirect(base_url('MainController/products'));
        }

    }

    public function delete($id)
    {
        //Load dependencies
        $this->load->model('Dat');

        $data_binding = array("$id");

        $query = "DELETE FROM tbl_product WHERE prod_id = ?";

        $execute = $this->Dat->execute($query, $data_binding);

        $query2 = "DELETE FROM tbl_product_component WHERE prod_id = ?";

        $execute2 = $this->Dat->execute($query2, $data_binding);

        redirect(base_url('MainController/products'));

    }

    public function ajax_load()
    {
        //Load dependencies
        $this->load->model('Dat');

        $id = $this->input->get('prod_id');

        $data_biding = array("$id");
        $query = "SELECT * FROM tbl_product_component WHERE prod_id = ?";

        $select = $this->Dat->select($query, $data_biding);

        foreach ($select as $selects) {

            $data[] = array(
                "comp_name" => $selects['comp_name'],
                "comp_desc" => $selects['comp_desc'],
            );
        }

        echo json_encode($data);

    }

    public function add_product_components()
    {
        //Load dependencies
        $this->load->model('Dat');

        $prod_id = $this->input->post('prod_id');
        $comp_name = $this->input->post('comp_name');
        $comp_desc = $this->input->post('comp_desc');
        $user_id = $this->input->post('user_id');
        $date = date('m-d-Y H:i:s');

        $data_binding = array("$prod_id", "$comp_name", "$comp_desc", "$user_id", "$date");

        $query = "INSERT INTO tbl_product_component(prod_id,comp_name,comp_desc,user_id,insert_date)";
        $query .= "VALUES(?,?,?,?,?)";

        $execute = $this->Dat->execute($query, $data_binding);

        if ($execute) {
            redirect(base_url('MainController/products'));
        }

    }

    public function ajax_edit_data()
    {
        //Load dependencies
        $this->load->model('Dat');

        $id = $this->input->get('prod_id');

        $data_bind = array("$id");

        $query = "SELECT
                tbl_product.price,
                tbl_product_component.comp_name,
                tbl_product_component.comp_desc,
                tbl_product.prod_name,
                tbl_product.prod_code
                FROM
                tbl_product
                INNER JOIN tbl_product_component
                ON tbl_product.prod_id = tbl_product_component.prod_id
                WHERE
                tbl_product.prod_id = ?
                ";

        $select = $this->Dat->select($query, $data_bind);

        foreach ($select as $selects) {

            $data[] = array(
                "price" => $selects['price'],
                "comp_name" => $selects['comp_name'],
                "comp_desc" => $selects['comp_desc'],
                "prod_name" => $selects['prod_name'],
                "prod_code" => $selects['prod_code']
            );
        }

        echo json_encode($data);


    }

    public function edit()
    {
        //Load dependencies
        $this->load->model('Dat');

        $id = $this->input->post('id');
        $product_code = $this->input->post('product_code');
        $product_name = $this->input->post('product_name');
        $price = $this->input->post('price');

        $data_bind = array($product_code, $product_name, $price, $id);

        $query = "UPDATE tbl_product SET prod_code = ? ,";
        $query .= " prod_name = ? , price = ? WHERE";
        $query .= " prod_id = ?";

        $execute = $this->Dat->execute($query, $data_bind);

        if ($execute) {
            redirect(base_url('MainController/products'));
        } else {
            echo $execute;
        }

    }

}
