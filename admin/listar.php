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
		
		$banco = new Conexao();

		$sql = "SELECT * FROM TipoConteudo T WHERE Tip_slug='".$tipoConteudo."' LIMIT 0,1";
		$recset = $banco->executa($sql);
		
		
		while ($linha = mysql_fetch_array($recset)){  	
			
			$idTipoDeConteudo = $linha['Tip_id'];
			$nomeTipoDeConteudo = $linha['Tip_nome'];
			$slugTipoDeConteudo = $linha['Tip_slug'];
			$iconeTipoDeConteudo = $linha['Tip_icone'];
			
			break;
		}
		
		$sql2 = "SELECT * FROM CampoPersonalizado C WHERE TipoConteudo_Tip_id='".$idTipoDeConteudo."' AND Cam_listar IS TRUE ORDER BY Cam_ordem LIMIT 0,5";
		$recset2 = $banco->executa($sql2);
		
		$titulosTabelaArray = array();
		$arrayCamposPersonalizados = array();
		
		while ($linha2 = mysql_fetch_array($recset2)){  	
			array_push($titulosTabelaArray, $linha2['Cam_nome']);
		}
		
		$sql3 = "SELECT * FROM Postagem P WHERE TipoConteudo_Tip_id='".$idTipoDeConteudo."' ORDER BY POST_id DESC";
		$recset3 = $banco->executa($sql3);
		

		$sqlOtimizado = "SELECT
						P.Post_id,
						
						co.Cont_valor as nome,
						co2.Cont_valor as usuario,
						co3.Cont_valor as email
						
						FROM
						postagem p,
						
						conteudocampopostagem co,
						campopersonalizado ca,
						
						conteudocampopostagem co2,
						campopersonalizado ca2,
						
						conteudocampopostagem co3,
						campopersonalizado ca3
						
						WHERE true
						
						AND co.Postagem_Post_id=P.Post_id
						AND co.CampoPersonalizado_Cam_id=ca.Cam_id
						AND ca.Cam_slug='nome-completo'
						
						AND co2.Postagem_Post_id=P.Post_id
						AND co2.CampoPersonalizado_Cam_id=ca2.Cam_id
						AND ca2.Cam_slug='usuario'
						
						AND co3.Postagem_Post_id=P.Post_id
						AND co3.CampoPersonalizado_Cam_id=ca3.Cam_id
						AND ca3.Cam_slug='email'
						
						";
			$recsetOtimizado = $banco->executa($sqlOtimizado);
 	}
 }


 
?>

<div id="conteudo">
	<div id="containerTopoInterno">
		<div class="iconeH2 left">
			<img src="<?php echo InfoDados::$urlIcone.'PNG-32/'.$iconeTipoDeConteudo; ?>">
		</div>
		<h2 class="tituloPagina left">
			<?php echo $nomeTipoDeConteudo;?>
		</h2>
		<div class="contBtnAdd left">
			<a href="<?php echo InfoDados::$urlBaseAdmin.'adicionar/'.$slugTipoDeConteudo; ?>" class="botao">Adicionar</a>
		</div>
		<div class="boxPesquisa right">
			<input type="text"> <input type="button" class="botao" value="Pesquisar">
		</div>
	</div>


		<table class="listagemDeDados" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td class="tituloColuna" width="1">&nbsp;</td>
				<?php
					foreach($titulosTabelaArray as $titulos){
						echo "<td class=\"tituloColuna\">".$titulos."</td>";
					}
				?>
			</tr>
			
			<?php
			//*/
			while ($linha3 = mysql_fetch_array($recset3)){ 
			
				$post_id = $linha3['Post_id'];
								
				$sql4 = "SELECT P.Post_id, C.Cont_valor FROM Postagem P, ConteudoCampoPostagem C, CampoPersonalizado Ca WHERE C.Postagem_Post_id=P.Post_id AND Ca.Cam_id=C.CampoPersonalizado_Cam_id AND Ca.Cam_listar is true AND P.Post_id='".$post_id."' ORDER BY Ca.Cam_ordem LIMIT 0,5";
				$recset4 = $banco->executa($sql4);
				
				$opcoes = true;
				
				echo "<tr class=\"linhaListagem\">";
				echo "<td>&nbsp;</td>";
				
				while ($linha4 = mysql_fetch_array($recset4)){ 
					echo "<td class=\"linhaListagem\"><a href=\"#editar\">".$linha4['Cont_valor']."</a>";
					if($opcoes){
						echo "<div class=\"opcoesItem\">";
						echo "	<a href=\"#editar\">Editar</a> | <a onclick=\"if ( confirm('Você está prestes a excluir \'Titulo teste\'\n\'Cancelar\' para interromper, \'OK\' para excluir.') ) { return true;}return false;\" href=\"#ecluir\" class=\"linkExcluir\">Excluir</a>";
						echo "</div>";
						$opcoes = false;
					}
					echo "</td>";
				}
				
				echo "</tr>";
				
			}
			//*/
			?>
			
			<?php 
			/*/
				while ($linhaOtimizado= mysql_fetch_array($recsetOtimizado)){
					echo "<tr class=\"linhaListagem\">";
					echo "	<td>&nbsp;</td>";
					echo "	<td class=\"linhaListagem\"><a href=\"#editar\">".$linhaOtimizado['nome']."</a>";
					echo "	<div class=\"opcoesItem\">";
					echo "		<a href=\"#editar\">Editar</a> | <a onclick=\"if ( confirm('Você está prestes a excluir \'Titulo teste\'\n\'Cancelar\' para interromper, \'OK\' para excluir.') ) { return true;}return false;\" href=\"#ecluir\" class=\"linkExcluir\">Excluir</a>";
					echo "	</div>";
					echo "	</td>";
					echo "	<td class=\"linhaListagem\">".$linhaOtimizado['usuario']."</a>";
					echo "	<td class=\"linhaListagem\">".$linhaOtimizado['email']."</a>";
					echo "</tr>";
				}
			//*/
			?>
			
			<tr>
				<td class="tituloColuna">&nbsp;</td>
				<?php
					foreach($titulosTabelaArray as $titulos){
						echo "<td class=\"tituloColuna\">".$titulos."</td>";
					}
				?>
			</tr>
		</table>

</div>
<div class="clear"></div>