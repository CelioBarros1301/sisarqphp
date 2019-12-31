<?php
    session_start();
    if( isset($_SESSION['user'])){
        header("location: sisarq.php");
   }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="sidebar/css/style2.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="sidebar/css/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="fontawesome/js/solid.js"></script>
    <script defer src="fontawesome/js/fontawesome.js"></script>
    <style>
        body {
            font-family: "Lato", sans-serif;
        }



        .main-head {
            height: 150px;
            background: #FFF;

        }

        .sidenav {
            height: 100%;
            background-color: #007bff;
            overflow-x: hidden;
            padding-top: 20px;


            background-image: url('imagem/arquivo3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            /*opacity: 2.0;*/
        }


        .main {
            padding: 0px 10px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }
        }

        @media screen and (max-width: 450px) {
            .login-form {
                margin-top: 10%;
            }

            .register-form {
                margin-top: 10%;
            }
        }

        @media screen and (min-width: 768px) {
            .main {
                margin-left: 40%;
            }

            .sidenav {
                width: 40%;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
            }

            .login-form {
                margin-top: 40%;
            }

            .register-form {
                margin-top: 60%;
            }
        }


        .login-main-text {
            margin-top: 10%;
            padding: 60px;
            color: #007bff
        }

        .login-main-text h2 {
            font-weight: 300;
        }

        .btn-black {
            background-color: #000 !important;
            color: #fff;
        }
    </style>


</head>



<body>

    <div class="sidenav">
        <div class="login-main-text">
            <h1 class="text-center font-weight-bold">SISARQ</h1>
            <br><br>
            <h4 class="text-center font-weight-bold">Sistema de Gestão de Arquivo.</h4>
            <br><br>
            <h4 class="text-center font-weight-bold">Informar login e Senha para acesso ao Sistema.</h4>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">

                <form action="login.php" method="POST">
                    <div class="form-group">
                        <img src="imagem/LogoEmpresa1.jpg"
                            class="img-block img-rounded img-responsive embed-responsive-4by3l"
                            alt="LogoMarca da Empresa" style="width:100%">
                    </div>
                    <div class="form-group">
                        <label>Login</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Informar e-mail" required >
                        <?php
                            if (isset($_GET['error'])) {
                                if ( $_GET['error']=="user_not_found" ){
                                    echo '<span class="text-danger" >Usuário Não Encontrado</span>';
                                }
                                if ( $_GET['error']=="user_log" ){
                                    echo '<span class="text-danger" >Usuário logado em outra estação</span>';
                                }
                            }
                        ?>

                    </div>
                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" name="senha" class="form-control" placeholder="Informar Senha" required>
                        <?php
                            if (isset($_GET['error'])) {
                                if ( $_GET['error']=="password_incorrect" ){
                                    echo '<span class="text-danger">Senha Invalida!!!</span>';
                                }
                            }
                        ?>
                    </div>

                    <button type="submit" class="btn btn-primary">
                            Login
                    </button>
                   
                </form>
            </div>
        </div>
    </div>

    
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="jquery/jquery-3.3.1.slim.min.js"></script>
    <!-- Popper.JS -->
    <script src="jquery/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="bootstrap4/js/bootstrap.min.js"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="sidebar/js/jquery.mCustomScrollbar.concat.min.js"></script>
    
    <script src="alert2/sweetalert2.min.js"></script>
   

   <?php  
   /*
    if(!isset($_GET['error'])){ return false; }

    switch($_GET['error']){
      case "user_not_found":
        $title = "Usuário Não Encontrado";
        $subtitle = "Seu usuário nao encoontra-se na nossa base!";
        $type = "error";
      break;

      case "password_incorrect":
        $title = "Senha Incorreta";
        $subtitle = "Você errou sua senha!";
        $type = "error";
      break;

      case "access_denied":
        $title = "Acesso não Permitido";
        $subtitle = "Sai Fora";
        $type = "error";
      break;

      case "session_ending":
        $title = "Sessão Encerrada";
        $subtitle = "Sua sessão foi encerrada";
        $type = "success";
      break;

      case "easter_egg":
        $title = "Você descobriu um Easter EGG";
        $subtitle = "você será levado ao <a href='http://decifra.me'> Decifra-me </a>";
        $type = "info";
      break;

    }
*/
?>
<!--
    <script type="text/javascript">
         
         Swal.fire(
            "<?=$title;?>",
            "<?=$subtitle;?>",
            "<?=$type;?>"
        );

    </script>
    -->
</body>


</html>