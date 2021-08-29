<?php
require_once '../Models/modelo_formulario_admin.php';

//TOMO EL TOKEN DE LA VARIABLE GET
$dirPanelAdmin='../views/panel_admin.php';
$dirPanelAdminModuloSalir='../views/panel_admin.php?modulos=salir_admin';
$dirIndexOnline='../index_online.php';
$idtad=ModeloFormularios::mdlUserDataSpecific('usuarios','id','1');
//print_r($idtad);
//echo '<br><br>';
//echo 'Token admin: '; print_r($idtad['token']);
if ($_GET['idt']){
    $idt=$_GET['idt'];
    $consultaToken=ModeloFormularios::mdlSpecificValueQuery('usuarios','token','token',$idt);
    //echo 'Consulta : '; print_r($consultaToken);
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
    require_once "../controllers/ctr_formularios.php";
    require_once "../Models/modelo_formulario_admin.php";

    // require_once "../Models/conexion_registros.php";
    // $conexionRegistroDB = ConexionRegistrosDB::conectar();
    // echo '<pre>'; print_r($conexionRegistroDB);
    // echo '</pre>'
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../Assets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Assets/styles-contenido.css">
    <link rel="stylesheet" type="text/css" href="../Assets/styles_warnings.css">
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://kit.fontawesome.com/a1eaea322c.js" crossorigin="anonymous"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Control Panel</title>

</head>

<body>
    <!--Logo-->
    <div class="container-fluid head2">
        <h1 class="text-center py-3 text-s">SCOL</h1>
        <p class="text-center text-s space">Sistema de Consulda Online Lux<br></p>
    </div>
    <!--NavBar-->
    <div class="container-fluid ">
        <div class="container">
            <nav class="nav justify-content-center py-1 bg-light">
                <!-- Links -->
                <ul class="nav nav-pills justify-content-center">

                    <?php if (isset($_GET["modulos"])) : ?>
                        <?php if ($_GET["modulos"] == "inicio_admin") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo $dirPanelAdmin.'?modulos=inicio_admin&idt='.$idt;?>">Inicio</a>
                                <!-- Paso la variable por metodo get y post -->
                                <input type="hidden" name="idt" id="code" value="<?php echo $idt; ?>">
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $dirPanelAdmin.'?modulos=inicio_admin&idt='.$idt;?>">Inicio</a>
                                <input type="hidden" name="idt" id="code" value="<?php echo $idt; ?>">
                            </li>
                        <?php endif ?>
                        <?php if ($_GET["modulos"] == "registro_admin") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo $dirPanelAdmin.'?modulos=registro_admin&idt='.$idt;?>">Registrar</a>
                                <input type="hidden" name="idt" id="code" value="<?php echo $idt; ?>">
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $dirPanelAdmin.'?modulos=registro_admin&idt='.$idt;?>">Registrar</a>
                                <input type="hidden" name="idt" id="code" value="<?php echo $idt; ?>">
                            </li>
                        <?php endif ?>
                        <?php if ($_GET["modulos"] == "carga_admin") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo $dirPanelAdmin.'?modulos=carga_admin&idt='.$idt;?>">Subir</a>
                                <input type="hidden" name="idt" id="code" value="<?php echo $idt; ?>">
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $dirPanelAdmin.'?modulos=carga_admin&idt='.$idt;?>">Subir</a>
                                <input type="hidden" name="idt" id="code" value="<?php echo $idt; ?>">   
                            </li>
                        <?php endif ?>
                        <?php if ($_GET["modulos"] == "buscar_admin") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo $dirPanelAdmin.'?modulos=buscar_admin&idt='.$idt;?>">Buscar</a>
                                <input type="hidden" name="idt" id="code" value="<?php echo $idt; ?>">
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $dirPanelAdmin.'?modulos=buscar_admin&idt='.$idt;?>">Buscar</a>
                                <input type="hidden" name="idt" id="code" value="<?php echo $idt; ?>">
                            </li>
                        <?php endif ?>
                        <?php if ($_GET["modulos"] == "salir_admin") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href= "<?php echo $dirPanelAdmin.'?modulos=salir_admin&idt='.$idt;?>">Salir</a>
                                <input type="hidden" name="idt" id="code" value="<?php echo $idt; ?>">
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $dirPanelAdmin.'?modulos=salir_admin&idt='.$idt;?>">Salir</a>
                                <input type="hidden" name="idt" id="code" value="<?php echo $idt; ?>">
                            </li>
                        <?php endif ?>

                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo $dirPanelAdmin.'?modulos=inicio_admin&idt='.$idt;?>">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $dirPanelAdmin.'?modulos=registro_admin&idt='.$idt;?>">Registrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $dirPanelAdmin.'?modulos=carga_admin&idt='.$idt;?>">Subir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $dirPanelAdmin.'?modulos=buscar_admin&idt='.$idt;?>">Buscar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $dirPanelAdmin.'?modulos=salir_admin&idt='.$idt;?>">Salir</a>
                        </li>
                        <input type="hidden" name="idt" id="code" value="<?php echo $idt; ?>">
                    <?php endif ?>
                </ul>
            </nav>
        </div>
    </div>
    <div class="container-fluid contenido">
        <div class="container py-5">
            <?php

            if (isset($_GET["modulos"])) {
                if (($_GET["modulos"] == "carga_admin") ||
                    ($_GET["modulos"] == "salir_admin") ||
                    ($_GET["modulos"] == "registro_admin") ||
                    ($_GET["modulos"] == "update_admin") ||
                    ($_GET["modulos"] == "historial_admin") ||
                    ($_GET["modulos"] == "update_results_admin") ||
                    ($_GET["modulos"] == "buscar_admin") ||
                    //($_GET["modulos"] == "buscarInicio_admin") ||
                    ($_GET["modulos"] == "inicio_admin")
                ) {
                    include "../views/modulos/" . $_GET["modulos"] . ".php";
                }
                else{
                    header('Location:../views/error-404.html');
                    die();
                }
            } else {
                include "../views/modulos/inicio_admin.php";
            }
            ?>
        </div>
    </div>
    <footer>
        <?php 
        include "../controllers/ctr_footer.php";
        DirsFooter::dirCSSFooterPA();
        DirsFooter::dirFooterPA(); 
        DirsFooter::dirCopyRight();
        ?>
    </footer>
</body>

</html>