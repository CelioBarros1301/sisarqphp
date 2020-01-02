<?php
    require_once("arquivoPDO.php");
    require_once("corredorPDO.php");
    require_once("estantePDO.php");

    require_once("prateleiraPDO.php");
    require_once("autorizadoPDO.php");
    

   
    $prateleiraPDO= new PrateleiraPDO();
    $codEmpresa="011";
    $codArquivo="01";
    $codCorredor="002";
    $codEstante='001';
    $codPrateleira='01';
    $autorizadoPDO= new AutorizadoPDO();

    $tabelaAutorizado =$autorizadoPDO->lista("");
    var_dump($tabelaAutorizado);
    ##$registro=$prateleiraPDO->delete($codEmpresa ,$codArquivo,$codCorredor,$codEstante,$codPrateleira);
   
    /*
    $corredorPDO= new CorredorPDO();
    $codEmpresa="011";
    $codArquivo="01";
    $codCorredor="001";
    $registro=$corredorPDO->busca($codEmpresa,$codArquivo,$codCorredor);
    var_dump($registro);
    */

    
?>