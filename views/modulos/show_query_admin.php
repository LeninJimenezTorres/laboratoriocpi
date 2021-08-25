<form method="post" id="otro" enctype="multipart/form-data">
    <div class="container p-5 bg-light">
        <h4 class="h2-title">Resultados de busqueda</h4>
        <p>Puede visualizar los registros</p>
    </div>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>Nombre del paciente</th>
                <th>Nombre del médico</th>
                <th>Codigo de Informe</th>
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
                        <td><?php echo $value["dr"] ?></td>
                        <td><?php echo $value["code"] ?></td>
                        <td><?php echo $value["reception"] ?></td>
                        <td><?php echo $value["deliver"] ?></td>
                        <td>
                            <div class="row justify-content-center align-items-center form-group">
                                <button type="submit" name="ver" value="<?php echo $value["code"]; ?>" class="btn btn-primary">Descargar</button>
                                <input type="hidden" name="code" id="code" value="<?php echo $value["code"]; ?>">
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</form>
