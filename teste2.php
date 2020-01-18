<?php


   
    include_once "menuPDO.php";

    $menuPDO= new MenuPDO();

    $menu=$menuPDO->lista(1);
    $ulFechamento=false;
    $html='<ul class="list-unstyled components">';
    $inicioItem=true;
    $item="";
    
    foreach ($menu  as  $opcao) {
        
        if ( $opcao['sta_menu']=='1' )
        {
            if ($inicioItem)
            {
                $item=substr($opcao['seq_menu'],0,2);
                $inicioItem=false;
            }
            if ( $item!=substr($opcao['seq_menu'],0,2) && $ulFechamento )
            {
                $item=$opcao['seq_menu'];
                $ulFechamento=false;
                $html.= "</ul>";
            }
            if ($opcao['tipo_menu']=='1')
            {
                $html.= '<li class="">';
                $html.= '<a href=?option='.$opcao['href_menu'].'><i class="'. $opcao['icone_menu'].'"></i> '.$opcao['nome_menu'].'</a>';
                $html.= '</li>';
            }
            if ($opcao['tipo_menu']=='0')
            {
                $subMenu='SubMenu'.$opcao['nome_menu'];
                $html.= '<li class="">';
                $html.= '<a href="#'.$subMenu.'" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">'.$opcao['nome_menu'].'</a>';
                $html.= '<ul class="collapse list-unstyled" id="'.$subMenu.'">';
                $ulFechamento=true;
                $item=substr($opcao['seq_menu'],0,2);
            }
        }
    }
    $html.= '</ul>';
      
?>

DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Sistema de Controle de Arquivo Morto</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">


    <link rel="stylesheet" type="text/css" href="datatable/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="datatable/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="datatable/css/fixedHeader.dataTables.min.css">
    

    
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="sidebar/css/style2.css">
    
    <link rel="stylesheet" href="sidebar/css/jquery.mCustomScrollbar.min.css">

      
    <link rel="icon" type="image/png" href="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-ios7-bolt-512.png"/>
    <!-- Fixar Head dataTbale-->
    <script type="text/javascript" src="bootstrap4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="bootstrap4/js/bootstrap.bundle.min.js"></script>
   
</head>



<body>
    <div>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="imagem/LogoEmpresa.jpg" class="img-rounded img-responsive img-thumbnail" alt="LogoMarca da Empresa"> 
                <h1>M E N U </h1>
            </div>
            <?php 
                echo $html ;
            ?>
     
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fa fa-align-left"></i>
                        <span>Mostrar/Encolher Menu</span>
                    </button>
                    <!--<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                     -->
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i> Sair</a>
                        </li>
                    </ul>
         
            </nav>
        
            <!-- FUNÇÃO GERENCIADORA DE CONTEUDO -->
            
           
        </div>
    </div>


    <script type="text/javascript" src="jquery/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/sistema.js"></script>

    <script type="text/javascript" src="bootstrap4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="sidebar/js/jquery.mCustomScrollbar.concat.min.js"></script>

    
    <script type="text/javascript" src="bootstrap4/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="datatable/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="datatable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="datatable/js/dataTables.buttons.min.js"></script>
        

</body>

</html>

