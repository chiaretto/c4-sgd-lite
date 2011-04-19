<?php

/* Atualizado em 07/01/2010
 * 
 * Classe de conexão com MySql
 * Auto: Fabiano Chiaretto Fernandes
 * Blog: http://blog.c4midia.com.br 
 * 
 * ----------------------INSERT
 * $banco = new Conexao();
 * $comando = $banco->executa("INSERT INTO tabela (campo) VALUE ('0')");
 * 
 * ----------------------UPDATE
 * $banco = new Conexao();
 * $comando = $banco->executa("UPDATE tabela SET campo='0' WHERE id=".$id." LIMIT 1");
 * 
 * ----------------------SELECT
 * $banco = new Conexao();
 * $recset = $banco->executa("SELECT * FROM tabela");
 * while ($linha = mysql_fetch_array($recset)){  	
 *  	echo "$linha['ID']";
 *  }
 *  
 *  
 */
class Conexao{	
	private $id;
	
	private $servidor="localhost";
	private $porta="3306";
	private $nomeBanco="c4sgd";
	private $usuario="root";
	private $senha="";
	
	public function __construct(){
		
	    try{

		if(!($this->id = mysql_connect($this->servidor,$this->usuario,$this->senha))){
		   echo "1 - Não foi possível conectar ao servidor MySQL. Favor Contactar o Administrador.";
		   //exit;
		}

	    }catch (Exception $e){
                echo $e->getMessage();
            }

  	   try{
		
		if(!($con=mysql_select_db($this->nomeBanco,$this->id))){
		   echo "2 - Não foi possível selecionar o banco. Favor Contactar o Administrador.";
		   //exit;
		}
	    }catch (Exception $e){
                echo $e->getMessage();
            }
	}
	
	public function executa($sql,$erro = 1){
	   if(empty($sql) OR !($this->id))
	       return 0; //Erro na conexao ou no comando SQL   
	   if (!($res = @mysql_query($sql,$this->id))) {
	      if($erro)
	        echo "Ocorreu um erro na execução do Comando SQL no banco de dados. Favor Contactar o Administrador.";
	      exit;
	   }
	   return $res;
	}
	
	
    public function getNomeBanco(){
        return $this->nomeBanco;
    }
    public function setNomeBanco($nomeBanco)    {
        $this->nomeBanco = $nomeBanco;
    }
	
    public function getPorta(){
        return $this->porta;
    }
    public function setPorta($porta){
        $this->porta = $porta;
    }
	
    public function getSenha(){
        return $this->senha;
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }
	
    public function getUsuario(){
        return $this->usuario;
    }
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function getServidor(){
        return $this->servidor;
    }
    public function setServidor($servidor){
        $this->servidor = $servidor;
    }
	
}

?>
