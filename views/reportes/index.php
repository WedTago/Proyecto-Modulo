<?php
use yii\helpers\Html;
?>

<div class="container">
    <h1 class="text-center my-4">Reportes</h1>

    <div class="card mb-3">
        <div class="card-header bg-info text-white text-center">Selecciona un Reporte</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <?= Html::a('Costos de Reservaciones', ['reporte1'], ['class' => 'btn btn-outline-success btn-block mb-2']) ?>
                </div>
                <div class="col-md-4">
                    <?= Html::a('Habitaciones Disponibles', ['reporte2'], ['class' => 'btn btn-outline-success btn-block mb-2']) ?>
                </div>
                <div class="col-md-4">
                    <?= Html::a('Popularidad de Habitaciones', ['reporte3'], ['class' => 'btn btn-outline-success btn-block mb-2']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
