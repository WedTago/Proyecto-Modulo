<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Reporte de Habitaciones Disponibles';
?>

<h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

<div class="card mb-4">
    <div class="card-header bg-info text-white">Filtros de Búsqueda</div>
    <div class="card-body">
        <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['reportes/reporte2']]); ?>
        <div class="row">
            <div class="col-md-4">
                <?= Html::label('Fecha de Entrada', 'fecha_entrada', ['class' => 'form-label']) ?>
                <?= Html::textInput('fecha_entrada', Yii::$app->request->get('fecha_entrada', ''), [
                    'type' => 'date',
                    'class' => 'form-control'
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= Html::label('Fecha de Salida', 'fecha_salida', ['class' => 'form-label']) ?>
                <?= Html::textInput('fecha_salida', Yii::$app->request->get('fecha_salida', ''), [
                    'type' => 'date',
                    'class' => 'form-control'
                ]) ?>
            </div>
            <div class="col-md-4 d-flex align-items-end gap-2">
                <?= Html::submitButton('Buscar Disponibilidad', ['class' => 'btn btn-primary w-100']) ?>
                <?= Html::a('Regresar', ['index'], ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php if (!empty($habitaciones)): ?>
    <h2 class="mb-3">Habitaciones Disponibles</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-info text-white">
                <tr>
                    <th scope="col">Número de Habitación</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Precio por Noche</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($habitaciones as $habitacion): ?>
                    <tr class="table-light">
                        <td><?= Html::encode($habitacion['num_habitacion']) ?></td>
                        <td><?= Html::encode($habitacion['tipo']) ?></td>
                        <td>$<?= Html::encode(number_format($habitacion['precio_por_noche'], 2)) ?></td>
                        <td>
                            <?php if ($habitacion['disponibilidad']): ?>
                                <span class="badge bg-success">Disponible</span>
                            <?php else: ?>
                                <span class="badge bg-danger">No Disponible</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="alert alert-warning">No se encontraron habitaciones disponibles para las fechas seleccionadas.</p>
<?php endif; ?>