<?php

require_once("Conexao_Class.php");

class CorredorPDO
{

    public function __construct(){}
  
    public function busca($codEmpresa,$codArquivo,$codCorredor)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_corredores ";
            $sql.=" WHERE cod_empresa=? and ";
            $sql.="       cod_arquivo=? and ";
            $sql.="       cod_corredor=?  ";
            
            
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codArquivo);
            $smtm->bindValue(3,$codCorredor);
            
            
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
    
    public function insert($corredor)
    {
        /*
        * Objeto: Incluir Usuario
        * Parametros: $usuario-> Objeto Corredoro               
        * Nota: 
        */

        try
        {
            $conexao=Conexao::getConnection();
            $sql='INSERT INTO tb_corredores ( ';
            $sql.='`cod_empresa`,';
            $sql.='`cod_arquivo`,';
            $sql.='`cod_corredor`,';
            $sql.='`des_corredor`,';
            $sql.='`sig_corredor`)';
            
            $sql.=' VALUES ( ';
            if ($arquivo->getCodigoCorredor()=="000")
            {
                $sql.='?,';
                $sql.='?,';
                
                $sql.='(SELECT right(concat("000",max(corredor.cod_corredor)+1),3) from tb_corredores corredor';
                $sql.=' where corredor.cod_empresa=' . "'". $corredor->getCodigoEmpresa() ."' AND ";
                $sql.='  corredor.cod_arquivo=' . "'". $corredor->getCodigoArquivo() ."' AND ";
                
                $sql.='?,?)';
              
            }
            else
            {
                $sql.='?,?,?,?,?)';
            }
            
            $smtm=$conexao->prepare($sql);
            if ($corredor->getCodigoCorredor()=="000")
            { 
                $smtm->bindValue(1,$corredor->getCodigoEmpresa());
                $smtm->bindValue(2,$corredor->getCodigoArquivo()));
                $smtm->bindValue(3,$corredor>getDescricao());
                $smtm->bindValue(4,$arquivo->getSigla());
            }
            else
            {
                $smtm->bindValue(1,$corredor->getCodigoEmpresa());
                $smtm->bindValue(2,$corredor->getCodigoArquivo()));
                $smtm->bindValue(3,$corredor->getCodigoCorredor()));
                $smtm->bindValue(4,$corredor>getDescricao());
                $smtm->bindValue(5,$arquivo->getSigla());
               
             
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


    public function update($corredor)
    {
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_corredores SET ";
        $sql.='`des_corredor`=? ,';
        $sql.='`sig_arquivo`=? ';
        
       
        $sql.= " WHERE cod_empresa=? and ";
        $sql.= "       cod_arquivo=? and ";
        $sql.= "       cod_corredor=? ";
        
        
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$corredor->getDescricao());
        $smtm->bindValue(2,$corredor->getSigla());
       
        $smtm->bindValue(3,$arquivo->getcodigoEmpresa());
        $smtm->bindValue(4,$arquivo->getcodigoArquivo());
        $smtm->bindValue(5,$arquivo->getcodigoCorredor());

        
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }

    public function delete($codEmpresa,$codArquivo,$codCorredor)
    {
        $conexao=Conexao::getConnection();
        $sql="DELETE  FROM  tb_corredores ";
        $sql.= " WHERE cod_empresa=? and ";
        $sql.= "       cod_arquivo=? and  ";
        $sql.= "       cod_corredor=?  ";
        
        
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$codEmpresa);
        $smtm->bindValue(2,$codArquivo);
        $smtm->bindValue(2,$codCorredor);
        
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
        $sql.=" FROM tb_arquivos arquivo left join tb_empresas empresa on";
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

}

?>