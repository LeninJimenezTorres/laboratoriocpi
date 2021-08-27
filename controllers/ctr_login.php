
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://kit.fontawesome.com/a1eaea322c.js" crossorigin="anonymous"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
require_once "Models/conexion_registros.php";
require_once "Models/modelo_formulario.php";
require_once 'ctr_panel.php';
                    
class ControladorLogin{
    public function ctrLogin()
    {
        echo '<p></p>';
        if(isset($_POST["ingreso"]))
        {
            if (preg_match('/^[_a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/',$_POST["nombre"])
            && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_]+$/',$_POST["passwd"]))
            { 
                $tabla = 'usuarios';
                $column = 'name';
                $valor = $_POST['nombre'];
                $respuesta = ModeloFormularioMain::mdlConsultaEspecfDB($tabla, $column, $valor);
                
                if (isset($respuesta['name']) && isset($respuesta['password'])){
                    if($respuesta['name']==$_POST["nombre"] && $respuesta['password']==$_POST["passwd"]){
                        // echo '<p>'.print_r($respuesta).'</p>';
                        echo '<div class="alert-success">Ingreso exitoso</div>';
                           
                        if($respuesta['name'] == "admin_cpi")
                        {
                            //INICIO LA PRIVATIZACION COGIENDO LA VARIABLE DE SESSION EN EL INGRESO
                            $adm=new ControladorTypePanel();
                            $adm->ctrAbrirPanelAdmin();
                            //print_r($_SESSION);
                        }
                        else{
                            //include "/views/panel_usuario.php";
                            $id=$respuesta['id'];
                            echo 'Este es el id= ';print_r($id);
                            ModelUserTypes::mdlUserCall($id,$respuesta['name']);
                            //$adm=new ControladorTypePanel();
                            //$adm->ctrAbrirPanelUser($respuesta['id']);
                        }
                    }     
                }
                //if (!isset($respuesta['name'])){ 
                else{
                    echo '<div class="alert-danger"">Usuario no encontrado</div>';
                } 

                
                //echo '<script>if(window.history.replaceState){window.history.replaceState( null, null, window.location.href);}</script>';
                
                    $_SESSION["validarSesionAdmin"]="bad";
            }
            else {
                echo '<div class="alert-danger text-center">Error de ingreso, se ha detectado caracteres no permitidos <br></div>'; 
            }

        }
    }          
}
?>