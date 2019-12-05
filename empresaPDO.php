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
    public function insert($codigo,$descricao)
    {
        /*
        * Objeto: Incluir Empresa
        * Parametros:   $codigo->Codigo da Empesa
        *               $descricao->nome da empresa             
        * Nota: Se o codigo da empresa for igual a 000, sistema deve gerar automaticamente o proximo codigo
        */
        $sql='INSERT INTO tb_empresas(`cod_empresa`,`des_empresa`) ';
        $sql.= 'VALUES ( ';
        if ($codigo=="000")
        {
            $sql.='(SELECT right(concat("00",max(empresa.cod_empresa)+1),3) from tb_empresas empresa),';
            $sql.='?)';
        }
        else
        {
            $sql.='?,?)';
        }

        $smtm=$this->conexao->prepare($sql);
        if ($codigo=="000")
        {
                $smtm->bindValue(1,$descricao);
        }
        else
        {
            $smtm->bindValue(1,$codigo);
            $smtm->bindValue(2,$descricao);
        }
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
        $sql="DELETE  FROM  tb_empresas ";
        $sql.= " WHERE cod_empresa=? ";
        
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
