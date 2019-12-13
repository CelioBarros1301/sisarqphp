<?php  

	
	function validate_options(){
			
		if(!isset($_GET['option'])){
			return false;
		}
		global $user;
		
		switch($_GET['option']){
			
			case "painel":				
				$users = count(file("users.txt"));
				include_once 'painel.html';
			break;

			/** 
			* Essa opção faz a inclusão do arquivo html que nada mais é o fomulário de cadastro de usuários
			**/

			# Empresa
			case 'empresa':	
					
				include_once 'empresa.html';			
			break;

			case 'cadempresa':
				
				include_once 'formempresa.html';
			break;

			# Autorizado
			case 'autorizado':	
					
				include_once 'autorizado.html';			
			break;

			case 'cadautorizado':
				
				include_once 'formautorizado.html';
			break;
			
			# usuario
			case 'usuario':	
					
				include_once 'usuario.html';			
			break;

			case 'cadusuario':
				
				include_once 'formusuario.html';
			break;
					
			
			case 'manager_users':
				
				include_once 'manager_users.html';
			break;

			
			


		}# End Switch
	}#End Funtion validate_options



?>