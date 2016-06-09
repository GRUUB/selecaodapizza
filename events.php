
			<?php
				if(isset($_GET['pag']) && $_GET['pag'] == "events" && isset($_GET['do']) && $_GET['do'] == "insert"){
			?>
			
			<div class="content-header">
				<h2 class="content-header-title">Cadastrar novo evento</h2>
			</div>

			<form action="" method="post">
			
				<div class="row">
					
					<div class="col-lg-3">					
						<strong>Nome</strong>
						<input type="text" name="nome" class="form-control" />
					</div>
					
					<div class="col-lg-3">
						<strong>E-mail</strong>
						<input type="text" name="email" class="form-control" />					
					</div>
					
					<div class="col-lg-3">
						<strong>Telefone</strong>
						<input type="text" name="telefone" class="form-control" />					
					</div>
					
					<div class="col-lg-3">
						<strong>Celular</strong>
						<input type="text" name="celular" class="form-control" />					
					</div>
					
				</div> <!-- /.row -->
				
				<br />
				
				<div class="row">
					
					<div class="col-lg-3">
						<strong>Data</strong>
						<input type="text" id="data" name="data" class="form-control" />
					</div>
					
					<div class="col-lg-1">					
						<strong>Chegada</strong>
						<input type="text" name="hora_chegada" class="form-control" />
					</div>
					
					<div class="col-lg-1">
						<strong>Início</strong>
						<input type="text" name="hora_inicio" class="form-control" />					
					</div>
					
					<div class="col-lg-1">
						<strong>Término</strong>
						<input type="text" name="hora_termino" class="form-control" />
					</div>
					
					<div class="col-lg-1">
						<strong>Adultos</strong>
						<input type="text" name="adultos" class="form-control" />
					</div>
					
					<div class="col-lg-2">
						<br />
						<input type="text" name="valor_adulto" class="form-control dinheiro" placeholder="R$" />
					</div>
					
					<div class="col-lg-1">
						<strong>Crianças</strong>
						<input type="text" name="criancas" class="form-control" />
					</div>
					
					<div class="col-lg-2">
						<br />
						<input type="text" name="valor_crianca" class="form-control dinheiro" placeholder="R$" />
					</div>
					
				</div> <!-- /.row -->
				
				<br />
				
				<div class="row">
					
					<div class="col-lg-4">					
						<strong>Endereço</strong>
						<input type="text" name="endereco" class="form-control" />
					</div>
					
					<div class="col-lg-4">
						<strong>Bairro</strong>
						<input type="text" name="bairro" class="form-control" />					
					</div>
					
					<div class="col-lg-4">
						<strong>Cidade</strong>
						<input type="text" name="cidade" class="form-control" />					
					</div>
					
				</div> <!-- /.row -->
				
				<br />
				
				<div class="row">
					
					<div class="col-lg-3">					
						<strong>Porta Pizza</strong>
						<input type="text" name="porta_pizza" class="form-control" />
					</div>
					
					<div class="col-lg-3">
						<strong>Taxa de Deslocamento</strong>
						<input type="text" name="deslocamento" class="form-control" />					
					</div>
					
					<div class="col-lg-3">
						<strong>Pizzaiolo</strong>
						<input type="text" name="pizzaiolo" class="form-control" />					
					</div>
					
					<div class="col-lg-3">
						<strong>Garçom</strong>
						<input type="text" name="garcom" class="form-control" />					
					</div>
					
				</div> <!-- /.row -->
				
				<br />
				
				<div class="row">
					
					<div class="col-lg-6">					
						<strong>Observações</strong>
						<textarea name="observacoes" rows="5" class="form-control"></textarea>
					</div>
					
					<div class="col-lg-6">
						<strong>Observações (Controle Interno)</strong>
						<textarea name="observacoes_interno" rows="5" class="form-control"></textarea>		
					</div>
					
				</div> <!-- /.row -->
				
				<br />
				
				<div class="row">
					
					<div class="col-lg-3">					
						<strong>Status</strong>
						<select name="status" class="form-control">
							<option value="0">Evento não confirmado</option>
							<option value="3">Evento aguardando confirmação</option>
							<option value="1">Evento confirmado</option>
							<option value="2">Evento realizado</option>
							<option value="4">Evento recebido e registrado no caixa</option>
						</select>
					</div>
					
					<div class="col-lg-9">
						<br />
						<div class="pull-right">
							<a href="#" onclick="window.history.back();" class="btn btn-md btn-secondary">
								<i class="fa fa-arrow-left"></i> Voltar
							</a>
							<button type="submit" name="insertEvent" class="btn btn-md btn-success">
								<i class="fa fa-check"></i> Cadastrar evento
							</button>
						</div>
					</div>
					
				</div> <!-- /.row -->
			
			</form>
			
			<?php } elseif(isset($_GET['pag']) && $_GET['pag'] == "events" && isset($_GET['do']) && $_GET['do'] == "edit" && $_GET['id'] != ""){ ?>
			
			<?php
				$id = addslashes($_GET['id']);
				$sql = "SELECT * FROM eventos WHERE id = ?";
				$query = $pdo->prepare($sql);
				$query->execute(array($id));
				$linha = $query->fetch(PDO::FETCH_OBJ);
			?>
			
			<div class="content-header">
				<h2 class="content-header-title">Editar evento - <?php echo $linha->nome; ?></h2>
			</div>

			<form action="" method="post">
			
				<div class="row">
					
					<div class="col-lg-3">					
						<strong>Nome</strong>
						<input type="text" name="nome" class="form-control" value="<?php echo $linha->nome; ?>" />
					</div>
					
					<div class="col-lg-3">
						<strong>E-mail</strong>
						<input type="text" name="email" class="form-control" value="<?php echo $linha->email; ?>" />					
					</div>
					
					<div class="col-lg-3">
						<strong>Telefone</strong>
						<input type="text" name="telefone" class="form-control" value="<?php echo $linha->telefone; ?>" />					
					</div>
					
					<div class="col-lg-3">
						<strong>Celular</strong>
						<input type="text" name="celular" class="form-control" value="<?php echo $linha->celular; ?>" />					
					</div>
					
				</div> <!-- /.row -->
				
				<br />
				
				<div class="row">
					
					<div class="col-lg-3">
						<strong>Data</strong>
						<input type="text" id="data" name="data" class="form-control" value="<?php echo $linha->dia; ?>/<?php echo $linha->mes; ?>/<?php echo $linha->ano; ?>" />
					</div>
					
					<div class="col-lg-1">					
						<strong>Chegada</strong>
						<input type="text" name="hora_chegada" class="form-control" value="<?php echo $linha->hora_chegada; ?>" />
					</div>
					
					<div class="col-lg-1">
						<strong>Início</strong>
						<input type="text" name="hora_inicio" class="form-control" value="<?php echo $linha->hora_inicio; ?>" />					
					</div>
					
					<div class="col-lg-1">
						<strong>Término</strong>
						<input type="text" name="hora_termino" class="form-control" value="<?php echo $linha->hora_termino; ?>" />
					</div>
					
					<div class="col-lg-1">
						<strong>Adultos</strong>
						<input type="text" name="adultos" class="form-control" value="<?php echo $linha->adultos; ?>" />
					</div>
					
					<div class="col-lg-2">
						<br />
						<input type="text" name="valor_adulto" class="form-control dinheiro" placeholder="R$" value="<?php echo $linha->valor_adulto; ?>" />
					</div>
					
					<div class="col-lg-1">
						<strong>Crianças</strong>
						<input type="text" name="criancas" class="form-control" value="<?php echo $linha->criancas; ?>" />
					</div>
					
					<div class="col-lg-2">
						<br />
						<input type="text" name="valor_crianca" class="form-control dinheiro" placeholder="R$" value="<?php echo $linha->valor_crianca; ?>" />
					</div>
					
				</div> <!-- /.row -->
				
				<br />
				
				<div class="row">
					
					<div class="col-lg-4">					
						<strong>Endereço</strong>
						<input type="text" name="endereco" class="form-control" value="<?php echo $linha->endereco; ?>" />
					</div>
					
					<div class="col-lg-4">
						<strong>Bairro</strong>
						<input type="text" name="bairro" class="form-control" value="<?php echo $linha->bairro; ?>" />					
					</div>
					
					<div class="col-lg-4">
						<strong>Cidade</strong>
						<input type="text" name="cidade" class="form-control" value="<?php echo $linha->cidade; ?>" />					
					</div>
					
				</div> <!-- /.row -->
				
				<br />
				
				<div class="row">
					
					<div class="col-lg-3">					
						<strong>Porta Pizza</strong>
						<input type="text" name="porta_pizza" class="form-control" value="<?php echo $linha->porta_pizza; ?>" />
					</div>
					
					<div class="col-lg-3">
						<strong>Taxa de Deslocamento</strong>
						<input type="text" name="deslocamento" class="form-control" value="<?php echo $linha->deslocamento; ?>" />					
					</div>
					
					<div class="col-lg-3">
						<strong>Pizzaiolo</strong>
						<input type="text" name="pizzaiolo" class="form-control" value="<?php echo $linha->pizzaiolo; ?>" />					
					</div>
					
					<div class="col-lg-3">
						<strong>Garçom</strong>
						<input type="text" name="garcom" class="form-control" value="<?php echo $linha->garcom; ?>" />					
					</div>
					
				</div> <!-- /.row -->
				
				<br />
				
				<div class="row">
					
					<div class="col-lg-6">					
						<strong>Observações</strong>
						<textarea name="observacoes" rows="5" class="form-control"><?php echo nl2br($linha->observacoes); ?></textarea>
					</div>
					
					<div class="col-lg-6">
						<strong>Observações (Controle Interno)</strong>
						<textarea name="observacoes_interno" rows="5" class="form-control"><?php echo nl2br($linha->observacoes_interno); ?></textarea>		
					</div>
					
				</div> <!-- /.row -->
				
				<br />
				
				<div class="row">
					
					<div class="col-lg-3">					
						<strong>Status</strong>
						<select name="status" class="form-control">
							<option value="0" <?php if($linha->status == 0){ echo "selected"; } ?>>Evento não confirmado</option>
							<option value="3" <?php if($linha->status == 3){ echo "selected"; } ?>>Evento aguardando confirmação</option>
							<option value="1" <?php if($linha->status == 1){ echo "selected"; } ?>>Evento confirmado</option>
							<option value="2" <?php if($linha->status == 2){ echo "selected"; } ?>>Evento realizado</option>
							<option value="4" <?php if($linha->status == 4){ echo "selected"; } ?>>Evento recebido e registrado no caixa</option>
						</select>
					</div>
					
					<div class="col-lg-2">
						<center>
							<strong>Adultos</strong> <br />
							<a href="#" class="btn btn-default btn-md" style="cursor: default;"><i class="fa fa-usd"></i> <?php echo number_format($linha->soma_adultos,2,",","."); ?></a>
						</center>
					</div>
					
					<div class="col-lg-2">
						<center>
							<strong>Crianças</strong> <br />
							<a href="#" class="btn btn-default btn-md" style="cursor: default;"><i class="fa fa-usd"></i> <?php echo number_format($linha->soma_criancas,2,",","."); ?></a>
						</center>
					</div>
					
					<div class="col-lg-2">
						<center>
							<strong>Evento</strong> <br />
							<a href="#" class="btn btn-default btn-md" style="cursor: default;"><i class="fa fa-usd"></i> <?php echo number_format($linha->soma_total,2,",","."); ?></a>
						</center>
					</div>
					
					<div class="col-lg-3">
						<br />
						<div class="pull-right">
							<a href="#" onclick="window.history.back();" class="btn btn-md btn-secondary">
								<i class="fa fa-arrow-left"></i> Voltar
							</a>
							<button type="submit" name="editEvent" class="btn btn-md btn-success">
								<i class="fa fa-check"></i> Editar evento
							</button>
						</div>
					</div>
					
				</div> <!-- /.row -->
			
			</form>
			
			<?php } elseif(isset($_GET['pag']) && $_GET['pag'] == "events" && isset($_GET['do']) && $_GET['do'] == "view"){ ?>
			
			<div class="content-header">
				<h2 class="content-header-title">Ver todos os eventos</h2>
			</div>
			
			<div class="row">				
				<div class="col-lg-3 col-md-3 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
						<select name="ano" class="form-control input-sm" onChange='document.location.href="?pag=<?php echo $_GET['pag']; ?>&do=view&<?php if(isset($_GET['status'])){ echo "status=".$_GET['status']."&ano="; } else { echo "ano="; } ?>"+this.value;'>
							<option value="null">SELECIONAR O ANO</option>
							<option value="2016" <?php if(isset($_GET['ano']) && $_GET['ano'] == 2016) { echo "selected"; } ?>>2016</option>
							<option value="2017" <?php if(isset($_GET['ano']) && $_GET['ano'] == 2017) { echo "selected"; } ?>>2017</option>
							<option value="2018" <?php if(isset($_GET['ano']) && $_GET['ano'] == 2018) { echo "selected"; } ?>>2018</option>
							<option value="2019" <?php if(isset($_GET['ano']) && $_GET['ano'] == 2019) { echo "selected"; } ?>>2019</option>
							<option value="2020" <?php if(isset($_GET['ano']) && $_GET['ano'] == 2020) { echo "selected"; } ?>>2020</option>
						</select>
					</div>
				</div><!-- ./col -->
				
				<div class="col-lg-3 col-md-3 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-list"></i></span>
						<select name="status" class="form-control input-sm" onChange='document.location.href="?pag=<?php echo $_GET['pag']; ?>&do=view&<?php if(isset($_GET['ano'])){ echo "ano=".$_GET['ano']."&status="; } else { echo "status="; } ?>"+this.value;'>
							<option value="null">FILTRAR POR STATUS</option>
							<option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == "0") { echo "selected"; } ?>>Evento não confirmado</option>
							<option value="3" <?php if(isset($_GET['status']) && $_GET['status'] == "3") { echo "selected"; } ?>>Evento aguardando confirmação</option>
							<option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == "1") { echo "selected"; } ?>>Evento confirmado</option>
							<option value="2" <?php if(isset($_GET['status']) && $_GET['status'] == "2") { echo "selected"; } ?>>Evento realizado</option>
							<option value="4" <?php if(isset($_GET['status']) && $_GET['status'] == "4") { echo "selected"; } ?>>Evento recebido e registrado no caixa</option>
						</select>
					</div>
				</div><!-- ./col -->
				<div class="col-lg-6 col-md-6 col-xs-12">
					<a href="?pag=<?php echo $_GET['pag']; ?>&do=insert" class="btn btn-sm btn-warning pull-right"><i class="fa fa-plus"></i> Adicionar novo evento</a>
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
									<th>Nome do cliente</th>
									<th width="10%">Data</th>
									<th width="10%">Hora</th>
									<th width="15%">Status</th>
									<th width="20%"></th>
								</tr>
							</thead>
							
							<tbody>
								<?php
									if(!isset($_GET['status']) && !isset($_GET['ano'])){
										$ano = date("Y");
										$sql = "SELECT * FROM eventos WHERE ano = '{$ano}' ORDER BY mes, dia, ano, hora_chegada ASC";
									}
									
									if(isset($_GET['status']) && isset($_GET['ano'])){
										$status = addslashes($_GET['status']);
										$ano = addslashes($_GET['ano']);
										$sql = "SELECT * FROM eventos WHERE ano = '{$ano}' AND status = '{$status}' ORDER BY mes, dia, ano, hora_chegada ASC";
									}
									
									if( (isset($_GET['status']) && $_GET['status'] != "null") && (isset($_GET['ano']) && $_GET['ano'] == "null")){
										$status = addslashes($_GET['status']);
										$sql = "SELECT * FROM eventos WHERE status = '{$status}' ORDER BY mes, dia, ano, hora_chegada ASC";
									}
									
									if( (isset($_GET['status']) && $_GET['status'] == "null") && (isset($_GET['ano']) && $_GET['ano'] != "null")){
										$ano = addslashes($_GET['ano']);
										$sql = "SELECT * FROM eventos WHERE ano = '{$ano}' ORDER BY mes, dia, ano, hora_chegada ASC";
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
									<td>
										<?php if($linha->status == 0) { echo "<div class='label label-warning'>Evento não confirmado</div>"; } ?>
										<?php if($linha->status == 1) { echo "<div class='label label-success'>Evento confirmado</div>"; } ?>
										<?php if($linha->status == 2) { echo "<div class='label label-secondary'>Evento realizado</div>"; } ?>
										<?php if($linha->status == 3) { echo "<div class='label label-danger'>Evento aguardando confirmação</div>"; } ?>
										<?php if($linha->status == 4) { echo "<div class='label label-success'>Evento recebido e registrado no caixa</div>"; } ?>
									</td>
									<td align="center">
										<?php if($linha->status == 0) { ?>
											<a href="#confirmar<?php echo $linha->id; ?>" data-toggle="modal" class="btn btn-sm btn-success">
												<i class="fa fa-check"></i>
											</a>
										<?php } ?>
										<?php if($linha->status == 1) { ?>
											<a href="#" onclick="window.open('imprimir.php?id=<?php echo $linha->id; ?>');" class="btn btn-sm btn-success">
												<i class="fa fa-print"></i>
											</a>
										<?php } ?>
										<?php if($linha->status == 2) { ?>
											<a href="#receber<?php echo $linha->id; ?>" data-toggle="modal" class="btn btn-sm btn-success">
												<i class="fa fa-usd"></i>
											</a>
										<?php } ?>
										<?php if($linha->status == 3) { ?>
											<a href="#confirmar<?php echo $linha->id; ?>" data-toggle="modal" class="btn btn-sm btn-success">
												<i class="fa fa-envelope"></i>
											</a>
										<?php } ?>
										<a href="?pag=events&do=edit&id=<?php echo $linha->id; ?>" class="btn btn-sm btn-secondary">
											<i class="fa fa-edit"></i>
										</a>
										<a href="#remover<?php echo $linha->id; ?>" data-toggle="modal" class="btn btn-sm btn-primary">
											<i class="fa fa-trash-o"></i>
										</a>
									</td>
								</tr>
								
								<!-- Confirmar -->
								<div class="modal modal-styled fade" id="confirmar<?php echo $linha->id; ?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title">Confirmar evento - <?php echo $linha->nome; ?></h4>
											</div>
											<form action="" method="post">
												<div class="modal-body">
														Confirmação do evento para: <strong><?php echo $linha->nome; ?></strong> <br />
														Data do evento: <strong><?php echo $linha->dia."/".$linha->mes."/".$linha->ano; ?></strong> <br />
														Hora de chegada: <strong><?php echo $linha->hora_chegada; ?></strong> <br />
														Hora de início: <strong><?php echo $linha->hora_inicio; ?></strong> <br />
														Hora de término: <strong><?php echo $linha->hora_termino; ?></strong> <br />
														Adultos: <strong><?php echo $linha->adultos; ?></strong> (<i><?php echo dinheiro($linha->valor_adulto); ?>/adulto</i>) <br />
														Crianças: <strong><?php echo $linha->criancas; ?></strong> (<i><?php echo dinheiro($linha->valor_crianca); ?>/adulto</i>) <br />
														Porta Pizza: <strong><?php echo $linha->porta_pizza; ?></strong> <br />
														Taxa de Deslocamento: <strong><?php echo $linha->deslocamento; ?></strong> <br />
														Pizzaiolo(s): <strong><?php echo $linha->pizzaiolo; ?></strong> <br />
														Garçom(ns): <strong><?php echo $linha->garcom; ?></strong> <br /><br />
														
														<strong>Valor total do evento: <?php echo dinheiro($linha->soma_total); ?></strong> <br /><br />
														
														<label class="label label-danger">ATENÇÃO: Confira todos os dados do evento antes de confirmar o mesmo!</label>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
													<?php if($linha->status == 0){ ?><button type="submit" name="confirmEvent" class="btn btn-success pull-right"><i class="fa fa-check"></i> Confirmar</button><?php } ?>
													<button type="submit" name="emailConfirmEvent" class="btn btn-success pull-right"><i class="fa fa-envelope"></i> Enviar pedido de confirmação por e-mail</button>
													<input type="hidden" name="id" value="<?php echo $linha->id; ?>"/>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!-- Confirmar -->
								
								<!-- Receber -->
								<div class="modal modal-styled fade" id="receber<?php echo $linha->id; ?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title">Fazer fechamento do evento - <?php echo $linha->nome; ?></h4>
											</div>
											<form action="" method="post">
												<div class="modal-body">
													<div class="row">
														<div class="col-md-4">
															<label for="equipe">Custo equipe</label>
															<input type="text" name="equipe" id="equipe" class="form-control dinheiro" placeholder="R$">
														</div>
														<div class="col-md-4">
															<label for="ingredientes">Custo ingredientes</label>
															<input type="text" name="ingredientes" id="ingredientes" class="form-control dinheiro" placeholder="R$">
														</div>
														<div class="col-md-4">
															<label for="recebido">Valor recebido</label>
															<input type="text" name="recebido" id="recebido" class="form-control dinheiro" placeholder="R$" value="<?php echo number_format($linha->soma_total,2,".",""); ?>">
														</div>
													</div>
													<br />
													<div class="row">
														<div class="col-md-12">
															<label for="tipo">Tipo de recebimento</label>
															<select name="tipo" id="tipo" class="form-control">
																<option value="">SELECIONE</option>
																<option value="Cartão de Crédito/Débito">Cartão de Crédito/Débito</option>
																<option value="Dinheiro">Dinheiro</option>
																<option value="Cheque">Cheque</option>
																<option value="Outro">Outro</option>
															</select>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
													<button type="submit" name="receive" class="btn btn-success pull-right"><i class="fa fa-check"></i> Confirmar</button>
													<input type="hidden" name="id" value="<?php echo $linha->id; ?>"/>
													<input type="hidden" name="nome" value="<?php echo $linha->nome; ?>"/>
													<input type="hidden" name="total" value="<?php echo $linha->soma_total; ?>"/>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!-- Receber -->
								
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
													<button type="submit" name="removeEvent" class="btn btn-success pull-right"><i class="fa fa-check"></i> Confirmar</button>
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