<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller
{


    public function index()
    {

        $table = "pageview_tbl";
        $count = $this->Dat->getAll($table);

        foreach ($count as $pagecount) {
            $inc = $pagecount['page_count'] + 1;

            $tbl = "pageview_tbl";
            $data = array(
                "page_count" => $inc
            );
            $increment = $this->Dat->update($pagecount['id'], $data, $tbl);
        }

        $this->load->view('home');
    }

    public function check_view()
    {
        $this->load->view('check');
    }

}
