	<div class="navbar">

		<div class="container">

			<div class="navbar-header">

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<i class="fa fa-cogs"></i>
				</button>

				<!--
				<a class="navbar-brand navbar-brand-image" href="./index.php?pag=events&do=view&status=null&ano=<?php echo date("Y"); ?>">
					<img src="./img/logo.png" alt="Site Logo">
				</a>
				-->

			</div> <!-- /.navbar-header -->

			<div class="navbar-collapse collapse">

				<ul class="nav navbar-nav navbar-right">
				
					<li>
						<a href="http://selecaodapizza.com.br" target="_blank">
							<i class="fa fa-external-link"></i> 
							&nbsp;&nbsp;Site
						</a>
					</li>
					
					<li class="dropdown navbar-profile">
						<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
							Olá, <?php echo $_SESSION['nome']; ?>!&nbsp;&nbsp;
							<i class="fa fa-caret-down"></i>
						</a>
						
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="index.php?pag=users&do=edit&id=<?php echo $_SESSION['id']; ?>">
									<i class="fa fa-user"></i> 
									&nbsp;&nbsp;Meu Perfil
								</a>
							</li>
							
							<li class="divider"></li>
							
							<li>
								<a href="index.php?account-login">
									<i class="fa fa-sign-out"></i> 
									&nbsp;&nbsp;Logout
								</a>
							</li>
						</ul>
					</li>

				</ul>

			</div> <!--/.navbar-collapse -->

		</div> <!-- /.container -->

	</div> <!-- /.navbar -->

	<div class="mainbar">

		<div class="container">

			<button type="button" class="btn mainbar-toggle" data-toggle="collapse" data-target=".mainbar-collapse">
			  <i class="fa fa-bars"></i>
			</button>

			<div class="mainbar-collapse collapse">

				<ul class="nav navbar-nav mainbar-nav">

					<li <?php if($_GET['pag'] && $_GET['pag'] == "index" || !$_GET['pag']) { echo 'class="active"'; } ?>>
						<a href="index.php?pag=index&mes=<?php echo date("m"); ?>&ano=<?php echo date("Y"); ?>">
							<i class="fa fa-dashboard"></i>
							Dashboard
						</a>
					</li>

					<li <?php if($_GET['pag'] && $_GET['pag'] == "events") { echo 'class="active"'; } ?>>
						<a href="index.php?pag=events&do=view&status=null&ano=<?php echo date("Y"); ?>">
							<i class="fa fa-calendar"></i>
							Eventos
						</a>
					</li>

					<li <?php if($_GET['pag'] && $_GET['pag'] == "ingredients") { echo 'class="active"'; } ?>>
						<a href="index.php?pag=ingredients&do=view">
							<i class="fa fa-coffee"></i>
							Ingredientes
						</a>
					</li>

					<li <?php if($_GET['pag'] && $_GET['pag'] == "clients") { echo 'class="active"'; } ?>>
						<a href="index.php?pag=clients&do=view">
							<i class="fa fa-thumbs-up"></i>
							Clientes
						</a>
					</li>

					<li <?php if($_GET['pag'] && $_GET['pag'] == "cash") { echo 'class="active"'; } ?>>
						<a href="index.php?pag=cash&do=view&mes=<?php echo date("m"); ?>&ano=<?php echo date("Y"); ?>">
							<i class="fa fa-money"></i>
							Financeiro
						</a>
					</li>
					
					<li <?php if($_GET['pag'] && $_GET['pag'] == "users") { echo 'class="active"'; } ?>>
						<a href="index.php?pag=users&do=view">
							<i class="fa fa-users"></i>
							Usuários
						</a>
					</li>
				
				</ul>

			</div> <!-- /.navbar-collapse -->   

		</div> <!-- /.container --> 

	</div> <!-- /.mainbar -->