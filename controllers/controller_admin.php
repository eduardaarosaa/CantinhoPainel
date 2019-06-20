<?php

class controller_admin extends CI_Controller{

   function __construct() {
        parent::__construct();
        
        $this->load->model('Model_cantinho');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

    }

    function index(){

        $this->load->view('view_admin');

    }

   
}
    
