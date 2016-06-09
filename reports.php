<?php
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();

	// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['id']) OR ($_SESSION['status'] == '0')) {
		// Destrói a sessão por segurança
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: account-login.php"); exit;
	}
	
	if(isset($_GET['account-login'])){
		// Destrói a sessão por segurança
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: account-login.php"); exit;
	}
	
	require_once "config.php";
	require_once "class/Events.class.php";
	require_once "class/Promotions.class.php";
	require_once "class/Clients.class.php";
	require_once "class/Cash.class.php";
	require_once "class/Users.class.php";
	
	function dinheiro($valor) {
		$valor = number_format($valor, 2, '.', '.');
		return "R$".$valor;
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <title>Painel de Administração - Seleção da Pizza</title>

  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300,700">
  <link rel="stylesheet" href="http://localhost/selecaodapizza/painel/css/font-awesome.min.css">
  <link rel="stylesheet" href="http://localhost/selecaodapizza/painel/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css">
  <link rel="stylesheet" href="http://localhost/selecaodapizza/painel/css/bootstrap.css">

  <!-- Plugin CSS -->
  <link rel="stylesheet" href="http://localhost/selecaodapizza/painel/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css">
  <link rel="stylesheet" href="http://localhost/selecaodapizza/painel/js/plugins/datepicker/datepicker.css">
  <link rel="stylesheet" href="http://localhost/selecaodapizza/painel/js/plugins/magnific/magnific-popup.css">

  <!-- App CSS -->
  <link rel="stylesheet" href="http://localhost/selecaodapizza/painel/css/target-admin.css">
  <link rel="stylesheet" href="http://localhost/selecaodapizza/painel/css/custom.css">
  
  <!-- Page CSS -->
  <link rel="stylesheet" href="http://localhost/selecaodapizza/painel/css/demos/ui-notifications.css">


  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>

<body>

	<?php
		include "header.php";
	?>


	<div class="container">

		<div class="content">

			<div class="content-container" style="z-index: 1049;">
			
				<div class="row">
					<div class="col-md-8">
						<h2 class="content-header-title">Relatórios</h2>
					</div>
					<div class="col-md-4">
						<a href="#" onclick="window.history.back();" class="btn btn-md btn-secondary pull-right">
							<i class="fa fa-arrow-left"></i> Voltar
						</a>
					</div>
				</div>
				
				<hr />
		
				<div class="row">
					<div class="col-lg-12 col-md-12">
								Resultado do relatório
								<span class="tools pull-right">
									<a style="color: #fff;" href="" data-placement="top" title="Imprimir relatório" value="$('#toPrint').printElement()" id="simplePrint" class="btn btn-success fa fa-print tooltips"></a>
								</span>
							<div id="toPrint">
									<table class="table table-bordered table-condensed">
										<thead>
											<tr>
												<th>Descrição</th>
												<th>Categoria</th>
												<th width="7%">Data</th>
												<th width="7%">Valor</th>
											</tr>
										</thead>
										
										<tbody>
											<?php
													extract($_GET);
													
													if(!empty($de) AND !empty($ate)){
														$de = explode("/", $de);
														
														$diaDe = $de[0];
														$mesDe = $de[1];
														$anoDe = $de[2];
														
														$dataDe = $anoDe."-".$mesDe."-".$diaDe;
														
														$ate = explode("/", $ate);
														
														$diaAte = $ate[0];
														$mesAte = $ate[1];
														$anoAte = $ate[2];
														
														$dataAte = $anoAte."-".$mesAte."-".$diaAte;
													}
													
													if(!empty($de) AND empty($ate)){
														$de = explode("/", $de);
														
														$diaDe = $de[0];
														$mesDe = $de[1];
														$anoDe = $de[2];
														
														$dataDe = $anoDe."-".$mesDe."-".$diaDe;
													}
													
													if(empty($de) AND !empty($ate)){
														$ate = explode("/", $ate);
														
														$diaAte = $ate[0];
														$mesAte = $ate[1];
														$anoAte = $ate[2];
														
														$dataAte = $anoAte."-".$mesAte."-".$diaAte;
													}
													
													if(empty($categoria) && empty($tipo) && empty($de) && empty($ate)){
														$sql = "SELECT * FROM movimentos, categorias WHERE categorias_id_categorias = id_categorias ORDER BY data_movimentos DESC";
														
														$sql2 = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = 'receita'";
														$query2 = $pdo->prepare($sql2);
														$query2->execute();
														$linha2 = $query2->fetch(PDO::FETCH_OBJ);
														$entradas = $linha2->total;
														
														$sql3 = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = 'despesa'";
														$query3 = $pdo->prepare($sql3);
														$query3->execute();
														$linha3 = $query3->fetch(PDO::FETCH_OBJ);
														$saidas = $linha3->total;
														
														$total = $entradas-$saidas;
													}
													
													if(empty($categoria) && empty($tipo) && !empty($de) && !empty($ate)){													
														$sql = "SELECT * FROM movimentos, categorias WHERE (data_movimentos BETWEEN '$dataDe' AND '$dataAte') AND categorias_id_categorias = id_categorias ORDER BY data_movimentos DESC";
														
														$sql2 = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = 'receita' AND (data_movimentos BETWEEN '$dataDe' AND '$dataAte')";
														$query2 = $pdo->prepare($sql2);
														$query2->execute();
														$linha2 = $query2->fetch(PDO::FETCH_OBJ);
														$entradas = $linha2->total;
														
														$sql3 = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = 'despesa' AND (data_movimentos BETWEEN '$dataDe' AND '$dataAte')";
														$query3 = $pdo->prepare($sql3);
														$query3->execute();
														$linha3 = $query3->fetch(PDO::FETCH_OBJ);
														$saidas = $linha3->total;
														
														$total = $entradas-$saidas;
													}
													
													if(empty($categoria) && !empty($tipo) && !empty($de) && !empty($ate)){
														$sql = "SELECT * FROM movimentos, categorias WHERE tipo_movimentos = '$tipo' AND (data_movimentos BETWEEN '$dataDe' AND '$dataAte') AND categorias_id_categorias = id_categorias ORDER BY data_movimentos DESC";
														
														$sql2 = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = '$tipo' AND (data_movimentos BETWEEN '$dataDe' AND '$dataAte')";
														$query2 = $pdo->prepare($sql2);
														$query2->execute();
														$linha2 = $query2->fetch(PDO::FETCH_OBJ);
														$entradas = $linha2->total;
														
														if($tipo == 'despesa'){
															$total = "-".$row['total'];
														} else {
															$total = $row['total'];
														}
													}
													
													if(!empty($categoria) && !empty($tipo) && !empty($de) && !empty($ate)){
														$sql = "SELECT * FROM movimentos, categorias WHERE categorias_id_categorias = '$categoria' AND tipo_movimentos = '$tipo' AND (data_movimentos BETWEEN '$dataDe' AND '$dataAte') AND categorias_id_categorias = id_categorias ORDER BY data_movimentos DESC";
														
														$sql2 = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = '$tipo' AND (data_movimentos BETWEEN '$dataDe' AND '$dataAte') AND categorias_id_categorias = '$categoria'";
														$query2 = $pdo->prepare($sql2);
														$query2->execute();
														$linha2 = $query2->fetch(PDO::FETCH_OBJ);
														$entradas = $linha2->total;
														
														if($tipo == 'despesa'){
															$total = "-".$row['total'];
														} else {
															$total = $row['total'];
														}
													}
													
													if(!empty($categoria) && !empty($tipo) && empty($de) && empty($ate)){
														$sql = "SELECT * FROM movimentos, categorias WHERE categorias_id_categorias = '$categoria' AND tipo_movimentos = '$tipo' AND categorias_id_categorias = id_categorias ORDER BY data_movimentos DESC";
														
														$sql2 = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = '$tipo' AND categorias_id_categorias = '$categoria'";
														$query2 = $pdo->prepare($sql2);
														$query2->execute();
														$linha2 = $query2->fetch(PDO::FETCH_OBJ);
														$entradas = $linha2->total;
														
														if($tipo == 'despesa'){
															$total = "-".$row['total'];
														} else {
															$total = $row['total'];
														}
													}
													
													if(!empty($categoria) && empty($tipo) && empty($de) && empty($ate)){
														$sql = "SELECT * FROM movimentos, categorias WHERE categorias_id_categorias = '$categoria' AND categorias_id_categorias = id_categorias ORDER BY data_movimentos DESC";
														
														$sql2 = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = 'receita' AND categorias_id_categorias = '$categoria'";
														$query2 = $pdo->prepare($sql2);
														$query2->execute();
														$linha2 = $query2->fetch(PDO::FETCH_OBJ);
														$entradas = $linha2->total;
														
														$sql3 = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = 'despesa' AND categorias_id_categorias = '$categoria'";
														$query3 = $pdo->prepare($sql3);
														$query3->execute();
														$linha3 = $query3->fetch(PDO::FETCH_OBJ);
														$saidas = $linha3->total;
														
														$total = $entradas-$saidas;
													}
													
													if(empty($categoria) && !empty($tipo) && empty($de) && empty($ate)){
														$sql = "SELECT * FROM movimentos, categorias WHERE tipo_movimentos = '$tipo' AND categorias_id_categorias = id_categorias ORDER BY data_movimentos DESC";
														
														$sql2 = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = '$tipo'";
														$query2 = $pdo->prepare($sql2);
														$query2->execute();
														$linha2 = $query2->fetch(PDO::FETCH_OBJ);
														$entradas = $linha2->total;
														
														if($tipo == 'despesa'){
															$total = "-".$linha2->total;
														} else {
															$total = $linha2->total;
														}
													}
													
													if(empty($categoria) && !empty($tipo) && !empty($de) && !empty($ate)){
														$sql = "SELECT * FROM movimentos, categorias WHERE tipo_movimentos = '$tipo' AND (data_movimentos BETWEEN '$dataDe' AND '$dataAte') AND categorias_id_categorias = id_categorias ORDER BY data_movimentos DESC";
														
														$sql2 = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = '$tipo' AND (data_movimentos BETWEEN '$dataDe' AND '$dataAte')";
														$query2 = $pdo->prepare($sql2);
														$query2->execute();
														$linha2 = $query2->fetch(PDO::FETCH_OBJ);
														$entradas = $linha2->total;
														
														if($tipo == 'despesa'){
															$total = "-".$row['total'];
														} else {
															$total = $row['total'];
														}
													}
													
													if(!empty($categoria) && empty($tipo) && !empty($de) && !empty($ate)){
														$sql = "SELECT * FROM movimentos, categorias WHERE categorias_id_categorias = '$categoria' AND (data_movimentos BETWEEN '$dataDe' AND '$dataAte') AND categorias_id_categorias = id_categorias ORDER BY data_movimentos DESC";
														
														$sql2 = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = 'receita' AND categorias_id_categorias = '$categoria' AND (data_movimentos BETWEEN '$dataDe' AND '$dataAte')";
														$query2 = $pdo->prepare($sql2);
														$query2->execute();
														$linha2 = $query2->fetch(PDO::FETCH_OBJ);
														$entradas = $linha2->total;
														
														$sql3 = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = 'despesa' AND categorias_id_categorias = '$categoria' AND (data_movimentos BETWEEN '$dataDe' AND '$dataAte')";
														$query3 = $pdo->prepare($sql3);
														$query3->execute();
														$linha3 = $query3->fetch(PDO::FETCH_OBJ);
														$saidas = $linha3->total;
														
														$total = $entradas-$saidas;
													}
													
													$query = $pdo->prepare($sql);
													$query->execute();
													if($query->rowCount() == 0){
														echo "<tr><td colspan='5'>Nenhum registro encontrado!</td></tr>";
													} else {
														while($linha = $query->fetch(PDO::FETCH_OBJ)){
											?>
											<tr>
												<td><?php echo $linha->descricao_movimentos; ?></td>
												<td><?php echo $linha->nome_categorias; ?></td>
												<td><?php echo $linha->dia_movimentos . "/" . $linha->mes_movimentos . "/" . $linha->ano_movimentos; ?></td>
												<td style="font-size: 15px;"><div style="cursor: default;" class="btn btn-<?php if($linha->tipo_movimentos == "receita"){ echo 'success'; } else { echo 'danger'; } ?> btn-xs"><?php if($linha->tipo_movimentos == "despesa"){ $valor = $linha->valor_movimentos - $linha->valor_movimentos * 2; echo dinheiro($valor); } else { echo dinheiro($linha->valor_movimentos); } ?></div></td>
											</tr>
											<?php } } ?>
											<tr>
												<td colspan="5" align="right"><div style="cursor: default; font-weight: bold;" class="btn btn-<?php if($total > 0){ echo 'success'; } else { echo 'danger'; } ?> btn-xs"><?php echo dinheiro($total); ?></div></td>
											</tr>
										</tbody>
									</table>
							</div>
					</div>
				</div>
			
			</div>
			
		</div>
		
	</div>
	
	<footer class="footer">

		<div class="container">

			<div class="row">

				<div class="col-sm-6">

					<p>Seleção da Pizza &copy; 2016</p>

				</div> <!-- /.col -->

				<div class="col-sm-6">

					<a href="#"><img src="img/gruub.png" width="20%" class="pull-right" /></a>

				</div> <!-- /.col -->

			</div> <!-- /.row -->

		</div> <!-- /.container -->
	  
	</footer>

	<script src="http://localhost/selecaodapizza/painel/js/libs/jquery-1.10.1.min.js"></script>
	<script src="http://localhost/selecaodapizza/painel/js/libs/jquery-ui-1.9.2.custom.min.js"></script>
	<script src="http://localhost/selecaodapizza/painel/js/libs/bootstrap.min.js"></script>

	<!--[if lt IE 9]>
	<script src="http://localhost/selecaodapizza/painel/js/libs/excanvas.compiled.js"></script>
	<![endif]-->
	  
	<!-- Plugin JS -->
	<script src="http://localhost/selecaodapizza/painel/js/plugins/datepicker/bootstrap-datepicker.js"></script>
	<script src="http://localhost/selecaodapizza/painel/js/plugins/magnific/jquery.magnific-popup.min.js"></script>
	<script src="http://localhost/selecaodapizza/painel/js/plugins/howl/howl.js"></script>

	<!-- App JS -->
	<script src="http://localhost/selecaodapizza/painel/js/target-admin.js"></script>
	  
	<!-- Plugin JS -->
	<script src="http://localhost/selecaodapizza/painel/js/demos/form-extended.js"></script>
	
	<!-- Mask Money -->
	<script src="js/jquery.maskMoney.js" type="text/javascript"></script>
	
	<script>
		$('#data').datepicker({
			format: 'dd/mm/yyyy'
		});
		
		$("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:".", thousands:""});
		
		$('input[name=tipo]:radio').click(function() {
			if($(this).val()=="despesa") {
				$('#comprovante').show();
				$('#comprovante2').show();
			} else {
				$('#comprovante').hide();
				$('#comprovante2').hide();
			}
		});

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
	</script>