<?php
    $autolist = ControladorFormulario::Autocomplete();
    $otra = 'sdfsdfsdfesd';
    $var="";
    foreach ($autolist as $key => $value){ 
        if ($value["name"] != "admin_cpi") 
        {   
            $var=$var.$value["name"].',';
        }
    } 
    $var = substr($var, 0, -1);
    //echo $var.'<br>';
    $lista = explode(',', $var, sizeof($autolist)-1);
    //print_r($lista);
    //include '../views/modulos/bootstrap.php';


?>
<form action="#" class="p-5 bg-light" method="post" enctype="multipart/form-data">
    <div class="texto-simple py-2"> 
        <p>Complete la siguiente información:</p>
    </div>
    <div class="form-group">
        <label for="usr">Nombre del medico tratante:</label>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input type="text" class="form-control" id="dr" name="dr">
        </div>
    </div>
    <div class="form-group">
        <label for="id">Número de informe:</label>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
            <input type="text" class="form-control" id="informe" name="informe">
        </div>
    </div>
    <div class="form-group">
        <label for="paciente">Nombre del paciente:</label>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input type="text" class="form-control" id="paciente" name="paciente">
        </div>
    </div>
    <div class="form-group">
        <label for="date">Fecha de recepcion:</label>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
            <input type="date" class="form-control" id="date" name="date">
        </div>
    </div>
    <div class="form-group">
        <label for="date-out">Fecha de entrega:</label>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
            <input type="date" class="form-control" id="date-out" name="date-out">
        </div>
    </div>
    <div>
        <p><br>Seleccione el documento en PDF o Word:</br></p>
    </div>

    <div class="form-group">
        <input type="file" class="form-control-file border" name="file" id="file">
    </div>
    <div class="row justify-content-center align-items-center form-group">
        <button type="submit" class="btn btn-primary" name="upload" id="upload" vlue="upload">Subir</button>
    </div>
</form>
<script type="text/javascript" src="../Assets/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="../Assets/jquery-ui.css">
<script type="text/javascript" src="../Assets/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //var items = [ "pepito juarez","pedrito" ,"lao", "esteban"];
        var items = <?php echo json_encode($lista); ?>;   
        $("#dr").autocomplete({source:items});
    });
</script>    
<?php
ControladorFormulario::ctrIngresoDatosResultados();