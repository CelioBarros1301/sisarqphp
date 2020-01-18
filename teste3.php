<?php

include_once "menuPDO.php";

    $menuPDO= new MenuPDO();

    $menu=$menuPDO->lista(4);

    #var_dump( $menu);
    echo count($menu);

?>