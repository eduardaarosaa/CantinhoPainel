<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

//include_once  APPPATH . "/third_party/PHPMailer/class.phpmailer.php";
//include_once  APPPATH . "/third_party/PHPMailer/class.smtp.php";

class Controller_webservice extends REST_Controller
{

    private $aparelho = null;
    private $ip = null;
    private $sistema = null;
    
    function __construct()
    {
              

     parent::__construct();
    
    // Ex. definindo limites, habilitar em application/config/rest.php
        $this->methods['perfil_get']['limit'] = 500; // 500 requisições por hora, usuário ou chave
        $this->methods['users_post']['limit'] = 100; // 100 requisições por hora, usuário ou chave
        $this->load->model('model_webservice');
        //$this->load->model('model_usuarios');
        $this->load->library('email');

        //Resgatando dados do acesso.
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->sistema = $_SERVER['HTTP_USER_AGENT'];
        //$iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
        //$iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
        //$iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
        $Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
        $webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");
        
        if ($Android){
            $this->aparelho = "Google";
        } else { //Caso abra pelo Navegador de MAC / PC / Linux
            $this->aparelho = "Desktop";
        }

    }
    
    public function login_comum_get(){
         $valores = array(
         
            'email' =>$this->get('email'),
             'senha' =>$this->get('senha'),
             'id' =>$this->get('id')
         );
        $this->form_validation->set_data($valores);
        $this->form_validation->set_rules('email', 'Login do Usuário', 'required');
        $this->form_validation->set_rules('senha', 'Senha do Usuário (Criptografada)', 'required');
        if ($this->form_validation->run()) {
            $auth = $this->model_webservice->validar_login($valores);
            if ($auth == true) {
                 unset($auth->email);
                 unset($auth->senha);
                $this->response(array('status' => 1, 'retorno' => "Logado com sucesso",'dados'=> $auth), Self::HTTP_OK);
                } else {
                $this->response(array('status' => 0, 'retorno' => "Dados inválidos"), Self::HTTP_OK);
                }
           
    }
                       
 }
    public function criar_usuarios_post(){
        
            $codigo = $this->post('codigo');
                
                if($codigo == 123){
                     $codigo = "adm";
                    
                }else{
                    
                    $codigo = "user";
                }

        
        $valores = array(
        'nome' =>$this->post('nome'),
         'email' =>$this->post('email'),
//         'confirma_email' =>$this->post('email'),
         'senha' =>$this->post('senha'),
          'codigo' =>$codigo,
         'ativacao' =>1,
         'cpf' =>$this->post('cpf')
        );
        
        $this->form_validation->set_data($valores);
        $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('cpf', 'CPF', 'required|min_length[10]|max_length[11]');
        $this->form_validation->set_rules('email', 'Email', 'required|min_length[10]|max_length[60]|is_unique[usuarios.email]');
        $this->form_validation->set_rules('senha', 'Senha', 'required');

        if ($this->form_validation->run()) {

//            $this->model_webservice->start();
            $this->model_webservice->criar_usuarios($valores);
            $commit = $this->model_webservice->commit();
            
            
            if ($commit['status']) {

                //$this->response(array(),Self::HTTP_OK); //200
                $this->response(array('status' => 1, 'retorno' => "Login criado com sucesso"), Self::HTTP_OK);
            } else {

                $this->response(
                                      array(
                            'status' => 0,
                            'retorno' => "Falha interna {$commit['message']}"
                    ), Self::HTTP_INTERNAL_SERVER_ERROR); //500
            }

        } else { //Campos Preenchidos

            $erros = strip_tags(validation_errors());
            $this->response(
              
                    array(
                        'status' => 0,
                        'retorno' => str_replace("O campo Email deve conter um valor único", "Email já cadastrado", str_replace("\r\n", "", $erros))
                ), Self::HTTP_ACCEPTED); //202

        }

    }
                       
    public function editar_usuario_post(){
        
         $valores = array(
        'id' =>$this->post('id'),
        'nome' =>$this->post('nome'),
        'cpf' =>$this->post('cpf'),
         'email' =>$this->post('email'),
//         'confirma_email' =>$this->post('email'),
         'senha' =>$this->post('senha'),
         'ativacao' =>1
            
      
        );
        
        $this->form_validation->set_data($valores);
        $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[5]|max_length[100]');
//        $this->form_validation->set_rules('cpf', 'CPF', 'required|min_length[10]|max_length[11]');
        $this->form_validation->set_rules('email', 'Email');
//        $this->form_validation->set_rules('confirma_email', 'Confirmação do Email', 'required|min_length[10]|max_length[60]|is_unique[seg_usuarios.email_usuario]');
        $this->form_validation->set_rules('senha', 'Senha', 'required');

        if ($this->form_validation->run()) {
            
//            $this->model_webservice->start();
            $this->model_webservice->editar_usuarios($valores);
            
/* @var $commit type */
            $commit = $this->model_webservice->commit();
            
            
            if ($commit['status']) {

                //$this->response(array(),Self::HTTP_OK); //200
                $this->response(array('status' => 1, 'retorno' => "Perfil Editado com sucesso"), Self::HTTP_OK);
            } else {

                $this->response(
                                      array(
                            'status' => 0,
                            'retorno' => "Falha interna {$commit['message']}"
                    ), Self::HTTP_INTERNAL_SERVER_ERROR); //500
            }

        } else { //Campos Preenchidos

            $erros = strip_tags(validation_errors());
            $this->response(
              
                    array(
                        'status' => 0,
                        'retorno' => str_replace("O campo Email deve conter um valor único", "Email já cadastrado", str_replace("\r\n", "", $erros))
                ), Self::HTTP_ACCEPTED); //202

        }

    }
    
    public function verificar_dados_senha_get(){
        
         $email = array(
         
            'email' =>$this->get('email')
         
         );
        
        
        $login = $this->model_webservice->verificar_dados_senha($email);
             
        if($login == true){

         echo str_replace('\/','/',json_encode(array('status'=>1,'response'=> 'email existe' ))); 
            
        } else{
         $this->response(array('status' => 0, 'verificar_dados_senha_get' => "")); //200 ok

            } 
    }
    
    public function alterar_senha_post(){
        
        $senha = array(
        
        'senha'=>$this->get('senha')    
            
            
        );
        
        
        $recuperar_senha = $this->model_webservice->alterar_senha($senha);
        
        if($recuperar_senha == true){
             echo str_replace('\/','/',json_encode(array('status'=>1,'response'=> 'Senha alterada com sucesso' ))); 
            
        } else{
         $this->response(array('status' => 0, 'alterar_senha' => "Falha")); //200 ok

            } 
            
        }

        
    
    
    public function RecuperarSenha_get(){
        $email = $this->get("email");
        if(!isset($email)){
            $this->myResponse(Falha, "Informar o Email", null, Self::HTTP_ACCEPTED);
            return;
        }

        $this->form_validation->set_data(array("email" => $email));
        $this->form_validation->set_rules("email", "Email", "is_unique[usuarios.email]");

        if($this->form_validation->run()){
            $this->myResponse(Falha, "Email não cadastrado", null, Self::HTTP_ACCEPTED);
            return;
        }else{
            
            $token = $this->model_webservice->gerar_token_alterecao_senha($email);
        
            $url = "http://". $_SERVER['HTTP_HOST'] ."/br/Controller_site/trocar_senha?token=". $token->token;

            $teste['protocol'] = 'sendmail';
            $teste['mailpath'] = '/usr/sbin/sendmail';
            $teste['charset'] = 'UTF-8';
            $teste['wordwrap'] = TRUE;

            $this->email->initialize($teste);

            $this->email->from('eduardacirina@gmail.com', 'Cantinho');
            $this->email->to($email);
            $this->email->subject('Recuperação de senha ');
            $this->email->message("
                    Olá senhor(a) 
                    <br><br>
                    Recebemos sua solicitação de alteração de senha! <br>
                    Para fazer a troca clique no link a seguir e siga as instruções.
                    <br><br>
                    ");
          
          
           $this->email->send();
           

                      if ($this->email->send() == true) {

                $this->response(array(),Self::HTTP_OK); //200
                $this->response(array('resposta' => array('code' => 1, 'retorno' => "Email enviado com sucesso.")), Self::HTTP_OK);
            } else {

                $this->response(
                    array('resposta' =>
                        array(
                            'code' => 0,
                            'retorno' => "Falha interna")
                    ), Self::HTTP_INTERNAL_SERVER_ERROR); //500
            }

// Will only print the email headers, excluding the message subject and body
            //echo $this->email->print_debugger(array('body'));
            
            
        }
        

    }
    
    
                       
    public function Publicacoes_get(){
        
      
        $images = $this->model_webservice->getPublicacoes();
        
        
        
        //$pathCover = $_SERVER['DOCUMENT_ROOT'] . base_url("uploads/publicacoes");
            
//        foreach($images as $image){
//        
//         if (is_dir($pathCover) && file_exists($pathCover . $publicacoes)):
//                    //atribui os valores retornados do banco em um novo array após as validações
//                    $data['id'] = $id;
//
//
//                    $data['id'] = $id;
//                    $data['titulo'] = $titulo;
//                    $data['descricao'] = $descricao;
//                    $data['imagem'] = $imagem;
//                    $data['ativacao'] = $ativacaoo;
//                  
//                    //insere no array de revistas os dados
//                    array_push($publicacoes, $data);
//                endif;
//                
//                
//        }
//          
        if($images>0){
         
      //  $this->response(array('status' => 1, 'publicacoes' => json_encode( $images))); //200 
        
    //   echo $this->response(array('status' => 1, 'publicacoes' => json_encode(str_replace('\/','/',$images)))); //200
        
         echo str_replace('\/','/',json_encode(array('status'=>1,'pubicacoes'=>($images)))); 

            
    //str_replace('\/','/', $this->response(array('status' => 1, 'publicacoes' => json_encode($images)))); 
            
            
        } else{
         $this->response(array('status' => 0, 'publicacoes' => "")); //200 ok
         
         

            }
         
         
        
    }
    
    
                       
    public function criar_publicacoes_post(){
        
        $valores = array(
         'id_usuario'=>$this->post('id_usuario'),
         'titulo'=> $this->post('titulo'),
         'ingrendies'=>$this->post('ingrendies'),
         'descricao'=> $this->post('descricao'),
          'imagem'=> $this->post('imagem'),
          'ativacao'=>1
        
        );
        
        $this->form_validation->set_data($valores);
        $this->form_validation->set_rules('id_usuario', 'required');
        $this->form_validation->set_rules('titulo','required');
        $this->form_validation->set_rules('ingrendies','required');
        $this->form_validation->set_rules('descricao','required');
        $this->form_validation->set_rules('imagem','required');

    
    
//    if ($this->form_validation->run()) {

//            $this->model_webservice->start();
            $this->model_webservice->criar_publicacoes($valores);
            $commit = $this->model_webservice->commit();
            
            
            
            if ($commit['status']) {

                //$this->response(array(),Self::HTTP_OK); //200
                $this->response(array('status' => 1, 'retorno' => "Publicação criada com sucesso"), Self::HTTP_OK);
            } else {

                $this->response(
                                      array(
                            'status' => 0,
                            'retorno' => "Falha interna {$commit['message']}"
                    ), Self::HTTP_INTERNAL_SERVER_ERROR); //500
            }

       

        }


//    }
//    
    
    public function exibir_comentarios_get(){
        
//        $valores = array(
//            'id' => $this->get('id'),
//            'id_usuarios' => $this->get('id_usuarios'),
//            'id_publicacao' => $this->get('id_publicacoes'),
//            'date_time' => $this->get('date_time'),
//            'nome' => $this->get('nome'),
//            'comentario' =>$this->get('comentario'),
//            'ativacao' => 1
//  
//        );
            $comentarios = $this->model_webservice->exibir_comentarios();
            
            

             
        if($comentarios>0){
           // $this->response(array('status' => 1, 'exibir_comentarios' => json_encode($comentarios))); //200 ok
           
         echo str_replace('\/','/',json_encode(array('status'=>1,'exibir_comentarios'=>($comentarios)))); 
            
        } else{
         $this->response(array('status' => 0, 'exibir_comentarios' => "")); //200 ok

            } 
    }
    
    public function criar_comentarios_post(){
        
            $valores = array(
            'id_usuarios' => $this->post('id_usuarios'),
            'id_publicacao' => $this->post('id_publicacao'),
            'date_time' => $this->get('date_time'),
            'nome' => $this->post('nome'),
            'comentario' =>$this->post('comentario'),
            'ativacao' => 1
  
        );
            
//        $this->form_validation->set_data($valores);
//        $this->form_validation->set_rules('id_usuario', 'required');
//        $this->form_validation->set_rules('id_publicacoes','required');
//        $this->form_validation->set_rules('nome','required');
//        $this->form_validation->set_rules('comentario','required');
        
        
        
         $this->model_webservice->criar_comentarios($valores);
         $commit = $this->model_webservice->commit();
            
            
            if ($commit['status']) {

                //$this->response(array(),Self::HTTP_OK); //200
                $this->response(array('resposta' => array('code' => 1, 'retorno' => "Comentário com sucesso")), Self::HTTP_OK);
            } else {

                $this->response(
                    array('resposta' =>
                        array(
                            'code' => 0,
                            'retorno' => "Falha interna {$commit['message']}")
                    ), Self::HTTP_INTERNAL_SERVER_ERROR); //500
            }

       
        }
        
        public function favoritos_get(){
            
            $favoritos = $this->model_webservice->favoritos();
            
            

             
        if($favoritos>0){
           // $this->response(array('status' => 1, 'favoritos' => json_encode($favoritos))); //200 ok
        
         echo str_replace('\/','/',json_encode(array('status'=>1,'favoritos'=>($favoritos)))); 

            
        } else{
         $this->response(array('status' => 0, 'favoritos' => "")); //200 ok

            } 
            
        }

        
    
    
    
    
    
    
                       
                       
    //Função usada para retornar os resultados em JSON
      function myResponse($status, $mensagem, $resultado, $httpcode)
    {
        $this->response(array(
            "status" => $status,
            "result" => $mensagem,
            "data" => (is_null($resultado) ? (object)null : $resultado)
        ), $httpcode);
    }

    function errorResponse($code, $msg)
    {
        return array(
            "code" => $code,
            "errorMsg" => $msg
        );
    }

                       
    }
    