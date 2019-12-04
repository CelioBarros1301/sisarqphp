


<?php
##require("Conexao_Class.php");
require("empresaPDO.php");
$empresa= new empresaPDO();

$resulSet=$empresa -> lista('Empresa');
print_r
?>