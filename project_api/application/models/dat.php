<?php

class Dat extends CI_Model{

	function __construct(){
		parent::__construct();
	}

        public function authenticate($table,$where){


           $query = $this->db->query("SELECT * FROM $table WHERE $where");

           if($query->num_rows() > 0){
                return 1;
           }else{
                return 0;
           }


        }


        public function selectData($table){

            $select = $this->db->get($table);
            return $select->result_array();

        }


    	public function insertData($table,$data){

            $insert = $this->db->insert($table,$data);

            if($insert){
                return "Insert Successful!";
            }else{
                return "Insert Failed!";
            }

    	}



        public function updateData($table,$data,$id){


            $where  = $this->db->where('id',$id);
            $update = $this->db->update($table,$data);

            if($update){
                return "Update Successful!";
            }else{
                return "Update Failed!";
            }

        }

        public function deleteData($table,$id){

            $where  = $this->db->where('id',$id);
            $delete = $this->db->delete($table);

            if($delete){
                return "Record Deleted";
            }else{
                return "Delete Failed!";
            }

        }

}
?>
