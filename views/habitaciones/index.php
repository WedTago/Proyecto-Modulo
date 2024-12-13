<?php

use app\models\Habitaciones;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\HabitacionesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Habitaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="habitaciones-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Crear Habitaciones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered table-striped table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'num_habitacion',
            'tipo',
            'precio',
            'disponibilidad',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Habitaciones $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'num_habitacion' => $model->num_habitacion]);
                },
                'header' => 'Acciones',
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

