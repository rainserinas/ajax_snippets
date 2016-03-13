<?php

class Dat extends CI_Model
{

    public function getAll($table)
    {
        $this->db->cache_on();
        return $this->db->get($table)->result_array();
    }

    public function insert($table, $data)
    {
        $this->db->cache_on();
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function delete($id,$table)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
        return true;
    }

    public function changeStatus($id)
    {
        $table = $this->getDataById($id);
        if ($table[0]->status == 0) {
            $this->update($id, array('status' => '1'));
            return "Activated";
        } else {
            $this->update($id, array('status' => '0'));
            return "Deactivated";
        }
    }

    public function getDataById($id, $table)
    {
        $this->db->where('id', $id);
        return $this->db->get($table)->result();
    }

    public function update($id, $data, $table)
    {
        $this->db->cache_on();
        $this->db->where('id', $id);
        $this->db->update($table, $data);
        return true;
    }

    public function select_where($table, $data)
    {
        $this->db->cache_on();
        $query = $this->db->get_where($table, $data);
        return $query->result_array();
    }

    public function execute($query){
        $this->db->cache_on();
        $result = $this->db->query($query);
        return $result->result_array();
    }
}