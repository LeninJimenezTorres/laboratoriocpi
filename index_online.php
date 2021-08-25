<?php
    //LLAMO AL CONTROLADOR QUE ABRE LA VENTANA DE INICIO PARA EL LOGIN
    require_once "controllers/ctr_online.php";
    $plantilla = new ControladorPlantilla();
    $plantilla -> ctrTraerPlantilla();
?>