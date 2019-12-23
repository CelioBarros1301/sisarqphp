<?php
    require_once("arquivoPDO.php");
    require_once("corredorPDO.php");

    
   
    $corredorPDO= new CorredorPDO();
    $codEmpresa="011";
    $codArquivo="01";
    $codCorredor="001";
    
    
    $registro=$corredorPDO->delete($codEmpresa ,$codArquivo,$codCorredor);
   
    /*
    $corredorPDO= new CorredorPDO();
    $codEmpresa="011";
    $codArquivo="01";
    $codCorredor="001";
    $registro=$corredorPDO->busca($codEmpresa,$codArquivo,$codCorredor);
    var_dump($registro);
    */

    
?>