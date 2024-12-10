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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Habitaciones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
