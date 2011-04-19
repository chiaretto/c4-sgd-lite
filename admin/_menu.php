<?php 
/* 
 * Menu lateral
 * Sistema de Gerenciamento de Dados Lite - SGDL
 *
 * @autor: Fabiano Chiaretto Fernandes
 * @ultimaAlteracao 11:44 07/07/2010
 *
 */
 
?>
<div id="colunaMenu">
		
    <!-- Início bloco de menu -->
    <div class="blocoMenu">
        <div class="iconeMenu">
            <img src="css/img/icone_tiposFormularios16.png">
        </div>
        <div class="iconeSeta">
            <br/>
        </div>
        <a class="linkBlocoMenu" href="<?php echo InfoDados::$urlBaseAdmin ?>?pagina=listar_tipoDeDados.php">Tipos de dados</a>
        <div class="clear">
        </div>
        <ul class="opcoesMenu">
            <li class="itemMenu">
                <a class="linkMenu" href="<?php echo InfoDados::$urlBaseAdmin ?>?pagina=listar_tipoDeDados.php">Editar</a>
            </li>
            <li class="itemMenu">
                <a class="linkMenu" href="<?php echo InfoDados::$urlBaseAdmin ?>?pagina=adicionar_tipoDeDados.php">Adicionar</a>
            </li>
        </ul>
    </div>
	<!-- Final bloco de menu -->
	
    <!-- Início bloco de menu -->
    <div class="blocoMenu">
        <div class="iconeMenu">
            <img src="css/img/icone_configuracoes16.png">
        </div>
        <div class="iconeSeta">
            <br/>
        </div>
        <a class="linkBlocoMenu" href="<?php echo InfoDados::$urlBaseAdmin ?>?pagina=_lsitar_usuarios.php">Usuários</a>
        <div class="clear">
        </div>
        <ul class="opcoesMenu">
            <li class="itemMenu">
                <a class="linkMenu" href="<?php echo InfoDados::$urlBaseAdmin ?>?pagina=_listar_usuarios.php">Editar</a>
            </li>
            <li class="itemMenu">
                <a class="linkMenu" href="<?php echo InfoDados::$urlBaseAdmin ?>?pagina=_adicionar_usuarios.php">Adicionar</a>
            </li>
        </ul>
    </div>
	<!-- Final bloco de menu -->
	
</div>
