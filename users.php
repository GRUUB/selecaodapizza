			
			<?php
				if(isset($_GET['pag']) && $_GET['pag'] == "users" && isset($_GET['do']) && $_GET['do'] == "insert"){
			?>
			
			<div class="content-header">
				<h2 class="content-header-title">Cadastrar novo usuário</h2>
			</div>

			<form action="" method="post">
			
				<div class="row">
					
					<div class="col-lg-4">					
						<strong>Nome</strong>
						<input type="text" name="nome" class="form-control" />
					</div>
					
					<div class="col-lg-4">
						<strong>E-mail</strong>
						<input type="text" name="email" class="form-control" />					
					</div>
					
					<div class="col-lg-4">
						<strong>Login</strong>
						<input type="text" name="login" class="form-control" />					
					</div>
					
				</div> <!-- /.row -->
				
				<br />
				
				<div class="row">
					
					<div class="col-lg-3">
						<strong>Senha</strong>
						<input type="password" name="senha" class="form-control" />					
					</div>
					
					<div class="col-lg-3">
						<strong>Confirme sua senha</strong>
						<input type="password" name="senha_2" class="form-control" />					
					</div>
					
					<div class="col-lg-3">					
						<strong>Status</strong>
						<select name="status" class="form-control">
							<option value="1">Ativo</option>
							<option value="0">Inativo</option>
						</select>
					</div>
					
					<div class="col-lg-3">
						<br />
						<div class="pull-right">
							<a href="#" onclick="window.history.back();" class="btn btn-md btn-secondary">
								<i class="fa fa-arrow-left"></i> Voltar
							</a>
							<button type="submit" name="insertUser" class="btn btn-md btn-success">
								<i class="fa fa-check"></i> Cadastrar usuário
							</button>
						</div>
					</div>
					
				</div> <!-- /.row -->
			
			</form>
			
			<?php } elseif(isset($_GET['pag']) && $_GET['pag'] == "users" && isset($_GET['do']) && $_GET['do'] == "edit" && $_GET['id'] != ""){ ?>
			
			<?php
				$id = addslashes($_GET['id']);
				$sql = "SELECT * FROM usuarios WHERE id = ?";
				$query = $pdo->prepare($sql);
				$query->execute(array($id));
				if($query->rowCount() == 1){
					$linha = $query->fetch(PDO::FETCH_OBJ);
			?>
			
			<div class="content-header">
				<h2 class="content-header-title">Editar usuário - <?php echo $linha->nome; ?></h2>
			</div>

			<form action="" method="post">
			
				<div class="row">
					
					<div class="col-lg-4">					
						<strong>Nome</strong>
						<input type="text" name="nome" class="form-control" value="<?php echo $linha->nome; ?>" />
					</div>
					
					<div class="col-lg-4">
						<strong>E-mail</strong>
						<input type="text" name="email" class="form-control" value="<?php echo $linha->email; ?>" />					
					</div>
					
					<div class="col-lg-4">
						<strong>Login</strong>
						<input type="text" name="login" class="form-control" value="<?php echo $linha->login; ?>" />					
					</div>
					
				</div> <!-- /.row -->
				
				<br />
				
				<div class="row">
					
					<div class="col-lg-3">
						<strong>Senha</strong>
						<input type="password" name="senha" class="form-control" />
						<span class="help-block">Deixe em branco para <strong>não alterar</strong></span>
					</div>
					
					<div class="col-lg-3">
						<strong>Confirme sua senha</strong>
						<input type="password" name="senha_2" class="form-control" />					
					</div>
					
					<div class="col-lg-3">					
						<strong>Status</strong>
						<select name="status" class="form-control">
							<option value="1" <?php if($linha->status == 1) { echo "selected"; } ?>>Ativo</option>
							<option value="0" <?php if($linha->status == 0) { echo "selected"; } ?>>Inativo</option>
						</select>
					</div>
					
					<div class="col-lg-3">
						<br />
						<div class="pull-right">
							<a href="#" onclick="window.history.back();" class="btn btn-md btn-secondary">
								<i class="fa fa-arrow-left"></i> Voltar
							</a>
							<button type="submit" name="editUser" class="btn btn-md btn-success">
								<i class="fa fa-check"></i> Editar usuário
							</button>
						</div>
					</div>
					
				</div> <!-- /.row -->
			
			</form>
			<?php } else { include "404.php"; } ?> <!-- Verifica se existe o #ID -->
			
			<?php } elseif(isset($_GET['pag']) && $_GET['pag'] == "users" && isset($_GET['do']) && $_GET['do'] == "view"){ ?>
			
			<div class="content-header">
				<h2 class="content-header-title">Ver todos os usuários</h2>
			</div>
			
			<div class="row">
				<div class="col-lg-3 col-md-3 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-list"></i></span>
						<select name="status" class="form-control input-sm" onChange='document.location.href="?pag=<?php echo $_GET['pag']; ?>&do=view&status="+this.value;'>
							<option value="null">FILTRAR POR STATUS</option>
							<option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == "1") { echo "selected"; } ?>>Ativo</option>
							<option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == "0") { echo "selected"; } ?>>Inativo</option>
						</select>
					</div>
				</div><!-- ./col -->
				
				<div class="col-lg-9 col-md-9 col-xs-12">
					<a href="?pag=<?php echo $_GET['pag']; ?>&do=insert" class="btn btn-sm btn-warning pull-right"><i class="fa fa-plus"></i> Adicionar novo usuário</a>
				</div>
			</div><!-- ./row -->
			
			<hr />
			
			<div class="row">
			
				<div class="col-lg-12">
					
					<div class="table-responsive">

						<table class="table table-bordered table-hover">
						
							<thead>
								<tr>
									<th width="5%">#</th>
									<th>Nome</th>
									<th>E-mail</th>
									<th>Usuário</th>
									<th>Status</th>
									<th width="20%"></th>
								</tr>
							</thead>
							
							<tbody>
								<?php
									if(!isset($_GET['status'])){
										$sql = "SELECT id, nome, email, login, status FROM usuarios";
									} 
									
									if(isset($_GET['status'])){
										$sql = "SELECT id, nome, email, login, status FROM usuarios WHERE status = '{$_GET['status']}'";
									}
									
									$query = $pdo->prepare($sql);
									$query->execute();
									if($query->rowCount() >= 1){
										while($linha = $query->fetch(PDO::FETCH_OBJ)){
								?>
								<tr>
									<td><?php echo $linha->id; ?></td>
									<td><?php echo $linha->nome; ?></td>
									<td><?php echo $linha->email; ?></td>
									<td><?php echo $linha->login; ?></td>
									<td>
										<?php if($linha->status == 0) { echo "<div class='label label-warning'>Inativo</div>"; } ?>
										<?php if($linha->status == 1) { echo "<div class='label label-success'>Ativo</div>"; } ?>
									</td>
									<td align="center">
										<a href="?pag=<?php echo $_GET['pag']; ?>&do=edit&id=<?php echo $linha->id; ?>" class="btn btn-sm btn-secondary">
											<i class="fa fa-edit"></i>
										</a>
										<a href="#remover<?php echo $linha->id; ?>" data-toggle="modal" class="btn btn-sm btn-primary">
											<i class="fa fa-trash-o"></i>
										</a>
									</td>
								</tr>
								
								<!-- Remover -->
								<div class="modal modal-styled fade" id="remover<?php echo $linha->id; ?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title">Remover usuário - <?php echo $linha->nome; ?></h4>
											</div>
											<form action="" method="post">
												<div class="modal-body">
														Você tem certeza que deseja remover este registro? <label class="label label-danger">ESTA AÇÃO NÃO PODE SER DESFEITA!</label>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
													<button type="submit" name="removeUser" class="btn btn-success pull-right"><i class="fa fa-check"></i> Confirmar</button>
													<input type="hidden" name="id" value="<?php echo $linha->id; ?>"/>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!-- Remover -->
								
								<?php }} else { echo "<tr><td colspan='99'>Nenhum registro encontrado!</td></tr>"; } ?>
								
							</tbody>
							
						</table>

					</div> <!-- /.table-responsive -->
				
				</div> <!-- /.col-lg-12 -->
			
			</div> <!-- /.row -->
			
			<?php } else { include "404.php"; } ?>