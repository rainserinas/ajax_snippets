<?php

class dat extends CI_Model{

	function __construct(){
		parent::__construct();
	}

    	public function insertData($query){

            $insert = $this->db->query($query);

            if($insert){
                return "Insert Successful!";
            }else{
                return "Insert Failed!";
            }

    	}

}
?>
