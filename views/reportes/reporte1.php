<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Reporte de Costos de Reservaciones';
?>

<h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

<div class="card mb-4">
    <div class="card-header bg-info text-white">Filtros de Búsqueda Avanzados</div>
    <div class="card-body">
        <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['reportes/reporte1'], 'id' => 'reporte-form']); ?>
        <div class="row">
            <div class="col-md-3">
                <?= Html::label('ID de Reserva', 'id_reserva', ['class' => 'form-label']) ?>
                <?= Html::textInput('id_reserva', Yii::$app->request->get('id_reserva', ''), [
                    'placeholder' => 'Ingrese ID de reserva',
                    'class' => 'form-control'
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= Html::label('Nombre del Cliente', 'nombre_cliente', ['class' => 'form-label']) ?>
                <?= Html::textInput('nombre_cliente', Yii::$app->request->get('nombre_cliente', ''), [
                    'placeholder' => 'Nombre o apellidos',
                    'class' => 'form-control'
                ]) ?>
            </div>
            <div class="col-md-2">
                <?= Html::label('Rango de Costo', 'rango_costo', ['class' => 'form-label']) ?>
                <div class="input-group">
                    <?= Html::textInput('costo_min', Yii::$app->request->get('costo_min', ''), [
                        'placeholder' => 'Mín',
                        'class' => 'form-control',
                        'type' => 'number',
                        'step' => '0.01'
                    ]) ?>
                    <?= Html::textInput('costo_max', Yii::$app->request->get('costo_max', ''), [
                        'placeholder' => 'Máx',
                        'class' => 'form-control',
                        'type' => 'number',
                        'step' => '0.01'
                    ]) ?>
                </div>
            </div>
            <div class="col-md-2">
                <?= Html::label('Estado de Pago', 'estatus_pago', ['class' => 'form-label']) ?>
                <?= Html::dropDownList('estatus_pago', Yii::$app->request->get('estatus_pago', ''), [
                    '' => 'Todos',
                    '1' => 'Pagado',
                    '0' => 'Pendiente'
                ], ['class' => 'form-control']) ?>
            </div>
            <div class="col-md-2 d-flex align-items-end gap-2">
                <?= Html::submitButton('Generar Reporte', ['class' => 'btn btn-primary w-100']) ?>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                <?= Html::label('Ordenar por', 'ordenar_por', ['class' => 'form-label']) ?>
                <?= Html::dropDownList('ordenar_por', Yii::$app->request->get('ordenar_por', ''), [
                    '' => 'Seleccionar',
                    'id_reserva' => 'ID Reserva',
                    'costo_total' => 'Costo Total',
                    'fecha_entrada' => 'Fecha de Entrada',
                    'noches' => 'Número de Noches'
                ], ['class' => 'form-control']) ?>
            </div>
            <div class="col-md-4">
                <?= Html::label('Dirección de Orden', 'direccion_orden', ['class' => 'form-label']) ?>
                <?= Html::dropDownList('direccion_orden', Yii::$app->request->get('direccion_orden', ''), [
                    'ASC' => 'Ascendente',
                    'DESC' => 'Descendente'
                ], ['class' => 'form-control']) ?>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <?= Html::a('Regresar', ['index'], ['class' => 'btn btn-secondary me-2']) ?>
                <?= Html::button('Limpiar Filtros', [
                    'class' => 'btn btn-outline-secondary', 
                    'onclick' => '$("#reporte-form")[0].reset();'
                ]) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php if (!empty($reservas)): ?>
    <h2 class="mb-3">Resultados del Reporte</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-info text-white">
                <tr>
                    <th scope="col">ID Reserva</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Fecha Entrada</th>
                    <th scope="col">Fecha Salida</th>
                    <th scope="col">Tipo Habitación</th>
                    <th scope="col">Precio/Noche</th>
                    <th scope="col">Noches</th>
                    <th scope="col">Costo Total</th>
                    <th scope="col">Estado Pago</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva): ?>
                    <tr class="table-light">
                        <td><?= Html::encode($reserva['id_reserva']) ?></td>
                        <td><?= Html::encode($reserva['nombre'] . ' ' . $reserva['apellido1'] . ' ' . $reserva['apellido2']) ?></td>
                        <td><?= Html::encode($reserva['fecha_entrada']) ?></td>
                        <td><?= Html::encode($reserva['fecha_salida']) ?></td>
                        <td><?= Html::encode($reserva['tipo_habitacion']) ?></td>
                        <td>$<?= Html::encode(number_format($reserva['precio_por_noche'], 2)) ?></td>
                        <td><?= Html::encode($reserva['noches']) ?></td>
                        <td>$<?= Html::encode(number_format($reserva['costo_total'], 2)) ?></td>
                        <td><?= $reserva['estatus_pago'] ? '<span class="badge bg-success">Pagado</span>' : '<span class="badge bg-warning">Pendiente</span>' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="alert alert-warning">No se encontraron reservaciones para los filtros seleccionados.</p>
<?php endif; ?>

<?php
$this->registerJs("
    $(document).ready(function() {
        $('#reporte-form').on('submit', function(e) {
            var costoMin = parseFloat($('input[name=\"costo_min\"]').val()) || 0;
            var costoMax = parseFloat($('input[name=\"costo_max\"]').val()) || Infinity;
            
            if (costoMin > costoMax) {
                e.preventDefault();
                alert('El costo mínimo no puede ser mayor que el costo máximo');
            }
        });
    });
");
?>