<?php

require("constantes.php");

class Conexao 
{
    private static $connection;
    
    private function __construct(){}

    public static function getConnection()
    {
        $pdoConfig=DB_DRIVER. ":host=". DB_HOST .";";
        $pdoConfig .="dbname=".DB_NAME;

        ##mysql:host=localhost;dbname=meuBancoDeDados'
        try
        {
            
            if (!isset($connection))
            {
                $connection=new PDO($pdoConfig,DB_USER,DB_PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $connection;

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