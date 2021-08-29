<?php include '../views/modulos/bootstrap.php'; ?>
<link rel="stylesheet" type="text/css" href="http://localhost/cpi_login/Assets/styles-messages.css">

<?php
$dirIndexOnline='../index_online.php';
if ($_GET['idt']){
  $idt=$_GET['idt'];
  $consultaToken=ModeloFormularios::mdlSpecificValueQuery('usuarios','token','token',$idt);
  //echo 'Consulta : '; print_r($consultaToken);
  //echo 'Variable idt: '.$_GET['idt'];
  if ($consultaToken){
      if($consultaToken['token']!=$idt)
      {
          echo '<script>window.location ="'.$dirIndexOnline.'"</script>';
          return;
      }
      if ($idtad['token']!=$idt){
          echo '<script>window.location ="'.$dirIndexOnline.'"</script>';
          return;
      }
  }
  else{
      echo '<script>window.location ="'.$dirIndexOnline.'"</script>';
      return;
  }          
}
else{
  echo '<script>window.location ='.$dirIndexOnline.'</script>';
  return;
}
?>
<form class="p-5 bg-light" method="post" id="registro">
  <div class="texto-simple">
    <p>Ingrese los datos del usuario</p>
  </div>
  <div class="form-group">
    <label for="nombre">Nombres Completos:</label>
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-user"></i></span>
      <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
  </div>
  <div class="form-group">
    <label for="especialidad">Especialidad:</label>
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-book-medical"></i></span>
      <input type="text" class="form-control" id="especialidad" name="especialidad" required>
    </div>
  </div>
  <div class="form-group">
    <label for="casa">Casa de salud:</label>
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-hospital"></i></span>
      <input type="text" class="form-control" id="casa" name="casa" required>
    </div>
  </div>
  <div class="form-group">
    <label for="pwd">Contraseña:</label>
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-key"></i></span>
      <input type="text" class="form-control" id="pass" name="pass" required>
    </div>
  </div>
  <div class="form-group">
    <label for="mail">Email:</label>
    <div class="input-group-prepend">
      <span class="input-group-text">@</span>
      <input type="email" class="form-control" id="email" name="email">
    </div>
  </div>
  <div class="form-group">
    <label for="phone">Telefono:</label>
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
      <input type="tel" class="form-control" id="phone" name="telf">
    </div>
  </div>
  <div class="row justify-content-center align-items-center form-group py-5">
    <button type="submit" class="btn btn-primary" style="align-content:center" name="submit">Registrar</button>
  </div>
  <div class="warnings">
    <p id="msgGeneral"></p>
    <p class="warnings" id="warnings"></p>
  </div>
  <?php ControladorFormulario::ctrRegistroUsuarioValidado($idt);?>
</form>
<!-- <script type="text/javascript" src="http://localhost/cpi_login/Assets/script_registro.js"></script> -->