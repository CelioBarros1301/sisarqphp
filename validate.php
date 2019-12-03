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
			case 'empresa':	
					
				include_once 'empresa.html';			
			break;

			case 'manager_users':
				
				include_once 'manager_users.html';
			break;

			case 'cadempresa':
				
				include_once 'formempresa.html';
			break;
			

		}# End Switch
	}#End Funtion validate_options



?>