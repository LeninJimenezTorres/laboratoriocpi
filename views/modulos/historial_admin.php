<?php
//$resultados = ControladorFormulario::ctrShowResults($_POST['ver']);
if (isset($_GET["name"])){
    $val=$_GET["name"];
    //echo $val;
    $resultados=ControladorFormulario::ctrShowResults($val);    
}
else{
    //echo '<script>window.location = "../views/panel_admin.php?modulos=inicio_admin";</script>';
    $resultados=null;
                
}
//print_r($resultados);
//echo '<br>'. sizeof($resultados);
?>
<form method="post">
    <div class="container p-5 bg-light">
        <h4 class="h2-title">Historial</h4>
        <p>Puede visualizar, editar y eliminar los registros</p>
        
    </div>
    <div class="container p-5 bg-dark text-light text-center">
        <h5> Médico 
        <?php echo $_GET['name'];?>   
        </h5> 
    </div>
    <table class="table table-dark table-hover text-center">
        <thead>
            <tr>
                <th>Nombre del paciente</th>
                <th>Codigo de Informe</th>
                <th>Fecha recepción de muestra</th>
                <th>Fecha entrega de resultado</th>
                <th>Informe</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($resultados)): ?>
                <?php foreach ($resultados as $key => $value) : ?>
                    <tr>
                        <td><?php echo $value["patient"] ?></td>
                        <td><?php echo $value["code"] ?></td>
                        <td><?php echo $value["reception"] ?></td>
                        <td><?php echo $value["deliver"] ?></td>
                        <td>
                            <div class="row justify-content-center align-items-center form-group">
                                <button type="submit" name="download" value="<?php echo $value["code"] ?>" class="btn btn-primary"><i class="fas fa-file-pdf"></i></button>        
                            </div>
                        </td>
                        <td>
                            <div class="row justify-content-center align-items-center form-group">
                                <a href="panel_admin.php?modulos=update_results_admin&code=<?php echo $value["code"];?>" type="submit" name="update_result" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                            </div>
                            <div class="row justify-content-center align-items-center form-group">
                                <button type="submit" name="eliminar" value="<?php echo $value["code"] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
                <?php
                    if (isset($value["result"]) && isset($value["dr"]))
                    {
                        ControladorFormulario::ctrEliminarExamen();
                        ControladorFormulario::ctrDownload();    
                    } 
                ?>
                    
            <?php endif ?>

        </tbody>
    </table>
</form>

