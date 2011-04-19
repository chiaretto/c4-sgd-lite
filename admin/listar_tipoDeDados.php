<?php 
/* 
 * Página inicial do administrador
 * Sistema de Gerenciamento de Dados - SGD
 * 
 * @autor: Fabiano Chiaretto Fernandes
 * @ultimaAlteracao 16:35 07/07/2010
 * 
 */
 
 // Define o tipo de conteúdo
 if($_GET){
 	if(isset($_GET['tipoConteudo'])){
 		$tipoConteudo = Util::anti_injection_static($_GET['tipoConteudo']);
 	}else{
 		$tipoConteudo = "a";
 	}

 }
 
$banco = new Conexao();
$sql = "SELECT * FROM TipoConteudo T";
$recset = $banco->executa($sql);

?>

<div id="conteudo">
	<div id="containerTopoInterno">
		<div class="iconeH2 left">
			<img src="css/img/icone_pasta32.png">
		</div>
		<h2 class="tituloPagina left">
			Tipos de Dados do Sistema
		</h2>
		<div class="contBtnAdd left">
			<a href="<?php echo InfoDados::$urlBaseAdmin ?>adicionar_tipoDeDados/" class="botao">Adicionar</a>
		</div>
		<div class="boxPesquisa right">
			<input type="text"> <input type="button" class="botao" value="Pesquisar">
		</div>
	</div>


		<table class="listagemDeDados" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td class="tituloColuna" width="1">&nbsp;</td>
				<td class="tituloColuna">Nome do tipo de conteúdo</td>

			</tr>
			
			<?php
			while ($linha = mysql_fetch_array($recset)){  	
			?>
			
			<tr id="linha-<?php echo $linha['Tip_id'];?>" class="linhaListagem">
				<td>&nbsp;</td>
				<td>
				<a href="<?php echo InfoDados::$urlBaseAdmin.'editar_tipoDeDados/'.$linha['Tip_slug']; ?>">
				<?php echo $linha['Tip_nome']; ?>
				</a>
				<div class="opcoesItem">
					<a href="<?php echo InfoDados::$urlBaseAdmin.'editar_tipoDeDados/'.$linha['Tip_slug']; ?>">Editar</a> | <a href="javascript:removerTipoDeDados('<?php echo $linha['Tip_id'];?>','<?php echo $linha['Tip_nome']; ?>');void(0);" class="linkExcluir">Excluir</a>
				</div>
				</td>
			</tr>
			
			<?php 
			}
			?>
			
			<tr>
				<td class="tituloColuna">&nbsp;</td>
				<td class="tituloColuna">Título</td>
			</tr>
		</table>

</div>
<div class="clear"></div>