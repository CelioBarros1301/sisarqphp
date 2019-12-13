<?php
    function inverse($x) {
        if (!$x) {
            throw new Exception('Divisão por zero.');
        }
        return 1/$x;
    }

    try {
        echo inverse(5) . "\n";
    } catch (Exception $e) {
        echo 'Exceção capturada: ',  $e->getMessage(), "\n";
    } 

    try 
    {
        echo inverse(0) . "\n";
    } 
    catch (Exception $e) 
    {
        echo 'Exceção capturada: ',  $e->getMessage(), "\n"
    } 
    finally
    {
        echo "Segundo finally.\n";
     }

?>