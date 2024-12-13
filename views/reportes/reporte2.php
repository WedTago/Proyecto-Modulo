<?php
/** @var yii\web\View $this */
?>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// Colocamos aquí el nombre de nuestro reporte.
$this->title = 'Reporte de Disponibilidad de Cuartos segun la fecha';
?>

<h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

<div class="card mb-4">
    <div class="card-header bg-info text-white">Filtros de Búsqueda</div>
    <div class="card-body">

        <!-- Declaramos el formulario con la accion que apunta a nuestro controlador y la accion reporte1 -->
        <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['reportes/reporte2']]); ?>

        <!-- Declaramos los campos que seran enviados a nuestro reporte -->
        <div class="row">
            <div class="col-md-4">
                <?= Html::label('Reservas', 'fecha_entrada', ['class' => 'form-label']) ?>
                <select name="fecha_entrada" class="form-control">
                    <option value="">Selecciona una fecha de entrada</option>
                    <?php
                    // Hacemos un consulta a la DB apra meter los departamentos en una lista desplegable
                    $fechas_e = Yii::$app->db->createCommand("SELECT fecha_entrada FROM reservas")->queryAll();

                    // Recorremos los departamentos encontrados y los  acomodamos en un option
                    foreach ($fechas_e as $fecha_e) {
                        $selected = (Yii::$app->request->get('fecha_entrada') == $fecha_e['fecha_entrada']) ? 'selected' : '';
                        echo "<option value='{$fecha_e['fecha_entrada']}' $selected>{$fecha_e['fecha_entrada']}</option>";
                    }
                    ?>
                    <?php
                    // Hacemos un consulta a la DB apra meter los departamentos en una lista desplegable
                    $fechas_s = Yii::$app->db->createCommand("SELECT fecha_salida FROM reservas")->queryAll();
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <?= Html::label('Reservas', 'fecha_salida', ['class' => 'form-label']) ?>
                <select name="fecha_salida" class="form-control">
                    <option value="">Selecciona una fecha de salida</option>
                    <?php

                // Recorremos los departamentos encontrados y los  acomodamos en un option
                foreach ($fechas_s as $fecha_s) {
                    $selected = (Yii::$app->request->get('fecha_salida') == $fecha_s['fecha_salida']) ? 'selected' : '';
                    echo "<option value='{$fecha_s['fecha_salida']}' $selected>{$fecha_s['fecha_salida']}</option>";
                }
                ?>
                <?php
                // Hacemos un consulta a la DB apra meter los departamentos en una lista desplegable
                $fechas_s = Yii::$app->db->createCommand("SELECT fecha_salida FROM reservas")->queryAll();
                ?>
            </select>
        <div class="col-md-4 d-flex align-items-end gap-2">
            <!-- Este boton hace el reporte -->
            <?= Html::submitButton('Generar Reporte', ['class' => 'btn btn-primary w-100']) ?>
            <?= Html::a('Regresar', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>            
    </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<!-- Si encontramos registros los metemos en una tabla html para ser mostrados, se envian desde la linea 41 -->
<?php if (!empty($fechas)): ?>
    <h2 class="mb-3">Resultados del Reporte</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-info text-white">
                <tr>
                    <th scope="col">Habitaciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Recorremos cada registro y lo metemos en la celdas de la tabla -->
                <?php foreach ($fechas as $fecha): ?>
                    <tr class="table-light">
                        <!-- Cada campo debe councidir con la consulta SQL que realizamos previamente -->
                        <td><?= Html::encode($fecha['disponible']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="alert alert-warning">No se encontraron resultados para los filtros seleccionados.</p>
<?php endif; ?>
