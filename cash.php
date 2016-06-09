			<?php 
				if(isset($_GET['pag']) && $_GET['pag'] == "cash" && isset($_GET['do']) && $_GET['do'] == "view"){
			?>
			
			<div class="content-header">
				<h2 class="content-header-title">Fluxo de caixa</h2>
			</div>
			
			<div class="row">				
				<div class="col-lg-3 col-md-3 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<select name="mes" class="form-control input-sm" onChange='document.location.href="?pag=<?php echo $_GET['pag']; ?>&do=view&<?php if(isset($_GET['ano'])){ echo "ano=".$_GET['ano']."&mes="; } else { echo "mes="; } ?>"+this.value;'>
							<option value="null">SELECIONAR O MÊS</option>
							<option value="01" <?php if(isset($_GET['mes']) && $_GET['mes'] == 1) { echo "selected"; } ?>>Janeiro</option>
							<option value="02" <?php if(isset($_GET['mes']) && $_GET['mes'] == 2) { echo "selected"; } ?>>Fevereiro</option>
							<option value="03" <?php if(isset($_GET['mes']) && $_GET['mes'] == 3) { echo "selected"; } ?>>Março</option>
							<option value="04" <?php if(isset($_GET['mes']) && $_GET['mes'] == 4) { echo "selected"; } ?>>Abril</option>
							<option value="05" <?php if(isset($_GET['mes']) && $_GET['mes'] == 5) { echo "selected"; } ?>>Maio</option>
							<option value="06" <?php if(isset($_GET['mes']) && $_GET['mes'] == 6) { echo "selected"; } ?>>Junho</option>
							<option value="07" <?php if(isset($_GET['mes']) && $_GET['mes'] == 7) { echo "selected"; } ?>>Julho</option>
							<option value="08" <?php if(isset($_GET['mes']) && $_GET['mes'] == 8) { echo "selected"; } ?>>Agosto</option>
							<option value="09" <?php if(isset($_GET['mes']) && $_GET['mes'] == 9) { echo "selected"; } ?>>Setembro</option>
							<option value="10" <?php if(isset($_GET['mes']) && $_GET['mes'] == 10) { echo "selected"; } ?>>Outubro</option>
							<option value="11" <?php if(isset($_GET['mes']) && $_GET['mes'] == 11) { echo "selected"; } ?>>Novembro</option>
							<option value="12" <?php if(isset($_GET['mes']) && $_GET['mes'] == 12) { echo "selected"; } ?>>Dezembro</option>
						</select>
					</div>
				</div><!-- ./col -->
				
				<div class="col-lg-3 col-md-3 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
						<select name="ano" class="form-control input-sm" onChange='document.location.href="?pag=<?php echo $_GET['pag']; ?>&do=view&<?php if(isset($_GET['mes'])){ echo "mes=".$_GET['mes']."&ano="; } else { echo "ano="; } ?>"+this.value;'>
							<option value="null">SELECIONAR O ANO</option>
							<option value="2016" <?php if(isset($_GET['ano']) && $_GET['ano'] == 2016) { echo "selected"; } ?>>2016</option>
							<option value="2017" <?php if(isset($_GET['ano']) && $_GET['ano'] == 2017) { echo "selected"; } ?>>2017</option>
							<option value="2018" <?php if(isset($_GET['ano']) && $_GET['ano'] == 2018) { echo "selected"; } ?>>2018</option>
							<option value="2019" <?php if(isset($_GET['ano']) && $_GET['ano'] == 2019) { echo "selected"; } ?>>2019</option>
							<option value="2020" <?php if(isset($_GET['ano']) && $_GET['ano'] == 2020) { echo "selected"; } ?>>2020</option>
						</select>
					</div>
				</div><!-- ./col -->
				
				<div class="col-lg-6 col-md-6 col-xs-12">
					<div class="pull-right">
						<a href="?pag=<?php echo $_GET['pag']; ?>&do=reports" class="btn btn-danger btn-sm"><i class="fa fa-list"></i> Gerar relatórios</a>
					</div>
				</div>
			</div><!-- ./row -->
			
			<hr />
			
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<section class="panel panel-default">
						<header class="panel-heading">
							Entradas e saídas deste mês
						</header>
						<div class="panel-body">
							<section id="unseen">
								<table class="table table-bordered table-striped table-condensed">
									<thead>
										<tr>
											<th>Entradas</th>
											<th>Saídas</th>
										</tr>
									</thead>
								
									<tbody>
										<?php
											if(isset($_GET['mes'])){
												$mesHoje = $_GET['mes'];
											} else {
												$mesHoje = date("m");
											}
											
											if(isset($_GET['ano'])){
												$anoHoje = $_GET['ano'];
											} else {
												$anoHoje = date("Y");
											}
											
											$sql = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = 'receita' && mes_movimentos = '$mesHoje' && ano_movimentos = '$anoHoje'";
											$query = $pdo->prepare($sql);
											$query->execute();
											$linha = $query->fetch(PDO::FETCH_OBJ);
											$entradas = $linha->total;

											$sql2 = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = 'despesa' && mes_movimentos = '$mesHoje' && ano_movimentos = '$anoHoje'";
											$query2 = $pdo->prepare($sql2);
											$query2->execute();
											$linha2 = $query2->fetch(PDO::FETCH_OBJ);
											$saidas = $linha2->total;

											$resultadoMes = $entradas-$saidas;
										?>
										<tr>
											<td style="color: green"><?php if($entradas == ""){ echo "R$0.00"; } else { echo dinheiro($entradas); } ?></td>
											<td style="color: red"><?php if($saidas == ""){ echo "R$0.00"; } else { echo dinheiro($saidas); } ?></td>
										</tr>
										
										<tr>
											<td colspan="2">
												Resultado <font style="float: right; font-weight: bold;" color="<?php if ($resultadoMes < 0) { echo "red"; } else { echo "green"; } ?>"><?php if($resultadoMes == ""){ echo "R$0.00"; } else { echo dinheiro($resultadoMes); } ?></font>
											</td>
										</tr>
									</tbody>
								</table>
							</section>
						</div>
					</section>
				</div>
				
				<div class="col-lg-6 col-md-6">
					<section class="panel panel-primary">
						<header class="panel-heading">
							Balanço Geral
						</header>
						<div class="panel-body">
							<section id="unseen">
								<table class="table table-bordered table-striped table-condensed">
									<thead>
										<tr>
											<th>Entradas</th>
											<th>Saídas</th>
										</tr>
									</thead>
									
									<tbody>
										<?php											
											$sql = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = 'receita'";
											$query = $pdo->prepare($sql);
											$query->execute();
											$linha = $query->fetch(PDO::FETCH_OBJ);
											$entradas = $linha->total;

											$sql2 = "SELECT SUM(valor_movimentos) as total FROM movimentos WHERE tipo_movimentos = 'despesa'";
											$query2 = $pdo->prepare($sql2);
											$query2->execute();
											$linha2 = $query2->fetch(PDO::FETCH_OBJ);
											$saidas = $linha2->total;

											$balancoGeral = $entradas-$saidas;
										?>
										<tr>
											<td style="color: green"><?php if($entradas == ""){ echo "R$0.00"; } else { echo dinheiro($entradas); } ?></td>
											<td style="color: red"><?php if($saidas == ""){ echo "R$0.00"; } else { echo dinheiro($saidas); } ?></td>
										</tr>
										
										<tr>
											<td colspan="2">
												Resultado <font style="float: right; font-weight: bold;" color="<?php if ($balancoGeral < 0) { echo "red"; } else { echo "green"; } ?>"><?php echo dinheiro($balancoGeral); ?></font>
											</td>
										</tr>
									</tbody>
								</table>
							</section>
						</div>
					</section>
				</div>
			</div>
			
			<hr />
			
			<div class="row">
				<div class="col-lg-8 col-md-8 col-xs-12">
					<h3 class="text-success">Movimentos deste mês</h3>
				</div>
				
				<div class="col-lg-4 col-md-4 col-xs-12">
					<div class="pull-right">
						<a href="?pag=<?php echo $_GET['pag']; ?>&do=insert" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i> Adicionar movimento</a>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th width="5%">#</th>
									<th>Descrição</th>
									<th>Categoria</th>
									<th>Data</th>
									<th width="7%" style="align: center;">Comprovante</th>
									<th width="7%" style="align: center;">Valor</th>
									<th width="20%"></th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(isset($_GET['mes'])){
										$mesHoje = $_GET['mes'];
									} else {
										$mesHoje = date("m");
									}
									
									if(isset($_GET['ano'])){
										$anoHoje = $_GET['ano'];
									} else {
										$anoHoje = date("Y");
									}
									
									$sql = "SELECT * FROM movimentos, categorias WHERE mes_movimentos = '$mesHoje' && ano_movimentos = '$anoHoje' && id_categorias = categorias_id_categorias ORDER BY dia_movimentos, mes_movimentos, ano_movimentos";									
									$query = $pdo->prepare($sql);
									$query->execute();
									if($query->rowCount() >= 1){
										while($linha = $query->fetch(PDO::FETCH_OBJ)){
								?>
								<tr>
									<td><?php echo $linha->id_movimentos; ?></td>
									<td><?php echo $linha->descricao_movimentos; ?> &nbsp;&nbsp;&nbsp;</td>
									<td><?php echo $linha->nome_categorias; ?></td>
									<td><?php echo $linha->dia_movimentos . "/" . $linha->mes_movimentos . "/" . $linha->ano_movimentos; ?></td>
									<td align="center" <?php if($linha->comprovante_movimentos == "" && $linha->tipo_movimentos == "despesa"){ echo "class='warning'"; } elseif($linha->comprovante_movimentos != "" && $linha->tipo_movimentos == "despesa"){ echo "class='success'"; } elseif($linha->tipo_movimentos == "receita"){ echo ""; } ?>><?php if($linha->comprovante_movimentos != "" && $linha->tipo_movimentos == "despesa"){ echo "<a href='uploads/comprovantes/".$linha->comprovante_movimentos."' class='btn btn-success btn-xs tooltips' data-placement='top' target='_blank' title='[#".$linha->id_movimentos."] - ".$linha->descricao_movimentos."'><i class='fa fa-search'></i> Ver comprovante</a>"; } elseif($linha->tipo_movimentos == "receita"){ echo "- - - - - - - - - -"; } else if($linha->comprovante_movimentos == "" && $linha->tipo_movimentos == "despesa") { echo "- - - - - - - - - -"; } ?></td>
									<td style="font-size: 15px;"><label class="label label-<?php if($linha->tipo_movimentos == "receita"){ echo 'success'; } else { echo 'danger'; } ?>">R$<?php echo $linha->valor_movimentos; ?></label></td>
									<td align="center">
										<?php
											if($linha->categorias_id_categorias != 1){
										?>
										<a href="?pag=<?php echo $_GET['pag']; ?>&do=edit&id=<?php echo $linha->id_movimentos; ?>" class="btn btn-sm btn-secondary">
											<i class="fa fa-edit"></i>
										</a>
										<a href="#remover<?php echo $linha->id_movimentos; ?>" data-toggle="modal" class="btn btn-sm btn-primary">
											<i class="fa fa-trash-o"></i>
										</a>
										<?php } ?>
										<?php if($linha->categorias_id_categorias == 1){ echo '<a href="#infos'.$linha->id_movimentos.'" data-toggle="modal">+detalhes</a>'; } ?>
									</td>
								</tr>
								
								<!-- Remover -->
								<div class="modal modal-styled fade" id="remover<?php echo $linha->id_movimentos; ?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title">Remover movimento - <?php echo $linha->descricao_movimentos; ?></h4>
											</div>
											<form action="" method="post">
												<div class="modal-body">
														Você tem certeza que deseja remover este registro? <label class="label label-danger">ESTA AÇÃO NÃO PODE SER DESFEITA!</label>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
													<button type="submit" name="removeMoviment" class="btn btn-success pull-right"><i class="fa fa-check"></i> Confirmar</button>
													<input type="hidden" name="id" value="<?php echo $linha->id_movimentos; ?>"/>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!-- Remover -->
								
								<!-- Informações -->
								<div class="modal modal-styled fade" id="infos<?php echo $linha->id_movimentos; ?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title">Informações sobre o movimento - <?php echo $linha->descricao_movimentos; ?></h4>
											</div>
											<form action="" method="post">
												<div class="modal-body">
													<?php echo nl2br($linha->observacoes_movimentos); ?>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
													<button type="button" class="btn btn-success pull-right" data-dismiss="modal"><i class="fa fa-check"></i> Confirmar</button>
													<input type="hidden" name="id" value="<?php echo $linha->id; ?>"/>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!-- Informações -->
								<?php }} else { echo "<tr><td colspan='99'>Nenhum registro encontrado!</td></tr>"; } ?>
							</tbody>
						</table>
					</div> <!-- /.table-responsive -->
				</div> <!-- /.col-lg-12 -->
			</div> <!-- /.row -->
			
			<hr />
			
			<div class="row">
				<div class="col-lg-8 col-md-8 col-xs-12">
					<h3 class="text-success">Categorias</h3>
				</div>
				
				<div class="col-lg-4 col-md-4 col-xs-12">
					<div class="pull-right">
						<a href="?pag=<?php echo $_GET['pag']; ?>&do=insertCat" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i> Adicionar categoria</a>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th width="5%">#</th>
									<th>Nome</th>
									<th width="20%"></th>
								</tr>
							</thead>
							<tbody>
								<?php
									$sql = "SELECT * FROM categorias";
									$query = $pdo->prepare($sql);
									$query->execute();
									if($query->rowCount() >= 1){
										while($linha = $query->fetch(PDO::FETCH_OBJ)){
								?>
								<tr>
									<td><?php echo $linha->id_categorias; ?></td>
									<td><?php echo $linha->nome_categorias; ?></td>
									<td align="center">
										<a href="?pag=<?php echo $_GET['pag']; ?>&do=editCat&id=<?php echo $linha->id_categorias; ?>" class="btn btn-sm btn-secondary">
											<i class="fa fa-edit"></i>
										</a>
										<a href="#removerCategoria<?php echo $linha->id_categorias; ?>" data-toggle="modal" class="btn btn-sm btn-primary">
											<i class="fa fa-trash-o"></i>
										</a>
									</td>
								</tr>
								
								<!-- Remover -->
								<div class="modal modal-styled fade" id="removerCategoria<?php echo $linha->id_categorias; ?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title">Remover categoria - <?php echo $linha->nome_categorias; ?></h4>
											</div>
											<form action="" method="post">
												<div class="modal-body">
														Você tem certeza que deseja remover este registro? <label class="label label-danger">ESTA AÇÃO NÃO PODE SER DESFEITA!</label>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
													<button type="submit" name="removeCat" class="btn btn-success pull-right"><i class="fa fa-check"></i> Confirmar</button>
													<input type="hidden" name="id" value="<?php echo $linha->id_categorias; ?>"/>
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
			
			<!-- ADD MOVIMENTO -->
			<?php 
				} elseif(isset($_GET['pag']) && $_GET['pag'] == "cash" && isset($_GET['do']) && $_GET['do'] == "insert"){ 
			?>
			<div class="content-header">
				<h2 class="content-header-title">Cadastrar movimento</h2>
			</div>
			
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<label for="descricao">Descrição</label>
						<input type="text" name="descricao" id="descricao" class="form-control">
					</div>
					<div class="col-md-2">
						<label for="data">Data</label>
						<input type="text" name="data" id="data" class="form-control" value="<?php echo date("d/m/Y"); ?>" required="required">
					</div>
					<div class="col-md-4">
						<label for="categoria">Categoria</label>
						<select name="categoria" id="categoria" class="form-control" required="required">
							<?php
								$sql = "SELECT * FROM categorias";
								$query = $pdo->prepare($sql);
								$query->execute();
								
								
								if($query->rowCount() > 0){
									echo "<option value=''>SELECIONE</option>";
									while($linha = $query->fetch(PDO::FETCH_OBJ)){
							?>
							<option value="<?php echo $linha->id_categorias; ?>"><?php echo $linha->nome_categorias; ?></option>
							<?php } } else { ?>
							<option value="">Nenhuma categoria encontrada!</option>
							<?php } ?>
						</select>
					</div>
				</div>
				
				<br />
				
				<div class="row">
					<div class="col-md-2">
						<label for="valor">Valor</label>
						<input type="text" name="valor" id="valor" class="form-control dinheiro" placeholder="R$">
					</div>
					<div class="col-md-3">
						<label for="">Tipo</label> <br />
						<input type="radio" name="tipo" value="receita" id="receita2"> <label for="receita2" style="color: green;">Receita</label> &nbsp;&nbsp;&nbsp;
						<input type="radio" name="tipo" value="despesa" id="despesa2"> <label for="despesa2" style="color: red;">Despesa</label>
					</div>
					<div id="comprovante" style="display: none;">
						<div class="col-md-3">
							<label for="comprovante">Comprovante</label>
							<input type="file" name="comprovante" id="comprovante" class="form-control">
						</div>
					</div>
					<div class="col-lg-4">
						<br />
						<div class="pull-right">
							<a href="#" onclick="window.history.back();" class="btn btn-md btn-secondary">
								<i class="fa fa-arrow-left"></i> Voltar
							</a>
							<button type="submit" name="insertMoviment" class="btn btn-md btn-success">
								<i class="fa fa-check"></i> Cadastrar movimento
							</button>
						</div>
					</div>
				</div>
			</form>
			<!-- ADD MOVIMENTO -->
			
			<!-- ADD CATEGORIA -->
			<?php 
				} elseif(isset($_GET['pag']) && $_GET['pag'] == "cash" && isset($_GET['do']) && $_GET['do'] == "insertCat"){
			?>
			
			<div class="content-header">
				<h2 class="content-header-title">Cadastrar categoria</h2>
			</div>
			
			<form action="" method="post">
				<div class="row">
					<div class="col-md-8">
						<label for="nome">Nome</label>
						<input type="text" name="nome" id="nome" class="form-control">
					</div>
					
					<div class="col-lg-4">
						<br />
						<div class="pull-right">
							<a href="#" onclick="window.history.back();" class="btn btn-md btn-secondary">
								<i class="fa fa-arrow-left"></i> Voltar
							</a>
							<button type="submit" name="insertCat" class="btn btn-md btn-success">
								<i class="fa fa-check"></i> Cadastrar categoria
							</button>
						</div>
					</div>
				</div>
			</form>
			<!-- ADD CATEGORIA -->
			
			<!-- EDIT MOVIMENTO -->
			<?php
				} elseif(isset($_GET['pag']) && $_GET['pag'] == "cash" && isset($_GET['do']) && $_GET['do'] == "edit" && $_GET['id'] != ""){
			?>
			
			<?php
				$id = addslashes($_GET['id']);
				$sql = "SELECT * FROM movimentos WHERE id_movimentos = ?";
				$query = $pdo->prepare($sql);
				$query->execute(array($id));
				$linha = $query->fetch(PDO::FETCH_OBJ);
			?>
			
			<div class="content-header">
				<h2 class="content-header-title">Editar movimento - <?php echo $linha->descricao_movimentos; ?></h2>
			</div>
			
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<label for="descricao">Descrição</label>
						<input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo $linha->descricao_movimentos; ?>">
					</div>
					<div class="col-md-2">
						<label for="data">Data</label>
						<input type="text" name="data" id="data" class="form-control" value="<?php echo date("d/m/Y", strtotime($linha->data_movimentos)); ?>" required="required">
					</div>
					<div class="col-md-4">
						<label for="categoria">Categoria</label>
						<select name="categoria" id="categoria" class="form-control" required="required">
							<?php
								$sql2 = "SELECT * FROM categorias";
								$query2 = $pdo->prepare($sql2);
								$query2->execute();
								
								if($query2->rowCount() > 0){
									echo "<option value=''>SELECIONE</option>";
									while($linha2 = $query2->fetch(PDO::FETCH_OBJ)){
							?>
							<option value="<?php echo $linha2->id_categorias; ?>" <?php if($linha->categorias_id_categorias == $linha2->id_categorias){ echo "selected"; } ?>><?php echo $linha2->nome_categorias; ?></option>
							<?php } } else { ?>
							<option value="">Nenhuma categoria encontrada!</option>
							<?php } ?>
						</select>
					</div>
				</div>
				
				<br />
				
				<div class="row">
					<div class="col-md-2">
						<label for="valor">Valor</label>
						<input type="text" name="valor" id="valor" class="form-control dinheiro" placeholder="R$" value="<?php echo $linha->valor_movimentos; ?>">
					</div>
					<div class="col-md-3">
						<label for="">Tipo</label> <br />
						<input type="radio" name="tipo" value="receita" id="receita2" <?php if($linha->tipo_movimentos == "receita"){ echo "checked"; } ?>> <label for="receita2" style="color: green;">Receita</label> &nbsp;&nbsp;&nbsp;
						<input type="radio" name="tipo" value="despesa" id="despesa2" <?php if($linha->tipo_movimentos == "despesa"){ echo "checked"; } ?>> <label for="despesa2" style="color: red;">Despesa</label>
					</div>
					<div id="comprovante" style="display: none;">
						<div class="col-md-3">
							<label for="comprovante">Comprovante</label>
							<input type="file" name="comprovante" id="comprovante" class="form-control">
						</div>
					</div>
					<div class="col-lg-4">
						<br />
						<div class="pull-right">
							<a href="#" onclick="window.history.back();" class="btn btn-md btn-secondary">
								<i class="fa fa-arrow-left"></i> Voltar
							</a>
							<button type="submit" name="editMoviment" class="btn btn-md btn-success">
								<i class="fa fa-check"></i> Editar movimento
							</button>
						</div>
					</div>
				</div>
			</form>
			<!-- EDIT MOVIMENTO -->
			
			<!-- EDIT CATEGORIA -->
			<?php
				} elseif(isset($_GET['pag']) && $_GET['pag'] == "cash" && isset($_GET['do']) && $_GET['do'] == "editCat" && $_GET['id'] != ""){
			?>
			
			<?php
				$id = addslashes($_GET['id']);
				$sql = "SELECT * FROM categorias WHERE id_categorias = ?";
				$query = $pdo->prepare($sql);
				$query->execute(array($id));
				$linha = $query->fetch(PDO::FETCH_OBJ);
			?>
			
			<div class="content-header">
				<h2 class="content-header-title">Editar categoria - <?php echo $linha->nome_categorias; ?></h2>
			</div>
			
			<form action="" method="post">
				<div class="row">
					<div class="col-md-8">
						<label for="nome">Nome</label>
						<input type="text" name="nome" id="nome" class="form-control" value="<?php echo $linha->nome_categorias; ?>">
					</div>
					
					<div class="col-lg-4">
						<br />
						<div class="pull-right">
							<a href="#" onclick="window.history.back();" class="btn btn-md btn-secondary">
								<i class="fa fa-arrow-left"></i> Voltar
							</a>
							<button type="submit" name="editCat" class="btn btn-md btn-success">
								<i class="fa fa-check"></i> Editar categoria
							</button>
						</div>
					</div>
				</div>
			</form>
			<!-- EDIT CATEGORIA -->
			
			<!-- REPORTS -->
			<?php
				} elseif(isset($_GET['pag']) && $_GET['pag'] == "cash" && isset($_GET['do']) && $_GET['do'] == "reports"){
			?>
			<div class="content-header">
				<h2 class="content-header-title">Gerar relatórios</h2>
			</div>
			
			<form action="reports.php" method="GET" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-3">
						<label for="categoria">Categoria</label>
						<select name="categoria" id="categoria" class="form-control">
							<?php
							
								$sql = "SELECT * FROM categorias ORDER BY nome_categorias";
								$query = $pdo->prepare($sql);
								$query->execute();
								
								if($query->rowCount() == 0){
									echo "<option value=''>Nenhuma categoria cadastrada!</option>";
								} else {
									echo "<option value=''>SELECIONE</option>";
									while($linha = $query->fetch(PDO::FETCH_OBJ)){
							?>
							<option value="<?php echo $linha->id_categorias; ?>"><?php echo $linha->nome_categorias; ?></option>
							<?php } } ?>
						</select>
					</div>
					
					<div class="col-md-3">
						<label for="">Tipo</label> <br />
						<input type="radio" name="tipo" value="receita" id="receita"> <label for="receita" style="color: green;">Receita</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="tipo" value="despesa" id="despesa"> <label for="despesa" style="color: red;">Despesa</label>
					</div>

					<div class="col-md-6">
						<label for="">Data</label> <br />
						<div class="input-daterange input-group" id="data">
							<input type="text" class="input-sm form-control" name="de" placeholder="Data de início"/>
							<span class="input-group-addon">-</span>
							<input type="text" class="input-sm form-control" name="ate" placeholder="Data final" />
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<br />
						<div class="pull-right">
							<a href="#" onclick="window.history.back();" class="btn btn-md btn-secondary">
								<i class="fa fa-arrow-left"></i> Voltar
							</a>
							<button type="submit" class="btn btn-md btn-success">
								<i class="fa fa-check"></i> Gerar relatório
							</button>
							<input type="hidden" name="pag" value="cash" />
						</div>
					</div>
				</div>
			</form>
			<!-- REPORTS -->
			
			<?php } else { include "404.php"; } ?>