			
			<div class="row">

				<div class="col-sm-6 col-md-3">
					<div class="row-stat">
						<p class="row-stat-label">Eventos confirmados este mês</p>
						<?php
							$ano = addslashes($_GET['ano']);
							$mes = addslashes($_GET['mes']);
							$sqlConfirmados = "SELECT id, status FROM eventos WHERE mes = '{$mes}' AND ano = '{$ano}' AND status = '1'";
							$queryConfirmados = $pdo->prepare($sqlConfirmados);
							$queryConfirmados->execute();
							$rowsConfirmados = $queryConfirmados->rowCount();
						?>
						<h3 class="row-stat-value"><?php echo $rowsConfirmados; ?></h3>
					</div> <!-- /.row-stat -->
				</div> <!-- /.col -->

				<div class="col-sm-6 col-md-3">
					<div class="row-stat">
						<p class="row-stat-label">Eventos realizados este mês</p>
						<?php
							$ano = addslashes($_GET['ano']);
							$mes = addslashes($_GET['mes']);
							$sqlRealizados = "SELECT id, status FROM eventos WHERE mes = '{$mes}' AND ano = '{$ano}' AND status = '2'";
							$queryRealizados = $pdo->prepare($sqlRealizados);
							$queryRealizados->execute();
							$rowsRealizados = $queryRealizados->rowCount();
						?>
						<h3 class="row-stat-value"><?php echo $rowsRealizados; ?></h3>
					</div> <!-- /.row-stat -->
				</div> <!-- /.col -->

				<div class="col-sm-6 col-md-3">
					<div class="row-stat">
						<p class="row-stat-label">Eventos realizados este ano</p>
						<?php
							$ano = addslashes($_GET['ano']);
							$sqlConfirmadosAno = "SELECT id, status FROM eventos WHERE ano = '{$ano}' AND status = '2'";
							$queryConfirmadosAno = $pdo->prepare($sqlConfirmadosAno);
							$queryConfirmadosAno->execute();
							$rowsConfirmadosAno = $queryConfirmadosAno->rowCount();
						?>
						<h3 class="row-stat-value"><?php echo $rowsConfirmadosAno; ?></h3>
					</div> <!-- /.row-stat -->
				</div> <!-- /.col -->

				<div class="col-sm-6 col-md-3">
					<div class="row-stat">
						<p class="row-stat-label">Total de eventos realizados</p>
						<?php
							$sqlRealizados = "SELECT id, status FROM eventos WHERE status = '2'";
							$queryRealizados = $pdo->prepare($sqlRealizados);
							$queryRealizados->execute();
							$rowsRealizados = $queryRealizados->rowCount();
						?>
						<h3 class="row-stat-value"><?php echo $rowsRealizados; ?></h3>
					</div> <!-- /.row-stat -->
				</div> <!-- /.col -->
				
			</div> <!-- /.row -->

			<hr />
			
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
					<a href="?pag=events&do=insert" class="btn btn-sm btn-warning pull-right"><i class="fa fa-plus"></i> Adicionar novo evento</a>
				</div>
			</div><!-- ./row -->
			
			<hr />
			
			<h3 class="text-success">Eventos confirmados para este mês</h3>
			
			<div class="row">
			
				<div class="col-lg-12">
					
					<div class="table-responsive">

						<table class="table table-bordered table-hover">
						
							<thead>
								<tr>
									<th width="5%">#</th>
									<th>Nome do cliente</th>
									<th width="10%">Data</th>
									<th width="10%">Hora</th>
									<th width="20%"></th>
								</tr>
							</thead>
							
							<tbody>
								<?php
									if(!isset($_GET['ano'])){
										$ano = addslashes($_GET['ano']);
										$mes = addslashes($_GET['mes']);
										$sql = "SELECT id, nome, dia, mes, ano, hora_chegada, status FROM eventos WHERE ano = '{$ano}' AND mes = '{$mes}' AND status = '1' ORDER BY mes, dia, ano, hora_chegada ASC";
									}
									
									if(isset($_GET['ano']) && $_GET['ano'] != "null"){
										$ano = addslashes($_GET['ano']);
										$mes = addslashes($_GET['mes']);
										$sql = "SELECT id, nome, dia, mes, ano, hora_chegada, status FROM eventos WHERE ano = '{$ano}' AND mes = '{$mes}' AND status = '1' ORDER BY mes, dia, ano, hora_chegada ASC";
									}
									
									$query = $pdo->prepare($sql);
									$query->execute();
									if($query->rowCount() >= 1){
										while($linha = $query->fetch(PDO::FETCH_OBJ)){
								?>
								<tr>
									<td><?php echo $linha->id; ?></td>
									<td><?php echo $linha->nome; ?></td>
									<td><?php echo $linha->dia; ?>/<?php echo $linha->mes; ?>/<?php echo $linha->ano; ?></td>
									<td><?php echo $linha->hora_chegada; ?></td>
									<td align="center">
										<a href="#" onclick="window.open('imprimir.php?id=<?php echo $linha->id; ?>');" class="btn btn-sm btn-success">
											<i class="fa fa-print"></i>
										</a>
										<a href="?pag=events&do=edit&id=<?php echo $linha->id; ?>" class="btn btn-sm btn-secondary">
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
												<h4 class="modal-title">Remover evento - <?php echo $linha->nome; ?></h4>
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

			<hr />
			
			<h3 class="text-info">Eventos realizados este mês</h3>
			
			<div class="row">
			
				<div class="col-lg-12">
					
					<div class="table-responsive">

						<table class="table table-bordered table-hover">
						
							<thead>
								<tr>
									<th width="5%">#</th>
									<th>Nome do cliente</th>
									<th width="10%">Data</th>
									<th width="10%">Hora</th>
									<th width="20%"></th>
								</tr>
							</thead>
							
							<tbody>
							
								<?php
									if(!isset($_GET['ano'])){
										$ano = addslashes($_GET['ano']);
										$mes = addslashes($_GET['mes']);
										$sql = "SELECT id, nome, dia, mes, ano, hora_chegada, status FROM eventos WHERE ano = '{$ano}' AND mes = '{$mes}' AND status = '2' ORDER BY mes, dia, ano, hora_chegada ASC";
									}
									
									if(isset($_GET['ano']) && $_GET['ano'] != "null"){
										$ano = addslashes($_GET['ano']);
										$mes = addslashes($_GET['mes']);
										$sql = "SELECT id, nome, dia, mes, ano, hora_chegada, status FROM eventos WHERE ano = '{$ano}' AND mes = '{$mes}' AND status = '2' ORDER BY mes, dia, ano, hora_chegada ASC";
									}
									
									$query = $pdo->prepare($sql);
									$query->execute();
									if($query->rowCount() >= 1){
										while($linha = $query->fetch(PDO::FETCH_OBJ)){
								?>
								<tr>
									<td><?php echo $linha->id; ?></td>
									<td><?php echo $linha->nome; ?></td>
									<td><?php echo $linha->dia; ?>/<?php echo $linha->mes; ?>/<?php echo $linha->ano; ?></td><td><?php echo $linha->hora_chegada; ?></td>
									<td align="center">
										<a href="#" onclick="window.open('imprimir.php?id=<?php echo $linha->id; ?>');" class="btn btn-sm btn-success">
											<i class="fa fa-print"></i>
										</a>
										<a href="?pag=events&do=edit&id=<?php echo $linha->id; ?>" class="btn btn-sm btn-secondary">
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
												<h4 class="modal-title">Remover evento - <?php echo $linha->nome; ?></h4>
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