<?php
	
	class Evento {
		
		// Mensagens
		public $MsgOk;
		public $MsgNo;
		
		
		
		
	
		/////////////////////////
		// ----- INSERT ----- //
		///////////////////////
		
		// Adicionar evento
		public function Add($nome, $email, $dia, $mes, $ano, $hora_chegada, $hora_inicio, $hora_termino, $telefone, $celular, $adultos, $valor_adulto, $criancas, $valor_crianca, $endereco, $bairro, $cidade, $porta_pizza, $deslocamento, $pizzaiolo, $garcom, $observacoes, $observacoes_interno, $status, $soma_adultos, $soma_criancas, $soma_total, $data_cadastro){
			
			global $pdo;
			
			$sql = "INSERT INTO eventos (nome, email, dia, mes, ano, hora_chegada, hora_inicio, hora_termino, telefone, celular, adultos, valor_adulto, criancas, valor_crianca, endereco, bairro, cidade, porta_pizza, deslocamento, pizzaiolo, garcom, observacoes, observacoes_interno, status, soma_adultos, soma_criancas, soma_total, data_cadastro) 
					VALUES (:nome, :email, :dia, :mes, :ano, :hora_chegada, :hora_inicio, :hora_termino, :telefone, :celular, :adultos, :valor_adulto, :criancas, :valor_crianca, :endereco, :bairro, :cidade, :porta_pizza, :deslocamento, :pizzaiolo, :garcom, :observacoes, :observacoes_interno, :status, :soma_adultos, :soma_criancas, :soma_total, :data_cadastro)";
			
			$query = $pdo->prepare($sql);
			$query->bindValue(":nome",$nome);
			$query->bindValue(":email",$email);
			$query->bindValue(":dia",$dia);
			$query->bindValue(":mes",$mes);
			$query->bindValue(":ano",$ano);
			$query->bindValue(":hora_chegada",$hora_chegada);
			$query->bindValue(":hora_inicio",$hora_inicio);
			$query->bindValue(":hora_termino",$hora_termino);
			$query->bindValue(":telefone",$telefone);
			$query->bindValue(":celular",$celular);
			$query->bindValue(":adultos",$adultos);
			$query->bindValue(":valor_adulto",$valor_adulto);
			$query->bindValue(":criancas",$criancas);
			$query->bindValue(":valor_crianca",$valor_crianca);
			$query->bindValue(":endereco",$endereco);
			$query->bindValue(":bairro",$bairro);
			$query->bindValue(":cidade",$cidade);
			$query->bindValue(":porta_pizza",$porta_pizza);
			$query->bindValue(":deslocamento",$deslocamento);
			$query->bindValue(":pizzaiolo",$pizzaiolo);
			$query->bindValue(":garcom",$garcom);
			$query->bindValue(":observacoes",$observacoes);
			$query->bindValue(":observacoes_interno",$observacoes_interno);
			$query->bindValue(":status",$status);
			$query->bindValue(":soma_adultos",$soma_adultos);
			$query->bindValue(":soma_criancas",$soma_criancas);
			$query->bindValue(":soma_total",$soma_total);
			$query->bindValue(":data_cadastro",$data_cadastro);
			
			// Executa Query
			if($query->execute()){
				$this->MsgOk = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'success'
										  , title: 'All right!'
										  , content: 'Evento cadastrado com sucesso.'
										  , sticky: $(this).data ('sticky')
										  , lifetime: 7500
										  , iconCls: 'fa fa-check-square-o'
										});
										
									});
								</script>";
			} else {
				$this->MsgNo = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'danger'
										  , title: 'Ooooops!'
										  , content: 'Algo deu errado por aqui... Tente novamente mais tarde! <strong>Se o erro persistir, entre em contato com o suporte: <u>(41) 3089-2767</u></strong>.'
										  , sticky: $(this).data ('sticky')
										  , lifetime: 7500
										  , iconCls: 'fa fa-ban'
										});
										
									});
								</script>";
			}
		}
		
		/////////////////////////////
		// ----- END INSERT ----- //
		///////////////////////////
		
		
		
		
		
		/////////////////////////
		// ----- UPDATE ----- //
		///////////////////////
		
		public function Edit($nome, $email, $dia, $mes, $ano, $hora_chegada, $hora_inicio, $hora_termino, $telefone, $celular, $adultos, $valor_adulto, $criancas, $valor_crianca, $endereco, $bairro, $cidade, $porta_pizza, $deslocamento, $pizzaiolo, $garcom, $observacoes, $observacoes_interno, $status, $soma_adultos, $soma_criancas, $soma_total, $id){
			
			global $pdo;
			
			// Prepara a edição
			$query = $pdo->prepare("UPDATE eventos SET nome = ?, email = ?, dia = ?, mes = ?, ano = ?, hora_chegada = ?, hora_inicio = ?, hora_termino = ?, telefone = ?, celular = ?, adultos = ?, valor_adulto = ?, criancas = ?, valor_crianca = ?, endereco = ?, bairro = ?, cidade = ?, porta_pizza = ?, deslocamento = ?, pizzaiolo = ?, garcom = ?, observacoes = ?, observacoes_interno = ?, status = ?, soma_adultos = ?, soma_criancas = ?, soma_total = ? WHERE id = ?");
			
			// Passa os parâmetros para executar a query
			$parametros = array($nome, $email, $dia, $mes, $ano, $hora_chegada, $hora_inicio, $hora_termino, $telefone, $celular, $adultos, $valor_adulto, $criancas, $valor_crianca, $endereco, $bairro, $cidade, $porta_pizza, $deslocamento, $pizzaiolo, $garcom, $observacoes, $observacoes_interno, $status, $soma_adultos, $soma_criancas, $soma_total, $id);
			
			// Executa a query
			if($query->execute($parametros)){
				$this->MsgOk = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'success'
										  , title: 'All right!'
										  , content: 'Evento editado com sucesso.'
										  , sticky: $(this).data ('sticky')
										  , lifetime: 7500
										  , iconCls: 'fa fa-check-square-o'
										});
										
									});
								</script>";
			} else {
				$this->MsgNo = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'danger'
										  , title: 'Ooooops!'
										  , content: 'Algo deu errado por aqui... Tente novamente mais tarde! <strong>Se o erro persistir, entre em contato com o suporte: <u>(41) 3089-2767</u></strong>.'
										  , sticky: $(this).data ('sticky')
										  , lifetime: 7500
										  , iconCls: 'fa fa-ban'
										});
										
									});
								</script>";
			}
			
		}
		
		/////////////////////////////
		// ----- END UPDATE ----- //
		///////////////////////////
		
		
		
		
		
		/////////////////////////
		// ----- CONFIRM ----- //
		///////////////////////
		
		public function Confirm($status, $id){
			
			global $pdo;
			
			// Prepara a edição
			$query = $pdo->prepare("UPDATE eventos SET status = ? WHERE id = ?");
			
			// Passa os parâmetros para executar a query
			$parametros = array($status, $id);
			
			// Executa a query
			if($query->execute($parametros)){
				$this->MsgOk = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'success'
										  , title: 'All right!'
										  , content: 'Evento confirmado com sucesso.'
										  , sticky: $(this).data ('sticky')
										  , lifetime: 7500
										  , iconCls: 'fa fa-check-square-o'
										});
										
									});
								</script>";
			} else {
				$this->MsgNo = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'danger'
										  , title: 'Ooooops!'
										  , content: 'Algo deu errado por aqui... Tente novamente mais tarde! <strong>Se o erro persistir, entre em contato com o suporte: <u>(41) 3089-2767</u></strong>.'
										  , sticky: $(this).data ('sticky')
										  , lifetime: 7500
										  , iconCls: 'fa fa-ban'
										});
										
									});
								</script>";
			}
			
		}
		
		public function EmailConfirm($status, $id){
			
			global $pdo;
			
			$query = $pdo->prepare("SELECT * FROM eventos WHERE id = {$id}");
			
			if($query->execute()){
				$linha = $query->fetch(PDO::FETCH_OBJ);
				
				$subject = 'Seleção da Pizza - Confirmação de evento';
				$from = 'contato@selecaodapizza.com.br';
				$to = $linha->email;
				$bcc = null; // Esconder endereços de e-mails.
				$cc = null; // Qualquer destinatário pode ver os endereços de e-mail especificados nos campos To e Cc.
				$message = 'Olá ' . $linha->nome . ', <br /><br />';
				$message .= 'Você está recebendo este e-mail para confirmação dos dados para o evento solicitado. <br /><br />';
				$message .= 'Por favor, confira todos os dados abaixo: <br /><br />';
				$message .= '<strong>Nome do contratante:</strong> ' . $linha->nome . ' <br />';
				$message .= '<strong>Data do evento:</strong> '.$linha->dia.'/'.$linha->mes.'/'.$linha->ano.' <br />';
				$message .= '<strong>Hora de chegada:</strong> '.$linha->hora_chegada.' <br />';
				$message .= '<strong>Hora de início:</strong> '.$linha->hora_inicio.' <br />';
				$message .= '<strong>Hora de término:</strong> '.$linha->hora_termino.' <br />';
				$message .= '<strong>Qtd. Adultos:</strong> '.$linha->adultos.' <i>(R$'.number_format($linha->valor_adulto,2,",",".").'/adulto)</i> <br />';
				$message .= '<strong>Qtd. Crianças:</strong> '.$linha->criancas.' <i>(R$'.number_format($linha->valor_crianca,2,",",".").'/criança)</i> <br /><br />';
				$message .= 'LOCAL DO EVENTO <br />';
				$message .= '<strong>Endereço:</strong> '.$linha->endereco.' <br />';
				$message .= '<strong>Bairro:</strong> '.$linha->bairro.' <br />';
				$message .= '<strong>Cidade:</strong> '.$linha->cidade.' <br /><br />';
				$message .= 'ADICIONAIS DO EVENTO: <br />';
				$message .= '<strong>Porta Pizza:</strong> '.$linha->porta_pizza.' <br />';
				$message .= '<strong>Taxa de Deslocamento:</strong> '.$linha->deslocamento.' <br /><br />';
				$message .= '<strong>VALOR TOTAL DO EVENTO: R$'.number_format($linha->soma_total,2,",",".").'</strong> <br /><br />';
				$message .= 'Se você está ciente e de acordo com os dados descritos acima, por favor, <a href="http://www.selecaodapizza.com.br/confirmEvent.php?codAuth='.$linha->id.','.base64_encode($linha->email).'" title="Clique aqui para confirmar seu evento">clique aqui para confirmar seu evento</a>. <br /><br />';
				$message .= 'Se você tiver qualquer dúvida, por favor, responda este e-mail ou entre em contato conosco através do telefone: <strong>(41) 3354-9889</strong>. <br /><br />';
				$message .= 'Atenciosamente, <br />';
				$message .= '<strong>Seleção da Pizza</strong> <br />';
				$message .= '(41) 3354-9889 <br />';
				$message .= '<a href="http://www.selecaodapizza.com.br" title="Seleção da Pizza">Visite nosso site</a>';
				
				$headers = sprintf( 'Date: %s%s', date( "D, d M Y H:i:s O" ), PHP_EOL );
				$headers .= sprintf( 'Return-Path: %s%s', $from, PHP_EOL );
				$headers .= sprintf( 'To: %s%s', $to, PHP_EOL );
				$headers .= sprintf( 'Cc: %s%s', $cc, PHP_EOL );
				$headers .= sprintf( 'Bcc: %s%s', $bcc, PHP_EOL );
				$headers .= sprintf( 'From: %s%s', $from, PHP_EOL );
				$headers .= sprintf( 'Reply-To: %s%s', $from, PHP_EOL );
				$headers .= sprintf( 'Message-ID: <%s@%s>%s', md5( uniqid( rand( ), true ) ), $_SERVER[ 'HTTP_HOST' ], PHP_EOL );
				$headers .= sprintf( 'X-Priority: %d%s', 3, PHP_EOL );
				$headers .= sprintf( 'X-Mailer: PHP/%s%s', phpversion( ), PHP_EOL );
				$headers .= sprintf( 'Disposition-Notification-To: %s%s', $from, PHP_EOL );
				$headers .= sprintf( 'MIME-Version: 1.0%s', PHP_EOL );
				$headers .= sprintf( 'Content-Transfer-Encoding: 8bit%s', PHP_EOL );
				$headers .= sprintf( 'Content-Type: text/html; charset="UTF-8"%s', PHP_EOL );
				
				if(mail( null, $subject, $message, $headers )){
					
					// Prepara a query
					$query2 = $pdo->prepare("UPDATE eventos SET status = ? WHERE id = ?");
					
					// Passa os parâmetros para executar a query
					$parametros = array($status, $id);
					
					// Executa a query
					if($query2->execute($parametros)){
						$this->MsgOk = "<script type='text/javascript'>
											$(window).load(function() {

												$.howl ({
												  type: 'success'
												  , title: 'All right!'
												  , content: 'E-mail enviado com sucesso.'
												  , sticky: $(this).data ('sticky')
												  , lifetime: 7500
												  , iconCls: 'fa fa-check-square-o'
												});
												
											});
										</script>";
					} else {
						$this->MsgNo = "<script type='text/javascript'>
											$(window).load(function() {

												$.howl ({
												  type: 'danger'
												  , title: 'Ooooops!'
												  , content: 'Algo deu errado por aqui... Tente novamente mais tarde! <strong>Se o erro persistir, entre em contato com o suporte: <u>(41) 3089-2767</u></strong>.'
												  , sticky: $(this).data ('sticky')
												  , lifetime: 7500
												  , iconCls: 'fa fa-ban'
												});
												
											});
										</script>";
					}
					
				}
			
			}
			
		}
		
		/////////////////////////////
		// ----- END CONFIRM ----- //
		///////////////////////////
		
		
		
		
		
		/////////////////////////
		// ----- RECEIVE ----- //
		///////////////////////
		
		public function Receive($equipe, $ingredientes, $recebido, $total, $tipo, $nome, $observacoes, $status, $id){
			
			global $pdo;
			
			// Prepara a edição
			$query = $pdo->prepare("UPDATE eventos SET status = ? WHERE id = ?");
			
			// Passa os parâmetros para executar a query
			$parametros = array($status, $id);
			
			// Executa a query
			if($query->execute($parametros)){
				
				$data = date("Y-m-d");
				$dia = date("d");
				$mes = date("m");
				$ano = date("Y");
				
				$custo = $equipe + $ingredientes;
				$valor = $recebido - $custo;
				
				$observacoes = "Custo equipe: <strong>R$" . number_format($equipe,2,',','.') . "</strong><br />";
				$observacoes .= "Custo ingredientes: <strong>R$" . number_format($ingredientes,2,',','.') . "</strong><br />";
				$observacoes .= "Valor total do evento: <strong>R$" . number_format($total,2,',','.') . "</strong><br />";
				$observacoes .= "Valor recebido: <strong>R$" . number_format($recebido,2,',','.') . "</strong><br />";
				$observacoes .= "Tipo de recebimento: <strong>" . $tipo . "</strong><br /><br />";
				$observacoes .= "<font style='color: green;'>Receita total deste evento: <strong>R$" . number_format($valor,2,',','.') . "</strong></font><br />";
				$observacoes .= "<font style='color: red;'>Custo total deste evento: <strong>R$" . number_format($custo,2,',','.') . "</strong></font>";
				
				$query2 = $pdo->prepare("INSERT INTO movimentos (descricao_movimentos, data_movimentos, dia_movimentos, mes_movimentos, ano_movimentos, valor_movimentos, tipo_movimentos, categorias_id_categorias, observacoes_movimentos) VALUES (:descricao, :data, :dia, :mes, :ano, :valor, :tipo, :categoria, :observacoes)");
				$query2->bindValue(":descricao","Evento #" . $id . " (" . $nome . ")");
				$query2->bindValue(":data",$data);
				$query2->bindValue(":dia",$dia);
				$query2->bindValue(":mes",$mes);
				$query2->bindValue(":ano",$ano);
				$query2->bindValue(":valor",$valor);
				$query2->bindValue(":tipo","receita");
				$query2->bindValue(":categoria",1);
				$query2->bindValue(":observacoes",$observacoes);
				
				if($query2->execute()){
					$this->MsgOk = "<script type='text/javascript'>
										$(window).load(function() {

											$.howl ({
											  type: 'success'
											  , title: 'All right!'
											  , content: 'Evento recebido e registrado no caixa com sucesso.'
											  , sticky: $(this).data ('sticky')
											  , lifetime: 7500
											  , iconCls: 'fa fa-check-square-o'
											});
											
										});
									</script>";
				} else {
					$this->MsgNo = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'danger'
										  , title: 'Ooooops!'
										  , content: 'Não foi possível receber e registrar este evento no caixa. Tente novamente mais tarde! <strong>Se o erro persistir, entre em contato com o suporte: <u>(41) 3089-2767</u></strong>.'
										  , sticky: $(this).data ('sticky')
										  , lifetime: 7500
										  , iconCls: 'fa fa-ban'
										});
										
									});
								</script>";
				}
			} else {
				$this->MsgNo = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'danger'
										  , title: 'Ooooops!'
										  , content: 'Algo deu errado por aqui... Tente novamente mais tarde! <strong>Se o erro persistir, entre em contato com o suporte: <u>(41) 3089-2767</u></strong>.'
										  , sticky: $(this).data ('sticky')
										  , lifetime: 7500
										  , iconCls: 'fa fa-ban'
										});
										
									});
								</script>";
			}
			
		}
		
		/////////////////////////////
		// ----- END CONFIRM ----- //
		///////////////////////////
		
		
		
		/////////////////////////
		// ----- DELETE ----- //
		///////////////////////
		
		public function Remove($id){
			
			global $pdo;
			
			// Prepara a query
			$query = $pdo->prepare("DELETE FROM eventos WHERE id = ?");
			
			// Executa a query
			if($query->execute(array($id))){
				$this->MsgOk = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'success'
										  , title: 'All right!'
										  , content: 'Evento removido com sucesso.'
										  , sticky: $(this).data ('sticky')
										  , lifetime: 7500
										  , iconCls: 'fa fa-check-square-o'
										});
										
									});
								</script>";
			} else {
				$this->MsgNo = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'danger'
										  , title: 'Ooooops!'
										  , content: 'Algo deu errado por aqui... Tente novamente mais tarde! <strong>Se o erro persistir, entre em contato com o suporte: <u>(41) 3089-2767</u></strong>.'
										  , sticky: $(this).data ('sticky')
										  , lifetime: 7500
										  , iconCls: 'fa fa-ban'
										});
										
									});
								</script>";
			}
			
		}
		
		/////////////////////////////
		// ----- END DELETE ----- //
		///////////////////////////
		
	}