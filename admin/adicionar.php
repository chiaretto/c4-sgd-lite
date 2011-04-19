<?php 
/* 
 * Página inicial do administrador
 * Sistema de Gerenciamento de Dados - SGD
 *
 * @autor: Fabiano Chiaretto Fernandes
 * @ultimaAlteracao 18:16 07/07/2010
 *
 */
 
 // Define o tipo de conteúdo
 if($_GET){
 	if(isset($_GET['tipoConteudo'])){
 		$tipoConteudo = Util::anti_injection_static($_GET['tipoConteudo']);
 	}
 }
 
/* Criação da instância */
$banco = new Conexao();
$sql = "SELECT * FROM TipoConteudo T WHERE Tip_slug='".$tipoConteudo."' LIMIT 0,1";
$recset = $banco->executa($sql);

while ($linha = mysql_fetch_array($recset)){  	

	$idTipoDeConteudo = $linha['Tip_id'];
	$nomeTipoDeConteudo = $linha['Tip_nome'];
	$iconeTipoDeConteudo = $linha['Tip_icone'];
	
	break;
}

/* Inserção da postagem e dos valores personalizados */
if($_POST){

	$sql2 = "INSERT INTO Postagem (TipoConteudo_Tip_id, Post_data) VALUES ('".$idTipoDeConteudo."','".date("Y-m-d H:i:s")."')";
 	
	$banco->executa($sql2);
	$Postagem_Post_id = mysql_insert_id();
	
	/* Verifica quantos campos personalizados o formulário possui */
	//$numeroDeItens = sizeof($_POST['nomeDoCampo']);
	
	
	foreach($_POST as $chave => $valor){
		if($chave!="submit"){
			//echo $chave.":".$valor."<br/>";
			$sql3 = "INSERT INTO ConteudoCampoPostagem (CampoPersonalizado_Cam_id, Postagem_Post_id, Cont_valor, Conta_data) VALUES ('".$chave."','".$Postagem_Post_id."','".$valor."','".date("Y-m-d H:i:s")."')";
			$banco->executa($sql3);
		}
	}
	
	//print_r($_POST);
 	
}


$sql2 = "SELECT * FROM CampoPersonalizado C WHERE TipoConteudo_Tip_id='".$idTipoDeConteudo."' ORDER BY Cam_ordem ASC";
$recset2 = $banco->executa($sql2);


?>

<div id="conteudo">
    <div id="containerTopoInterno">
        <div class="iconeH2 left">
            <img src="<?php echo InfoDados::$urlIcone.'PNG-32/'.$iconeTipoDeConteudo; ?>">
        </div><h2 class="tituloPagina left">Adicionar <?php echo $nomeTipoDeConteudo;?></h2>
    </div>
    <div>
	<form action="" method="post">
		<table width="100%">
			<tr>
				<td>
				<?php
				while ($linha2 = mysql_fetch_array($recset2)){
					
					$tipoConteudoCampo = $linha2['Cam_tipo'];
					$nomeCampo = $linha2['Cam_nome'];
					$slugCampo = $linha2['Cam_slug'];
					$idCampo = $linha2['Cam_id'];
					$helpCampo = $linha2['Cam_help'];
					
					//echo $tipoConteudoCampo;
					
					switch($tipoConteudoCampo){
				
					case "texto":{
				?>
		            <div class="containerCampo">
		                <label for="<?php echo $idCampo;?>" class="labelForm">
		                    <?php echo $nomeCampo;?>
		                </label>
		                <div class="containerInput">		                	<input id="<?php echo $idCampo;?>" name="<?php echo $idCampo;?>" type="text" class="campoForm">		                </div>
						<span class="helpCampo"><?php echo $helpCampo;?></span>
		            </div>
				<?php 
					}break; 
				?>
				
				<?php
					case "html":{
				?>
		 			<div class="containerCampo">
			        <script type="text/javascript">
					bkLib.onDomLoaded(function() {
						new nicEditor({fullPanel : true}).panelInstance('<?php echo $idCampo;?>');
					});
					</script>
		                <label for="<?php echo $idCampo;?>" class="labelForm">
		                    <?php echo $nomeCampo;?>
		                </label>
						<div class="containerTextArea">
							<textarea name="<?php echo $idCampo;?>" id="<?php echo $idCampo;?>" rows="10" class="campoForm"></textarea>
						</div>
						<span class="helpCampo"><?php echo $helpCampo;?></span>
		            </div>
				<?php 
					}break; 
				?>
				
				<?php
					case "senha":{
				?>
		            <div class="containerCampo">
		                <label for="<?php echo $idCampo;?>" class="labelForm">
		                    <?php echo $nomeCampo;?>
		                </label>
		                <div class="containerInput">
		                	<input id="<?php echo $idCampo;?>" name="<?php echo $idCampo;?>" type="password" class="campoForm">
		                </div>
						<span class="helpCampo"><?php echo $helpCampo;?></span>
		            </div>
				<?php 
					}break; 
				?>
				
				<?php 
					default: "Campo inválido";
					}//finaliza switch
				}//finaliza while
				?>
				
					</td>
	    			<td valign="top" width="132">
	    				<div class="containerCampo">
			                <label class="labelForm">
			                    Publicação
			                </label>
							
			                <div class="containerInput">
			                	<button id="submit" name="submit" type="submit"  class="botaoPrincipal">Salvar</button>
			                </div>
			            </div>
						
	    			</td>
	    		</tr>
	    	</table>
		</form>

    </div>
</div>
<div class="clear">
</div>
