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
    require("Documento_Class.php"   );

    

    $caixaPDO           = new CaixaPDO();
    $prateleiraPDO      = new PrateleiraPDO();
    $estantePDO         = new EstantePDO();
    $corredorPDO        = new CorredorPDO();
    $arquivoPDO         = new ArquivoPDO();
    $setorautorizadoPDO = new SetorAutorizadoPDO();
    $autorizadoPDO      = new AutorizadoPDO();

    $tipodocumentoPDO   = new TipoDocumentoPDO();
    $statusPDO          = new StatusPDO();

    $documentoPDO       = new DocumentoPDO();
     
    

    $codAutorizado  ="";
    $codEmpresa     ="";
    $codSetor       ="";
    $codArquivo     ="";
    $codCorredor    ="";
    $codEstante     ="";
    $codPrateleira  ="";
    $codCaixa       ="";
    $codTipo        ="";
    $codStatus      ="";
    $codDocumento   ="";



               
    # Array para guarda os nome das Colunas doa DataTable
        
    $dataTableColunas = array(); 
    $dataTable        = array();
   
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
    $codDocumento   =isset($_GET['codDoc'])?$_GET['codDoc']:"";
        
        
    if (isset($_GET['status']) && ( $_GET['status']=="i" || $_GET['status']=="a" || $_GET['status']=="e" ) )
    {
       
        $empresaPDO    = new EmpresaPDO();
        $setorPDO      = new SetorPDO();
        
        # Localizar Registro Quando da Alteracao/Exclusao
        
        if ($_GET['status']!='i')
        {
            $registro       =$documentoPDO->busca($codDocumento);
            $codEmpresa     =$registro["cod_empresa"];
            $codSetor       =$registro['cod_setor'];
            $codArquivo     =$registro['cod_arquivo'];
            $codCorredor    =$registro['cod_corredor'];
            $codEstante     =$registro['cod_estante'];
            $codPrateleira  =$registro['cod_prateleira'];
            $codCaixa       =$registro['cod_estante'];
            $codTipo        =$registro['tip_documento'];
        

        }
        if ($_GET['status']!='e')
        {
            $tabelaEmpresa    =$empresaPDO->lista("");
            $tabelaSetor      =$setorPDO->listaSetor  ($codEmpresa,"");
            $tabelaArquivo    =$arquivoPDO->listaArquivo($codEmpresa,"");
            $tabelaCorredor   =$corredorPDO->listaCorredor($codEmpresa,$codArquivo,"");
            $tabelaEstante    =$estantePDO->listaEstante($codEmpresa,$codArquivo,$codCorredor,"");
            $tabelaPrateleira =$prateleiraPDO->listaPrateleira($codEmpresa,$codArquivo,$codCorredor,$codEstante,"");
            $tabelaCaixa      =$caixaPDO->listaCaixa($codEmpresa,$codSetor,"");
            $tabelaTipo       =$tipodocumentoPDO->listaTipoDocumento($codEmpresa,"");
            $tabelaStatus     =$statusPDO->lista("");
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
        $numeroInicial  =$_POST['NumIniDoc'];
        $numeroFinal    =$_POST['NumFinDoc'];
        $anoExercicio   =$_POST['AnoExe'];
        $anoCalendario  =$_POST['AnoCal'];
        $emissaoInicial =$_POST['EmiIniDoc'];
        $emissaoFinal   =$_POST['EmiFinDoc'];
        $dataDestruicao =$_POST['DesDoc'];
        $detalhe        =$_POST['TexDoc'];


        $documento=new Documento();        
       
        # Gerando as informacoes do Objeto
        
        $documento->setIdDocumento   ($_POST['CodDoc']);
        $documento->setCodigoEmpresa ($_POST['CodEmp']);
        $documento->setCodigoSetor   ($_POST['CodSet']);
        $documento->setCodigoArquivo($_POST['CodArq']);
        $documento->setCodigoCorredor($_POST['CodCor']);
        $documento->setCodigoEstante($_POST['CodEst']);
        $documento->setCodigoPrateleira($_POST['CodPra']);
        $documento->setCodigoCaixa($_POST['CodCai']);
        $documento->setTipoDocumento($_POST['CodTip']);

        $documento->setNumeroInicial($_POST['NumIniDoc']);
        $documento->setNumeroFinal($_POST['NumFinDoc']);

        $documento->setDataInicial($_POST['EmiIniDoc']);
        $documento->setDataFinal($_POST['EmiFinDoc']);
        $documento->setDataDestruicao($_POST['DesDoc']);
        $documento->setDescricao($_POST['TexDoc']);

        $documento->setAnoExercicio($_POST['AnoExe']);
        $documento->setAnoCalendario($_POST['AnoCal']);
        $documento->setCodigoStatus('02');
        



        #$corredor->setSigla($_POST['sigCor']);
        
        switch ($operacao)
        {
            case 'a':
                #$registro=$corredorPDO->update($corredor);
            break;
            case 'i':
                try 
                {
                    $registro=$documentoPDO->insert($documento);
                    $conexao=null;
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

        header("location:sisarq.php?option=documento&status=f");
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