<?php
if ($_GET['idt'] && $_GET['name']){
    //$existe = ControladorFormulario::ctrDatoExistente('usuarios','idt',$idt);//me devuelve el id
    $dirIndexOnline='../index_online.php';
    $dirPanelUser='../views/panel_usuario.php';
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
        <p>Busqueda por nombre de paciente</p>
        <div class="input-group-prepend justify-content-center align-items-center p-4">
            <button type="submit" class="btn btn-primary d-flex p-1" name="search"><i class="fas fa-search p-1"></i> Buscar</button>
            <input for="inputsm" type="text" class="form-control-plaintext p-1 text-dark" placeholder="      Ingrese el nombre del paciente" id="buscar" name="buscar">
        </div>
    </div>
</form>
<?php 
    ControladorFormulario::ctrBusquedaUserPatient($name);      