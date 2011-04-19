<?php 
/* 
 * Página: Alterar  Tipo de dados
 * Sistema de Gerenciamento de Dados - SGD
 *
 * @autor: Fabiano Chiaretto Fernandes
 * @ultimaAlteracao 09:09 28/01/2011
 *
 */
 
 // Define o tipo de conteúdo
 if($_GET){
 	if(isset($_GET['tipoConteudo'])){
 		$tipoConteudo = Util::anti_injection_static($_GET['tipoConteudo']);
 	}else{
 		$tipoConteudo = "";
 	}
 }
 
 if($_POST){
	
	/* Criação da instância */
	$banco = new Conexao();
	
	/* Verifica quantos campos personalizados o formulário possui */
	$numeroDeItens = sizeof($_POST['nomeDoCampo']);
	/*
	foreach($_POST['nomeDoCampo'] as $key_name => $key_value) {
		echo "<b>Nome campo: </b>".$key_value." | <b>Tipo campo:</b> ".$_POST['tipoDoCampo'][$key_name];
		echo "<br/>";
		echo "--------";
		echo "<br/>";
	}
	*/
	
	$nomeTipoConteudo = Util::anti_injection_static($_POST['nomeTipoConteudo']);
	$slugTipoConteudo = Util::criar_slug(Util::anti_injection_static($_POST['nomeTipoConteudo']));
	$iconeTipoConteudo = Util::anti_injection_static($_POST['iconeTipoConteudo']);
	
	//echo "[".$iconeTipoConteudo."]";
	
	/* Inclusão do campo no banco de dados */
	
	/* Inserção do tipo de conteudo */ 
	$sql1 = "INSERT INTO TipoConteudo(Tip_nome, Tip_slug, Tip_icone, Tip_data) VALUES ('".$nomeTipoConteudo."','".$slugTipoConteudo."','".$iconeTipoConteudo."','".date("Y-m-d H:i:s")."')";
	$banco->executa($sql1);  
	$TipoConteudo_Tip_id = mysql_insert_id();
	
	/* Inserção dos campos personalizados */ 
	foreach($_POST['nomeDoCampo'] as $idCampo => $valorCampo) {
		//echo "<b>Nome campo: </b>".$valorCampo." | <b>Tipo campo:</b> ".$_POST['tipoDoCampo'][$idCampo];
		
		$nomeCampo = $valorCampo;
		$slugCampo = Util::criar_slug($valorCampo);
		$tipoCampo = $_POST['tipoDoCampo'][$idCampo];
		$listarCampo = $_POST['listarCampo'][$idCampo];
		$helpCampo = $_POST['helpCampo'][$idCampo];
		
		if($nomeCampo!=""){
			$sql2 = "INSERT INTO CampoPersonalizado (TipoConteudo_Tip_id, Cam_nome, Cam_slug, Cam_tipo, Cam_listar, Cam_help, Cam_data, Cam_ordem) VALUES ('".$TipoConteudo_Tip_id."','".$nomeCampo."','".$slugCampo."','".$tipoCampo."','".$listarCampo."','".$helpCampo."','".date("Y-m-d H:i:s")."','".$idCampo."')";
			$banco->executa($sql2);	
		}
	}
	
	$url = InfoDados::$urlBaseAdmin."editar_tipoDeDados/";
		
	//header("Location: ".$url);
	
	echo "<script>";
	echo " self.location='$url';";
	echo "</script>"; 

 }
 
/* Abrir o tipo de dados */
if($tipoConteudo){
	
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
	
	$sql2 = "SELECT * FROM CampoPersonalizado C WHERE TipoConteudo_Tip_id='".$idTipoDeConteudo."' ORDER BY Cam_ordem ASC";
	$recset2 = $banco->executa($sql2);
}

?>
<div id="conteudo">
    <div id="containerTopoInterno">
        <div class="iconeH2 left">
            <img src="css/img/icone_pasta32.png">
        </div>
			<h2 class="tituloPagina left">Editar Tipo de Dados</h2>
    	</div>
    <div>
    	<form action="" method="post">
	    	<table width="100%">	    		<tr>	    			<td>
			            <div class="containerCampo">
			                <label for="nomeTipoConteudo" class="labelForm">
			                    Nome do tipo de dados
			                </label>
			                <div class="containerInput">			                	<input id="nomeTipoConteudo" name="nomeTipoConteudo" type="text" class="campoForm" value="<?php echo $nomeTipoDeConteudo;?>">			                </div>
							<span class="helpCampo">Digite o nome de forma simples. Esse será o nome da tabela no banco.</span>
			            </div>
						<div class="containerCampo">
			                <label for="iconeTipoConteudo" class="labelForm">
			                    Ícone do tipo de dados
			                </label>
			                <div class="containerInput">
			                	<div class="listRadio">
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Profile.png" <?php echo ($iconeTipoDeConteudo=="Profile.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Profile.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Email.png" <?php echo ($iconeTipoDeConteudo=="Email.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Email.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Loading.png" <?php echo ($iconeTipoDeConteudo=="Loading.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Loading.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Bar Chart.png" <?php echo ($iconeTipoDeConteudo=="Bar Chart.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Bar Chart.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Comment.png" <?php echo ($iconeTipoDeConteudo=="Comment.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Comment.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Info.png" <?php echo ($iconeTipoDeConteudo=="Info.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Info.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Picture.png" <?php echo ($iconeTipoDeConteudo=="Picture.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Picture.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Save.png" <?php echo ($iconeTipoDeConteudo=="Save.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Save.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Modify.png" <?php echo ($iconeTipoDeConteudo=="Modify.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Modify.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Add.png" <?php echo ($iconeTipoDeConteudo=="Add.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Add.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Search.png" <?php echo ($iconeTipoDeConteudo=="Search.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Search.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Warning.png" <?php echo ($iconeTipoDeConteudo=="Warning.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Warning.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Pie Chart.png" <?php echo ($iconeTipoDeConteudo=="Pie Chart.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Pie Chart.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Print.png" <?php echo ($iconeTipoDeConteudo=="Print.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Print.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Exit.png" <?php echo ($iconeTipoDeConteudo=="Exit.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Exit.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Load.png" <?php echo ($iconeTipoDeConteudo=="Load.png")?"checked":""; ?> class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Load.png">
                                </label></div>
			                </div>
							<span class="helpCampo">Selecione a imagem no tamanho de 45x45 pixels para referênciar esse tipo de conteúdo.</span>
			            </div>
						
						<ul id="listaItensCamposPersonalizados">							
							<?php
								$contador=0;
								
								while ($linha = mysql_fetch_array($recset2)){
									$contador++;  	
							?>
							
							<li class="itemCampoPersonalizado" id="itemCampoPersonalizado-<?php echo $contador; ?>">
					            <div class="containerCampo">
									<label class="labelForm">
						                    Campo personalizado
											<a href="javascript:void(0);" class="removerCampo right <?php echo ($contador=="1")?"hide":""; ?>">Remover este campo</a>
						            </label>
									<table width="100%">										<tr>											<td>
												<span class="helpCampo">Nome do campo</span>
								                <div class="containerInput">
								                    <input id="nomeDoCampo[]" name="nomeDoCampo[]" type="text" class="campoForm" value="<?php echo $linha["Cam_nome"];?>">
								                </div>
											</td>											<td>
												<span class="helpCampo">Escolha o tipo do conteúdo</span>
								                <div class="containerInput">
								                    <select name="tipoDoCampo[]" id="tipoDoCampo[]">
								                    	<option value="texto" <?php echo ($linha["Cam_tipo"]=="texto")?"selected":""; ?>>Texto Simples</option>
								                    	<option value="html" <?php echo ($linha["Cam_tipo"]=="html")?"selected":""; ?>>Html</option>
								                    	<option value="categorizacao" <?php echo ($linha["Cam_tipo"]=="categorizacao")?"selected":""; ?> disabled="true">Categorização</option>
								                    	<option value="senha" <?php echo ($linha["Cam_tipo"]=="senha")?"selected":""; ?>>Senha</option>
								                    	<option value="data" <?php echo ($linha["Cam_tipo"]=="data")?"selected":""; ?> disabled="true">Data</option>
								                    	<option value="hora" <?php echo ($linha["Cam_tipo"]=="hora")?"selected":""; ?> disabled="true">Hora</option>
								                    	<option value="checkBox" <?php echo ($linha["Cam_tipo"]=="checkBox")?"selected":""; ?> disabled="true">Check box</option>
								                    	<option value="comboBox" <?php echo ($linha["Cam_tipo"]=="comboBox")?"selected":""; ?> disabled="true">Combo box</option>
								                    	<option value="radioBox" <?php echo ($linha["Cam_tipo"]=="radioBox")?"selected":""; ?> disabled="true">Radio box</option>
								                    	<option value="imagem" <?php echo ($linha["Cam_tipo"]=="imagem")?"selected":""; ?> disabled="true">Imagem Única</option>
								                    	<option value="galeriaDeImagens" <?php echo ($linha["Cam_tipo"]=="galeriaDeImagens")?"selected":""; ?> disabled="true">Galeria de Imagens</option>
								                    	<option value="galeriaDeArquivos" <?php echo ($linha["Cam_tipo"]=="galeriaDeArquivos")?"selected":""; ?> disabled="true">Galeria de Arquivos</option>
								                    </select>
								                </div>
											</td>
											<td>
												<span class="helpCampo">Mensagem de ajuda do campo</span>
								                <div class="containerInput">
								                    <input id="helpCampo[]" name="helpCampo[]" type="text" class="campoForm" value="<?php echo $linha["Cam_help"]; ?>">
								                </div>
											</td>
											<td>
												<span class="helpCampo">Listar campo</span>
								                <div class="containerInput">
		 											<select name="listarCampo[]" id="listarCampo[]">
								                    	<option value="0" <?php echo ($linha["Cam_listar"]=="0")?"selected":""; ?>>Não</option>
								                    	<option value="1" <?php echo ($linha["Cam_listar"]=="1")?"selected":""; ?>>Sim</option>
													</select>
								                </div>
											</td>										</tr>									</table>
					            </div>
							</li>
							
							<?php 
								}
							?>
							
						</ul>
						<a id="adicionarNovoCampo" href="javascript:void(0);" class="botao">Adicionar novo campo</a>
			       
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
					<div class="containerCampo">
		                <label class="labelForm">
		                    Tipo de Dados
		                </label>
						<span class="helpCampo">Selecione o tipo</span>
		                <div class="containerInput">
								<select name="listarCampo[]" id="listarCampo[]">
		                    	<option value="0">Postagens</option>
		                    	<option value="1">Configurações</option>
							</select>
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
