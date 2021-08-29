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
                //$validacion = 'WRONG';x`  
                echo '<script>window.location ="'.$dirIndexOnline.'"</script>';
                return;
            }
            if ($idtad['token']!=$idt){
                //$validacion = 'WRONG';
                echo '<script>window.location ="'.$dirIndexOnline.'"</script>';
                return;
            }
            else if($idtad['token']==$idt){
                $dr = ControladorFormulario::ctrConsultaDatos('usuarios', 'name', $_GET['name']);
                //Consulta de todos los registros de resultados con el nombre del dr
                //$resultados = ControladorFormulario::ctrConsultaDatosEspecificosUser('resultados', 'dr', $dr['name']);
                //$validacion = 'OK';        
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
    //<?php if ($validacion == 'OK'):
    //<?php endif
    $resultados = ControladorFormulario::ctrConsultaDatosEspecificosUser('resultados', 'dr', $dr['name']);
                
?>
<form method="post">
    <div class="container p-5 bg-light">
        <h4 class="h2-title">Historial del Dr.
            <?php echo $dr['name']; ?>
        </h4>
        <p>Puede descargar los informes de los resultados</p>
        <div class="input-group-prepend justify-content-center align-items-center p-4">
            <button type="submit" class="btn btn-primary d-flex p-1" name="search"><i class="fas fa-search p-1"></i> Buscar</button>
            <input for="inputsm" type="text" class="form-control-plaintext p-1 text-dark" placeholder="      Ingrese el nombre del paciente" id="buscar" name="buscar"> 
        </div>
    </div>
    <?php ControladorFormulario::ctrlBusquedaResultPanel($dr['name'],$idt);?>
    <table class="table table-dark table-hover text-center">
        <thead>
            <tr>
                <th>Nombre del paciente</th>
                <th>Fecha recepción de muestra</th>
                <th>Fecha entrega de resultado</th>
                <th>Informe</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($resultados)) : ?>
                <?php foreach ($resultados as $key => $value) : ?>
                    <tr>
                        <td><?php echo $value["patient"] ?></td>
                        <td><?php echo $value["reception"] ?></td>
                        <td><?php echo $value["deliver"] ?></td>
                        <td>
                            <div class="row justify-content-center align-items-center form-group">
                                <button type="submit" name="download" value="<?php echo $value["code"] ?>" class="btn btn-primary"><i class="fas fa-file-pdf"></i></button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
               
            <?php endif ?>
        </tbody>
    </table>
</form>
<?php
ControladorFormulario::ctrDownload($idt);
echo '<script>if(window.history.replaceState){window.history.replaceState( null, null, window.location.href);}</script>';
