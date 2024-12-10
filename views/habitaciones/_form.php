<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Habitaciones $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="habitaciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'num_habitacion')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'tipo')->dropDownList([ 'Sencillo' => 'Sencillo', 'Doble' => 'Doble', 'Doble grande' => 'Doble grande', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'precio')->dropDownList([ '500.00' => '500.00', '600.00' => '600.00', '1000.00' => '1000.00', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'disponibilidad')->dropDownList([ '0' => 'No disponible', '1' => 'Disponible', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
