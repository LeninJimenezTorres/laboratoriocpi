<?php
$dirIndexOnline='../index_online.php';
if ($_GET['idt']){
    $idt=$_GET['idt'];
    $consultaToken=ModeloFormularios::mdlSpecificValueQuery('usuarios','token','token',$idt);
    //echo 'Consulta : '; print_r($consultaToken);
    //echo 'Variable idt: '.$_GET['idt'];
    if ($consultaToken){
        if($consultaToken['token']!=$idt)
        {
            echo '<script>window.location ="'.$dirIndexOnline.'"</script>';
            return;
        }
        if ($idtad['token']!=$idt){
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
$usuarios = ControladorFormulario::ctrSeleccionarRegistros();
//echo '<pre>';print_r($usuarios);echo'</pre>';

?>
<!-- <link rel="stylesheet" type="text/css" href="http://localhost/cpi_login/Assets/styles-contenido.css"> -->
    
<form method="POST" id="acciones">
    <div class="input-group-prepend justify-content-center align-items-center p-4">
        <button type="submit" class="btn btn-primary d-flex p-1" name="search" value="buscar"><i class="fas fa-search p-1"></i> Buscar</button>
        <input for="inputsm" type="text" class="form-control-plaintext p-1 text-dark" placeholder="      Ingrese el nombre del médico" id="buscar" name="buscar">   
    </div>
    <?php ControladorFormulario::ctrlBusquedaUserPanel($idt); ?>
    <div class="container-fluid p-2 lola bg-light"> <!--bg-light-->
        <h4 class="h3-title text-center"><br><br>Lista de usuarios registrados</h4>
        <p><br>Click en 'Ver' para desplegar el historial de exámenes por médico:</p>
        <table class="table table-dark table-hover text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Especialidad</th>
                    <th>Casa de Salud</th>
                    <th>Key</th>
                    <th>Email</th>
                    <th>Telf</th>
                    <th>Archivo</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($usuarios as $key => $value) : ?>
                    <?php if ($value["name"] != "admin_cpi") : ?>
                        <tr>
                            <td><?php echo $value["id"] ?></td>
                            <td><?php echo $value["name"] ?> </td>
                            <td><?php echo $value["specialty"] ?></td>
                            <td><?php echo $value["home"] ?></td>
                            <td><?php echo $value["password"] ?></td>
                            <td><?php echo $value["email"] ?></td>
                            <td><?php echo $value["phone"] ?></td>
                            <td>
                                <div class="row justify-content-center align-items-center form-group">
                                    <a href="panel_admin.php?modulos=historial_admin&name=<?php echo $value["name"];?>&idt=<?php echo $idt;?>" type="submit" id="ver" name="ver" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                </div>
                            </td>
                            <td>
                                <div class="row justify-content-center align-items-center form-group">
                                    <a href="panel_admin.php?modulos=update_admin&id=<?php echo $value["id"];?>&idt=<?php echo $idt;?>" type="submit" name="editar" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                </div>
                                <div class="row justify-content-center align-items-center form-group">
                                    <form action="" method="post">
                                        <button type="submit" class="btn btn-danger" name="eliminar" value="<?php echo $value["id"] ?>"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</form>
<?php
    $rem = new ControladorFormulario();
    $rem -> ctrEliminarUsuario($idt);

    //ControladorFormulario::ctrlBusquedaUserPanel();
    echo '<script>if(window.history.replaceState){window.history.replaceState( null, null, window.location.href);}</script>';
                    