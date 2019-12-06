|<?php
require("Conexao_Class.php");

class AutorizadoPDO
{

     private $conexao; 
     
     public  function __construct()
  
     {
         $this->conexao=Conexao::getConnection(); 
     }
    public function busca($codigo)
    {
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_autorizados ";
            $sql.=" WHERE cod_autorizado=?";
            
            $smtm=$this->conexao->prepare($sql);
            $smtm->bindValue(1,$codigo);
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            return $resultSet ;      
            

    }
    public function insert($autorizado)
    {
        /*
        * Objeto: Incluir Autorizadoa
        * Parametros: $Autorizado-> Objeto Autorizado               
        * Nota: Se o codigo do Autorizado  for igual a 0000, sistema deve gerar automaticamente o proximo codigo
        */

        $codigo=$autorizado->getCodigo();
                
        $sql='INSERT INTO tb_autorizados (`cod_autorizado`,';
        $sql.='`nom_autorizado`,';
        $sql.='`emp_autorizado`,';
        $sql.='`set_autorizado`,';
        $sql.='`fun_autorizado`,';
        $sql.='`email_autorizado`,';
        $sql.='`cel_autorizado`,';
        $sql.='`tel_autorizado`,';
        $sql.='`log_autorizado`)';
        
        $sql.=' VALUES ( ';
        
        if ($codigo=="0000")
        {
            $sql.='(SELECT right(concat("0000",max(autorizado.cod_autorizado)+1),4) from tb_autorizados autorizado),';
            $sql.='?,?,?,?,?,?,?,?)';
        }
        else
        {
            $sql.='?,?,?,?,?,?,?,?,?)';
        }

        $smtm=$this->conexao->prepare($sql);
        if ($codigo=="0000")
        {
                $smtm->bindValue(1,$autorizado->getNome());
                $smtm->bindValue(2,$autorizado->getEmpresa());
                $smtm->bindValue(3,$autorizado->getSetor());
                $smtm->bindValue(4,$autorizado->getFuncao());
                $smtm->bindValue(5,$autorizado->getEmail());
                $smtm->bindValue(6,$autorizado->getCelular());
                $smtm->bindValue(7,$autorizado->getTelefone());
                $smtm->bindValue(8,$autorizado->getLogin());
                
        }
        else
        {
            $smtm->bindValue(1,$autorizado->getCodigo());
            $smtm->bindValue(2,$autorizado->getNome());
            $smtm->bindValue(3,$autorizado->getEmpresa());
            $smtm->bindValue(4,$autorizado->getSetor());
            $smtm->bindValue(5,$autorizado->getFuncao());
            $smtm->bindValue(6,$autorizado->getEmail());
            $smtm->bindValue(7,$autorizado->getCelular());
            $smtm->bindValue(8,$autorizado->getTelefone());
            $smtm->bindValue(9,$autorizado->getLogin());
          
        }
        return $smtm->execute();
    }


    public function update($autorizado)
    {
        $sql="UPDATE  tb_autorizados SET ";
        $sql.='`nom_autorizado`=?,';
        $sql.='`emp_autorizado`=?,';
        $sql.='`set_autorizado`=?,';
        $sql.='`fun_autorizado`=?,';
        $sql.='`email_autorizado`=?,';
        $sql.='`cel_autorizado`=?,';
        $sql.='`tel_autorizado`=?,';
        $sql.='`log_autorizado`=?';
       
        $sql.= " WHERE cod_autorizado=?";
        
        $smtm=$this->conexao->prepare($sql);
        
        $smtm->bindValue(1,$autorizado->getNome());
        $smtm->bindValue(2,$autorizado->getEmpresa());
        $smtm->bindValue(3,$autorizado->getSetor());
        $smtm->bindValue(4,$autorizado->getFuncao());
        $smtm->bindValue(5,$autorizado->getEmail());
        $smtm->bindValue(6,$autorizado->getCelular());
        $smtm->bindValue(7,$autorizado->getTelefone());
        $smtm->bindValue(8,$autorizado->getLogin());
        $smtm->bindValue(9,$autorizado->getCodigo());
        return $smtm->execute();
    }

    public function delete($codigo)
    {
        $sql="DELETE  FROM  tb_autorizados ";
        $sql.= " WHERE cod_autorizado=? ";
        
        $smtm=$this->conexao->prepare($sql);
        $smtm->bindValue(1,$codigo);
               
        return $smtm->execute();
    }


    public function lista($filtro)
    {
        $result=array();
        $sql="SELECT cod_autorizado Codigo,nom_autorizado Nome, emp_autorizado Empresa,cel_autorizado Celular ";
        $sql.=" FROM tb_autorizados ";
        $smtm=$this->conexao -> prepare($sql);
        
        if (isset($filtro))
        {
            $sql.= " WHERE nome_autorizado like '%?%'";
            $smtm->bindValue(1,$filtro);
        }
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        return  $result;
    }

}


?>
