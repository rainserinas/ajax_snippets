<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class about_data extends CI_Controller
{


    public function index()
    {
        $table = "about_tbl";
        $result = $this->Dat->getAll($table);

        foreach($result as $results){
            $data[] = array(
                "about_title"=>$results['title'],
                "about_text"=>$results['about_text'],
                "side_img_url"=>$results['side_img_url']
            );
        }

        echo json_encode($data);
    }


}
