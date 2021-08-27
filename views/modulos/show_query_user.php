<script>
    function abrir(valor) {
        //alert(valor);
        window.open(valor, "Diseño Web");
    }
</script>
<form method="post" enctype="multipart/form-data">
    <div class="container p-5 bg-light">
        <h4 class="h2-title">Resultados de busqueda</h4>
        <p>Puede visualizar los registros</p>
    </div>
    <table class="table table-dark table-hover text-center">
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
                        <?php
                        $filename = ModeloFormularios::mdlSpecificValueQuery('resultados', 'result', 'code', $value['code']);
                        $user = ModeloFormularios::mdlSpecificValueQuery('resultados', 'dr', 'code', $value['code']);
                        $location = 'http://localhost/cpi_login/views/results/' . $user["dr"] . '/';
                        $dir = $location . $filename['result'] . '.pdf';
                        ?>
                        <td>
                            <div class="row justify-content-center align-items-center form-group">
                                <a onclick="abrir('<?php echo $dir ?>')" name="download" class="btn btn-primary"><i class="fas fa-file-pdf"></i></a>
                                <input type="hidden" name="code" id="code" value="<?php echo $value["code"]; ?>">
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</form>