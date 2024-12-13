<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Reporte de Costos de Reservaciones';
?>

<h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

<div class="card mb-4">
    <div class="card-header bg-info text-white">Filtros de Búsqueda</div>
    <div class="card-body">
        <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['reportes/reporte1']]); ?>
        <div class="row">
            <div class="col-md-4">
                <?= Html::label('ID de Reserva', 'id_reserva', ['class' => 'form-label']) ?>
                <?= Html::textInput('id_reserva', Yii::$app->request->get('id_reserva', ''), [
                    'placeholder' => 'Ingrese ID de reserva',
                    'class' => 'form-control'
                ]) ?>
            </div>
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
                <?= Html::submitButton('Generar Reporte', ['class' => 'btn btn-primary w-100']) ?>
                <?= Html::a('Regresar', ['index'], ['class' => 'btn btn-secondary']) ?>
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
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido1</th>
                    <th scope="col">Apellido2</th>
                    <th scope="col">Duracion en Dias</th>
                    <th scope="col">TotalReserva</th>
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
                        <!-- Cada campo debe councidir con la consulta SQL que realizamos previamente -->
                        <td><?= Html::encode($reserva['nombre']) ?></td>
                        <td><?= Html::encode($reserva['apellido1']) ?></td>
                        <td><?= Html::encode($reserva['apellido2']) ?></td>
                        <td><?= Html::encode($reserva['Duracion']) ?></td>
                        <td><?= Html::encode($reserva['TotalReserva']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="alert alert-warning">No se encontraron reservaciones para los filtros seleccionados.</p>
<?php endif; ?>