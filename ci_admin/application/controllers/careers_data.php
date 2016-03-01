<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class careers_data extends CI_Controller
{


    public function index()
    {
        $table = "careers_tbl";

        $where = array(
            "status" => "1"
        );
        $result = $this->Dat->select_where($table, $where);

        foreach ($result as $results) {
            $data[] = array(
                "career_img_url" => $results['career_img_url']
            );
        }

        echo json_encode($data);
    }


}
