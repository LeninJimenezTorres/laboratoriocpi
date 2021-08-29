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
//AQUI LLAMO A UN CONTROLADOR QUE CONSULTA LOS DATOS EN LA DB DEL ID DE LA VARIABLE GET
if(isset($_GET['id'])){
    $tabla = 'usuarios';
    $column = 'id';
    $valor = $_GET['id'];
    if($valor!=1)
    {
      $usuario = ControladorFormulario::ctrConsultaDatos($tabla, $column, $valor);
      //echo '<pre>'; print_r($usuario);echo '</pre>';  
    }
}
?>

<link rel="stylesheet" type="text/css" href="http://localhost/cpi_login/Assets/styles-messages.css">
    
<form class="p-5 bg-light" method="post" id="update">
  <div class="texto-simple">
    <p>Modifique los datos que desee, todos son opcionales</p>
  </div>
  <div class="form-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-user"></i></span>
      <input type="text" class="form-control" id="nombre" name="update_nombre" placeholder="Ingrese Nombres Completos" value="<?php if(!empty($usuario["name"])){echo $usuario["name"];} else {echo '';}?>" required>
    </div>
  </div>
  <div class="form-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-book-medical"></i></span>
      <input type="text" class="form-control" id="especialidad" name="update_especialidad" placeholder="Ingrese la Especialidad" value="<?php if(!empty($usuario["specialty"])){echo $usuario["specialty"];} else {echo '';}?>" required>
    </div>
  </div>
  <div class="form-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-hospital"></i></span>
      <input type="text" class="form-control" id="casa" name="update_casa" placeholder="Ingrese la Casa de salud" value="<?php if(!empty($usuario["home"])){echo $usuario["home"];} else {echo '';} ?>" required>
    </div>
  </div>
  <div class="form-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-key"></i></span>
      <input type="text" class="form-control" id="pass" name="update_pass" placeholder="Cambie la Contraseña">
      <input type="hidden" name="old_pass" id="old_pass" value="<?php if(!empty($usuario["password"])){echo $usuario["password"];} else {echo '';} ?>">
      <input type="hidden" name="id" id="id" value="<?php echo $usuario["id"];?>">
    </div>
  </div>
  <div class="form-group">
    <div class="input-group-prepend">
      <span class="input-group-text">@</span>
      <input type="email" class="form-control" id="mail" name="update_email" placeholder="Ingrese el Email" value="<?php if(!empty($usuario["email"])){echo $usuario["email"];} else {echo '';} ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
      <input type="tel" class="form-control" id="phone" name="update_telf" placeholder="Ingrese el teléfono" value="<?php if(!empty($usuario["phone"])){echo $usuario["phone"];} else {echo '';} ?>">
    </div>
  </div>
  <div class="row justify-content-center align-items-center form-group py-5">
    <button type="submit" class="btn btn-primary" style="align-content:center" name="actualizar">Actualizar</button>
  </div>
  <div class = "warnings">
    <p id="msgGeneral"></p>
    <p class = "warnings" id="warnings"></p>
  </div>  
  <?php
        include 'bootstrap.php';
        $mod = new ControladorFormulario();
        $mod->ctrUpdate($idt);
        
  ?>
</form>
