<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Reporte de Popularidad de Habitaciones';
?>

<h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

<div class="card mb-4">
    <div class="card-header bg-info text-white">Filtros de Búsqueda</div>
    <div class="card-body">
        <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['reportes/reporte3']]); ?>
        <div class="row">
            <div class="col-md-4">
                <?= Html::label('Número de Habitación', 'num_habitacion', ['class' => 'form-label']) ?>
                <?= Html::textInput('num_habitacion', Yii::$app->request->get('num_habitacion', ''), [
                    'placeholder' => 'Ingrese número de habitación',
                    'class' => 'form-control'
                ]) ?>
            </div>
            <div class="col-md-4 d-flex align-items-end gap-2">
                <?= Html::submitButton('Generar Reporte', ['class' => 'btn btn-primary w-100']) ?>
                <?= Html::a('Regresar', ['index'], ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php if (!empty($estadisticas)): ?>
    <h2 class="mb-3">Estadísticas de Ocupación</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-info text-white">
                <tr>
                    <th scope="col">Número de Habitación</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Precio por Noche</th>
                    <th scope="col">Total Reservas</th>
                    <th scope="col">Total Noches</th>
                    <th scope="col">Promedio Noches</th>
                    <th scope="col">Clientes Distintos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estadisticas as $estadistica): ?>
                    <tr class="table-light">
                        <td><?= Html::encode($estadistica['num_habitacion']) ?></td>
                        <td><?= Html::encode($estadistica['tipo']) ?></td>
                        <td>$<?= Html::encode(number_format($estadistica['precio_por_noche'], 2)) ?></td>
                        <td><?= Html::encode($estadistica['total_reservas']) ?></td>
                        <td><?= Html::encode($estadistica['total_noches']) ?></td>
                        <td><?= Html::encode($estadistica['promedio_noches']) ?></td>
                        <td><?= Html::encode($estadistica['clientes_distintos']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="alert alert-warning">No se encontraron estadísticas para los filtros seleccionados.</p>
<?php endif; ?>