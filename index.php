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
	require_once "class/Spreadsheets.class.php";
	require_once "class/Ingredients.class.php";
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

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,300,700">
  <link rel="stylesheet" href="https://gruub.com.br/selecaodapizza/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://gruub.com.br/selecaodapizza/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css">
  <link rel="stylesheet" href="https://gruub.com.br/selecaodapizza/css/bootstrap.css">

  <!-- Plugin CSS -->
  <link rel="stylesheet" href="https://gruub.com.br/selecaodapizza/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css">
  <link rel="stylesheet" href="https://gruub.com.br/selecaodapizza/js/plugins/datepicker/datepicker.css">
  <link rel="stylesheet" href="https://gruub.com.br/selecaodapizza/js/plugins/magnific/magnific-popup.css">

  <!-- App CSS -->
  <link rel="stylesheet" href="https://gruub.com.br/selecaodapizza/css/target-admin.css">
  <link rel="stylesheet" href="https://gruub.com.br/selecaodapizza/css/custom.css">
  
  <!-- Page CSS -->
  <link rel="stylesheet" href="https://gruub.com.br/selecaodapizza/css/demos/ui-notifications.css">


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
				
				<?php
					if(!isset($_GET['pag']) || $_GET['pag'] == "index"){
						include "main.php";
					} elseif(isset($_GET['pag']) && $_GET['pag'] == "events"){
						include "events.php";
					} elseif(isset($_GET['pag']) && $_GET['pag'] == "spreadsheets"){
						include "spreadsheets.php";
					} elseif(isset($_GET['pag']) && $_GET['pag'] == "ingredients"){
						include "ingredients.php";
					} elseif(isset($_GET['pag']) && $_GET['pag'] == "promotions"){
						include "promotions.php";
					} elseif(isset($_GET['pag']) && $_GET['pag'] == "clients"){
						include "clients.php";
					} elseif(isset($_GET['pag']) && $_GET['pag'] == "cash"){
						include "cash.php";
					} elseif(isset($_GET['pag']) && $_GET['pag'] == "reports"){
						include "reports.php";
					} elseif(isset($_GET['pag']) && $_GET['pag'] == "users"){
						include "users.php";
					} else { include "404.php"; }
				?>
			
			</div> <!-- /.content-container -->
		  
		</div> <!-- /.content -->

	</div> <!-- /.container -->


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

	<script src="https://gruub.com.br/selecaodapizza/js/libs/jquery-1.10.1.min.js"></script>
	<script src="https://gruub.com.br/selecaodapizza/js/libs/jquery-ui-1.9.2.custom.min.js"></script>
	<script src="https://gruub.com.br/selecaodapizza/js/libs/bootstrap.min.js"></script>

	<!--[if lt IE 9]>
	<script src="https://gruub.com.br/selecaodapizza/js/libs/excanvas.compiled.js"></script>
	<![endif]-->
	  
	<!-- Plugin JS -->
	<script src="https://gruub.com.br/selecaodapizza/js/plugins/datepicker/bootstrap-datepicker.js"></script>
	<script src="https://gruub.com.br/selecaodapizza/js/plugins/magnific/jquery.magnific-popup.min.js"></script>
	<script src="https://gruub.com.br/selecaodapizza/js/plugins/howl/howl.js"></script>

	<!-- App JS -->
	<script src="https://gruub.com.br/selecaodapizza/js/target-admin.js"></script>
	  
	<!-- Plugin JS -->
	<script src="https://gruub.com.br/selecaodapizza/js/demos/form-extended.js"></script>
	
	<!-- Mask Money -->
	<script src="js/jquery.maskMoney.js" type="text/javascript"></script>
	<script src="js/mask.js" type="text/javascript"></script>
	
	<script>
		$('#data').datepicker({
			format: 'dd/mm/yyyy'
		});
		
		$("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:".", thousands:""});
		
		$("input.quantidade").maskMoney({showSymbol:false, symbol:"(kg/und) ", decimal:".", thousands:"", precision: 3});
		
		$('input[name=tipo]:radio').click(function() {
			if($(this).val()=="despesa") {
				$('#comprovante').show();
				$('#comprovante2').show();
			} else {
				$('#comprovante').hide();
				$('#comprovante2').hide();
			}
		});
	</script>
	
	<?php
	
		/* START EVENTS */
		
		// Inserir evento
		if(isset($_POST['insertEvent'])){
			extract($_POST);
			
			$data = explode("/", $data);
			
			$dia = $data[0];
			$mes = $data[1];
			$ano = $data[2];
			
			$soma_adultos = $adultos * $valor_adulto;
			
			$soma_criancas = $criancas * $valor_crianca;
			
			$soma_total = $soma_adultos + $soma_criancas + $porta_pizza + $deslocamento;
			
			$data_cadastro = date("Y-m-d H:i:s");
			
			$evento = new Evento();
			$evento->Add($nome, $email, $dia, $mes, $ano, $hora_chegada, $hora_inicio, $hora_termino, $telefone, $celular, $adultos, $valor_adulto, $criancas, $valor_crianca, $endereco, $bairro, $cidade, $porta_pizza, $deslocamento, $pizzaiolo, $garcom, $observacoes, $observacoes_interno, $status, $soma_adultos, $soma_criancas, $soma_total, $data_cadastro);
		
			echo $evento->MsgOk;
			echo $evento->MsgNo;
		}
		
		// Editar evento
		if(isset($_POST['editEvent'])){
			extract($_POST);
			
			$data = explode("/", $data);
			
			$dia = $data[0];
			$mes = $data[1];
			$ano = $data[2];
			
			$soma_adultos = $adultos * $valor_adulto;
			
			$soma_criancas = $criancas * $valor_crianca;
			
			$soma_total = $soma_adultos + $soma_criancas + $porta_pizza + $deslocamento;
			
			$evento = new Evento();
			$evento->Edit($nome, $email, $dia, $mes, $ano, $hora_chegada, $hora_inicio, $hora_termino, $telefone, $celular, $adultos, $valor_adulto, $criancas, $valor_crianca, $endereco, $bairro, $cidade, $porta_pizza, $deslocamento, $pizzaiolo, $garcom, $observacoes, $observacoes_interno, $status, $soma_adultos, $soma_criancas, $soma_total, $id);
		
			echo $evento->MsgOk;
			echo $evento->MsgNo;
		}
		
		// Confirmar evento
		if(isset($_POST['confirmEvent'])){
			extract($_POST);
			
			$evento = new Evento();
			$evento->Confirm(1, $id);
		
			echo $evento->MsgOk;
			echo $evento->MsgNo;
		}
		
		// Confirmar evento (e-mail)
		if(isset($_POST['emailConfirmEvent'])){
			extract($_POST);
			
			$evento = new Evento();
			$evento->EmailConfirm(3, $id);
		
			echo $evento->MsgOk;
			echo $evento->MsgNo;
		}
		
		// Remover evento
		if(isset($_POST['removeEvent'])){
			extract($_POST);
			
			$evento = new Evento();
			$evento->Remove($id);
		
			echo $evento->MsgOk;
			echo $evento->MsgNo;
		}
		
		// Receber evento
		if(isset($_POST['receive'])){
			extract($_POST);
			
			$evento = new Evento();
			$evento->Receive($equipe, $ingredientes, $recebido, $total, $tipo, $nome, $observacoes, 4, $id);
		
			echo $evento->MsgOk;
			echo $evento->MsgNo;
		}
		
		/* END EVENTS */
		
		
		
		
		
		/* START SPREADSHEETS */
		
		// Confirmar planilha
		if(isset($_POST['confirmSpreadsheet'])){
			extract($_POST);
			
			$planilha = new Planilha();
			$planilha->Confirm($id);
		
			echo $planilha->MsgOk;
			echo $planilha->MsgNo;
		}
		
		// Remover planilha
		if(isset($_POST['removeSpreadsheet'])){
			extract($_POST);
			
			$planilha = new Planilha();
			$planilha->Remove($id);
		
			echo $planilha->MsgOk;
			echo $planilha->MsgNo;
		}
		
		
		
		/* END SPREADSHEETS */
		
		
		
		
		
		/* START CLIENTS */
	
		// Inserir cliente
		if(isset($_POST['insertClient'])){
			extract($_POST);
			
			$cliente = new Cliente();
			$cliente->Add($nome, $email, $telefone, $celular, $aniversario, $status);
				
			echo $cliente->MsgOk;
			echo $cliente->MsgNo;
		}
		
		// Editar cliente
		if(isset($_POST['editClient'])){
			extract($_POST);
			
			
			$cliente = new Cliente();
			$cliente->Edit($nome, $email, $telefone, $celular, $aniversario, $status, $id);
				
			echo $cliente->MsgOk;
			echo $cliente->MsgNo;
		}
		
		// Remover cliente
		if(isset($_POST['removeClient'])){
			extract($_POST);
			
			$cliente = new Cliente();
			$cliente->Remove($id);
		
			echo $cliente->MsgOk;
			echo $cliente->MsgNo;
		}
		
		/* END CLIENTS */
		
		
		
		
		
		/* START CASH */
	
		// Inserir movimento
		if(isset($_POST['insertMoviment'])){
			extract($_POST);
			extract($_FILES);
			
			$caixa = new Caixa();
			$caixa->Add($descricao, $data, $dia, $mes, $ano, $categoria, $valor, $tipo, $comprovante);
				
			echo $caixa->MsgOk;
			echo $caixa->MsgNo;
		}
		
		// Editar movimento
		if(isset($_POST['editMoviment'])){
			extract($_POST);
			
			$caixa = new Caixa();
			$caixa->Edit($descricao, $data, $dia, $mes, $ano, $categoria, $valor, $tipo, $comprovante, $id);
				
			echo $caixa->MsgOk;
			echo $caixa->MsgNo;
		}
		
		// Remover movimento
		if(isset($_POST['removeMoviment'])){
			extract($_POST);
			
			$caixa = new Caixa();
			$caixa->Remove($id);
		
			echo $caixa->MsgOk;
			echo $caixa->MsgNo;
		}
	
		// Inserir categoria
		if(isset($_POST['insertCat'])){
			extract($_POST);
			
			$caixa = new Caixa();
			$caixa->AddCat($nome);
				
			echo $caixa->MsgOk;
			echo $caixa->MsgNo;
		}
		
		// Editar categoria
		if(isset($_POST['editCat'])){
			extract($_POST);
			
			$caixa = new Caixa();
			$caixa->EditCat($nome, $id);
				
			echo $caixa->MsgOk;
			echo $caixa->MsgNo;
		}
		
		// Remover categoria
		if(isset($_POST['removeCat'])){
			extract($_POST);
			
			$caixa = new Caixa();
			$caixa->RemoveCat($id);
		
			echo $caixa->MsgOk;
			echo $caixa->MsgNo;
		}
		
		/* END CASH */
		
		
		
		
		
		/* START INGREDIENTS */
	
		// Inserir usuário
		if(isset($_POST['insertIngredient'])){
			extract($_POST);
			
			$ingrediente = new Ingrediente();
			$ingrediente->Add($nome, $valor, $quantidade);
				
			echo $ingrediente->MsgOk;
			echo $ingrediente->MsgNo;
		}
		
		// Editar usuário
		if(isset($_POST['editIngredient'])){
			extract($_POST);
			
			$ingrediente = new Ingrediente();
			$ingrediente->Edit($nome, $valor, $quantidade, $id);
			
			echo $ingrediente->MsgOk;
			echo $ingrediente->MsgNo;
		}
		
		// Remover usuário
		if(isset($_POST['removeIngredient'])){
			extract($_POST);
			
			$ingrediente = new Ingrediente();
			$ingrediente->Remove($id);
		
			echo $ingrediente->MsgOk;
			echo $ingrediente->MsgNo;
		}
		
		/* END INGREDIENTS */
		
		
		
		
		
		/* START USERS */
	
		// Inserir usuário
		if(isset($_POST['insertUser'])){
			extract($_POST);
			
			// Codifica a senha em um hash de 256 bits
			$senha = hash("whirlpool", $senha);
			$senha_2 = hash("whirlpool", $senha_2);
			
			// Verifica se as senhas digitadas são iguais
			if($senha != $senha_2){
				echo "<script type='text/javascript'>
							$(window).load(function() {
								
								$.howl ({
								  type: 'danger'
								  , title: 'Ooooops!'
								  , content: 'Parece que as senhas digitadas não conferem. Por favor, tente novamente! <strong>Se o erro persistir, entre em contato com o suporte: <u>(41) 3089-2767</u></strong>.'
								  , sticky: $(this).data ('sticky')
								  , lifetime: 7500
								  , iconCls: 'fa fa-ban'
								});
								
							});
						</script>";
			} else {
				$usuario = new Usuario();
				$usuario->Add($nome, $email, $login, $senha, $status);
				
				echo $usuario->MsgOk;
				echo $usuario->MsgNo;
			}
		}
		
		// Editar usuário
		if(isset($_POST['editUser'])){
			extract($_POST);
			
			
			// Verifica se as senhas digitadas são iguais
			if($senha != $senha_2){
				echo "<script type='text/javascript'>
							$(window).load(function() {
								
								$.howl ({
								  type: 'danger'
								  , title: 'Ooooops!'
								  , content: 'Parece que as senhas digitadas não conferem. Por favor, tente novamente! <strong>Se o erro persistir, entre em contato com o suporte: <u>(41) 3089-2767</u></strong>.'
								  , sticky: $(this).data ('sticky')
								  , lifetime: 7500
								  , iconCls: 'fa fa-ban'
								});
								
							});
						</script>";
			} else {
				$usuario = new Usuario();
				if($senha != "" && $senha_2 != ""){
					
					// Codifica a senha em um hash de 256 bits
					$senha = hash("whirlpool", $senha);
					
					$usuario->Edit($nome, $email, $login, $senha, $status, $id);
				} else {
					$usuario->Edit($nome, $email, $login, $senha, $status, $id);
				}
				
				echo $usuario->MsgOk;
				echo $usuario->MsgNo;
			}
		}
		
		// Remover usuário
		if(isset($_POST['removeUser'])){
			extract($_POST);
			
			$usuario = new Usuario();
			$usuario->Remove($id);
		
			echo $usuario->MsgOk;
			echo $usuario->MsgNo;
		}
		
		/* END USERS */
?>

</body>
</html>
