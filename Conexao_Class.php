<?php
/*
 * Classe de Conexao com o banco de Dados
*/

#Constantes com  os parametros de acesso ao banco de dados
require("constantes.php");

class Conexao 
{
    private static $connection;
    
    private function __construct(){}

    public static function getConnection()
    {
        $pdoConfig=DB_DRIVER. ":host=". DB_HOST .";";
        $pdoConfig .="dbname=".DB_NAME .";";
        $pdoConfig .="Charset=".DB_CHARSET;

        try
        {
            
            if (!isset($connection))
            {
                self::$connection=new PDO($pdoConfig,DB_USER,DB_PASSWORD);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(PDO::ATTR_PERSISTENT, TRUE);
                self::$connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');
                self::$connection->beginTransaction();
            }
            return self::$connection;

        }
        catch (PDOExecption $e  )
        {
            $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
            $mensagem .= "\nErro: " . $e->getMessage();
            throw new Exception($mensagem);
        }
    }


}
?>