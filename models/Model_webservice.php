<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_webservice extends CI_Model {

    public function validar_login($valores){

        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('email', $valores['email']);
        $this->db->where('senha', $valores['senha']);
        $login = $this->db->get();

        if (isset($login) && !is_null($login) && $login->num_rows() == 1) {
            $values = $login->row();
            return $values;
        } else {
            return false;
        }

    }
    
    public function criar_usuarios($valores){
        
        $this->start();
        $this->db->insert('usuarios',$valores);
        $result = $this->responseInsert($this->db->error(), "Usuario criado com sucesso");
        $this->commit();
        return $result;
        
    }
    public function editar_usuarios($valores){
        
        echo "Model";
        
        $tabela = "usuarios";
        $id = 'id';
        $this->start();
        //$this->gerarHistorico($id,$tabela,$valores,$valores[$id]);
        $this->db->where(array($id => $valores[$id]));
        $this->db->update($tabela,$valores);
        $result = $this->responseInsert($this->db->error(), "Perifl editado com sucesso");
        $this->commit();
        return $result;
        
        
        
    }
    
    public function getPublicacoes(){
        $this->db->select('*');
        $this->db->from("publicacoes");
        $this->db->where("ativacao = '1'");
      //  $this->db->where('ativacao' == '1');
        
        //$this->db->get_where('publicacoes', array(ativacao=> '1'));
        $data = $this->db->get()->result_array();
        
        return $data;
        
        
    }
    
    public function criar_publicacoes($valores){
        
        $this->start();
        $this->db->insert('publicacoes',$valores);
        $result = $this->responseInsert($this->db->error(), "Publicação realizada com sucesso");
        $this->commit();
        return $result;
        
        
    }
    
      public function exibir_comentarios(){
        $this->db->select('*');
        $this->db->from("comentarios");
        
        $data = $this->db->get()->result_array();
        
        return $data;
        
        
      }
      
      public function criar_comentarios($valores){
          
        $this->start();
        $this->db->insert('comentarios',$valores);
        $result = $this->responseInsert($this->db->error(), "Comentario realizado com sucesso");
        $this->commit();
        return $result;
          
          
          
      }
      
      public function favoritos(){
        $this->db->select('*');
        $this->db->from("favoritos");
        
        $data = $this->db->get()->result_array();
        
        return $data;
          
      }
      
      public function verificar_dados_senha($email){
          
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('email', $email['email']);
        $login = $this->db->get();

        if (isset($login) && !is_null($login) && $login->num_rows() == 1) {
          $login->row();
            return true;
        } else {
            return false;
        }

    }
    
    public function alterar_senha($email){
       
        $tabela = "usuarios";
        $id = 'id';
        $this->start();
        //$this->gerarHistorico($id,$tabela,$valores,$valores[$id]);
        $this->db->where(array($id => $email[$id]));
        $this->db->update($tabela,'senha');
        $result = $this->responseInsert($this->db->error(), "Senha alterada com sucesso!");
        $this->commit();
        return $result;
        
        
    }
          
       
      
      public function gerar_token_alterecao_senha($email){
          
        $this->db->select("id, nome, (SELECT HEX(AES_ENCRYPT(concat(email,'//',now()), '@pp1c@c@o35c@l@'))) token");
        $this->db->from("usuarios");
        $this->db->where("email", $email);
        $data = $this->db->get()->row();
       // $this->cad_token($data);
        return $data;
          
      }
    
    //função para todos - Matheus tinha criado no MY_model
      public function responseInsert($error, $msgIfNoError){
		    //tste
            return array(
                "code" => $error["code"],
                "message"=>($error["code"]==0? $msgIfNoError:"Erro"),
                "error_description" => $error
            );
        }
        
        public function start(){
			$this->db->trans_begin();
		}
                
       public function commit(){
			if ($this->db->trans_status() === FALSE) {
			    $this->db->trans_rollback();

			    $erro = array(
//			    				'fk_usuario' => $this->session->userdata('usuario'),
								'cod' => $this->code,
								'erro' => $this->message,
								'query' => $this->query,
								'funcao' => $this->funcao,
								'maquina_usuario_erro' => $_SERVER['HTTP_USER_AGENT']
			    			);
			    
			    //Gerando arquivo de erro.
			    log_message('error', 
			    			'Codigo: '.$this->code.' Mensagem: "'.$this->message.'" Query: "'.$this->query.'"');
			    
			    //Armazenando no banco o log.
//			    $this->db->insert('seg_log_erro',$erro);

			    return array('status' => false, 
//			    			 'log_erro' => $this->db->insert_id(),
			    			 'code' => $this->code, 
			    			 'message' => $this->message, 
			    			 'query' => $this->query);

			} else {
			    $this->db->trans_commit();
			    return array('status' => true);
			}
		}
		

        
}