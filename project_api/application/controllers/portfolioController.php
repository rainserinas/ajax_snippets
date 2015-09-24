<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class portfolioController extends CI_Controller {


	public function index(){
		$this->load->view('welcome_message');
	}

    public function login(){

        $username = $this->input->get('username');
        $password = $this->input->get('password');
        $table    = "tbl_useracct";
        $where    = "username = '$username' and password = '$password'";
        $auth     = $this->dat->selectData($table,$where);
        
        if(is_array($auth)){
            foreach ($auth as $key => $value) {
                $authdata  = (object)$value;
                $auth_array[] = array(
                    "id"=>$authdata->id
                );
            }
            echo json_encode($auth_array);
        }else{
            echo "";
        }


    }

    public function select_portfolio(){

        $table  = "portfolio_tbl";
        $select = $this->dat->selectData($table);
        foreach ($select as $key => $value) {
            $fetchdata = (object)$value;

            $tabledata[] = array(
                "section"=>$fetchdata->section,
                "subject"=>$fetchdata->subject,
                "prof_name"=>$fetchdata->prof_name,
                "description"=>$fetchdata->description,
                "score"=>$fetchdata->score
            );
        }

        echo json_encode($tabledata);

    }

    public function add_portfolio(){
        

        $section   = $this->input->post('section');
        $subject   = $this->input->post('subject');
        $prof_name = $this->input->post('prof_name');
        $desc      = $this->input->post('desc');
        $score     = $this->input->post('score');
        $check1    = $this->input->post('check1');
        $check2    = $this->input->post('check2');
        $check3    = $this->input->post('check3');
        $check4    = $this->input->post('check4');
        $check5    = $this->input->post('check5');
        $check6    = $this->input->post('check6');
        $check7    = $this->input->post('check7');

        $data = array(
          'section'=>$section,
          'subject'=>$subject,
          'prof_name'=>$prof_name,
          'description'=>$desc,
          'score'=>$score,
          'checkbox_1'=>$check1,
          'checkbox_2'=>$check2,
          'checkbox_3'=>$check3,
          'checkbox_4'=>$check4,
          'checkbox_5'=>$check5,
          'checkbox_6'=>$check6,
          'checkbox_7'=>$check7  
        );

        $table  = "portfolio_tbl";
        $result = $this->dat->insertData($table,$data);

        echo $result;
        

    }

    public function edit_portfolio(){


        $subject = $this->input->post('subject');
        $id      = $this->input->post('id');
        $data    = array(
            'subject'=>$subject
        );
        $table   = "portfolio_tbl";
        $result  = $this->dat->updateData($table,$data,$id);

        echo $result;



    }

    public function delete_portfolio(){

        $id     = $this->input->post('id');
        $table  = "portfolio_tbl";
        $result = $this->dat->deleteData($table,$id);

        echo $result;



    }

    public function listSubject(){

        $where      = $this->input->get('val');
       
        if($where != "All Section"){
            $query      = "sec_desc = '$where'";
        }else{
            $query      = "";
        }

        $table      = "tbl_subj";
        $resultSubject = $this->dat->selectData($table,$query);

        foreach ($resultSubject as $key => $value) {
            $subjectdata = (object)$value;
            if($subjectdata != ""){
                echo "<tr>";
                echo "<td><span style='cursor:pointer;' onclick='listStudents(\"$subjectdata->stud_id\")'><font color='#45B4FF'>$subjectdata->subj_name<font></span></td>";
                echo "<td>$subjectdata->categ</td>";
                echo "</tr>";
            }else{
                echo "<tr rowspan='2'>";
                echo "<td>No Results</td>";
                echo "</tr>";
            }
        }
        
        
    }

    public function listStudents(){

        $student_id    = $this->input->get('student_id');
        $query         = "id = '$student_id'";
        $table         = "tbl_useracct";
        $resultStudent = $this->dat->selectData($table,$query);

        foreach ($resultStudent as $key => $value) {
            $studentdata = (object)$value;
            echo "<tr>";
            echo "<td>$studentdata->id</td>";
            echo "<td>$studentdata->name</td>";
            echo "</tr>";
        }

    }







}
