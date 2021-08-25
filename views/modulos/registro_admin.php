<?php include '../views/modulos/bootstrap.php'; ?>
<link rel="stylesheet" type="text/css" href="http://localhost/cpi_login/Assets/styles-messages.css">

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
  <?php

  //$nombre = new ControladorFormulario();
  //$nombre -> ctrRegistro();
  ControladorFormulario::ctrRegistroUsuarioValidado();
  // if ($registro == "ok") 
  // {
  //   echo '<script>
  //     if(window.history.replaceState)
  //     {
  //         window.history.replaceState( null, null, window.location.href);
  //     }
  //     </script>';

  //     echo '<div class="alert-success">Registro exitoso</div>';
  // }
  // if ($registro != "ok") 
  // {
  //   echo '<script>
  //     if(window.history.replaceState)
  //     {
  //         window.history.replaceState( null, null, window.location.href);
  //     }
  //     </script>';

  //     if (!empty($registro)){
  //     echo '<div class="alert-warning">Error de ingreso de datos</div>'; 
  //       if (!empty($registro['name'])){
  //         echo '<div class="alert-warning"> - '.$registro['name'].'</div>';
  //       }
  //       if (!empty($registro['specialty'])){
  //         echo '<div class="alert-warning"> - '.$registro['specialty'].'</div>';
  //       }
  //       if (!empty($registro['home'])){
  //         echo '<div class="alert-warning"> - '.$registro['home'].'</div>';
  //       }
  //       if (!empty($registro['password'])){
  //         echo '<div class="alert-warning"> - '.$registro['password'].'</div>';
  //       }

  //   }
  // }
  ?>
</form>
<!-- <script type="text/javascript" src="http://localhost/cpi_login/Assets/script_registro.js"></script> -->