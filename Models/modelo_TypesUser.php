<?php
class ModelUserTypes{
    static public function mdlAdmCall(){
        $_SESSION["validarSesionAdmin"]="ok";
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
    static public function mdlUserCall(){
        echo '
            <script>
                if(window.history.replaceState)
                {
                    window.history.replaceState( null, null, window.location.href);
                }
                window.location = "http://localhost/cpi_login/views/panel_usuario.php?modulos=inicio_usuario"
            </script>
            ';
    }
}