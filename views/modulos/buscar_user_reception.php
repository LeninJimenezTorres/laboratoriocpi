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
    <div class="container-fluid p-2 lola bg-light">
        <!--bg-light-->
        <p><br>Seleccione la fecha de solicitud:</p>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
            <input type="date" class="form-control" id="fecha" name="fecha">
            <button type="submit" class="btn btn-primary d-flex p-1" name="search"><i class="fas fa-search p-1"></i> Buscar</button>
        </div>
    </div>
</form>
<?php ControladorFormulario::ctrBusquedaUserReception('reception',$name);