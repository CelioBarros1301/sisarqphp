<?php
  
/*
* Regras de Negocio para a Processo de Manutencoa Arquivo
*  Objetos envolvidos: Arquivo
*  Regra: 
*/
    
    require("acessomenuPDO.php");
    require("AcessoMenu_Class.php");
    include_once("menuPDO.php");
    
    require("usuarioPDO.php");
    
    $acessoPDO  = new AcessoMenuPDO();
    $acesso     = new AcessoMenu();
    
    $usuarioPDO = new UsuarioPDO();
    $menuPDO    = new MenuPDO();

        
    
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $registro=Array();
    $user=$_SESSION['user'];
        
        
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codAcesso=isset($_GET['codAce'])?$_GET['codAce']:"";
        
        if ($acao=="i" ) 
        { 
            $tabelaUsuario=$usuarioPDO->lista("");
            $tabelaMenu   =$menusPDO->menu("");
        }
        else
        {
            $registro=$acessoPDO->busca($codAcesso);
            $codUsuario=$registro['id_usu'];
            $tabelaUsuario=$usuarioPDO->lista($codUsuario);
            $tabelaMenu   =$menuPDO->menu($codAcesso);
       
        }
       # $registro=$acessoPDO->busca($codAcesso);
        
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
    
        $filtroUsuario=$user['id_usu'];
        $filtroUsuario=isset($_GET['filtroUsu'])?$_GET['filtroUsu']: $filtroUsuario;
        $tabelaUsuario=$usuarioPDO->lista("");
        $dataTable=$acessoPDO->listaAcesso($filtroUsuario);
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
        
        
        # Gerando as informacoes do Objeto
    
        
        $acesso->setStatusIncluir($_POST['codAce']);
        $acesso->setStatusIncluir($_POST['codUsu']);
        $acesso->setStatusIncluir($_POST['CodMenu']);
            
        
        $acesso->setStatusIncluir($_POST['staInc']);
        $acesso->setStatusAlterar($_POST['staAlt']);
        $acesso->setStatusExcluir($_POST['staExc']);
        $acesso->setStatusConsultar($_POST['staCon']);
        $acesso->setStatusRelatorio($_POST['staInc']);
      
        

        switch ($operacao)
        {
            case 'a':
                $registro=$acessoPDO->update($acesso);
            break;
            case 'i':
                try 
                {
                    $conexao=Conexao::getConnection();
                    $registro=$acessoPDO->insert($acesso);
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
                $registro=$acessoPDO->delete($codAcesso);
            break;
        }
       # header("location:sisarq.php?option=acesso");
    }
     
?>