<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home_data extends CI_Controller
{


    public function index()
    {
        $table = "home_tbl";
        $result = $this->Dat->getAll($table);

        foreach($result as $results){
            $data[] = array(
                "id"=>$results['id'],
                "heading_img_url"=>$results['heading_img_url'],
                "heading_text"=>$results['heading_text'],
                "news_one_title"=>$results['news_one_title'],
                "news_one_text"=>$results['news_one_text'],
                "news_img_url"=>$results['news_img_url'],
                "news_two_title"=>$results['news_two_title'],
                "news_two_text"=>$results['news_two_text'],
                "news_two_img_url"=>$results['news_two_img_url'],
                "news_three_title"=>$results['news_three_title'],
                "news_three_text"=>$results['news_three_text'],
                "news_three_img_url"=>$results['news_three_img_url'],
                "description"=>$results['description'],
                "description_text"=>$results['description']
            );
        }

        echo json_encode($data);
    }


}
