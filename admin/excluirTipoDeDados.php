<?php 
/* 
 * Pсgina Ajax de remoчуo de Tipos de Conteњdos
 * Sistema de Gerenciamento de Dados - SGD
 * 
 * @autor: Fabiano Chiaretto Fernandes
 * @ultimaAlteracao15:18 16/11/2010
 * 
 */
 
 // Verifica se hс requisiчуo
 if($_POST){
 	if(isset($_POST['idTipoDeConteudo'])){
 		
		require_once("../classes/Conexao.class.php");
		require_once("../classes/Util.class.php");
		
 		$idTipoDeConteudo = Util::anti_injection_static($_POST['idTipoDeConteudo']);
		
		$banco = new Conexao();
		$sql = "DELETE FROM TipoConteudo WHERE Tip_id='".$idTipoDeConteudo."'";
		$banco->executa($sql);
		$sql = "DELETE FROM CampoPersonalizado WHERE TipoConteudo_Tip_id='".$idTipoDeConteudo."'";
		$banco->executa($sql);
		
		echo "ok";
 	}else{
 		echo "Erro.";
 	}
 }
 
 ?>