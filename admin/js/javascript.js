/* 
 * Controles de JavaScript
 * Sistema de Gerenciamento de Dados - SGD
 * 
 * @autor: Fabiano Chiaretto Fernandes
 * @ultimaAlteracao 16:35 07/07/2010
 * 
 */

//Inicialização do js
$(document).ready(function(){


});

$(function(){
	
	/* Exibe opções do item */
	$(".linhaListagem").mouseover(function(){
		$(".opcoesItem",this).css("visibility","visible");
	}); 
	
	/* Oculta opções do item */
	$(".linhaListagem").mouseout(function(){
		$(".opcoesItem",this).css("visibility","hidden");
	}); 
	
	/* Criar slug do campo */ 
	$("#nomeDoCampo").keyup(function(){
		$("#slugDoCampo").val(string_to_slug($("#nomeDoCampo").val()));
	})
	
	/* Adicionar Novo Campo */ 
	$("#adicionarNovoCampo").click(function(){
		//novoCampo = $("#itemCampoPersonalizado").clone();
		//novoCampo.insertAfter("li.itemCampoPersonalizado:last");

		var numeroItens = $('.itemCampoPersonalizado').length;
		var novoId  = new Number(numeroItens + 1);      
		
		var novoItem = $('#itemCampoPersonalizado-'+ numeroItens).clone().attr('id', 'itemCampoPersonalizado-' + novoId);
		
		$(novoItem).find('.removerCampo').removeClass('hide');
		
		$('#itemCampoPersonalizado-' + numeroItens).after(novoItem);
		
	})
	
	/* Remover Campo */ 
	$("a.removerCampo").live('click', function(){
		$(this).parent().parent().parent().remove();
	});
	
	/* Ordenar Campos */ 
	$("#listaItensCamposPersonalizados").sortable({ axis: 'y', cursor: 'pointer', handle: 'label', forceHelperSize: true, helper: 'clone', containment: 'parent',tolerance: 'pointer', opacity: 0.6  });
	
});

/*
 * Ajax remover registros
 */

function removerTipoDeDados(id,nome){
	
	obj = "#linha-"+id;
	obj2 = "#menu-"+id;
	
	if ( confirm('Você está prestes a excluir \''+nome+'\'\n\'Cancelar\' para interromper, \'OK\' para excluir.') ) {

		$.post("ajax/excluirTipoDeDados.php", { idTipoDeConteudo: id },
		   function(data){
		     //alert("Operação concluída: " + data);
		     
			$(obj).fadeOut("slow");
			$(obj2).fadeOut("slow");
		     
		   });
		
		return true;
		
	} else {
	 return false;	
	}
}

//ajax('ajax_excluirTipoDeDados.php','id=<?php echo $linha['Tip_id'];?>');

/*
 * Slug e Acentos
 */
function RetiraAcentos(Campo,tipoRetorno) {
	var Acentos = "áàãâÀÁÂÃéèêÉÈÊíìîÌÍÎóòôõÓÒÕÔùúûÚÙÛçÇ";
	var Traducao ="aaaaAAAAeeeEEEiiiIIIooooOOOOuuuUUUcC";
	var Posic, Carac;
	var TempLog = "";
	for (var i=0; i < Campo.length; i++)
	{
	Carac = Campo.charAt (i);
	Posic  = Acentos.indexOf (Carac);
	if (Posic > -1)
	  TempLog += Traducao.charAt (Posic);
	else
		TempLog += Campo.charAt (i);
	}
	switch (tipoRetorno) {
	case 1:
		TempLog = TempLog.toUpperCase();
	break;
	case 2:
		TempLog = TempLog.toDownCase();
	break;
	default:
		TempLog = TempLog;
	}
		return (TempLog);
} 

function string_to_slug(str) {
	str = str.replace(/^\s+|\s+$/g, ''); // trim
	str = str.toLowerCase();

	// remove accents, swap ñ for n, etc
	var from = "àáäâãèéëêìíïîòóöôùúüûñç·/_,:;";
	var to = "aaaaaeeeeiiiioooouuuunc------";
	for ( var i = 0, l = from.length; i < l; i++) {
		str = str.replace(from[i], to[i]);
	}

	str = str.replace(/[^a-z0-9 -]/g, '') // remove caracteres invalidos
			.replace(/\s+/g, '-') // collapsa espaço e substitui por -
			.replace(/-+/g, '-'); // collapsa barras

	return str;
}

