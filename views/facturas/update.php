<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Facturas $model */

$this->title = 'Update Facturas: ' . $model->id_factura;
$this->params['breadcrumbs'][] = ['label' => 'Facturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_factura, 'url' => ['view', 'id_factura' => $model->id_factura]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="facturas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
