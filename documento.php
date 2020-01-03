<?php
  
/*
* Regras de Negocio para a Processo de Manutencao do Corredor
*  Objetos envolvidos: Arquivo
*  Regra: 
*/
    
    require("caixaPDO.php");
    require("prateleiraPDO.php");
    require("estantePDO.php");
    require("corredorPDO.php");
    require("arquivoPDO.php");
    require("setorautorizadoPDO.php");
    require("setorPDO.php");
    require("empresaPDO.php");
    require("autorizadoPDO.php");
    
   
    $caixaPDO           = new CaixaPDO();
    $prateleiraPDO      = new PrateleiraPDO();
    $estantePDO         = new EstantePDO();
    $corredorPDO        = new CorredorPDO();
    $arquivoPDO         = new ArquivoPDO();
    $setorPDO           = new SetorPDO();
    $empresaPDO         = new EmpresaPDO();
    $setorautorizadoPDO = new SetorAutorizadoPDO();
    $autorizadoPDO      = new AutorizadoPDO();
               
    # Array dados do filtro
    
    if ( isset($_GET['status'])  && $_GET['status']=="f"  )
    {
 
        $codAutorizado =isset($_GET['filCodAut'])?$_GET['filCodAut']:"";
        $codEmpresa    =isset($_GET['filCodEmp'])?$_GET['filCodEmp']:"";
        $codSetor      =isset($_GET['filCodSet'])?$_GET['filCodSet']:"";
        $codArquivo    =isset($_GET['filCodArq'])?$_GET['filCodArq']:"";
        $codCorredor   =isset($_GET['filCodCor'])?$_GET['filCodCor']:"";
        $codEstante    =isset($_GET['filCodEst'])?$_GET['filCodEst']:"";
        $codPrateleira =isset($_GET['filCodPra'])?$_GET['filCodPra']:"";
        $codCaixa      =isset($_GET['filCodCai'])?$_GET['filCodCai']:"";
    
        var_dump($_GET);

        $tabelaAutorizado =$autorizadoPDO->lista("");
        $tabelaEmpresa    =$setorautorizadoPDO->listaEmpresa($codAutorizado,$codEmpresa);
        $tabelaSetor      =$setorautorizadoPDO->listaSetor  ($codAutorizado,$codEmpresa,$codSetor);
        $tabelaArquivo    =$arquivoPDO->listaArquivo($codEmpresa,$codArquivo);
        $tabelaCorredor   =$corredorPDO->listaCorredor($codEmpresa,$codArquivo,$codCorredor);
        $tabelaEstante    =$estantePDO->listaEstante($codEmpresa,$codArquivo,$codCorredor,$codEstante);
        $tabelaPrateleira =$prateleiraPDO->listaPrateleira($codEmpresa,$codArquivo,$codCorredor,$codEstante,$codPrateleira);
        ##$tabelaCaixa      =$caixaPDO->listaPrateleira($codEmpresa,$codArquivo,$codCorredor,$codEstante);

    }
    
    /*
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $filtroEmpresa="";
    
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ) &&$_GET['status']!='F' )
    {
        $acao=$_GET['status'];
        $codEmpresa    =$_GET['codEmp'];
        $codArquivo    =$_GET['codArq'];
        $codCorredor   =$_GET['codCor'];
        $codEstante    =$_GET['codEst'];
        $codPrateleira =$_GET['codPra'];
        
  
        if ($acao=="i" ) 
        { 
            $tabelaEmpresa =$empresaPDO->lista("");
            
            $tabelaArquivo =$arquivoPDO->listaArquivo($codEmpresa,"");
            $tabelaCorredor=$corredorPDO->listaCorredor($codEmpresa,$codArquivo,"");
            $tabelaEstante =$estantePDO->listaEstante($codEmpresa,$codArquivo,$codCorredor,"");
            

            
        }
        else
        {
            $tabelaEmpresa =$empresaPDO->lista($codEmpresa);
            $tabelaArquivo =$arquivoPDO->listaArquivo($codEmpresa,$codArquivo);
            $tabelaCorredor=$corredorPDO->listaCorredor($codEmpresa,$codArquivo,$codCorredor);
            $tabelaEstante =$estantePDO->listaEstante($codEmpresa,$codArquivo,$codCorredor,$codEstante);
            
            
        }
        $registro=$prateleiraPDO->busca($codEmpresa,$codArquivo,$codCorredor,$codEstante,$codPrateleira);
        
        
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
            
        $dataTable=$prateleiraPDO->lista($filtroEmpresa);
        if ( $dataTable ) 
        {
            $dataTableColunas = array_keys($dataTable[0]);
        }
    }
    
    # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao=$_POST['operacao'];
        
        $codEmpresa    =$_POST['codEmp'];
        $codArquivo    =$_POST['codArq'];
        $codCorredor   =$_POST['codCor'];
        $codEstante    =$_POST['codEst'];
        $codPrateleira =$_POST['codPra'];
        
        
        
        # Gerando as informacoes do Objeto
        $prateleira->setCodigoEmpresa($_POST['codEmp']);
        $prateleira->setCodigoArquivo($_POST['codArq']);
        $prateleira->setCodigoCorredor($_POST['codCor']);
        $prateleira->setCodigoEstante($_POST['codEst']);
        $prateleira->setCodigoPrateleira($_POST['codPra']);
        $prateleira->setDescricao($_POST['desPra']);
        $prateleira->setSigla($_POST['sigPra']);
        
        
        switch ($operacao)
        {
            case 'a':
                $registro=$prateleiraPDO->update($prateleira);
            break;
            case 'i':
                try 
                {
                    $conexao =Conexao::getConnection();
                    $registro=$prateleiraPDO->insert($prateleira);
                    $conexao =null;
                }
                catch (PDOExecption $e  )
                {
                    $mensagem  = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
                    $mensagem .= "\nErro: " . $e->getMessage();
                    $conexao=null;
                    throw new Exception($mensagem);
                    
                }
               
            break;
            case 'e':
                
                $registro=$prateleiraPDO->delete($codEmpresa,$codArquivo,$codCorredor,$codEstante,$codPrateleira);
            break;
        }
        ##header("location:sisarq.php?option=prateleira&filtroEmp=$filtroEmpresa");
    }
     */
?>