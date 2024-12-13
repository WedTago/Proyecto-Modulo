<?php

use app\models\Clientes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\ClientesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Crear Cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered table-striped table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_cliente',
            'rfc',
            'telefono',
            'nombre',
            'apellido1',
            'apellido2',
            'correo',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Clientes $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_cliente' => $model->id_cliente]);
                },
                'header' => 'Acciones',
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
