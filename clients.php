			
			<?php
				if(isset($_GET['pag']) && $_GET['pag'] == "clients" && isset($_GET['do']) && $_GET['do'] == "insert"){
			?>
			
			<div class="content-header">
				<h2 class="content-header-title">Cadastrar novo cliente</h2>
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
						<strong>Data de nascimento</strong>
						<input type="date" name="aniversario" class="form-control" />					
					</div>
					
				</div> <!-- /.row -->
				
				<br />
			
				<div class="row">
					
					<div class="col-lg-3">					
						<strong>Telefone</strong>
						<input type="text" name="telefone" class="form-control" />
					</div>
					
					<div class="col-lg-3">
						<strong>Celular</strong>
						<input type="text" name="celular" class="form-control" />					
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
							<button type="submit" name="insertClient" class="btn btn-md btn-success">
								<i class="fa fa-check"></i> Cadastrar cliente
							</button>
						</div>
					</div>
					
				</div> <!-- /.row -->
			
			</form>
			
			<?php } elseif(isset($_GET['pag']) && $_GET['pag'] == "clients" && isset($_GET['do']) && $_GET['do'] == "edit" && $_GET['id'] != ""){ ?>
			
			<?php
				$id = addslashes($_GET['id']);
				$sql = "SELECT * FROM clientes WHERE id = ?";
				$query = $pdo->prepare($sql);
				$query->execute(array($id));
				if($query->rowCount() == 1){
					$linha = $query->fetch(PDO::FETCH_OBJ);
			?>
			
			<div class="content-header">
				<h2 class="content-header-title">Editar cliente - <?php echo $linha->nome; ?></h2>
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
						<strong>Data de nascimento</strong>
						<input type="date" name="aniversario" class="form-control" value="<?php echo $linha->aniversario; ?>" />					
					</div>
					
				</div> <!-- /.row -->
				
				<br />
				
				<div class="row">
					
					<div class="col-lg-3">
						<strong>Telefone</strong>
						<input type="text" name="telefone" class="form-control" value="<?php echo $linha->telefone; ?>" />
					</div>
					
					<div class="col-lg-3">
						<strong>Celular</strong>
						<input type="text" name="celular" class="form-control" value="<?php echo $linha->celular; ?>" />					
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
							<button type="submit" name="editClient" class="btn btn-md btn-success">
								<i class="fa fa-check"></i> Editar cliente
							</button>
						</div>
					</div>
					
				</div> <!-- /.row -->
			
			</form>
			<?php } else { include "404.php"; } ?> <!-- Verifica se existe o #ID -->
			
			<?php } elseif(isset($_GET['pag']) && $_GET['pag'] == "clients" && isset($_GET['do']) && $_GET['do'] == "view"){ ?>
			
			<div class="content-header">
				<h2 class="content-header-title">Ver todos os clientes</h2>
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
					<a href="?pag=<?php echo $_GET['pag']; ?>&do=insert" class="btn btn-sm btn-warning pull-right"><i class="fa fa-plus"></i> Adicionar novo cliente</a>
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
									<th>Status</th>
									<th width="20%"></th>
								</tr>
							</thead>
							
							<tbody>
								<?php
									if(!isset($_GET['status'])){
										$sql = "SELECT id, nome, email, status FROM clientes";
									} 
									
									if(isset($_GET['status'])){
										$sql = "SELECT id, nome, email, status FROM clientes WHERE status = '{$_GET['status']}'";
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
												<h4 class="modal-title">Remover cliente - <?php echo $linha->nome; ?></h4>
											</div>
											<form action="" method="post">
												<div class="modal-body">
														Você tem certeza que deseja remover este registro? <label class="label label-danger">ESTA AÇÃO NÃO PODE SER DESFEITA!</label>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
													<button type="submit" name="removeClient" class="btn btn-success pull-right"><i class="fa fa-check"></i> Confirmar</button>
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