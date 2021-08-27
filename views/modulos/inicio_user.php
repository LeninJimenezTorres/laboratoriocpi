<?php

if (isset($_GET['id']) && isset($_GET['nm'])) {
    if($_GET['id']== $_SESSION["validarSesionUser"] 
        && $_GET['nm']==$_SESSION["validarSesionUserName"])
    {
        //echo $_GET['id'].'<br><br><br>';
        //Consulta del nombre del id
        $dr = ControladorFormulario::ctrConsultaDatos('usuarios', 'id', $_GET['id']);
        //Consulta de todos los registros de resultados con el nombre del dr
        $resultados = ControladorFormulario::ctrConsultaDatosEspecificosUser('resultados', 'dr', $dr['name']);
        //echo 'Doctor: '; print_r($dr['name']);
        //echo '<pre>';print_r($resultados);echo'</pre>';
        $validacion = 'OK';
    }
    else{
        $validacion = 'WRONG';
    }
}
?>
<form method="post">
    <div class="container p-5 bg-light">
        <?php if ($validacion == 'OK'):?>
        <h4 class="h2-title">Historial del Dr.
            <?php echo $dr['name']; ?>
        </h4>
        <p>Puede descargar los informes de los resultados</p>
        <div class="input-group-prepend justify-content-center align-items-center p-4">
            <button type="submit" class="btn btn-primary d-flex p-1" name="search"><i class="fas fa-search p-1"></i> Buscar</button>
            <input for="inputsm" type="text" class="form-control-plaintext p-1 text-dark" placeholder="      Ingrese el nombre del paciente" id="buscar" name="buscar">
            
        </div>
        <?php ControladorFormulario::ctrlBusquedaResultPanel($dr['name']); ?>
        <?php endif?>
    </div>
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
                <?php
                if (isset($value["result"]) && isset($value["dr"])) {
                    ControladorFormulario::ctrDownload();
                }
                ?>
            <?php endif ?>
        </tbody>
    </table>
</form>
<?php
echo '<script>if(window.history.replaceState){window.history.replaceState( null, null, window.location.href);}</script>';
