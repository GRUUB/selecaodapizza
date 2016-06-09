<?php
	
	class Usuario {
		
		// Mensagens
		public $MsgOk;
		public $MsgNo;
		
		
		
		
	
		/////////////////////////
		// ----- INSERT ----- //
		///////////////////////
		
		// Adicionar evento
		public function Add($nome, $email, $login, $senha, $status){
			
			global $pdo;
			
			$sql = "INSERT INTO usuarios (nome, email, login, senha, status) 
					VALUES (:nome, :email, :login, :senha, :status)";
			
			$query = $pdo->prepare($sql);
			$query->bindValue(":nome",$nome);
			$query->bindValue(":email",$email);
			$query->bindValue(":login",$login);
			$query->bindValue(":senha",$senha);
			$query->bindValue(":status",$status);
						
			// Executa Query
			if($query->execute()){
				$this->MsgOk = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'success'
										  , title: 'All right!'
										  , content: 'Usuário cadastrado com sucesso.'
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
		
		public function Edit($nome, $email, $login, $senha, $status, $id){
			
			global $pdo;
			
			// Prepara a edição
			if($senha != ""){
				$query = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, login = ?, senha = ?, status = ? WHERE id = ?");
				// Passa os parâmetros para executar a query
				$parametros = array($nome, $email, $login, $senha, $status, $id);
			} else {
				$query = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, login = ?, status = ? WHERE id = ?");
				// Passa os parâmetros para executar a query
				$parametros = array($nome, $email, $login, $status, $id);
			}
			
			// Executa a query
			if($query->execute($parametros)){
				$this->MsgOk = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'success'
										  , title: 'All right!'
										  , content: 'Usuário editado com sucesso.'
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
			$query = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
			
			// Executa a query
			if($query->execute(array($id))){
				$this->MsgOk = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'success'
										  , title: 'All right!'
										  , content: 'Usuário removido com sucesso.'
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
										
										setTimeout('location.reload();', 2000);
										
									});
								</script>";
			}
			
		}
		
		/////////////////////////////
		// ----- END DELETE ----- //
		///////////////////////////
		
	}