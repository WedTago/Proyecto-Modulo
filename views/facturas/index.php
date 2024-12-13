<?php

use app\models\Facturas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\FacturasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Facturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facturas-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Crear Facturas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered table-striped table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_factura',
            'id_reserva',
            'estatus_pago',
            'descripcion',
            'fecha_factura',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Facturas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_factura' => $model->id_factura]);
                },
                'header' => 'Acciones',
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

