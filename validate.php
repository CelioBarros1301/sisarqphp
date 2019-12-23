<?php  
    
	
	function validate_options(){
		
		
		$_SESSION['transacao']="";
		if(!isset($_GET['option'])){
			return false;
		}
		global $user;
		
		switch($_GET['option']){
			
			case "painel":				
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
					
			# arquivo
			case 'arquivo':	
				include_once 'arquivo.html';			
			break;

			case 'cadarquivo':
				include_once 'formarquivo.html';
			break;
			
			# corredor
			case 'corredor':	
				include_once 'corredor.html';			
			break;

			case 'cadcorredor':
				include_once 'formcorredor.html';
			break;

			# estante
			case 'estante':	
				include_once 'estante.html';			
			break;

			case 'cadestante':
				include_once 'formestante.html';
			break;





			case 'manager_users':
				
				include_once 'manager_users.html';
			break;
			default:
				echo "Erro: 404 - Pagina Não encontrada";
		break;
			
			


		}# End Switch
	}#End Funtion validate_options


	function transacao(){
		
		
		$_SESSION['transacao']="";
		if(!isset($_GET['option'])){
			return false;
		}
		global $user;
		
		switch($_GET['option']){
			
			
			# Empresa
			case 'empresa':	
				$_SESSION['transacao']="Empresas";
			break;

			case 'cadempresa':
				$_SESSION['transacao']="Empresas";
			break;

			# Autorizado
			case 'autorizado':	
				$_SESSION['transacao']="Autorizados";	
			break;

			case 'cadautorizado':
				$_SESSION['transacao']="Autorizados";
			break;
			
			
			# arquivo
			case 'arquivo':	
				$_SESSION['transacao']="Arquivos";				
			break;

			case 'cadarquivo':
				$_SESSION['transacao']="Arquivos";	
			break;
			
			# corredor
			case 'corredor':	
				$_SESSION['transacao']="Corredores";				
			break;

			case 'cadcorredor':
				$_SESSION['transacao']="Corredores";	
			break;
	
			
			# usuario
			case 'usuario':	
				$_SESSION['transacao']="Usuarios";	
			break;

			case 'cadusuario':
				$_SESSION['transacao']="Usuarios";
			break;
					
			
			case 'manager_users':
				
				include_once 'manager_users.html';
			break;

			
			


		}# End Switch
	}#End Funtion validate_options


?>