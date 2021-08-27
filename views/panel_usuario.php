<?php
    require_once "../controllers/ctr_formularios.php";
    require_once "../Models/modelo_formulario_admin.php";
    session_start();
    // if(isset($_SESSION)){
    //     echo '<script>alert('.print_r($_SESSION).')</script>';
    // }
    if(isset($_SESSION["validarSesionUser"])){
        //CONSULTO SI EL ID ESTA EN LA BASE DE DATOS DE LOS DR
        //echo 'Variable sesion ID en panel: '.$_SESSION["validarSesionUser"].'<br><br>';
        //echo 'Variable sesion Name en panel: '.$_SESSION["validarSesionUserName"].'<br><br>';
        
        $existe = ControladorFormulario::ctrDatoExistente('usuarios','id',$_SESSION["validarSesionUser"]);//me devuelve el id
        //echo 'Existe el usuario: ';
        //print_r($existe);
        if($_SESSION["validarSesionUser"]!=$existe['id'] || $_SESSION['validarSesionUserName']!=$existe['name']){
            echo '<script>window.location = "http://localhost/cpi_login/index_online.php"</script>';
            return;
        }
    }
    else{
        echo '<script>window.location = "http://localhost/cpi_login/index_online.php"</script>';
        return;
    }
;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
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
                        <?php if ($_GET["modulos"] == "inicio_user") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="../views/panel_usuario.php?modulos=inicio_user&id=<?php echo $existe['id'];?>&nm=<?php echo $_SESSION["validarSesionUserName"];?>">Inicio</a>

                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../views/panel_usuario.php?modulos=inicio_user&id=<?php echo $existe['id'];?>&nm=<?php echo $_SESSION["validarSesionUserName"];?>">Inicio</a>
                            </li>
                        <?php endif ?>
                        <?php if ($_GET["modulos"] == "buscar_user") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="../views/panel_usuario.php?modulos=buscar_user">Buscar</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../views/panel_usuario.php?modulos=buscar_user">Buscar</a>
                            </li>
                        <?php endif ?>
                        <?php if ($_GET["modulos"] == "salir_admin") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="../views/panel_usuario.php?modulos=salir_admin">Salir</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../views/panel_usuario.php?modulos=salir_admin">Salir</a>
                            </li>
                        <?php endif ?>

                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="../views/panel_usuario.php?modulos=inicio_user&id=<?php echo $existe['id'];?>&nm=<?php echo $_SESSION["validarSesionUserName"];?>">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../views/panel_usuario.php?modulos=buscar_user">Buscar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../views/panel_usuario.php?modulos=salir_admin">Salir</a>
                        </li>
                    <?php endif ?>
                </ul>
            </nav>
        </div>
    </div>
    <div class="container-fluid contenido">
        <div class="container py-5">
            <?php

            if (isset($_GET["modulos"])) {
                if (($_GET["modulos"] == "buscar_user") ||
                    ($_GET["modulos"] == "buscar_user_patient") ||
                    ($_GET["modulos"] == "buscar_user_reception") ||
                    ($_GET["modulos"] == "buscar_user_deliver") ||
                    ($_GET["modulos"] == "inicio_user") ||
                    ($_GET["modulos"] == "salir_admin")
                ) {
                    include "../views/modulos/" . $_GET["modulos"] . ".php";
                }
                else{
                    header('Location:../views/error-404.html');
                    die();
                }
            } else {
                include "../views/modulos/inicio_user.php";
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