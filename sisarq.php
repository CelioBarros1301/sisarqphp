<?php  

	# Incluindo os arquivos necessários
	include_once "validate.php";
	##include_once "helpers.php";

	# Testando a session
	session_start();
	if(!isset($_SESSION['user'])){
		header("location: index.php?error=access_denied");
	}
	
	# Recuperando os dados da sessão
	$user = $_SESSION['user'];
    
	$page_title = "Usuario: ".$user['log_usuario'];

	# Criando a função de gerenciamento
	function page_content(){
		validate_options();
	}

	# Incluindo o arquivo de layout
	include_once 'template.html';

?>
