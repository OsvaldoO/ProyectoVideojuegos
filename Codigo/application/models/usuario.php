<?php

class Usuario extends CI_Model
{
    public function listaTop()
    {
    		$query = $this->db->query("SELECT * FROM usuarios ORDER BY puntos DESC");
    		return $query->result();
    }
    
    public function correctPass($usuario,$pass)
    {
			$query = $this->db->query("SELECT pass FROM usuarios WHERE nick = '$usuario'");
    		$user = $query->row();
    			if($user->pass == $pass)
    				{
    					return true;	
    				}
    		return false;
    	}
    	
    	public function cambiaPass($usuario, $pass) {
			$this->db->where('nick', $usuario);
			$this->db->update('usuarios', $pass); 
		}
 }
?>