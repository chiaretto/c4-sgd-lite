<?php 
/* 
 * Página: Adicionar Usuario
 * Sistema de Gerenciamento de Dados Lite - SGDL
 *
 * @autor: Fabiano Chiaretto Fernandes
 * @ultimaAlteracao 12:01 18/10/2010
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
?>
<div id="conteudo">
    <div id="containerTopoInterno">
        <div class="iconeH2 left">
            <img src="css/img/icone_pasta32.png">
        </div>
			<h2 class="tituloPagina left">Adicionar Tipo de Dados ao Sistema</h2>
    	</div>
    <div>
    	<form action="" method="post">
	    	<table width="100%">	    		<tr>	    			<td>
			            <div class="containerCampo">
			                <label for="nomeTipoConteudo" class="labelForm">
			                    Nome do tipo de dados
			                </label>
			                <div class="containerInput">			                	<input id="nomeTipoConteudo" name="nomeTipoConteudo" type="text" class="campoForm">			                </div>
							<span class="helpCampo">Digite o nome de forma simples. Esse será o nome da tabela no banco.</span>
			            </div>
						<div class="containerCampo">
			                <label for="iconeTipoConteudo" class="labelForm">
			                    Ícone do tipo de dados
			                </label>
			                <div class="containerInput">
			                	<div class="listRadio">
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Profile.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Profile.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Email.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Email.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Loading.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Loading.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Bar Chart.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Bar Chart.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Comment.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Comment.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Info.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Info.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Picture.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Picture.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Save.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Save.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Modify.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Modify.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Add.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Add.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Search.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Search.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Warning.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Warning.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Pie Chart.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Pie Chart.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Print.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Print.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Exit.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Exit.png">
                                </label>
                                <label>
                                    <input id="iconeTipoConteudo" name="iconeTipoConteudo" type="radio" value="Load.png" class="formRadio"><img src="css/icones/Web-Application-Icons-Set/PNG-32/Load.png">
                                </label></div>
			                </div>
							<span class="helpCampo">Selecione a imagem no tamanho de 45x45 pixels para referênciar esse tipo de conteúdo.</span>
			            </div>
						
						<ul id="listaItensCamposPersonalizados">							<li class="itemCampoPersonalizado" id="itemCampoPersonalizado-1">
					            <div class="containerCampo">
									<label class="labelForm">
						                    Campo personalizado
											<a href="javascript:void(0);" class="removerCampo right hide">Remover este campo</a>
						            </label>
									<table width="100%">										<tr>											<td>
										
												<span class="helpCampo">Nome do campo</span>
								                <div class="containerInput">
								                    <input id="nomeDoCampo[]" name="nomeDoCampo[]" type="text" class="campoForm">
								                </div>
											</td>											<td>
												<span class="helpCampo">Escolha o tipo do conteúdo</span>
								                <div class="containerInput">
								                    <select name="tipoDoCampo[]" id="tipoDoCampo[]">
								                    	<option value="texto">Texto Simples</option>
								                    	<option value="html">Html</option>
								                    	<option value="categorizacao" disabled="true">Categorização</option>
								                    	<option value="senha">Senha</option>
								                    	<option value="data" disabled="true">Data</option>
								                    	<option value="hora" disabled="true">Hora</option>
								                    	<option value="checkBox" disabled="true">Check box</option>
								                    	<option value="comboBox" disabled="true">Combo box</option>
								                    	<option value="radioBox" disabled="true">Radio box</option>
								                    	<option value="imagem" disabled="true">Imagem Única</option>
								                    	<option value="galeriaDeImagens" disabled="true">Galeria de Imagens</option>
								                    	<option value="galeriaDeArquivos" disabled="true">Galeria de Arquivos</option>
								                    </select>
								                </div>
											</td>
											<td>
												<span class="helpCampo">Mensagem de ajuda do campo</span>
								                <div class="containerInput">
								                    <input id="helpCampo[]" name="helpCampo[]" type="text" class="campoForm">
								                </div>
											</td>
											<td>
												<span class="helpCampo">Listar campo</span>
								                <div class="containerInput">
		 											<select name="listarCampo[]" id="listarCampo[]">
								                    	<option value="0">Não</option>
								                    	<option value="1">Sim</option>
													</select>
								                </div>
											</td>										</tr>									</table>
					            </div>
							</li>
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
