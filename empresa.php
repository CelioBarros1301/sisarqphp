<?php
    
    require("empresaPDO.php");
    $empresaPDO = new EmpresaPDO();
        
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codigo=$_GET['id'];
        $registro=$empresaPDO->busca($codigo);
        
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
        $empresas=$empresaPDO->lista("");
    }
    
    # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao=$_POST['operacao'];
        $codigo=$_POST['id'];
        $descricao=$_POST['desEmp'];
        switch ($operacao)
        {
            case 'a':
                $registro=$empresaPDO->update($codigo,$descricao);
            break;
            case 'i':
                $registro=$empresaPDO->insert($codigo,$descricao);
            break;
            case 'e':
                echo "<p>Deletando..</p>";
                $registro=$empresaPDO->delete($codigo);
            break;
        }
        header("location:sisarq.php?option=empresa");
    }
     
    
?>