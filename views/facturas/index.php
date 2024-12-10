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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Facturas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
