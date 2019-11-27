<?php

    
    if ( !isset($_SESSION['user'])){
    #    header("location: index.php");
    }

    # Informacoes do banco
    include_once  "database.php";
    var_dump($empresas);
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
    <!-- Our Custom CSS 
    <link rel="stylesheet" href="sidebar/css/style2.css">
    
    <link rel="stylesheet" href="sidebar/css/jquery.mCustomScrollbar.min.css">
    -->
    <link rel="stylesheet" type="text/css" href="fontawesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="datatable/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="datatable/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="datatable/css/fixedHeader.dataTables.min.css">
    
    <!--
    <link rel="stylesheet" type="text/css" href="datatable/css/dataTables.bootstrap4.min.css">
    -->
    <!-- Fixar Head dataTbale-->
   
    <script type="text/javascript" src="datatable/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="datatable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="datatable/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="datatable/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="datatable/js/jszip.min.js"></script>
    <script type="text/javascript" src="datatable/js/pdfmake.min.js"></script>
    <script type="text/javascript" src="datatable/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="datatable/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="datatable/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="datatable/js/dataTables.fixedHeader.min.js"></script>


   
    <style>
        
    </style>
</head>




<body>

    <div class="container">
        <div class="row">
            <div class="cols-sm-8 offset-4">
                <form action="" method="POST">
                    <a href="formempresa.php?rotina=Cadastro de empresa" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o" aria-hidden="true"></i> Novo</a>
                    
                    <button class="btn btn-primary btn-xs"><i class="fa fa-search" aria-hidden="true"></i> Filtro </button>
                
                    <table
                        class="table compact table-fixed table-striped table-bordered table-hover table-sm dt-responsive nowrap"
                        style="width:100%" id="tbempresa">

                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Empresa</th>
                                <th>Ações</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                               foreach ($empresas as $codigo=> $nome) {
                                   echo "<tr>";
                                   echo "<td>{$codigo}</td>";
                                   echo "<td>{$nome}</td>";
                                   echo '<td><button name="edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>';
                                   echo '<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>';
                                   echo "</tr>";
                               } 


                            ?>
                           
                        </tbody>

                    </table>
                </form>
            </div>
        </div>
    </div>

</body>

<script type="text/javascript" src="jquery/jquery-3.3.1.js"></script>
<script type="text/javascript" src="jquery/popper.min.js"></script>

<script type="text/javascript" src="bootstrap4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="bootstrap4/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript" src="sidebar/js/jquery.mCustomScrollbar.concat.min.js"></script>

<!--
<script type="text/javascript" src="datatable/js/buttons.colVis.min.js"></script>
-->
<script>
    $(document).ready(function () {
        $('#tbempresa').dataTable({
            "lengthMenu": [5, 10, 25, 50, 75, 100, 150, 200],
            "pageLength": 10,
            "responsive": true,

            "language":{
				    "sEmptyTable": "Nenhum registro encontrado",
				    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
				    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
				    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
				    "sInfoPostFix": "",
				    "sInfoThousands": ".",
				    "sLengthMenu": "_MENU_ resultados por página",
				    "sLoadingRecords": "Carregando...",
				    "sProcessing": "Processando...",
				    "sZeroRecords": "Nenhum registro encontrado",
				    "sSearch": "Pesquisar",
				    "oPaginate": {
				        "sNext": "Próximo",
				        "sPrevious": "Anterior",
				        "sFirst": "Primeiro",
				        "sLast": "Último"
				    },
				    
				    
				},


            fixedHeader: {
                header: true,
                headerOffset: $('#fixed').height() }
        } );     
        
    })
</script>

</html>