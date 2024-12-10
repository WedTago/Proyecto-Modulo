<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Habitaciones $model */

$this->title = 'Update Habitaciones: ' . $model->num_habitacion;
$this->params['breadcrumbs'][] = ['label' => 'Habitaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->num_habitacion, 'url' => ['view', 'num_habitacion' => $model->num_habitacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="habitaciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
