<?php
	
	class Caixa {
		
		// Mensagens
		public $MsgOk;
		public $MsgNo;
		
		
		
		
	
		/////////////////////////
		// ----- INSERT ----- //
		///////////////////////
		
		// Adicionar movimento
		public function Add($descricao, $data, $dia, $mes, $ano, $categoria, $valor, $tipo, $comprovante){
			
			global $pdo;
			
			$values = explode("/", $data);
		
			$dia = $values[0];
			$mes = $values[1];
			$ano = $values[2];
			
			$data = $ano."-".$mes."-".$dia;
			
			if(!empty($comprovante['name'])){
				$nome = $comprovante['name'];
				$ext = explode(".",$nome);
				$comprovante = md5($nome).date("dmY").".".$ext[1];
				$tipo = $comprovante['type'];
				$tamanho = $comprovante['size'];
				$temp = $comprovante['tmp_name'];
				$erro = $comprovante['error'];
				
				$diretorio = '/home/fourl856/public_html/gruub.com.br/selecaodapizza/painel/uploads/comprovantes';
				
				if($erro > 0){
					echo "Houve algum problema. Código do erro: $erro";
				} else {
					if($tamanho > 2000000){
						echo "Tamanho acima do limite (2mb). Tente novamente!";
					} else {
						if(move_uploaded_file($temp,$diretorio.$comprovante)){
							$sql = "INSERT INTO movimentos (descricao_movimentos, data_movimentos, dia_movimentos, mes_movimentos, ano_movimentos, valor_movimentos, comprovante_movimentos, tipo_movimentos, categorias_id_categorias, observacoes_movimentos) VALUES (:descricao, :data, :dia, :mes, :ano, :valor, :comprovante, :tipo, :categoria, :observacoes)";
							$query = $pdo->prepare($sql);
							$query->bindValue(":descricao",$descricao);
							$query->bindValue(":data",$data);
							$query->bindValue(":dia",$dia);
							$query->bindValue(":mes",$mes);
							$query->bindValue(":ano",$ano);
							$query->bindValue(":valor",$valor);
							$query->bindValue(":tipo",$tipo);
							$query->bindValue(":comprovante",$comprovante);
							$query->bindValue(":categoria",$categoria);
							$query->bindValue(":observacoes","");
							
				
							if($query->execute()){
								$this->MsgOk = "<script type='text/javascript'>
													$(window).load(function() {

														$.howl ({
														  type: 'success'
														  , title: 'All right!'
														  , content: 'Movimento cadastrado com sucesso.'
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
						} else {
								$this->MsgNo = "<script type='text/javascript'>
														$(window).load(function() {

															$.howl ({
															  type: 'danger'
															  , title: 'Ooooops!'
															  , content: 'Erro ao fazer upload do comprovante. Tente novamente mais tarde! <strong>Se o erro persistir, entre em contato com o suporte: <u>(41) 3089-2767</u></strong>.'
															  , sticky: $(this).data ('sticky')
															  , lifetime: 7500
															  , iconCls: 'fa fa-ban'
															});
															
														});
													</script>";
						}
					}
				}
			} else {
				$sql = "INSERT INTO movimentos (descricao_movimentos, data_movimentos, dia_movimentos, mes_movimentos, ano_movimentos, valor_movimentos, comprovante_movimentos, tipo_movimentos, categorias_id_categorias, observacoes_movimentos) VALUES (:descricao, :data, :dia, :mes, :ano, :valor, :comprovante, :tipo, :categoria, :observacoes)";
				$query = $pdo->prepare($sql);
				$query->bindValue(":descricao",$descricao);
				$query->bindValue(":data",$data);
				$query->bindValue(":dia",$dia);
				$query->bindValue(":mes",$mes);
				$query->bindValue(":ano",$ano);
				$query->bindValue(":valor",$valor);
				$query->bindValue(":tipo",$tipo);
				$query->bindValue(":comprovante","");
				$query->bindValue(":categoria",$categoria);
				$query->bindValue(":observacoes","");
				
				if($query->execute()){
					$this->MsgOk = "<script type='text/javascript'>
										$(window).load(function() {

											$.howl ({
											  type: 'success'
											  , title: 'All right!'
											  , content: 'Movimento cadastrado com sucesso.'
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
		
		// Adicionar categoria
		public function AddCat($nome){
			
			global $pdo;
			
			$sql = "INSERT INTO categorias (nome_categorias) VALUES ('$nome')";
			
			$query = $pdo->prepare($sql);
			$query->bindValue(":nome",$nome);
			
			// Executa Query
			if($query->execute()){
				$this->MsgOk = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'success'
										  , title: 'All right!'
										  , content: 'Categoria cadastrada com sucesso.'
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
		
		public function Edit($descricao, $data, $dia, $mes, $ano, $categoria, $valor, $tipo, $comprovante, $id){
			
			global $pdo;
			
			$values = explode("/", $data);
		
			$dia = $values[0];
			$mes = $values[1];
			$ano = $values[2];
			
			$data = $ano."-".$mes."-".$dia;
			
			if(!empty($comprovante['name'])){
				$nome = $comprovante['name'];
				$ext = explode(".",$nome);
				$comprovante = md5($nome).date("dmY").".".$ext[1];
				$tipo = $comprovante['type'];
				$tamanho = $comprovante['size'];
				$temp = $comprovante['tmp_name'];
				$erro = $comprovante['error'];
				
				$diretorio = '/home/fourl856/public_html/gruub.com.br/selecaodapizza/painel/uploads/comprovantes';
				
				if($erro > 0){
					echo "Houve algum problema. Código do erro: $erro";
				} else {
					if($tamanho > 2000000){
						echo "Tamanho acima do limite (2mb). Tente novamente!";
					} else {
						if(move_uploaded_file($temp,$diretorio.$comprovante)){
							// Prepara a edição
							$query = $pdo->prepare("UPDATE movimentos SET descricao_movimentos = ?, data_movimentos = ?, dia_movimentos = ?, mes_movimentos = ?, ano_movimentos = ?, categorias_id_categorias = ?, valor_movimentos = ?, tipo_movimentos = ?, comprovante_movimentos = ? WHERE id_movimentos = ?");
							
							// Passa os parâmetros para executar a query
							$parametros = array($descricao, $data, $dia, $mes, $ano, $categoria, $valor, $tipo, $comprovante, $id);
			
							// Executa a query
							if($query->execute($parametros)){
								$this->MsgOk = "<script type='text/javascript'>
													$(window).load(function() {

														$.howl ({
														  type: 'success'
														  , title: 'All right!'
														  , content: 'Movimento editado com sucesso.'
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
						} else {
							$this->MsgNo = "<script type='text/javascript'>
												$(window).load(function() {

													$.howl ({
													  type: 'danger'
													  , title: 'Ooooops!'
													  , content: 'Erro ao fazer upload do comprovante. Tente novamente mais tarde! <strong>Se o erro persistir, entre em contato com o suporte: <u>(41) 3089-2767</u></strong>.'
													  , sticky: $(this).data ('sticky')
													  , lifetime: 7500
													  , iconCls: 'fa fa-ban'
													});
													
												});
											</script>";
						}
					}
				}
			} else {
				// Prepara a edição
				$query = $pdo->prepare("UPDATE movimentos SET descricao_movimentos = ?, data_movimentos = ?, dia_movimentos = ?, mes_movimentos = ?, ano_movimentos = ?, categorias_id_categorias = ?, valor_movimentos = ?, tipo_movimentos = ? WHERE id_movimentos = ?");
				
				// Passa os parâmetros para executar a query
				$parametros = array($descricao, $data, $dia, $mes, $ano, $categoria, $valor, $tipo, $id);
			
				// Executa a query
				if($query->execute($parametros)){
					$this->MsgOk = "<script type='text/javascript'>
										$(window).load(function() {

											$.howl ({
											  type: 'success'
											  , title: 'All right!'
											  , content: 'Movimento editado com sucesso.'
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
		
		public function EditCat($nome, $id){
			
			global $pdo;
			
			// Prepara a edição
			$query = $pdo->prepare("UPDATE categorias SET nome_categorias = ? WHERE id_categorias = ?");
			
			// Passa os parâmetros para executar a query
			$parametros = array($nome, $id);
			
			// Executa a query
			if($query->execute($parametros)){
				$this->MsgOk = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'success'
										  , title: 'All right!'
										  , content: 'Categoria editada com sucesso.'
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
		// ----- DELETE ----- //
		///////////////////////
		
		public function Remove($id){
			
			global $pdo;
			
			// Prepara a query
			$query = $pdo->prepare("DELETE FROM movimentos WHERE id_movimentos = ?");
			
			// Executa a query
			if($query->execute(array($id))){
				$this->MsgOk = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'success'
										  , title: 'All right!'
										  , content: 'Movimento removido com sucesso.'
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
		
		public function RemoveCat($id){
			
			global $pdo;
			
			// Prepara a query
			$query = $pdo->prepare("DELETE FROM categorias WHERE id_categorias = ?");
			
			// Executa a query
			if($query->execute(array($id))){
				$this->MsgOk = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'success'
										  , title: 'All right!'
										  , content: 'Categoria removida com sucesso.'
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