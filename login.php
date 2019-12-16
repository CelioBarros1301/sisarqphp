<?php
    include_once "Usuario_Class.php";
    include_once  "usuarioPDO.php";
        
   
    #Dados dos Formularios
    $email=$_POST['email'];
    $senha=$_POST['senha'];

    #Localizar o usuario
    $usuarioPDO= new UsuarioPDO();
    $usuario=$usuarioPDO->buscaLogin($email);
    
    $error=""; 
    $login=false;
        
    if($email== $usuario['log_usuario'] and $senha==$usuario['sen_usuario'])
    {
        #Granando dados da Sessão
        session_start();
        $_SESSION['user']=$usuario;
        $login=true;
        header("location: index.php");
        
    }elseif ($email==$usuario['log_usuario'] and $senha!=$usuario['sen_usuario']){
        $error="password_incorrect";
     
    }
    if ($error=="password_incorrect"){
        header("location: index.php?error=password_incorrect");
    }elseif (!$login) {
        header("location: index.php?error=user_not_found");
    }
    
?>