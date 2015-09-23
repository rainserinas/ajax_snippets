<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class portfolioController extends CI_Controller {


	public function index(){
		$this->load->view('welcome_message');
	}

  public function add_portfolio(){
        $this->load->model('dat');

        $section   = $_POST['section'];
        $prof_name = $_POST['prof_name'];
        $desc      = $_POST['desc'];
        $score     = $_POST['score'];
        $check1    = $_POST['check1'];
        $check2    = $_POST['check2'];
        $check3    = $_POST['check3'];
        $check4    = $_POST['check4'];
        $check5    = $_POST['check5'];
        $check6    = $_POST['check6'];
        $check7    = $_POST['check7'];

        $query     = "INSERT INTO portfolio_tbl('section','prof_name','description','score','checkbox_1','checkbox_2','checkbox_3','checkbox_4','checkbox_5','checkbox_6','checkbox_7')
                      VALUES('$section','$prof_name','$desc','$score','$check1','$check2','$check3','$check4','$check5','$check6','$check7')";

        $result    = $this->dat->insertData($query);

        echo $section;

  }







}
