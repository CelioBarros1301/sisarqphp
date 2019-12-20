<?php
  
/*
* Regras de Negocio para a Processo de Manutencao do Corredor
*  Objetos envolvidos: Arquivo
*  Regra: 
*/
    
    require("corredorPDO.php");
    require("corredor_Class.php");

    require("arquivoPDO.php");
    require("empresaPDO.php");
    
   
    $corredorPDO= new CorredorPDO();
    $corredor=new Corredor();
    
    
    $arquivoPDO= new ArquivoPDO();
    $empresaPDO=new EmpresaPDO();
               
    
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $filtroEmpresa="";
        
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codEmpresa=$_GET['codEmp'];
        $codArquivo=$_GET['codArq'];
        
        if ($acao=="i" ) 
        { 
            $tabelaEmpresa=$empresaPDO->lista("");
            $tabelaArquivo=$arquivoPDO->lista("");
            
        }
        else
        {
            $tabelaEmpresa=$empresaPDO->lista($codEmpresa);
            $tabelaArquivo=$arquivoPDO->lista($codEmpresa,$codArquivo);
            
        }
        $registro=$corredorPDO->busca($codEmpresa,$codArquivo,$codCorredor);
        
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
        $filtroEmpresa="";
        if (isset($_GET['filtroEmp']) ) 
        {
            $filtroEmpresa=$_GET['filtroEmp'];
        }    
       
        $tabelaEmpresa=$empresaPDO->lista("");
            
        $dataTable=$corredorPDO->lista($filtroEmpresa);
        if ( $dataTable ) 
        {
            $dataTableColunas = array_keys($dataTable[0]);
        }
    }
    
    # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao=$_POST['operacao'];
        
        $codEmpresa=$_POST['codEmp'];
        $codArquivo=$_POST['codArq'];
        $codCorredor=$_POST['CodCor'];
        
        
        # Gerando as informacoes do Objeto
        $corredor->setCodigoEmpresa($_POST['codEmp']);
        $corredor->setCodigoArquivo($_POST['codArq']);
        $corredor->setCodigoCorredor($_POST['codCor']);
        $corredor->setDescricao($_POST['desCor']);
        $corredor->setSigla($_POST['sigCor']);
        
        
        switch ($operacao)
        {
            case 'a':
                $registro=$corredorPDO->update($corredor);
            break;
            case 'i':
                try 
                {
                    $conexao=Conexao::getConnection();
                    $registro=$corredorPDO->insert($corredor);
                    $conexao=null;
                }
                catch (PDOExecption $e  )
                {
                    $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
                    $mensagem .= "\nErro: " . $e->getMessage();
                    $conexao=null;
                    throw new Exception($mensagem);
                    
                }
               
            break;
            case 'e':
                $registro=$corredorPDO->delete($codEmpresa,$codArquivo,$codCorredor);
            break;
        }
        header("location:sisarq.php?option=corredor&filtroEmp=$filtroEmpresa");
    }
     
?>