<?php
/** @var yii\web\View $this */
?>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// Colocamos aquí el nombre de nuestro reporte.
$this->title = 'Reporte de Cuartos';
?>

<h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

<div class="card mb-4">
    <div class="card-header bg-info text-white">Filtros de Búsqueda</div>
    <div class="card-body">

        <!-- Declaramos el formulario con la accion que apunta a nuestro controlador y la accion reporte1 -->
        <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['reportes/reporte1']]); ?>

        <!-- Declaramos los campos que seran enviados a nuestro reporte -->
        <div class="row">
            <div class="col-md-4">
                <?= Html::label('Nombre', ['class' => 'form-label']) ?>
                <?= Html::textInput('nombre', Yii::$app->request->get('nombre', ''), [
                    'placeholder' => 'Nombre',
                    'class' => 'form-control'
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= Html::label('Apellido1', ['class' => 'form-label']) ?>
                <?= Html::textInput('apellido1', Yii::$app->request->get('apellido1', ''), [
                    'placeholder' => 'Apellido1',
                    'class' => 'form-control'
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= Html::label('Apellido2', ['class' => 'form-label']) ?>
                <?= Html::textInput('apellido2', Yii::$app->request->get('apellido2', ''), [
                    'placeholder' => 'Apellido2',
                    'class' => 'form-control'
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= Html::label('Fecha de Entrada', ['class' => 'form-label']) ?>
                <?= Html::textInput('fecha_entrada', Yii::$app->request->get('fecha_entrada', ''),['type' => 'date'], [
                    'placeholder' => 'Fecha de Entrada',
                    'class' => 'form-control'
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= Html::label('Fecha de Salida', ['class' => 'form-label']) ?>
                <?= Html::textInput('fecha_salidas', Yii::$app->request->get('fecha_salida', ''),['type' => 'date'], [
                    'placeholder' => 'Fecha de Salida',
                    'class' => 'form-control'
                ]) ?>
            </div>

            <div class="col-md-4">
                <?= Html::label('#Reserva', 'id_reserva', ['class' => 'form-label']) ?>
                <select name="id_reserva" class="form-control">
                    <option value="">Selecciona un #Reserva</option>
                    <?php
                    // Hacemos un consulta a la DB apra meter los departamentos en una lista desplegable
                    $Num_reserva = Yii::$app->db->createCommand("SELECT id_reserva FROM reservas")->queryAll();

                    // Recorremos los departamentos encontrados y los  acomodamos en un option
                    foreach ($Num_reserva as $id_reserva) {
                        $selected = (Yii::$app->request->get('id_reserva') == $id_reserva['id_reserva']) ? 'selected' : '';
                        echo "<option value='{$id_reserva['id_reserva']}' $selected>{$id_reserva['id_reserva']}</option>";
                    }
                    ?>
                </select>
            </div>

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
<?php if (!empty($reservas)): ?>
    <h2 class="mb-3">Resultados del Reporte</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-info text-white">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido1</th>
                    <th scope="col">Apellido2</th>
                    <th scope="col">Duracion</th>
                </tr>
            </thead>
            <tbody>
                <!-- Recorremos cada registro y lo metemos en la celdas de la tabla -->
                <?php foreach ($reservas as $reserva): ?>
                    <tr class="table-light">
                        <!-- Cada campo debe councidir con la consulta SQL que realizamos previamente -->
                        <td><?= Html::encode($reserva['nombre']) ?></td>
                        <td><?= Html::encode($reserva['apellido1']) ?></td>
                        <td><?= Html::encode($reserva['apellido2']) ?></td>
                        <td><?= Html::encode($reserva['fecha_entrada']) ?></td>
                        <td><?= Html::encode($reserva['fecha_salida']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="alert alert-warning">No se encontraron resultados para los filtros seleccionados.</p>
<?php endif; ?>