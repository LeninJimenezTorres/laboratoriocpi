<?php
class ModelUserTypes{
    static public function mdlAdmCall($token){
        //$_SESSION["validarSesionAdmin"]="ADMIN";
        echo '
            <script>
                if(window.history.replaceState)
                {
                    window.history.replaceState( null, null, window.location.href);
                }
                window.location = "http://localhost/cpi_login/views/panel_admin.php?modulos=inicio_admin&idt='.$token.'"
            </script>
            ';
    }
    static public function mdlUserCall($token,$name){
        //$_SESSION["validarSesionUser"]=$id;
        //$_SESSION['validarSesionUserName']=$name;
        echo '
            <script>
                if(window.history.replaceState)
                {
                    window.history.replaceState( null, null, window.location.href);
                }
                window.location = "http://localhost/cpi_login/views/panel_usuario.php?modulos=inicio_user&name='.$name.'&idt='.$token.'"
            </script>
            ';
    }
}