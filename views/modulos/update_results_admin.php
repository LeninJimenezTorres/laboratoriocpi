<?php
//AQUI LLAMO A UN CONTROLADOR QUE CONSULTA LOS DATOS EN LA DB DEL ID DE LA VARIABLE GET
if(isset($_GET['code'])){
    $tabla = 'resultados';
    $column = 'code';
    $valor = $_GET['code'];
    $datosResultado = ControladorFormulario::ctrConsultaDatos($tabla, $column, $valor);
}
?>

<!-- <link rel="stylesheet" type="text/css" href="http://localhost/cpi_login/Assets/styles-messages.css"> -->
    
<form class="p-5 bg-light" method="post" enctype="multipart/form-data">
    <div class="texto-simple">
        <h5>Médico <?php 
        $datosResultado = ControladorFormulario::ctrConsultaDatos('resultados', 'code', $_GET['code']);
        echo $datosResultado['dr'];?>
        </h5>
    </div>
    <div class="texto-simple">
        <p>Modifique los datos que desee, todos son opcionales</p>
    </div>
  <div class="form-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-user"></i></span>
      <input type="text" class="form-control" name="update_patient" placeholder="Ingrese el nombre del paciente" value="<?php if(!empty($datosResultado["patient"])){echo $datosResultado["patient"];} else {echo '';}?>" >
    </div>
  </div>
  <div class="form-group">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
        <input type="date" class="form-control" name="update_reception" placeholder="Seleccione la fecha de recepción" value="<?php if(!empty($datosResultado["reception"])){echo $datosResultado["reception"];} else {echo '';}?>" >
    </div>
  </div>
  <div class="form-group">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
        <input type="date" class="form-control" name="update_deliver" placeholder="Seleccione la fecha de entrega" value="<?php if(!empty($datosResultado["deliver"])){echo $datosResultado["deliver"];} else {echo '';} ?>" >
    </div>
  </div>
  <div class="form-group">
      <p>Seleccione otro documento si desea cambiarlo</p>  
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
        <input type="file" class="form-control-file border" name="file" id="file">
        <input type="hidden" name="code" id="code" value="<?php if(!empty($datosResultado["code"])){echo $datosResultado["code"];} else {echo '';} ?>">
    </div>
  </div>
  <div class="row justify-content-center align-items-center form-group py-5">
    <button type="submit" class="btn btn-primary" style="align-content:center" name="actualizar_result">Actualizar</button>
  </div>
  <div class = "warnings">
    <p id="msgGeneral"></p>
    <p class = "warnings" id="warnings"></p>
  </div>  
  <?php
        include 'bootstrap.php';
        ControladorFormulario::ctrUpdateResult();
        
  ?>
</form>