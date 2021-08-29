<?php
header("location:../index_online.php");
//echo '<script> setTimeout(function(){window.location = "../views/panel_admin.php?modulos=inicio_admin&idt='.$idt.'";},3000)</script>';
                    
session_destroy();
die();
?>