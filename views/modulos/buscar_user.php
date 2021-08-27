<form method="post">
    <nav class="nav justify-content-center py-2 d-flex flex-column">
        <ul class="nav nav-pills justify-content-center">
            <?php if (isset($_GET["modulos"])) : ?>
                <?php if ($_GET["modulos"] == "buscar_user_patient") : ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="../views/panel_usuario.php?modulos=buscar_user_patient">Busqueda por nombre</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/panel_usuario.php?modulos=buscar_user_patient">Busqueda por nombre</a>
                    </li>
                <?php endif ?>
                <?php if ($_GET["modulos"] == "buscar_user_reception") : ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="../views/panel_usuario.php?modulos=buscar_user_reception">Busqueda por fecha de solicitud</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/panel_usuario.php?modulos=buscar_user_reception">Busqueda por fecha de solicitud</a>
                    </li>
                <?php endif ?>
                <?php if ($_GET["modulos"] == "buscar_user_deliver") : ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="../views/panel_usuario.php?modulos=buscar_user_deliver">Busqueda por fecha de entrega</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/panel_usuario.php?modulos=buscar_user_deliver">Busqueda por fecha de entrega</a>
                    </li>
                <?php endif ?>

            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link active" href="../views/panel_usuario.php?modulos=buscar_user_patient">Busqueda por nombre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../views/panel_usuario.php?modulos=buscar_user_reception">Busqueda por fecha de solicitud</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../views/panel_usuario.php?modulos=buscar_user_deliver">Busqueda por fecha de entrega</a>
                </li>
            <?php endif ?>
        </ul>
    </nav>
</form>
<?php
$a = 1;
//ControladorFormulario::ctrBusquedaFiltro();