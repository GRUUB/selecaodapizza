<?php
	require_once "config.php";
	
	if(isset($_POST['confirmar'])){
		if(isset($_POST['check'])){
			
			$codAuth = explode(",", $_GET['codAuth']);
			$id = $codAuth[0];
			$email = base64_decode($codAuth[1]);
			
			// Validação do evento/cliente recebidos via $_GET
			$sql = "SELECT * FROM eventos WHERE id = ? AND email = ? AND status = ? LIMIT 1";
			$query = $pdo->prepare($sql);
			if($query->execute(array($id, $email, 0))){
				// Salva os dados encontados na variável $resultado
				$resultado = $query->fetch(PDO::FETCH_OBJ);
				$sql2 = "UPDATE eventos SET status = ? WHERE id = ?";
				$query2 = $pdo->prepare($sql2);
				$query2->bindValue(1, 1);
				$query2->bindValue(2, $resultado->id);
				if($query2->execute()){
					
				} else {
					$no = "Erro ao confirmar evento. Por favor, tente novamente! Se o erro persistir, por favor, entre em contato conosco através do telefone: <strong>(41) 3354-9889</strong>";
				}
			} else {
				// Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
				$no = "O evento não existe ou já foi confirmado! Se você acha que tem algum erro por aqui, por favor, entre em contato conosco através do telefone: <strong>(41) 3354-9889</strong>";
			}
		} else {
			$no = "Você deve aceitar nosso funcionamento do serviço para confirmar seu evento. Se você acha que tem algum erro por aqui, por favor, entre em contato conosco através do telefone: <strong>(41) 3354-9889</strong>";
		}
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <title>Confirmar evento - Seleção da Pizza</title>

  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,300,700">
  <link rel="stylesheet" href="https://gruub.com.br/selecaodapizza/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://gruub.com.br/selecaodapizza/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css">
  <link rel="stylesheet" href="https://gruub.com.br/selecaodapizza/css/bootstrap.min.css">

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

<body class="account-bg">

<div class="account-wrapper">

  <div class="account-logo">
    <img src="./img/logo-login.png" alt="GRUUB">
  </div>

    <div class="account-body">
		<?php
			if(isset($_GET['codAuth']) && $_GET['codAuth'] != ""){
				$codAuth = explode(",", $_GET['codAuth']);
				$id = $codAuth[0];
				$email = base64_decode($codAuth[1]);
					
				// Validação do evento e email recebidos via $_GET
				$sql = "SELECT * FROM eventos WHERE id = ? AND email = ? LIMIT 1";
				$query = $pdo->prepare($sql);
				$query->execute(array($id, $email));
				
				if($query->rowCount($query) == 1){		
					// Salva os dados encontados na variável $resultado
					$resultado = $query->fetch(PDO::FETCH_OBJ);
		?>
		
		<?php
			if(isset($ok)){
		?>
		<div class="alert alert-success" style="margin-top: 10px;"><span class="fa fa-check"></span> <?php echo $ok; ?></div>
		<?php } ?>

		<?php
			if(isset($no)){
		?>
		<div class="alert alert-danger" style="margin-top: 10px;"><span class="fa fa-times"></span> <?php echo $no; ?></div>
		<?php } ?>
		
		<?php
			if($resultado->status == 0){
		?>		
		<h3 class="account-body-title">Olá, <?php echo $resultado->nome; ?>!</h3>
		
		<h5 class="account-body-subtitle">Só falta mais este passo para confirmar o seu evento conosco.</h5>

		  <form class="form account-form" method="POST" action="">

			<div class="form-group">
				<label>Funcionamento do serviço:</label>
				
				<textarea class="form-control" style="height: 300px" disabled>
				1. Levamos forno, gás e todos os equipamentos necessários para produzir e servir as pizzas, exceto pratos, talheres, copos, bebidas e utensílios de mesa, que ficam a cargo do cliente providenciar.
				2. Servimos em média 50 combinações, entre pizzas salgadas, calzones e pizzas doces, que produzimos e assamos na hora. Temos também uma pizza doce especial, já inclusa no rodízio, que chamamos de “pizza bolo”, que se o cliente desejar pode acrescentar uma velinha para cantar os parabéns.
				3. A equipe chegará 30 minutos antes da hora de início para organizar a pizzaria. Serviremos à vontade, pelo período de até 3 horas, se necessário. Ou a combinar.
				Observação importante: Em caso de eventos em condomínios, se houver restrição ao uso do botijão de gás por parte do condomínio, por favor notificar nossa equipe com antecedência.
				</textarea>
			</div> <!-- /.form-group -->

			<div class="form-group">			
				<label><input type="checkbox" name="check"> Estou de acordo com as informações acima descritas.</label>
			</div> <!-- /.form-group -->
			
			<div class="form-group">
			  <button type="submit" name="confirmar" class="btn btn-success btn-block btn-lg" tabindex="4">
				Confirmar evento &nbsp; <i class="fa fa-check"></i>
			  </button>
			</div> <!-- /.form-group -->
			
		  </form>
		  
		<?php } else { ?>
		<div class="alert alert-success"><span class="fa fa-check"></span> Evento confirmado com sucesso. Esperamos anciosamente para que este dia chegue, para que possamos torná-lo inesquecível!</div>
		<?php } ?>
		
		<?php } else {
					echo '<div class="alert alert-danger"><span class="fa fa-times"></span> Código de autenticação inválido.</div>';
				}
		?>
		
		<?php } else { ?>
		<div class="alert alert-danger"><span class="fa fa-times"></span> Código de autenticação vazio ou inválido.</div>
		<?php } ?>
    </div> <!-- /.account-body -->
    <div class="account-footer">
      <p>
      Não consegue confirmar seu evento? <br />
      <a href="mailto:contato@selecaodapizza.com.br" class="">Entre em contato conosco</a>
      </p>
    </div> <!-- /.account-footer -->
	
  </div> <!-- /.account-wrapper -->

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

</body>
</html>
