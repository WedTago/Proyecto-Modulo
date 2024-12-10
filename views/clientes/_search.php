<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ClientesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="clientes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_cliente') ?>

    <?= $form->field($model, 'rfc') ?>

    <?= $form->field($model, 'telefono') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apellido1') ?>

    <?php  echo $form->field($model, 'apellido2') ?>

    <?php  echo $form->field($model, 'correo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
