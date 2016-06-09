<?php
	
	class Foto {
		
		// Mensagens
		public $MsgOk;
		public $MsgNo;
		
		
		
		
	
		/////////////////////////
		// ----- INSERT ----- //
		///////////////////////
		
		// Adicionar evento
		public function Add($nome, $imagem, $ordem, $status){
			
			global $pdo;
			
			
			// Verifica se existe a imagem
			if(!empty($_FILES['imagem']['name'])){
			
				//INFO IMAGEM
				$file = $_FILES['imagem'];
					
				//PASTA
				$folder	= '/home/pizzaexp/public_html/painel/uploads/fotos';
						
				//REQUISITOS
				$permite = array('image/jpg', 'image/jpeg', 'image/png');
				$maxSize = 1024 * 1024 * 20;
						
				//MENSAGENS
				$msg = array();
				$errorMsg = array(
					1 => 'O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini.',
					2 => 'O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE que foi especificado no formulário HTML',
					3 => 'O upload do arquivo foi feito parcialmente',
					4 => 'Não foi feito o upload do arquivo'
				);
				
				$name = $file['name'];
				$type = $file['type'];
				$size = $file['size'];
				$error = $file['error'];
				$tmp = $file['tmp_name'];
			
				$extensao = @end(explode('.', $name));
				$novoNome = rand().".$extensao";
				
				if($error != 0){
					$msg[] = "<strong>$name :</strong> ".$errorMsg[$error];
				} else if(!in_array($type, $permite)){
					$msg[] = "<strong>$name :</strong> Erro arquivo não suportado!";
				} else if($size > $maxSize){
					$msg[] = "<strong>$name :</strong> Erro arquivo ultrapassa o limite de 10MB";
				} else {
					// Se conseguir mover o arquivo para a pasta ($folder), prosseguir
					if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
						// Prepara o cadastro
						$query = $pdo->prepare("INSERT INTO fotos (nome, imagem, ordem, status) VALUES (:nome, :imagem, :ordem, :status)");
						$query->bindValue(":nome",$nome);
						$query->bindValue(":imagem",$novoNome);
						$query->bindValue(":ordem",$ordem);
						$query->bindValue(":status",$status);
						if($query->execute()){
							$this->MsgOk = "<script type='text/javascript'>
												$(window).load(function() {

													$.howl ({
													  type: 'success'
													  , title: 'All right!'
													  , content: 'Promoção cadastrada com sucesso.'
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
				foreach($msg as $pop)
				echo $pop.'<br>';
			}
		}
		
		/////////////////////////////
		// ----- END INSERT ----- //
		///////////////////////////
		
		
		
		
		
		/////////////////////////
		// ----- UPDATE ----- //
		///////////////////////
		
		public function Edit($nome, $imagem, $ordem, $status, $id){
			
			global $pdo;
			
			// Verifica se existe a imagem
			if(!empty($_FILES['imagem']['name'])){
			
				//INFO IMAGEM
				$file = $_FILES['imagem'];
					
				//PASTA
				$folder	= '/home/pizzaexp/public_html/painel/uploads/fotos';
						
				//REQUISITOS
				$permite = array('image/jpg', 'image/jpeg', 'image/png');
				$maxSize = 1024 * 1024 * 20;
						
				//MENSAGENS
				$msg = array();
				$errorMsg = array(
					1 => 'O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini.',
					2 => 'O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE que foi especificado no formulário HTML',
					3 => 'O upload do arquivo foi feito parcialmente',
					4 => 'Não foi feito o upload do arquivo'
				);
				
				$name = $file['name'];
				$type = $file['type'];
				$size = $file['size'];
				$error = $file['error'];
				$tmp = $file['tmp_name'];
			
				$extensao = @end(explode('.', $name));
				$novoNome = rand().".$extensao";
				
				if($error != 0){
					$msg[] = "<strong>$name :</strong> ".$errorMsg[$error];
				} else if(!in_array($type, $permite)){
					$msg[] = "<strong>$name :</strong> Erro arquivo não suportado!";
				} else if($size > $maxSize){
					$msg[] = "<strong>$name :</strong> Erro arquivo ultrapassa o limite de 10MB";
				} else {
					// Se conseguir mover o arquivo para a pasta ($folder), prosseguir
					if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
						// Prepara a query
						$query = $pdo->prepare("UPDATE fotos SET nome = ?, imagem = ?, ordem = ?, status = ? WHERE id = ?");
						// Passa os parâmetros para executar a query
						$parametros = array($nome, $novoNome, $ordem, $status, $id);
						if($query->execute($parametros)){
							$this->MsgOk = "<script type='text/javascript'>
												$(window).load(function() {

													$.howl ({
													  type: 'success'
													  , title: 'All right!'
													  , content: 'Promoção editada com sucesso.'
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
				foreach($msg as $pop)
				echo $pop.'<br>';
			} else {
				// Prepara a query
				$query = $pdo->prepare("UPDATE fotos SET nome = ?, ordem = ?, status = ? WHERE id = ?");
				// Passa os parâmetros para executar a query
				$parametros = array($nome, $ordem, $status, $id);
				if($query->execute($parametros)){
					$this->MsgOk = "<script type='text/javascript'>
										$(window).load(function() {

											$.howl ({
											  type: 'success'
											  , title: 'All right!'
											  , content: 'Promoção editada com sucesso.'
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
		
		/////////////////////////////
		// ----- END UPDATE ----- //
		///////////////////////////
		
		
		
		/////////////////////////
		// ----- DELETE ----- //
		///////////////////////
		
		public function Remove($id){
			
			global $pdo;
			
			// Prepara a query
			$query = $pdo->prepare("DELETE FROM fotos WHERE id = ?");
			
			// Executa a query
			if($query->execute(array($id))){
				$this->MsgOk = "<script type='text/javascript'>
									$(window).load(function() {

										$.howl ({
										  type: 'success'
										  , title: 'All right!'
										  , content: 'Promoção removida com sucesso.'
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