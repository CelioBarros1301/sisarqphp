<?php

require_once("Conexao_Class.php");

class DocumentoPDO
{

    public function __construct(){}
  
    public function busca($idDocumento)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_documentos ";
            $sql.=" WHERE cod_documento=?  ";
            
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$idDocumento);
            
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
/*
    public function insert($arquivo)
    {
        

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
                $sql.='(SELECT ifnull(right(concat("00",max(arquivo.cod_arquivo)+1),2),"01") from tb_arquivos arquivo where arquivo.cod_empresa=' . "'". $arquivo->getCodigoEmpresa() ."'),";
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

*/
    public function lista($filtro)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT * " ;  
        $sql.=" FROM view_documentos documento ";
        
        $sql.="WHERE codempresa=?";
        
        if ($filtro['codArquivo']!="")
        {
            $sql.=' AND  codArquivo="'.$filtro['codArquivo'].'"';
        }        

        if ($filtro['codCorredor']!="")
        {
            $sql.=' AND  codCorredor="'.$filtro['codCorredor'].'"';
        }        

        if ($filtro['codEstante']!="")
        {
            $sql.=' AND  codEstante="'.$filtro['codEstante'].'"';
        }        
        
        if ($filtro['codPrateleira']!="")
        {
            $sql.=' AND  codPrateleira="'.$filtro['codPrateleira'].'"';
        }

        if ($filtro['codSetor']!="")
        {
            $sql.=' AND  codSetor="'.$filtro['codSetor'].'"';
        }

        if ($filtro['codCaixa']!="")
        {
            $sql.=' AND  codCaixa="'.$filtro['codCaixa'].'"';
        }

        if ($filtro['exeDocumento']!="")
        {
            $sql.=' AND  AnoExercicio="'.$filtro['exeDocumento'].'"';
        }


        if ($filtro['calDocumento']!="")
        {
            $sql.=' AND  AnoCalendario="'.$filtro['calDocumento'].'"';
        }
        
        if ($filtro['codTipo']!="")
        {
            $sql.=' AND  CodTipo="'.$filtro['codTipo'].'"';
        }

        if ($filtro['codStatus']!="")
        {
            $sql.=' AND  CodStatus="'.$filtro['codStatus'].'"';
        }

        if ($filtro['numDocumento']!="")
        {
            $sql.=' AND ("' . $filtro['numDocumento'] .' " >= NumeroInicialDoc And ';
            $sql.= $filtro['numDocumento'] .' "<= NumeroFinalDoc )' ;
        }

        if ($filtro['emiDocumento']!="")
        {
            $sql.=' AND ("' . $filtro['emiDocumento'] .' " >= DataInicialDoc And ';
            $sql.= $filtro['emoDocumento'] .' "<= DataFinalDoc )' ;
        }

        if ($filtro['texDocumento']!="")
        {
            $sql.= ' AND DescricaoDocumento like "*' . $filtro['texDocumento'] . '"*' ;
        }

        $sql.= " ORDER BY CodCaixa" ;

        $smtm=$conexao -> prepare($sql);

        $smtm->bindValue(1,$filtro['codEmpresa']);
        
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }


}

?>