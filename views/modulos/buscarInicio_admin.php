<form method="post" id="acciones2">
    <div class="container-fluid p-2 lola"> <!--bg-light-->
        <h4 class="h3-title text-center"><br><br>Resultados</h4>
        <!-- <p><br>Click en 'Ver' para desplegar el historial de exámenes por médico:</p> -->
        <table class="table table-dark table-hover" id='resultadosTabla'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Especialidad</th>
                    <th>Casa de Salud</th>
                    <th>Key</th>
                    <th>Email</th>
                    <th>Telf</th>
                    <th>Archivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php if ($consulta["name"] != "admin_cpi") : ?>
                    <tr>
                        <td><?php echo $consulta["id"] ?></td>
                        <td><?php echo $consulta["name"] ?></td>
                        <td><?php echo $consulta["specialty"] ?></td>
                        <td><?php echo $consulta["home"] ?></td>
                        <td><?php echo $consulta["password"] ?></td>
                        <td><?php echo $consulta["email"] ?></td>
                        <td><?php echo $consulta["phone"] ?></td>
                        <td>
                            <div class="row justify-content-center align-items-center form-group">
                                <a href="panel_admin.php?modulos=historial_admin&name=<?php echo $consulta["name"];?>" type="submit" id="ver" name="ver" class="btn btn-primary">Ver</a>
                            </div>
                        </td>
                        <td>
                            <div class="row justify-content-center align-items-center form-group">
                                <a href="panel_admin.php?modulos=update_admin&id=<?php echo $consulta["id"];?>" type="submit" name="editar" class="btn btn-warning">Editar</a>
                            </div>
                            <div class="row justify-content-center align-items-center form-group">
                                <form action="" method="post">
                                    <button type="submit" class="btn btn-danger" name="eliminar" value="<?php echo $cons["id"] ?>">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</form>
<?php
    $rem = new ControladorFormulario();
    $rem -> ctrEliminarUsuario();
    echo '<script>if(window.history.replaceState){window.history.replaceState( null, null, window.location.href);}</script>';
                    
    