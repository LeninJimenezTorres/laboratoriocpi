<?php
if ($_GET['idt'] && $_GET['name']){
    //$existe = ControladorFormulario::ctrDatoExistente('usuarios','idt',$idt);//me devuelve el id
    $dirIndexOnline='../index_online.php';
    $dirPanelUser='../views/panel_usuario.php';
    $dirPanelUserModuloSalir='../views/panel_usuario.php?modulos=salir_admin';
    $idtad=ModeloFormularios::mdlUserDataSpecific('usuarios','name',$_GET['name']);

    $idt=$_GET['idt'];
    $name=$_GET['name'];
    $consultaToken=ModeloFormularios::mdlSpecificValueQuery('usuarios','token','token',$idt);
    //echo 'Consulta : '; print_r($consultaToken);
    if ($consultaToken){
        if($consultaToken['token']!=$idt)
        {
            //$validacion = 'WRONG';
            echo '<script>window.location ="'.$dirIndexOnline.'"</script>';
            return;
        }
        if ($idtad['token']!=$idt){
            //$validacion = 'WRONG';
            echo '<script>window.location ="'.$dirIndexOnline.'"</script>';
            return;
        }
    }
    else{
        echo '<script>window.location ="'.$dirIndexOnline.'"</script>';
        return;
    }   
}
else{
    echo '<script>window.location ='.$dirIndexOnline.'</script>';
    return;
}    
?>
<form method="post">
    <nav class="nav justify-content-center py-2 d-flex flex-column">
        <ul class="nav nav-pills justify-content-center">
            <?php if (isset($_GET["modulos"])) : ?>
                <?php if ($_GET["modulos"] == "buscar_user_patient") : ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo $dirPanelUser.'?modulos=buscar_user_patient&name='.$name.'&idt='.$idt;?>">Busqueda por nombre</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $dirPanelUser.'?modulos=buscar_user_patient&name='.$name.'&idt='.$idt;?>">Busqueda por nombre</a>
                    </li>
                <?php endif ?>
                <?php if ($_GET["modulos"] == "buscar_user_reception") : ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo $dirPanelUser.'?modulos=buscar_user_reception&name='.$name.'&idt='.$idt;?>">Busqueda por fecha de solicitud</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $dirPanelUser.'?modulos=buscar_user_reception&name='.$name.'&idt='.$idt;?>">Busqueda por fecha de solicitud</a>
                    </li>
                <?php endif ?>
                <?php if ($_GET["modulos"] == "buscar_user_deliver") : ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo $dirPanelUser.'?modulos=buscar_user_deliver&name='.$name.'&idt='.$idt;?>">Busqueda por fecha de entrega</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $dirPanelUser.'?modulos=buscar_user_deliver&name='.$name.'&idt='.$idt;?>">Busqueda por fecha de entrega</a>
                    </li>
                <?php endif ?>

            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $dirPanelUser.'?modulos=buscar_user_patient&name='.$name.'&idt='.$idt;?>">Busqueda por nombre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $dirPanelUser.'?modulos=buscar_user_reception&name='.$name.'&idt='.$idt;?>">Busqueda por fecha de solicitud</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $dirPanelUser.'?modulos=buscar_user_deliver&name='.$name.'&idt='.$idt;?>">Busqueda por fecha de entrega</a>
                </li>
            <?php endif ?>
        </ul>
    </nav>
</form>
<?php
$a = 1;
//ControladorFormulario::ctrBusquedaFiltro();