<form method="post">
    <div class="container-fluid p-2 lola bg-light">
        <!--bg-light-->
        <p><br>Seleccione la fecha de solicitud:</p>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
            <input type="date" class="form-control" id="fecha" name="fecha">
            <button type="submit" class="btn btn-primary d-flex p-1" name="search"><i class="fas fa-search p-1"></i> Buscar</button>
        </div>
    </div>
</form>
<?php ControladorFormulario::ctrBusquedaUserReception('reception');