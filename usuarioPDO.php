<?php

require_once("Conexao_Class.php");

class UsuarioPDO
{

    public function __construct(){}
  
    public function busca($login)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_usuarios ";
            $sql.=" WHERE log_usuario=?";
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$codigo);
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
    public function insert($usuario)
    {
        /*
        * Objeto: Incluir Usuario
        * Parametros: $usuario-> Objeto Usuario               
        * Nota: Se o codigo do Usuario e autoincremento
                */

        try
        {
            $conexao=Conexao::getConnection();
            $sql='INSERT INTO tb_usuarios ( ';
            $sql.='`log_usuario`,';
            $sql.='`sen_usuario`,';
            $sql.='`sta_usuario`,';
            $sql.='`per_usuario`) ';
            
            $sql.=' VALUES ( ';
            
            $sql.='?,?,?,?)';
            
            
            $smtm=$conexao->prepare($sql);
            
            $smtm->bindValue(1,$usuario->getLogin());
            $smtm->bindValue(2,$usuario->getSenha());
            $smtm->bindValue(3,$usuario->getStatus());
            $smtm->bindValue(4,$usuario->getPerfil());
            
            
            $result=$smtm->execute();
            
            return $result;
        }
        catch (PDOExecption $e  )
        {
            $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
            $mensagem .= "\nErro: " . $e->getMessage();
            throw new Exception($mensagem);
        }
    }


    public function update($usuario)
    {
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_autorizados SET ";
        $sql.='`sen_usuario`=?,';
        $sql.='`sta_usuario`=?,';
        $sql.='`per_usuario`=?) ';
       
        $sql.= " WHERE log_usuario=?";
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$usuario->getSenha());
        $smtm->bindValue(2,$usuario->getStatus());
        $smtm->bindValue(3,$usuario->getPerfil());
        $smtm->bindValue(4,$usuario->getLogin());
        
        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }

    public function delete($login)
    {
        $conexao=Conexao::getConnection();
        $sql="DELETE  FROM  tb_usuarios ";
        $sql.= " WHERE log_usuario=? ";
        
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$login);
        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }


    public function lista($filtro)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT id_usuarioo Codigo,log_usuario Login ";
        $sql.=" FROM tb_usuarios ";
        $smtm=$conexao -> prepare($sql);
        
        if (isset($filtro))
        {
            $sql.= " WHERE log_usuario like '%?%'";
            $smtm->bindValue(1,$filtro);
        }
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }

}

?>