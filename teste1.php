<?php
    require_once("arquivoPDO.php");
    require_once("corredorPDO.php");
    require_once("estantePDO.php");

    require_once("prateleiraPDO.php");
    require_once("autorizadoPDO.php");

    require_once("utilitarios.php");
    require_once("documentoPDO.php");
    
    $documentoPDO= new DocumentoPDO();

    $registro=$documentoPDO->busca("01100000000000000001");
    var_dump($registro);

    echo DateToBrasil("2020-01-08");
    echo DateToUsa("08/01/2020");


    /*
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
   
    
    $corredorPDO= new CorredorPDO();
    $codEmpresa="011";
    $codArquivo="01";
    $codCorredor="001";
    $registro=$corredorPDO->busca($codEmpresa,$codArquivo,$codCorredor);
    var_dump($registro);
    */

    
?>