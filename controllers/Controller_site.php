 
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_site extends CI_Controller {

	function __construct()
        
    {
        
        parent::__construct();
    
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
      
        $this->load->model('model_webservice');
        
    }
 
 
 
 public function trocar_senha($erros = null){
        $dados['trocar_senha']  = 'trocar_senha';
        $trocar_senha['trocar_senha'] = null;


        $token = $this->input->get("token");
        if(isset($token)){

            if($this->model_webservice->validar_token($token, true)){
                $trocar_senha['token'] = $token;
                
            }else{
                $trocar_senha['error_msg'] = "O link é invalido";
                
            }


        }else{
            $trocar_senha['error_msg'] = "É preciso informar o Token";
            
        }

    }

    public function sucesso_update_senha(){
        $dados['sucesso']  = 'trocar_senha';
        $sucesso['sucesso'] = null;

    
    }

    public function update_senha(){

        $this->form_validation->set_rules("confirme_senha_usuario", "Confirme senha nova", "required");
	    $this->form_validation->set_rules("senha_usuario", "Senha nova", "required|matches[confirme_senha_usuario]");

	    if($this->form_validation->run()){

            $token = $this->input->get("token");
            if(isset($token)){
                $dadosToken = $this->model_webservice->getDataViaToken($token);
                if($dadosToken->ativo == 1){
                    if($this->model_sites->uUpdate("seg_usuarios", array("senha_usuario"=>sha1($this->input->post("senha_usuario"))), array("id_usuario"=> $dadosToken->fk_usuario))){
                        if($this->model_webservice->zerarTokens($dadosToken->fk_usuario)){
                            $this->sucesso_update_senha();
                        }else{
                            echo 'Não Zerou';
                        }
                    }
                }else{
                    $trocar_senha['error_msg'] = "O link é invalido";
                   
                }
            }else{
                $trocar_senha['error_msg'] = "É preciso informar o Token";
                
            }
        }else{
	        echo form_error("confirme_senha_usuario");
            echo form_error("senha_usuario");
        }

    }
}

    