<?php

class Dat extends CI_Model
{


    public function execute($query, $data)
    {

        $execute = $this->db->query($query, $data);

        if ($execute) {
            return true;
        } else {
            return false;
        }

    }

    public function select($query, $data)
    {
        $select = $this->db->query($query, $data);

        return $select->result_array();

    }

    public function getLastId($query, $data)
    {
        $execute = $this->db->query($query, $data);

        $getLastId = $this->db->query('SELECT MAX(prod_id) as prod_id FROM tbl_product');

        if ($execute) {
            return $getLastId->result_array();
        } else {
            return false;
        }
    }


}