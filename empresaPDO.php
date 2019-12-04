|<?php
require("Conexao_Class.php");

class EmpresaPDO
{

     private $conexao; 
     
     public  function __construct()
  
     {
         $this->conexao=Conexao::getConnection(); 
     }
    public function busca($codigo)
    {
            $result=array();
            $sql="SELECT cod_empresa Codigo,";
            $sql.="des_empresa Empresa ";
            $sql.=" FROM tb_empresas ";
            $sql.=" WHERE cod_empresa=?";
            
            $smtm=$this->conexao->prepare($sql);
            $smtm->bindValue(1,$codigo);
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            return $resultSet ;      
            

    }
    public function insert($descricao)
    {
        $sql='INSERT INTO tb_empresas(`cod_empresa`,`des_empresa`) ';
        $sql.= 'VALUES ( ';
        $sql.='(SELECT right(concat("00",max(empresa.cod_empresa)+1),3) from tb_empresas empresa),';
        $sql.='?)';
        
        $smtm=$this->conexao->prepare($sql);
        $smtm->bindValue(1,$descricao);

        return $smtm->execute();
    }


    public function update($codigo,$descricao)
    {
        $sql="UPDATE  tb_empresas SET des_empresa=? ";
        $sql.= " WHERE cod_empresa=?";
        
        $smtm=$this->conexao->prepare($sql);
        $smtm->bindValue(1,$descricao);
        $smtm->bindValue(2,$codigo);

        return $smtm->execute();
    }

    public function delete($codigo)
    {
        $sql="DELETE  tb_empresas ";
        $sql.= " WHERE cod_empresa=?";
        
        $smtm=$this->conexao->prepare($sql);
        $smtm->bindValue(1,$codigo);

        return $smtm->execute();
    }


    public function lista($filtro)
    {
        $result=array();
        $sql="SELECT cod_empresa Codigo,des_empresa Empresa FROM tb_empresas ";
        $smtm=$this->conexao -> prepare($sql);
        
        if (isset($filtro))
        {
            $sql.= " WHERE des_empresa like '%?%'";
            $smtm->bindValue(1,$filtro);
        }
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        return  $result;
    }

}


?>
