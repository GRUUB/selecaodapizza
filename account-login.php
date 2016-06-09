<?php
	require_once "config.php";
	
	if(isset($_POST['logar'])){
		extract($_POST);

		$hash = hash('whirlpool', $_POST['senha']);

		// Validação do usuário/senha digitados
		$sql = "SELECT * FROM usuarios WHERE login = ? AND senha = ? AND status = ? LIMIT 1";
		$query = $pdo->prepare($sql);
		$query->bindValue(1, $_POST['login']);
		$query->bindValue(2, $hash);
		$query->bindValue(3, 1);
		if($query->execute()){
			// Salva os dados encontados na variável $resultado
			$resultado = $query->fetch(PDO::FETCH_OBJ);

			// Se a sessão não existir, inicia uma
			if (!isset($_SESSION)) session_start();

			// Salva os dados encontrados na sessão
			$_SESSION['id'] = $resultado->id;
			$_SESSION['nome'] = $resultado->nome;
			$_SESSION['login'] = $resultado->login;
			$_SESSION['status'] = $resultado->status;
			
			$ano = date("Y");
			$mes = date("m");
			
			header("Location: index.php?pag=index&mes=$mes&ano=$ano");
		} else {
			// Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
			$no = "O login e/ou senha digitados não são válidos. Por favor, tente novamente! <strong>Se o erro persistir, entre em contato com o suporte: <u>(41) 3089-2767</u></strong>.";
		}
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <title>Login - Seleção da Pizza</title>

  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300,700">
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
    <img src="./img/logo-login.png" alt="Target Admin">
  </div>

    <div class="account-body">

      <h3 class="account-body-title">Seja bem-vindo!</h3>

      <h5 class="account-body-subtitle">Faça login para obter acesso.</h5>

      <form class="form account-form" method="POST" action="">

        <div class="form-group">
          <label for="login-username" class="placeholder-hidden">Login</label>
          <input type="text" class="form-control" id="login-username" name="login" placeholder="Login" tabindex="1">

        </div> <!-- /.form-group -->

        <div class="form-group">
          <label for="login-password" class="placeholder-hidden">Senha</label>
          <input type="password" class="form-control" id="login-password" name="senha" placeholder="Senha" tabindex="2">
        </div> <!-- /.form-group -->

        <div class="form-group clearfix">
          <div class="pull-right">
            <a href="./account-forgot.php">Esqueceu a senha?</a>
          </div>
        </div> <!-- /.form-group -->

        <div class="form-group">
          <button type="submit" name="logar" class="btn btn-primary btn-block btn-lg" tabindex="4">
            Signin &nbsp; <i class="fa fa-play-circle"></i>
          </button>
        </div> <!-- /.form-group -->

      </form>


    </div> <!-- /.account-body -->

    <div class="account-footer">
      <p>
      Não consegue efetuar o login? &nbsp;
      <a href="mailto:agency@gruub.com.br" class="">Entre em contato conosco</a>
      </p>
    </div> <!-- /.account-footer -->

	<?php
		if(!empty($no)){
	?>
	<div class="alert alert-danger" style="margin-top: 10px;"><span class="fa fa-times"></span> <?php echo $no; ?></div>
	<?php } ?>
	
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
