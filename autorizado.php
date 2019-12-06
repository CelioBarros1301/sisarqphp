<?php
    
    require("autorizadoPDO.php");
    require("Autorizado_Class.php");
    
    $tabelaPDO = new AutorizadoPDO();
    $autorizado=new Autorizado();

    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 

        
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codigo=$_GET['id'];
        $registro=$tabelaPDO->busca($codigo);
        
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
        $dataTable=$tabelaPDO->lista("");
        $dataTableColunas = array_keys($dataTable[0]);
    }
    
    # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao=$_POST['operacao'];
        
        $codigo=$_POST['id'];

        # Gerando as informacoes do Objeto
        $autorizado->setCodigo($_POST['id']);
        $autorizado->setNome($_POST['nomeAut']);
        $autorizado->setEmpresa($_POST['empAut']);
        $autorizado->setSetor($_POST['setAut']);
        $autorizado->setFuncao($_POST['funAut']);
        $autorizado->setEmail($_POST['emailAut']);
        $autorizado->setCelular($_POST['celAut']);
        $autorizado->setTelefone($_POST['telAut']);
        $autorizado->setLogin($_POST['logAut']);
        
        
        switch ($operacao)
        {
            case 'a':
                $registro=$tabelaPDO->update($autorizado);
            break;
            case 'i':
                $registro=$tabelaPDO->insert($autorizado);
            break;
            case 'e':
                $registro=$tabelaPDO->delete($codigo);
            break;
        }
        header("location:sisarq.php?option=autorizado");
    }
     
    
?>