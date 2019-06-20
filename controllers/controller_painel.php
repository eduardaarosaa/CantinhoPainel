<?php

class controller_painel extends CI_Controller{

    function index(){

       

    }

    public function verificar_sessao(){
    	if($this->session->userdata('logado')==false){
    		redirect('cantinho/login');
    	}

    }

    public function login(){
    	$this->load->view('cantinho');

    }
}
    