<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Facturas $model */

$this->title = $model->id_factura;
$this->params['breadcrumbs'][] = ['label' => 'Facturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="facturas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_factura' => $model->id_factura], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_factura' => $model->id_factura], [
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
            'id_factura',
            'id_reserva',
            'estatus_pago',
            'descripcion',
            'fecha_factura',
        ],
    ]) ?>

</div>
