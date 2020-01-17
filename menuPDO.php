<?php

require_once("Conexao_Class.php");

class MenuPDO
{

    public function __construct(){}
  
   

    public function lista()
    {
        $conexao=Conexao::getConnection();
        $result=array();

        $sql = "SELECT    * ";
        $sql.= "FROM tb_menus menu "; 
        $sql.=" ORDER BY seq_menu,tipo_menu ";
      
        $smtm=$conexao->prepare($sql);
        
        
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }

}

?>