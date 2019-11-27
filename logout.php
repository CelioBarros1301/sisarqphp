<?php  

	# Abrir a sessão
	session_start();

	# Destruindo a sessão
	session_destroy();

	# Redirecionamento
	header("location: index.php?error=session_ending");


?>