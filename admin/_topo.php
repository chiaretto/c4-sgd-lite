<?php 
/*
 * Topo Administrador 
 * Sistema de Gerenciamento de Dados - SGD
 * 
 * @autor: Fabiano Chiaretto Fernandes
 * @ultimaAlteracao 14:23 05/07/2010
 * 
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		
		<title>Sistema de Gerenciamento de Dados</title>

		<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
		<link rel="shortcut icon" type="image/x-icon" href="css/favicon.ico">

		<meta http-equiv="Content-Language" content="pt-br">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; user-scalable=yes" />
		<meta name="author" content="Fabiano Chiaretto Fernandes">
		
		<script src="js/nicEdit.js" type="text/javascript"></script>

		<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/javascript.js"></script>
		
		<!--[if IE 6]>
			<link rel="stylesheet" type="text/css" href="css/style-ie6.css" media="all">
		<![endif]-->
		<!--[if IE 7]>
			<link rel="stylesheet" type="text/css" href="css/style-ie7.css" media="all">
		<![endif]-->
		<!--[if IE 8]>
			<link rel="stylesheet" type="text/css" href="css/style-ie8.css" media="all">
		<![endif]-->
		
		<?php
		if (stristr($_SERVER['HTTP_USER_AGENT'],'iPhone')) {
		    /* iPhone */
		   echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/style-iphone.css\" media=\"all\">";
		}
		?>
	</head>
	<body>
		
		<div id="topo">
			<div class="left">				<div id="logo" class="left">					<img src="css/img/pacote.png" alt="SGD">				</div>				<div id="slogan" class="left">					<?php echo InfoDados::$nomeSite; ?>				</div>			</div>			<div id="boxlogout" class="right">
				<a href="#">Logout</a>
			</div>			<div class="clear"></div>
			
		</div>