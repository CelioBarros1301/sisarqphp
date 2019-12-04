<?php
    
    require("empresaPDO.php");
    $empresaPDO = new EmpresaPDO();
        
    # Preencher Formulario com os dados 
    if (isset($_GET['status']))
    {
        $acao=$_GET['status'];
        $codigo=$_GET['id'];
        $registro=$empresaPDO->busca($codigo);
    }
    else
    {
        # Preencher o DataTable
        $empresas=$empresaPDO->lista("");
    }

?>