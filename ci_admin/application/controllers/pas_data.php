<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pas_data extends CI_Controller
{


    public function index()
    {
        $table = "pas_tbl";
        $where = array(
            "status"=>"1"
        );
        $result = $this->Dat->select_where($table,$where);

        foreach($result as $results){
            $data[] = array(
                "product_img_url"=>$results['product_img_url'],
                "product_description"=>$results['product_description']
            );
        }

        echo json_encode($data);
    }


}
