<?php

require_once("Conexao_Class.php");

class ArquivoPDO
{

    public function __construct(){}
  
    public function busca($codEmpresa,$codArquivo)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_arquivos ";
            $sql.=" WHERE cod_empresa=? and ";
            $sql.="       cod_arquivo=?  ";
            
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codArquivo);
            
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
    
    public function insert($arquivo)
    {
        /*
        * Objeto: Incluir Usuario
        * Parametros: $usuario-> Objeto Usuario               
        * Nota: Se o codigo do Usuario e autoincremento
                */

        try
        {
            $conexao=Conexao::getConnection();
            $sql='INSERT INTO tb_arquivos ( ';
            $sql.='`cod_empresa`,';
            $sql.='`cod_arquivo`,';
            $sql.='`des_arquivo`)';
            
            $sql.=' VALUES ( ';
            if ($arquivo->getCodigoArquivo()=="00")
            {
                $sql.='?,';
                $sql.='(SELECT right(concat("00",max(arquivo.cod_arquivo)+1),2) from tb_arquivos arquivo where arquivo.cod_empresa=' . "'". $arquivo->getCodigoEmpresa() ."'),";
                $sql.='?)';
              
            }
            else
            {
                $sql.='?,?,?)';
            }
            
            $smtm=$conexao->prepare($sql);
            if ($arquivo->getCodigoArquivo()=="00")
            { 
                $smtm->bindValue(1,$arquivo->getCodigoEmpresa());
                $smtm->bindValue(2,$arquivo->getDescricao());
            }
            else
            {
                $smtm->bindValue(1,$arquivo->getCodigoEmpresa());
                $smtm->bindValue(2,$arquivo->getCodigoArquivo());
                $smtm->bindValue(3,$arquivo->getDescricao());
            }
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


    public function update($arquivo)
    {
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_arquivos SET ";
        $sql.='`des_arquivo`=? ';
       
        $sql.= " WHERE cod_empresa=? and ";
        $sql.= "       cod_arquivo=? ";
        
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$arquivo->getDescricao());
        $smtm->bindValue(2,$arquivo->getcodigoEmpresa());
        $smtm->bindValue(3,$arquivo->getcodigoArquivo());
        
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }

    public function delete($codEmpresa,$codArquivo)
    {
        $conexao=Conexao::getConnection();
        $sql="DELETE  FROM  tb_arquivos ";
        $sql.= " WHERE cod_empresa=? and ";
        $sql.= "       cod_arquivo=?  ";
        
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$codEmpresa);
        $smtm->bindValue(2,$codArquivo);
        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }


    public function lista($filtro)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT empresa.cod_empresa CodEmpresa,des_empresa Empresa,cod_arquivo CodArquivo,des_arquivo Descricao ";
        $sql.=" FROM tb_arquivos arquivo ";
        $sql.="     inner join tb_empresas empresa on";
        $sql.="     arquivo.cod_empresa=empresa.cod_empresa ";
        $smtm=$conexao -> prepare($sql);
        
        if (isset($filtro))
        {
            $sql.= " WHERE ?";
            $smtm->bindValue(1,$filtro);
        }
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }

    public function listaArquivo($codEmpresa,$codArquivo)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT * ";
        $sql.=" FROM tb_arquivos ";
        
        $smtm=$conexao -> prepare($sql);
        
        if ($codArquivo != "" )
        {
            $sql.= " WHERE cod_empresa=? AND ";
            $sql.= "       cod_arquivo=?  ";
            $smtm=$conexao->prepare($sql);
            
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codArquivo);
        }
        else
        {
        
            $sql.= " WHERE cod_empresa=?  ";
            $smtm=$conexao->prepare($sql);
            
            $smtm->bindValue(1,$codEmpresa);
        }
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }

}

?>