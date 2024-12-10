<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Habitaciones $model */

$this->title = $model->num_habitacion;
$this->params['breadcrumbs'][] = ['label' => 'Habitaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="habitaciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'num_habitacion' => $model->num_habitacion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'num_habitacion' => $model->num_habitacion], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro de borrar esto?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'num_habitacion',
            'tipo',
            'precio',
            'disponibilidad',
        ],
    ]) ?>

</div>
