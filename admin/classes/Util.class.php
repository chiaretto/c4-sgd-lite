<?php

/* Atualizado em 15:12 16/11/2010
 * 
 * Classe de funções uteis para php
 * Auto: Fabiano Chiaretto Fernandes
 * Blog: http://blog.c4midia.com.br 
 * 
 * //Forma Normal
 * $util = new Util();
 * $nome = $util->anti_injection($_POST['nome']);
 * 
 * //Forma estática
 * $nome = Util::anti_injection_static($_POST['nome']);
 * 
 * 
 * Parametros
 * (string, adicionaBarras, utf8Decode);
 */


class Util{
	
	/*
	 * Função de validação de emails
	 */ 
	public static function validaEmail($valor){
		$retorno = $valor;
		return $retorno;
	}
	
	/*
	 * Função de validação de formulários
	 */ 
	public static function form($valor){
		$retorno = $valor;
		return $retorno;
	}
	
	/*
	 * Função normal
	 */ 
	public function anti_injection($campo, $adicionaBarras = false, $utf8 = false) {
		/* Remove palavras que contenham sintaxe sql */
        $campo = preg_replace("/(from|alter table|select|insert|delete|update|where|drop table|show tables|#|\*|--|\\\\)/i","",$campo);
        $campo = trim($campo);/* limpa espaços vazio */
        $campo = strip_tags($campo);/* tira tags html e php */
        if($adicionaBarras || !get_magic_quotes_gpc())
			$campo = addslashes($campo);/* Adiciona barras invertidas a uma string */
		if($utf8)
			$campo = utf8_decode($campo);
        return $campo;
	}
	
	/* 
	 * Função stática
	 */
	public static function anti_injection_static($campo, $adicionaBarras = false, $utf8 = false) {
		/* Remove palavras que contenham sintaxe sql */
        $campo = preg_replace("/(from|alter table|select|insert|delete|update|where|drop table|show tables|#|\*|--|\\\\)/i","",$campo);
        $campo = trim($campo);//limpa espaços vazio
        $campo = strip_tags($campo);//tira tags html e php
        if($adicionaBarras || !get_magic_quotes_gpc())
			$campo = addslashes($campo);//Adiciona barras invertidas a uma string
		if($utf8)
			$campo = utf8_decode($campo);
        return $campo;
	}
	
	/* 
	 * Função stática
	 */
	public static function criar_slug($string) {
		$caractere = array('à','á','ä','â','ã','è','é','ë','ê','ì','í','ï','î','ò','ó','ö','ô','ù','ú','ü','û','ñ','ç','·','/','_',',',':',';','|');
		$substituto = array('a','a','a','a','a','e','e','e','e','i','i','i','i','o','o','o','o','u','u','u','u','n','c','-','-','-','-','-','-','-');
		
		$string = str_replace($caractere, $substituto, $string);
		 
		$string = strtolower(trim($string));
		$string = preg_replace('/[^a-z0-9-]/', '-', $string);
		$string = preg_replace('/-+/', "-", $string);
		
        return $string;
	}
}


?>