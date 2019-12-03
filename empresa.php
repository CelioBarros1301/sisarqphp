<?php
    
    require("constantes.php");
    require("Conexao_Class.php");

    $conexao=Conexao::getConnection();
    $sqlEmpresas=$conexao->query("select cod_empresa,des_empresa from tb_empresas");
    $empresas=$sqlEmpresas->fetchAll();
   

?>