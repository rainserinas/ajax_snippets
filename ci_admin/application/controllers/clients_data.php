<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clients_data extends CI_Controller
{


    public function index()
    {
        $table = "clients_tbl";

        $where = array(
            "status" => "1"
        );
        $result = $this->Dat->select_where($table, $where);

        foreach ($result as $results) {
            $data[] = array(
                "client_img_url" => $results['client_img_url']
            );
        }

        echo json_encode($data);
    }


}
