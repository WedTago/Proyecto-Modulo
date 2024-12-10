<?php

use app\models\Reservas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ReservasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Reservas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Reservas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_reserva',
            //'id_cliente',
            'num_habitacion',
            'fecha_entrada',
            'fecha_salida',
            'estado',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Reservas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_reserva' => $model->id_reserva]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
