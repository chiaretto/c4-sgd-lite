<?php 
/*
 * Sistema de Gerenciamento de Dados Lite - SGDL
 * @autor: Fabiano Chiaretto Fernandes
 * 
 * @ultimaAlteracao 09:52 05/07/2010
 * 
 */
?>

<?php include_once('_topo.php') ?>

<?php include_once('_menu.php') ?>

<?php

// Função de autoload do sistema
function __autoload($nomeDaClasse) {
	include_once('classes/'.$nomeDaClasse.'.class.php');
}

// Tratamento do get da página
if(isset($_GET['pagina'])){
	$pagina = Util::anti_injection_static($_GET['pagina']);
}else{
	$pagina = "_home.php";
}


// Verifica se o arquivo da página existe
if(file_exists($pagina)){
	include_once($pagina);
}else{
	// Exibe a página de erro ou a mensagem, caso não exista uma pagina erro404
	if(file_exists("_erro404.html")){
		include_once("_erro404.html");
	}else{
		echo "Página ".$pagina." não encontrada.";
	}
}


?>

<?php include_once('_rodape.php') ?>
