<?php
	
	class Cliente {
		
		// Mensagens
		public $MsgOk;
		public $MsgNo;
		
		
		
		
	
		/////////////////////////
		// ----- INSERT ----- //
		///////////////////////
		
		// Adicionar evento
		public function Add($nome, $email, $telefone, $celular, $aniversario, $status){
			
			global $pdo;
			
			$sql = "INSERT INTO clientes (nome, email, telefone, celular, aniversario, status) 
					VALUES (:nome, :email, :telefone, :celular, :aniversario, :status)";
			
			$query = $pdo->prepare($sql);
			$query->bindValue(":nome",$nome);
			$query->bindValue(":email",$email);
			$query->bindValue(":telefone",$telefone);
			$query->bindValue(":celular",$celular);
			$query->bindValue(":aniversario",$aniversario);
			$query->bindValue(":status",$status);
						
			// Executa Query
			if($query->execute()){
				$this->MsgOk = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'success'
										  , title: 'All right!'
										  , content: 'Cliente cadastrado com sucesso.'
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
		
		public function Edit($nome, $email, $telefone, $celular, $aniversario, $status, $id){
			
			global $pdo;
			
			// Prepara a edição
			$query = $pdo->prepare("UPDATE clientes SET nome = ?, email = ?, telefone = ?, celular = ?, aniversario = ?, status = ? WHERE id = ?");
			// Passa os parâmetros para executar a query
			$parametros = array($nome, $email, $telefone, $celular, $aniversario, $status, $id);
			
			// Executa a query
			if($query->execute($parametros)){
				$this->MsgOk = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'success'
										  , title: 'All right!'
										  , content: 'Cliente editado com sucesso.'
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
			$query = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
			
			// Executa a query
			if($query->execute(array($id))){
				$this->MsgOk = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'success'
										  , title: 'All right!'
										  , content: 'Cliente removido com sucesso.'
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