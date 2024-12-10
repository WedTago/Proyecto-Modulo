<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\FacturasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="facturas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_factura') ?>

    <?= $form->field($model, 'id_reserva') ?>

    <?= $form->field($model, 'estatus_pago') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'fecha_factura') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
