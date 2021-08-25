<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
    require_once "control.php";
?>
<body>
    <div>

        <?php 
        $dirImagen=DirOculto::ctrIma();
        echo '<img src='.$dirImagen.'>';
        
        ?>
    </div>
    <div>
        <p>DOCUMENTO B</p>
        <?php include "indexA.php"; ?>

        <?php
        DirOculto::ctrFPA();
        ?>
    </div>


</body>

</html>