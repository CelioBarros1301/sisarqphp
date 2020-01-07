<?php
  
/*
* Regras de Negocio para a Processo de Manutencao do Corredor
*  Objetos envolvidos: Arquivo
*  Regra: 
*/
    
    require("caixaPDO.php"          );
    require("prateleiraPDO.php"     );
    require("estantePDO.php"        );
    require("corredorPDO.php"       );
    require("arquivoPDO.php"        );
    require("empresaPDO.php"        );
    require("setorPDO.php"          );
    require("setorautorizadoPDO.php");
    require("autorizadoPDO.php"     );
    require("tipodocumentoPDO.php"  );
    require("statusPDO.php"         );
    require("documentoPDO.php"      );

    

    $caixaPDO           = new CaixaPDO();
    $prateleiraPDO      = new PrateleiraPDO();
    $estantePDO         = new EstantePDO();
    $corredorPDO        = new CorredorPDO();
    $arquivoPDO         = new ArquivoPDO();
    $setorautorizadoPDO = new SetorAutorizadoPDO();
    $autorizadoPDO      = new AutorizadoPDO();

    $tipodocumentoPDO   = new TipoDocumentoPDO();
    $statusPDO          = new StatusPDO();

               
    # Array dados do filtro - Tab de Filro
    
    if ( isset($_GET['status'])  && ( $_GET['status']=="f" || $_GET['status']=="g"  ) )
    {
 
        $codAutorizado  =isset($_GET['filCodAut'])?$_GET['filCodAut']:"";
        $codEmpresa     =isset($_GET['filCodEmp'])?$_GET['filCodEmp']:"";
        $codSetor       =isset($_GET['filCodSet'])?$_GET['filCodSet']:"";
        $codArquivo     =isset($_GET['filCodArq'])?$_GET['filCodArq']:"";
        $codCorredor    =isset($_GET['filCodCor'])?$_GET['filCodCor']:"";
        $codEstante     =isset($_GET['filCodEst'])?$_GET['filCodEst']:"";
        $codPrateleira  =isset($_GET['filCodPra'])?$_GET['filCodPra']:"";
        $codCaixa       =isset($_GET['filCodCai'])?$_GET['filCodCai']:"";
        $codTipo        =isset($_GET['filCodTip'])?$_GET['filCodTip']:"";
        $codStatus      =isset($_GET['filCodSta'])?$_GET['filCodSta']:"";
 
       
        $tabelaAutorizado =$autorizadoPDO->lista("");
        $tabelaEmpresa    =$setorautorizadoPDO->listaEmpresa($codAutorizado,$codEmpresa);
        $tabelaSetor      =$setorautorizadoPDO->listaSetor  ($codAutorizado,$codEmpresa,$codSetor);
        $tabelaArquivo    =$arquivoPDO->listaArquivo($codEmpresa,$codArquivo);
        $tabelaCorredor   =$corredorPDO->listaCorredor($codEmpresa,$codArquivo,$codCorredor);
        $tabelaEstante    =$estantePDO->listaEstante($codEmpresa,$codArquivo,$codCorredor,$codEstante);
        $tabelaPrateleira =$prateleiraPDO->listaPrateleira($codEmpresa,$codArquivo,$codCorredor,$codEstante,$codPrateleira);
        $tabelaCaixa      =$caixaPDO->listaCaixa($codEmpresa,$codSetor,$codCaixa);
        $tabelaTipo       =$tipodocumentoPDO->listaTipoDocumento($codEmpresa,$codTipo);
        $tabelaStatus     =$statusPDO->lista("");
    }

    # Gerando a grid dos documentos conforme o filtro
    if ( isset($_GET['status'])  && $_GET['status']=="g"  )
    {
        $documentoPDO= new DocumentoPDO();
        $filtro=Array();
        $filtro['codAutorizado'] =isset($_GET['filCodAut'])?$_GET['filCodAut']:"";
        $filtro['codEmpresa']    =isset($_GET['filCodEmp'])?$_GET['filCodEmp']:"";
        $filtro['codSetor']      =isset($_GET['filCodSet'])?$_GET['filCodSet']:"";
        $filtro['codArquivo']    =isset($_GET['filCodArq'])?$_GET['filCodArq']:"";
        $filtro['codCorredor']   =isset($_GET['filCodCor'])?$_GET['filCodCor']:"";
        $filtro['codEstante']    =isset($_GET['filCodEst'])?$_GET['filCodEst']:"";
        $filtro['codPrateleira'] =isset($_GET['filCodPra'])?$_GET['filCodPra']:"";
        $filtro['codCaixa']      =isset($_GET['filCodCai'])?$_GET['filCodCai']:"";
        $filtro['codTipo']       =isset($_GET['filCodTip'])?$_GET['filCodTip']:"";
        $filtro['codStatus']     =isset($_GET['filCodSta'])?$_GET['filCodSta']:"";
 
        $filtro['numDocumento']  =isset($_GET['filNumDoc'])?$_GET['filNumDoc']:"";
        $filtro['emiDocumento']  =isset($_GET['filEmiDoc'])?$_GET['filEmiDoc']:"";
        $filtro['exeDocumento']  =isset($_GET['filAnoExe'])?$_GET['filAnoExe']:"";
        $filtro['calDocumento']  =isset($_GET['filAnoCal'])?$_GET['filAnoCal']:"";
        $filtro['texDocumento']  =isset($_GET['filTexDoc'])?$_GET['filTexDoc']:"";
        
        $dataTable=$documentoPDO->lista($filtro);
        if ( $dataTable ) 
        {
            $dataTableColunas = array_keys($dataTable[0]);
        }
       # header("location:sisarq.php?option=documento");
   
    }

    # Preencher Formulario com os dados 
        
    if (isset($_GET['status']) && ( $_GET['status']=="i" || $_GET['status']=="a" || $_GET['status']=="e" ) )
    {
        $acao=$_GET['status'];

        $empresaPDO    = new EmpresaPDO();
        $setorPDO      = new SetorPDO();
        $documentoPDO= new DocumentoPDO();
        

        $codDocumento   =isset($_GET['CodDoc'])?$_GET['CodDoc']:"";
        $codEmpresa     =isset($_GET['CodEmp'])?$_GET['CodEmp']:"";
        $codSetor       =isset($_GET['CodSet'])?$_GET['CodSet']:"";
        $codArquivo     =isset($_GET['CodArq'])?$_GET['CodArq']:"";
        $codCorredor    =isset($_GET['CodCor'])?$_GET['CodCor']:"";
        $codEstante     =isset($_GET['CodEst'])?$_GET['CodEst']:"";
        $codPrateleira  =isset($_GET['CodPra'])?$_GET['CodPra']:"";
        $codCaixa       =isset($_GET['CodCai'])?$_GET['CodCai']:"";
        $codTipo        =isset($_GET['CodTip'])?$_GET['CodTip']:"";
        
        if ($_GET['status']=='i')
        {
            $tabelaEmpresa    =$empresaPDO->lista("");
            $tabelaSetor      =$setorPDO->listaSetor  ($codEmpresa,"");
            $tabelaArquivo    =$arquivoPDO->listaArquivo($codEmpresa,"");
            $tabelaCorredor   =$corredorPDO->listaCorredor($codEmpresa,$codArquivo,"");
            $tabelaEstante    =$estantePDO->listaEstante($codEmpresa,$codArquivo,$codCorredor,"");
            $tabelaPrateleira =$prateleiraPDO->listaPrateleira($codEmpresa,$codArquivo,$codCorredor,$codEstante,"");
            $tabelaCaixa      =$caixaPDO->listaCaixa($codEmpresa,$codSetor,"");
            $tabelaTipo       =$tipodocumentoPDO->listaTipoDocumento($codEmpresa,"");
        }
        else
        {
            $tabelaEmpresa    =$empresaPDO->lista($codEmpresa);
            $tabelaSetor      =$setorPDO->listaSetor  ($codEmpresa,$codSetor);
            $tabelaArquivo    =$arquivoPDO->listaArquivo($codEmpresa,$codArquivo);
            $tabelaCorredor   =$corredorPDO->listaCorredor($codEmpresa,$codArquivo,$codCorredor);
            $tabelaEstante    =$estantePDO->listaEstante($codEmpresa,$codArquivo,$codCorredor,$codEstante);
            $tabelaPrateleira =$prateleiraPDO->listaPrateleira($codEmpresa,$codArquivo,$codCorredor,$codEstante,$codPrateleira);
            $tabelaCaixa      =$caixaPDO->listaCaixa($codEmpresa,$codSetor,$codCaixa);
            $tabelaTipo       =$tipodocumentoPDO->listaTipoDocumento($codEmpresa,$codTipo);
        }
        $registro=$documentoPDO->busca($codDocumento);   
    }
        # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao=$_POST['operacao'];
        
        $codDocumento   =$_POST['CodDoc'];
        $codEmpresa     =$_POST['CodEmp'];
        $codSetor       =$_POST['CodSet'];
        $codArquivo     =$_POST['CodArq'];
        $codCorredor    =$_POST['CodCor'];
        $codEstante     =$_POST['CodEst'];
        $codPrateleira  =$_POST['CodPra'];
        $codCaixa       =$_POST['CodCai'];
        $codTipo        =$_POST['CodTip'];
        
        
        # Gerando as informacoes do Objeto
        #$corredor->setCodigoEmpresa($_POST['codEmp']);
        #$corredor->setCodigoArquivo($_POST['codArq']);
        #$corredor->setCodigoCorredor($_POST['codCor']);
        ##$corredor->setDescricao($_POST['desCor']);
        #$corredor->setSigla($_POST['sigCor']);
        
        switch ($operacao)
        {
            case 'a':
                #$registro=$corredorPDO->update($corredor);
            break;
            case 'i':
                try 
                {
                    $conexao =Conexao::getConnection();
                    #$registro=$corredorPDO->insert($corredor);
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
                #$registro=$corredorPDO->delete($codEmpresa,$codArquivo,$codCorredor);
            break;
        }
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