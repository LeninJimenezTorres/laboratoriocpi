<form method="post" id="form-buscar">
    <div class="container-fluid p-2 lola bg-light">
        <!--bg-light-->
        <h4 class="h3-title text-center"><br><br>BUSQUEDA</h4>
        <p><br>Seleccione e ingrese el parámetro de búsqueda:</p>
        <ul class="nav nav-pills">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-search p-1"></i>FILTRO</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="panel_admin.php?modulos=buscar_admin&type=patient" value="patient">Nombre del paciente</a>
                    <a class="dropdown-item" href="panel_admin.php?modulos=buscar_admin&type=doctor" value="doctor">Nombre del médico</a>
                    <!-- <a class="dropdown-item" href="#">Fecha</a> -->
                </div>
            </li>
        </ul>
        <div class="input-group-prepend justify-content-center align-items-center p-4">
            <input for="inputsm" type="text" class="form-control-plaintext p-1 text-darck" placeholder="      Ingrese el nombre" id="valor" name="valor">
            <button  type="submit" class="btn btn-primary d-flex p-1" name="buscar" value="buscar"><i class="fas fa-search p-1"></i> Buscar</button>
        </div>
    </div>
</form>
<?php ControladorFormulario::ctrBusquedaFiltro();