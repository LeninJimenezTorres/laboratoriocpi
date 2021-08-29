<form method="post" id="acciones2">
    <div class="container-fluid p-2 lola">
        <!--bg-light-->
        <h4 class="h3-title text-center"><br><br>Resultados</h4>
        <!-- <p><br>Click en 'Ver' para desplegar el historial de exámenes por médico:</p> -->
        <table class="table table-dark table-hover text-center" id='resultadosTabla'>
            <thead>
                <tr>
                    <th>Nombre del paciente</th>
                    <th>Fecha recepción de muestra</th>
                    <th>Fecha entrega de resultado</th>
                    <th>Informe</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($consulta)) : ?>
                    <?php foreach ($consulta as $key => $value) : ?>
                        <tr>
                            <td><?php echo $value["patient"] ?></td>
                            <td><?php echo $value["reception"] ?></td>
                            <td><?php echo $value["deliver"] ?></td>
                            <td>
                                <div class="row justify-content-center align-items-center form-group">
                                    <form action="" method="post">
                                        <button type="submit" name="download" value="<?php echo $value["code"] ?>" class="btn btn-primary"><i class="fas fa-file-pdf"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>

                <?php endif ?>
            </tbody>
        </table>
    </div>
</form>
<?php
ControladorFormulario::ctrDownload();
echo '<script>if(window.history.replaceState){window.history.replaceState( null, null, window.location.href);}</script>';
