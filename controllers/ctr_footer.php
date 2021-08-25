<?php
    class DirsFooter{
        static public function ctrFPA(){
            echo '<script type="text/javascript" src="script.js"></script>'; 
        }
        static public function dirCSSFooterPA(){
            echo '<link rel="stylesheet" type="text/css" href="../Assets/styles-b.css">';
        }
        static public function dirCSSFooterPL(){
            echo '<link rel="stylesheet" type="text/css" href="../Assets/styles.css">';
        }
        static public function dirFooterPA(){
            include "../Views/Modulos/footerAuthorPA.php";
        }
        static public function dirFooterPL(){
            include "Views/Modulos/footerAuthorPL.php";
        }
        static public function dirCopyRight(){
            include "../Views/Modulos/footerCopyRight.php";
        }
        static public function dirCopyRightL(){
            include "Views/Modulos/footerCopyRight.php";
        }
    }
?>
