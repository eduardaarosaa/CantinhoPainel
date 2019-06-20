

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_cantinho extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    public function cadastro($data){
        
        return $this->db->insert('usuarios',$data);
       
        
    }
    
    public function login_comum($dados){
    
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('email',$dados['email']);
        $this->db->where('senha',$dados['senha']);
       
        
        $login = $this->db->get();
        
         if ($login->num_rows() == 1){
            return $login->row();
        } else {
            return false;
        }
   
   
  
    }
    
    public function painel($dados){
        
        return $this->db->query("Select * from usuarios")->result();
        
    }
    
    public function admin_publicacoes(){
        return $this->db->query("select * from publicacoes")->result();
    }
    
    public function exibir_comentarios(){
        
        return $this->db->query("select * from comentarios")->result();

    }
    
    public function exibir_usuarios(){
        
      return $this->db->query("select * from usuarios")->result();

        
    }
    
     public function desativar_publicacao($tabela,$id){
         
       $query =   $this->db->query("update ". $tabela . " set ativacao = 0 where id =".$id);
         
         if ($query == true){
             
             return true;
             
         }else {
             return false;
         }
         
     }
     public function ativar_publicacao($tabela,$id){
         
         $query = $this->db->query("update ". $tabela . " set ativacao = 1 where id=" . $id);
         
         if($query == true){
             
             return true;
         }else{
             return false;
         }
         
     }
     
     public function desativar_comentarios($tabela,$id){
         $query = $this->db->query("update ". $tabela . " set ativacao = 0 where id =".$id);
         
         if ($query == true){
             
             return true;
             
         }else {
             return false;
         }

         
     }
     
     public function ativar_comentarios($tabela,$id){
         
         $query = $this->db->query("update ". $tabela . " set ativacao = 1 where id =".$id);
         
         if(query == true){
             
             return true;
         }else{
             return false;
         }
     }
     
     public function desativar_usuarios($tabela,$id){
          
         $query = $this->db->query("update ". $tabela . " set ativacao = 0 where id =".$id);
         
         if ($query == true){
             
             return true;
             
         }else {
             return false;
         }
         
         
     }
     
     public function ativar_usuarios($tabela,$id){
         
         $query = $this->db->query("update ". $tabela . " set ativacao = 1 where id=".$id);
         
         if($query == true){
             
             return true;
         }else {
             
             return false;
         }
     }
}
     
     
    
    

