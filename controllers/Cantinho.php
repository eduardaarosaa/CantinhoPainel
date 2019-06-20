<?php

class cantinho extends CI_Controller{
    function __construct() {
        parent::__construct();
        
        $this->load->model('Model_cantinho');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');

    }
    

    function index(){
   
        $this->load->view('cantinho');
     

    }

 

    public function login(){
    	$this->load->view('cantinho');

    }

    public function cadastro(){
        
        $data = 'null';
         $this->form_validation->set_rules('nome', 'o campo nome é obrigatório', 'required');
        $this->form_validation->set_rules('email','o campo email é obrigatório', 'required');
        $this->form_validation->set_rules('senha', 'o campo senha é obrigatório','required');
         $this->form_validation->set_rules('codigo', 'o campo codigo é obrigatório','required');
        
        if($this->form_validation->run()==true){
            
            $data = array(
                'nome' => $this->input->post('nome'),
                'email' => $this->input->post('email'),
                'senha' => $this->input->post('senha'),
                'codigo' => $this->input->post('codigo'),
               
            );
            
            var_dump($data);
            
          $this->Model_cantinho->cadastro($data);
          
         redirect("cantinho/index", 'redirect');
         
        
        }
     
    }
    
    public function login_comum(){
        
       
        
        $this->form_validation->set_rules('email','E-mail','required');
	$this->form_validation->set_rules('senha','Senha','required');
		
        
		$dados = array (
			'email' => $this->input->post('email'),
			'senha' => $this->input->post('senha')
		);
                
                if($this->form_validation->run()){
                    
                    //var_dump($dados);
                    
              $auth = $this->Model_cantinho->login_comum($dados); 
              
            
                   if($auth){
				$sessao = array(
					'id'=> $auth->id,
                                        'nome'=>$auth->nome,
                                        'email'=>$auth->email,
                                        'codigo'=>$auth->codigo
                                    
				);
                 
	         $this->session->set_userdata($sessao);
                 
               
	         
                 $this->load->view('view_admin');
			

			} else {
                            
                            $this->load->view('cantinho');

        }
        
                }
       
                }
   
    
 public function logout() {

		$this->session->sess_destroy();
		$this->login();
                $this->load->view('cantinho');

	}
        
       
public function painel(){
    
    $dados['painel'] = ['painel'];
    
    $painel['painel'] = $this->Model_cantinho->painel($dados);
    
    
   $this->load->view('view_admin', $dados);
//   $this->load->view('menu',$dados);
    
    
}
 public function admin_publicacoes(){
        
        //$dados = $this->session->userdata('id');
        
        $publicacoes['publicacoes'] = $this->Model_cantinho->admin_publicacoes();
     
      
    	$this->load->view('admin_publicacoes',$publicacoes);
    }
    
     public function admin_comentarios(){
         
         $comentarios['comentarios'] = $this->Model_cantinho->exibir_comentarios();
         
         $this->load->view('admin_comentarios',$comentarios);

    }

   
    public function admin_usuarios(){
        $usuarios['usuarios'] = $this->Model_cantinho->exibir_usuarios();
   
    	$this->load->view('admin_usuarios',$usuarios);

    }
    
    public function desativar_publicacao(){
        
        $id = $_GET['id'];
        $tabela = 'publicacoes';
        
        $auth = $this->Model_cantinho->desativar_publicacao($tabela,$id);
        
        if($auth==true){
          
            redirect("cantinho/admin_publicacoes", 'redirect');
           
        }else{
            echo "Erro entrar em contato";
        }
        
    }
   public function ativar_publicacao(){
       $id = $_GET['id'];
       $tabela = 'publicacoes';
       $auth = $this->Model_cantinho->ativar_publicacao($tabela,$id);
       
       if($auth==true){
           
          redirect("cantinho/admin_publicacoes", 'redirect');
       }else{
           echo "Erro entrar em contato";
       }
           
       }
   

public function desativar_comentarios(){
        $id = $_GET['id'];
        $tabela = 'comentarios';
        
        $auth = $this->Model_cantinho->desativar_comentarios($tabela,$id);
        
        if($auth==true){
          
            redirect("cantinho/admin_comentarios", 'redirect');
    
    
    }else{
        echo "Erro entre em contato";
    }
  
}

 public function ativar_comentarios(){
     
     $id = $_GET['id'];
     $tabela = 'comentarios';
     
     $auth = $this->Model_cantinho->ativar_comentarios($tabela,$id);
     
     if($auth==true){
         
      redirect("cantinho/admin_comentarios", 'redirect');

     }else{
         
          echo "Erro entre em contato";
         
     }
        
    }
    
 public function desativar_usuarios(){
     
      $id = $_GET['id'];
      $tabela = 'usuarios';
        
      $auth = $this->Model_cantinho->desativar_usuarios($tabela,$id);
        
       if($auth==true){
          
         redirect("cantinho/admin_usuarios", 'redirect');
           
        }else{
            echo "Erro entrar em contato";
        }
     
 }
 
 public function ativar_usuarios(){
     
     $id = $_GET['id'];
     $tabela = 'usuarios';
     $auth = $this->Model_cantinho->ativar_usuarios($tabela,$id);
     
     if($auth == true){
        redirect("cantinho/admin_usuarios", 'redirect');
     }else{
         
         echo "Erro entrar em contato";
     }
 }
}
    
