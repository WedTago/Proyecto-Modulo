<?php
/** @var yii\web\View $this */
?>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// Colocamos aquí el nombre de nuestro reporte.
$this->title = 'Reporte de Alumnos';
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
                <?= Html::label('Comunidad', 'comunidad_id', ['class' => 'form-label']) ?>
                <select name="comunidad_id" class="form-control">
                    <option value="">Selecciona una habitacion</option>
                    <?php
                    // Hacemos un consulta a la DB apra meter los departamentos en una lista desplegable
                    $comunidades = Yii::$app->db->createCommand("SELECT id, nombre FROM comunidades")->queryAll();

                    // Recorremos los departamentos encontrados y los  acomodamos en un option
                    foreach ($comunidades as $comunidad) {
                        $selected = (Yii::$app->request->get('codigo_departamento') == $comunidad['id']) ? 'selected' : '';
                        echo "<option value='{$comunidad['id']}' $selected>{$comunidad['nombre']}</option>";
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
<?php if (!empty($alumnos)): ?>
    <h2 class="mb-3">Resultados del Reporte</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-info text-white">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Comunidad</th>
                </tr>
            </thead>
            <tbody>
                <!-- Recorremos cada registro y lo metemos en la celdas de la tabla -->
                <?php foreach ($alumnos as $alumno): ?>
                    <tr class="table-light">
                        <!-- Cada campo debe councidir con la consulta SQL que realizamos previamente -->
                        <td><?= Html::encode($alumno['id']) ?></td>
                        <td><?= Html::encode($alumno['nombre']) ?></td>
                        <td><?= Html::encode($alumno['apellido']) ?></td>
                        <td><?= Html::encode($alumno['email']) ?></td>
                        <td><?= Html::encode($alumno['edad']) ?></td>
                        <td><?= Html::encode($alumno['comunidad']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="alert alert-warning">No se encontraron resultados para los filtros seleccionados.</p>
<?php endif; ?>
