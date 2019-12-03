<?php
    
    require("constantes.php");
    require("Conexao_Class.php");

    $conexao=Conexao::getConnection();
    $sqlEmpresas=$conexao->query("select cod_empresa,des_empresa from tb_empresas");
    $empresa=$sqlEmpresas->fetchAll();
    ##echo "<pre>";
    ##var_dump($empresa);
    ##echo "</pre>";
    echo "<table>";
    foreach ($empresa as $registro) {
        var_dump($registro);
        echo "<br>==========<br>";
        echo "<tr>";
        echo "<td>";
        echo $registro["cod_empresa"];
        echo $registro["des_empresa"];
        
        echo "</td>";
        echo "<tr>";
        
    }



    echo "</table>";


?>