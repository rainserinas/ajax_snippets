<?php


class Dat extends CI_Model
{

    /*
    return all Home_tbls.
    created by your name
    created at 27-02-16.
    */
    public function getAll()
    {
        return $this->db->get('home_tbl')->result();
    }

    /*
    function for create Home_tbl.
    return Home_tbl inserted id.
    created by your name
    created at 27-02-16.
    */
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    /*
    return Home_tbl by id.
    created by your name
    created at 27-02-16.
    */

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('home_tbl');
        return true;
    }

    /*
    function for update Home_tbl.
    return true.
    created by your name
    created at 27-02-16.
    */

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

    /*
    function for delete Home_tbl.
    return true.
    created by your name
    created at 27-02-16.
    */

    public function getDataById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('home_tbl')->result();
    }

    /*
    function for change status of Home_tbl.
    return activated of deactivated.
    created by your name
    created at 27-02-16.
    */

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('home_tbl', $data);
        return true;
    }

}