<?php

    # Informacoes do banco
    include_once  "database.php";
    
    #Recuperando os dados do TXT de Users

    $users_f= file("users.txt");
    if ($users_f){
        # Tratamento dados txt 
        foreach ($$users_f as $key => $value) {
            # code...
            $value=substr($value,0,-1);
            $users_r[$key]=explode(" - ",$value);
        }
        $users=array_merge($users,$users_r);
    }

    #Dados dos Formularios
    $email=$_POST['email'];
    $senha=$_POST['senha'];

    #Localizar o usuario

    foreach ( $user as $usuario){
        if($email== $usuario[1] and $senha==$usuario[2]){

            #Granando dados da Sessão
            session_start();
            $_SESSION['user']=$usuario;
            $login=true;
            header("location: index.php");
        }elseif ($email==$usuario[1] and $senha!=$usuario[2]){
            $error="password_incorrect";
            break;
        }
    }
    if ($error==password_incorrect){
        header("location: index.php?error=password_incorrect");
    }elseif (!$login) {
        header("location: index.php?error=user_not_found");
    }
?>