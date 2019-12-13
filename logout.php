<?php  
include_once "Conexao_Class.php";

	# Abrir a sessão
	session_start();

	# Destruindo a sessão
	session_destroy();

	# Redirecionamento
	$conexao=Conexao::getConnection();
	$conecao=null;
	header("location: index.php?error=session_ending");
      

?>