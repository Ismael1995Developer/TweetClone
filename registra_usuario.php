<?php 
	
	require_once('db.class.php');

$usuario = $_POST['usuario'];
$email   =  $_POST['email'];
$senha   = md5($_POST['senha']);

	$objDB = new db();
	$link = $objDB->conecta_mysql();

	$usuario_existe = false;
	$email_existe = false;

	//verificar se o usuário já 
	
	$sql = " SELECT * from usuarios where usuario = '$usuario' ";
		if($resultado_id = mysqli_query($link, $sql)){

			$dados_usuario = mysqli_fetch_array($resultado_id);

			if(isset($dados_usuario['usuario'])){
				$usuario_existe = true;
			}

		}else {
			echo 'Erro viado tenta de novo';
		}
	
	//verificar se o e-mail já

		$sql = " SELECT * from usuarios where email = '$email' ";
		if($resultado_id = mysqli_query($link, $sql)){

			$dados_usuario = mysqli_fetch_array($resultado_id);

			if(isset($dados_usuario['email'])){
				$email_existe = true;
			}

		}else {
			echo 'Erro viado tenta de novo';
		}

		if ($usuario_existe || $email_existe) {

			$returno_get = '';

			if ($usuario_existe) {
				$returno_get.="erro_usuario=1&";
				// code...
			}

			if ($email_existe) {
				$returno_get.="erro_email=1&";
				// code...
			}

			 header('Location: inscrevase.php?'.$returno_get);
			 die();
		}

		

	$sql = "insert into usuarios(usuario, email, senha) values('$usuario','$email','$senha ')";

	// executar a query

	if(mysqli_query($link , $sql)){

		echo "Usuario registrado com sucesso!";
	}else{
		echo "erro ao registrar o usuario!";
	}

?>