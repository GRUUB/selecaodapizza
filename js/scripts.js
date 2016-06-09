$(document).ready(function(){
	$("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:".", thousands:""});
});

$(document).ready(function() {
	$("#simplePrint").click(function(){
		$('#toPrint').printElement();
	});
});

$(function() {

	$('input[name=tipo]:radio').click(function() {

		if($(this).val()=="despesa") {
			$('#comprovante').show();
			$('#comprovante2').show();
		} else {
			$('#comprovante').hide();
			$('#comprovante2').hide();
		}

	});

});

$(function() {
	$("input.data").datepicker({
		dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		dateFormat: 'dd/mm/yy',
		nextText: 'Próximo',
		prevText: 'Anterior'
	});
});

$(function() {
	$( "#de" ).datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		changeYear: true,
		numberOfMonths: 3,
		dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		dateFormat: 'dd/mm/yy',
		nextText: 'Próximo',
		prevText: 'Anterior',
		onClose: function( selectedDate ) {
			$( "#ate" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$( "#ate" ).datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		changeYear: true,
		numberOfMonths: 3,
		dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		dateFormat: 'dd/mm/yy',
		nextText: 'Próximo',
		prevText: 'Anterior',
		onClose: function( selectedDate ) {
			$( "#de" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
});