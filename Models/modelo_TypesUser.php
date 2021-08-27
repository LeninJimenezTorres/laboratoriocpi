<?php
class ModelUserTypes{
    static public function mdlAdmCall(){
        $_SESSION["validarSesionAdmin"]="ADMIN";
        echo '
            <script>
                if(window.history.replaceState)
                {
                    window.history.replaceState( null, null, window.location.href);
                }
                window.location = "http://localhost/cpi_login/views/panel_admin.php?modulos=inicio_admin"
            </script>
            ';
    }
    static public function mdlUserCall($id,$name){
        $_SESSION["validarSesionUser"]=$id;
        $_SESSION['validarSesionUserName']=$name;
        echo 'Variable sesion en modelo: '.$id;
        echo '
            <script>
                if(window.history.replaceState)
                {
                    window.history.replaceState( null, null, window.location.href);
                }
                window.location = "http://localhost/cpi_login/views/panel_usuario.php?modulos=inicio_user&id='.$id.'&nm='.$name.'"
            </script>
            ';
    }
}