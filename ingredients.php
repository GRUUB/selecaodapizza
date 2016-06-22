			
			<?php
				if(isset($_GET['pag']) && $_GET['pag'] == "ingredients" && isset($_GET['do']) && $_GET['do'] == "insert"){
			?>
			
			<div class="content-header">
				<h2 class="content-header-title">Cadastrar novo ingrediente</h2>
			</div>

			<form action="" method="post">
			
				<div class="row">
					
					<div class="col-lg-4">					
						<strong>Nome</strong>
						<input type="text" name="nome" class="form-control" />
					</div>
					
					<div class="col-lg-4">
						<strong>Valor</strong>
						<input type="text" name="valor" class="form-control dinheiro" placeholder="R$" />					
					</div>
					
					<div class="col-lg-4">
						<strong>Quantidade</strong>
						<input type="text" name="quantidade" class="form-control quantidade" />					
					</div>
					
				</div> <!-- /.row -->
			
				<div class="row">
					
					<div class="col-lg-12">
						<br />
						<div class="pull-right">
							<a href="#" onclick="window.history.back();" class="btn btn-md btn-secondary">
								<i class="fa fa-arrow-left"></i> Voltar
							</a>
							<button type="submit" name="insertIngredient" class="btn btn-md btn-success">
								<i class="fa fa-check"></i> Cadastrar ingrediente
							</button>
						</div>
					</div>
					
				</div> <!-- /.row -->
			
			</form>
			
			<?php } elseif(isset($_GET['pag']) && $_GET['pag'] == "ingredients" && isset($_GET['do']) && $_GET['do'] == "edit" && $_GET['id'] != ""){ ?>
			
			<?php
				$id = addslashes($_GET['id']);
				$sql = "SELECT * FROM ingredientes WHERE id = ?";
				$query = $pdo->prepare($sql);
				$query->execute(array($id));
				if($query->rowCount() == 1){
					$linha = $query->fetch(PDO::FETCH_OBJ);
			?>
			
			<div class="content-header">
				<h2 class="content-header-title">Editar ingrediente - <?php echo $linha->nome; ?></h2>
			</div>

			<form action="" method="post">
			
				<div class="row">
					
					<div class="col-lg-4">					
						<strong>Nome</strong>
						<input type="text" name="nome" class="form-control" value="<?php echo $linha->nome; ?>" />
					</div>
					
					<div class="col-lg-4">
						<strong>Valor</strong>
						<input type="text" name="valor" class="form-control dinheiro" placeholder="R$" value="<?php echo $linha->valor; ?>" />					
					</div>
					
					<div class="col-lg-4">
						<strong>Quantidade</strong>
						<input type="text" name="quantidade" class="form-control quantidade" value="<?php echo $linha->quantidade; ?>" />					
					</div>
					
				</div> <!-- /.row -->
			
				<div class="row">
					
					<div class="col-lg-12">
						<br />
						<div class="pull-right">
							<a href="#" onclick="window.history.back();" class="btn btn-md btn-secondary">
								<i class="fa fa-arrow-left"></i> Voltar
							</a>
							<button type="submit" name="editIngredient" class="btn btn-md btn-success">
								<i class="fa fa-check"></i> Editar ingrediente
							</button>
						</div>
					</div>
					
				</div> <!-- /.row -->
			
			</form>
			<?php } else { include "404.php"; } ?> <!-- Verifica se existe o #ID -->
			
			<?php } elseif(isset($_GET['pag']) && $_GET['pag'] == "ingredients" && isset($_GET['do']) && $_GET['do'] == "view"){ ?>
			
			<div class="content-header">
				<h2 class="content-header-title">Ver todos os ingredientes</h2>
			</div>
			
			<div class="row">	
				<div class="col-lg-12 col-md-12 col-xs-12">
					<a href="?pag=<?php echo $_GET['pag']; ?>&do=insert" class="btn btn-sm btn-warning pull-right"><i class="fa fa-plus"></i> Adicionar novo ingrediente</a>
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
									<th>Valor</th>
									<th>Quantidade</th>
									<th width="20%"></th>
								</tr>
							</thead>
							
							<tbody>
								<?php
									$sql = "SELECT * FROM ingredientes";
									$query = $pdo->prepare($sql);
									$query->execute();
									if($query->rowCount() >= 1){
										while($linha = $query->fetch(PDO::FETCH_OBJ)){
								?>
								<tr>
									<td><?php echo $linha->id; ?></td>
									<td><?php echo $linha->nome; ?></td>
									<td><?php echo dinheiro($linha->valor); ?></td>
									<td><?php echo $linha->quantidade; ?></td>
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
												<h4 class="modal-title">Remover ingrediente - <?php echo $linha->nome; ?></h4>
											</div>
											<form action="" method="post">
												<div class="modal-body">
														Você tem certeza que deseja remover este registro? <label class="label label-danger">ESTA AÇÃO NÃO PODE SER DESFEITA!</label>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
													<button type="submit" name="removeIngredient" class="btn btn-success pull-right"><i class="fa fa-check"></i> Confirmar</button>
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