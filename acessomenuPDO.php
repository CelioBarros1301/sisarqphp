<?php

require_once("Conexao_Class.php");

class AcessoMenuPDO
{

    public function __construct(){}
  
    public function busca($codAcesso)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_menu_usuarios acesso ";
            $sql.=" WHERE id_menu_usuario=?  ";
            
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$codAcesso);
            
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
    
    public function insert($acesso)
    {
        /*
        * Objeto: Incluir Usuario
        * Parametros: $usuario-> Objeto Usuario               
        * Nota: Se o codigo do Usuario e autoincremento
                */

        try
        {
            $conexao=Conexao::getConnection();
            $sql='INSERT INTO tb_menu_usuarios ( ';
            $sql.='`id_menu` ,';
            $sql.='`id_usu`  ,';
            $sql.='`sta_inc` ,';
            $sql.='`sta_alt` ,';
            $sql.='`sta_con` ,';
            $sql.='`sta_exc` ,';
            $sql.='`sta_rel`)' ;

            $sql.=' VALUES ( ?,?,?,?,?,?,?)';
          
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$acesso->getIdMenu());
            $smtm->bindValue(2,$acesso->getIdUsuario());
            $smtm->bindValue(3,$acesso->getStatusIncluir());
            $smtm->bindValue(4,$acesso->getStatusAlterar());
            $smtm->bindValue(5,$acesso->getStatusConsultar());
            $smtm->bindValue(6,$acesso->getStatusExcluir());
            $smtm->bindValue(7,$acesso->getStatusRelatorio());
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


    public function update($acesso)
    {
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_menu_usuarios SET ";
        $sql.='`id_menu` =?,';
        $sql.='`id_usu`  =?,';
        $sql.='`sta_inc` =?,';
        $sql.='`sta_alt` =?,';
        $sql.='`sta_con` =?,';
        $sql.='`sta_exc` =?,';
        $sql.='`sta_rel` =? ';
       
        $sql.= " WHERE id_menu_usuario=?  ";
        
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$acesso->getIdMenu());
        $smtm->bindValue(2,$acesso->getIdUsuario());
        $smtm->bindValue(3,$acesso->getStatusIncluir());
        $smtm->bindValue(4,$acesso->getStatusAlterar());
        $smtm->bindValue(5,$acesso->getStatusConsultar());
        $smtm->bindValue(6,$acesso->getStatusExcluir());
        $smtm->bindValue(7,$acesso->getStatusRelatorio());
       
        $smtm->bindValue(8,$acesso->getIdAcesso());
        
        
        
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }

    public function delete($codAcesso)
    {
        $conexao=Conexao::getConnection();
        $sql = "DELETE  FROM  tb_menu_usuarios   ";
        $sql.= "        WHERE id_menu_usuario =? ";
        
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$codAcesso);
        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }


    public function listaAcesso($codUsario)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql ="SELECT acesso.id_menu_usuario CodAcesso,id_menu CodMenu ," ; 
        $sql.="       menu.seq_menu          Ordem     , nome_menu Menu," ;
        $sql.="       acesso.sta_menu        Menu      , " ;
        $sql.="       acesso.sta_inc         Incluir   , " ;
        $sql.="       acesso.sta_alt         Alterar   , " ;
        $sql.="       acesso.sta_conc        Consultar , " ;
        $sql.="       acesso.sta_exc         Excluir   , " ;
        $sql.="       acesso.sta_rel         Relatorio  " ;
        $sql.=" FROM tb_menu_usuarios acesso   ";
        $sql.="     inner join tb_menus  menu on ";
        $sql.="          acesso.id_menu=menu.id_menu";
        
        $sql.= " WHERE acesso.id_usu=?";
        
        $smtm=$conexao -> prepare($sql);
        
        $smtm->bindValue(1,$codUsuario);
       
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }

    
}

?>