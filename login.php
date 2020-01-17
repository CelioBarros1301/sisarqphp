<?php
    include_once "Usuario_Class.php";
    include_once  "usuarioPDO.php";
        
   
    #Dados dos Formularios
    $email=$_POST['email'];
    $senha=base64_encode($_POST['senha']);
    
    #Localizar o usuario
    $usuarioPDO= new UsuarioPDO();
    $registro=$usuarioPDO->buscaLogin($email);

    $logado = isset($_COOKIE['CookieAcesso']) ? $_COOKIE['CookieAcesso'] : '';

    
    if (!$registro)
    {
        header("location: index.php?error=user_not_found");
    } 
    elseif(! ( $senha==$registro['sen_usuario'])) {
        header("location: index.php?error=password_incorrect");  
    }
    elseif ($registro['sta_usuario']!=$logado && $registro['sta_usuario']!="" ){
        header("location: index.php?error=user_log");
    }
    elseif ($registro['sta_usuario']=$logado && $registro['sta_usuario']!=""){
        session_start();
        $_SESSION['user']=$registro;
        echo "Logado";
        header("location: index.php");
    }
    else
    {
        #Granando dados da Sessão
        session_start();
        $_SESSION['user']=$registro;
        $login=true;
        $usuario=new Usuario();
        
        # Gravando Cookie

        $expira = time() + 60*60*24*30; 
        $hora   = base64_encode(time());
        setCookie('CookieAcesso', $hora, $expira);

        $usuario->setCodigo($registro['id_usu']);
        $usuario->setLogin($registro['log_usuario']);
        $usuario->setSenha(base64_decode($registro['sen_usuario']));
        $usuario->setPerfil($registro['per_usuario']);
        $usuario->setStatus($hora);
        $registro=$usuarioPDO->update($usuario);
        # Gravando Cookie

        header("location: index.php");
    }
    
?>