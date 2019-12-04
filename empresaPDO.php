|<?php

require("constantes.php");
require("Conexao_Class.php");
$conexao=Conexao::getConnection()

function listaEmpresa($filtro)
{

}
function insert($descricao)
{
    $sql="INSERT INTO tb_empresa(`cod_empresa`,`des_empresa`)";
    $sql.= "VALUES (";
    $sql.="(SELECT right(concat("00",max(empresa.cod_empresa)+1),3) from tb_empresas empresa),";
    $sql.="?);
    
    $smtm=$conexao->prepare($sql);
    $smtm->bindValue(1,$descricao);

    return $smtm->execute();
}

function lista($filtro)
{
    $result=array();
    $sql="SELECT * FROM tb_empresa`";
    $smtm=$conexao->prepare($sql);
    
    if (isset($filtro))
    {
        $sql.= " WHERE des_empresa like '%?%'";
        $smtm->bindValue(1,$filtro);
    }
    $smtm->execute();
    $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
    return  $result;
}



?>