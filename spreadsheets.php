			<?php
				if(isset($_POST['insertSpreadsheet'])){
					extract($_POST);
					
					$ingrediente = implode(",",$ingrediente);
					$custo = implode(",",$custo);
					$peso_retorno = implode(",",$peso_retorno);
					$peso_saida = implode(",",$peso_saida);
					
					$teste = explode(",",$peso_saida);
					$teste2 = explode(",",$peso_retorno);
					
					$valor_total = array();

					for($i = 0; $i < count($teste) && $i < count($teste2); $i++) {

						 $valor_total[] = $teste[$i] - $teste2[$i];

					}

					$valor_total = implode(",",$valor_total);
					
					$teste3 = explode(",",$valor_total);
					$teste4 = explode(",",$custo);
					
					for($i = 0; $i < count($teste3) && $i < count($teste4); $i++) {

						 $valor_total2[] = $teste3[$i] * $teste4[$i];

					}
					
					$total = array_sum($valor_total2);
					
					$data = date("Y-m-d");
					
					$planilhas = array();
					$planilhas[] = array(
										'evento' => $evento, 
										'ingrediente' => $ingrediente, 
										'peso_saida' => $peso_saida, 
										'peso_retorno' => $peso_retorno, 
										'total' => $total, 
										'data' => $data
										);
					
					// Monta o sql
					$sql = "INSERT INTO planilhas (evento, ingredientes, peso_saida, peso_retorno, total, data) VALUES";
					
					// Para cada elemento de $planilhas, faça:
					foreach ($planilhas as $planilha) {
						// Monta a parte consulta de cada usuário
						$sql .= " ('{$evento}', '{$ingrediente}', '{$peso_saida}', '{$peso_retorno}', '{$total}', '{$data}'),";
					}
					
					// Tira o último caractere (vírgula extra)
					$sql = substr($sql, 0, -1);
					
					$query = $pdo->prepare($sql);
					if($query->execute()){
						echo "<scipt>alert('Planilha cadastrada com sucesso!')</script>";
					} else {
						echo "<scipt>alert('Erro ao cadastradar planilha!')</script>";
					}
				}
			?>
			
			
			<?php
				if(isset($_GET['pag']) && $_GET['pag'] == "spreadsheets" && isset($_GET['do']) && $_GET['do'] == "insert"){
			?>
			
			<div class="content-header">
				<h2 class="content-header-title">Cadastrar nova planilha</h2>
			</div>

			<form action="" method="post">
			
				<div class="row">
					
					<div class="col-lg-4">					
						<strong>Evento</strong>
						<select type="text" name="evento" class="form-control">
							<?php
								$sql = "SELECT * FROM eventos WHERE status = 2";
								$query = $pdo->prepare($sql);
								$query->execute();
								while($linha = $query->fetch(PDO::FETCH_OBJ)){
									echo "<option value='{$linha->id}'>{$linha->nome}</option>";
								}
							?>
						</select>
					</div>
					
				</div> <!-- /.row -->
				
				<div class="row">
					<br />
					<div class="col-lg-3">
						<h4>Ingredientes</h4>
					</div>
					<div class="col-lg-3">
						<h4>Custo</h4>
					</div>
					<div class="col-lg-3">
						<h4>Peso Saída</h4>
					</div>
					<div class="col-lg-3">
						<h4>Peso Retorno</h4>
					</div>
					<br />
				</div>
					
				<div class="row">
					<?php
						$sql = "SELECT * FROM ingredientes";
						$query = $pdo->prepare($sql);
						$query->execute();
						while($linha = $query->fetch(PDO::FETCH_OBJ)){
					?>
					<div class="row">
						<div class="col-lg-12">	
							<div class="col-lg-3" style="margin-bottom: 10px;">
								<input type="text" name="ingrediente[]" class="form-control" value="<?php echo $linha->nome; ?>">
							</div>
							<div class="col-lg-3">
								<input type="text" name="custo[]" class="form-control" value="<?php echo $linha->valor; ?>">
							</div>
							<div class="col-lg-3">
								<input type="text" name="peso_saida[]" class="form-control quantidade">
							</div>
							<div class="col-lg-3">
								<input type="text" name="peso_retorno[]" class="form-control quantidade">
							</div>
						</div>
					</div>					
					<?php } ?>
					
				</div> <!-- /.row -->
			
				<div class="row">
					
					<div class="col-lg-12">
						<br />
						<div class="pull-right">
							<a href="#" onclick="window.history.back();" class="btn btn-md btn-secondary">
								<i class="fa fa-arrow-left"></i> Voltar
							</a>
							<button type="submit" name="insertSpreadsheet" class="btn btn-md btn-success">
								<i class="fa fa-check"></i> Cadastrar planilha
							</button>
						</div>
					</div>
					
				</div> <!-- /.row -->
			
			</form>
			
			<?php } elseif(isset($_GET['pag']) && $_GET['pag'] == "spreadsheets" && isset($_GET['do']) && $_GET['do'] == "edit" && $_GET['id'] != ""){ ?>
			
			<?php
				$id = addslashes($_GET['id']);
				$sql = "SELECT * FROM ingredientes WHERE id = ?";
				$query = $pdo->prepare($sql);
				$query->execute(array($id));
				if($query->rowCount() == 1){
					$linha = $query->fetch(PDO::FETCH_OBJ);
			?>
			
			<div class="content-header">
				<h2 class="content-header-title">Editar planilha - <?php echo $linha->nome; ?></h2>
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
							<button type="submit" name="editSpreadsheet" class="btn btn-md btn-success">
								<i class="fa fa-check"></i> Editar planilha
							</button>
						</div>
					</div>
					
				</div> <!-- /.row -->
			
			</form>
			<?php } else { include "404.php"; } ?> <!-- Verifica se existe o #ID -->
			
			<?php } elseif(isset($_GET['pag']) && $_GET['pag'] == "spreadsheets" && isset($_GET['do']) && $_GET['do'] == "view"){ ?>
			
			<div class="content-header">
				<h2 class="content-header-title">Ver todas as planilhas</h2>
			</div>
			
			<div class="row">	
				<div class="col-lg-12 col-md-12 col-xs-12">
					<a href="?pag=<?php echo $_GET['pag']; ?>&do=insert" class="btn btn-sm btn-warning pull-right"><i class="fa fa-plus"></i> Adicionar nova planilha</a>
				</div>
			</div><!-- ./row -->
			
			<hr />
			
			<div class="row">
			
				<div class="col-lg-12">
					
					<div class="table-responsive">

						<table class="table table-bordered table-hover">
						
							<thead>
								<tr>
									<th>Nome</th>
									<th>Custo</th>
									<th>Data</th>
									<th width="20%"></th>
								</tr>
							</thead>
							
							<tbody>
								<?php
									$sql = "SELECT * FROM planilhas, eventos WHERE evento = id";
									$query = $pdo->prepare($sql);
									$query->execute();
									if($query->rowCount() >= 1){
										while($linha = $query->fetch(PDO::FETCH_OBJ)){
								?>
								<tr>
									<td><?php echo $linha->nome; ?></td>
									<td><?php echo dinheiro($linha->total); ?></td>
									<td><?php echo date("d/m/Y", strtotime($linha->data)); ?></td>
									<td align="center">
										<?php
											if($linha->status_p == 0){
										?>
										<a href="#confirmar<?php echo $linha->id_p; ?>" data-toggle="modal" class="btn btn-sm btn-success">
											<i class="fa fa-check"></i>
										</a>
										<a href="#remover<?php echo $linha->id_p; ?>" data-toggle="modal" class="btn btn-sm btn-primary">
											<i class="fa fa-trash-o"></i>
										</a>
										<?php } ?>
									</td>
								</tr>
								
								<!-- Confirmar -->
								<div class="modal modal-styled fade" id="confirmar<?php echo $linha->id_p; ?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title">Confirmar planilha - <?php echo $linha->nome; ?></h4>
											</div>
											<form action="" method="post">
												<div class="modal-body">
														Você tem certeza que deseja confirmar este registro? <label class="label label-danger">ESTA AÇÃO NÃO PODE SER DESFEITA!</label>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
													<button type="submit" name="confirmSpreadsheet" class="btn btn-success pull-right"><i class="fa fa-check"></i> Confirmar</button>
													<input type="hidden" name="id" value="<?php echo $linha->id_p; ?>"/>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!-- Confirmar -->
								
								<!-- Remover -->
								<div class="modal modal-styled fade" id="remover<?php echo $linha->id_p; ?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title">Remover planilha - <?php echo $linha->nome; ?></h4>
											</div>
											<form action="" method="post">
												<div class="modal-body">
														Você tem certeza que deseja remover este registro? <label class="label label-danger">ESTA AÇÃO NÃO PODE SER DESFEITA!</label>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
													<button type="submit" name="removeSpreadsheet" class="btn btn-success pull-right"><i class="fa fa-check"></i> Confirmar</button>
													<input type="hidden" name="id" value="<?php echo $linha->id_p; ?>"/>
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