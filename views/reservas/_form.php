<?php

use yii\helpers\ArrayHelper; 
use app\models\Clientes;
use app\models\Habitaciones;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Reservas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="reservas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_cliente')->dropDownList( 
        ArrayHelper::map(Clientes::find()->all(), 'id_cliente', 'nombre', 'apellido1', 'apellido2'),
        ['prompt' => 'Selecciona un Cliente']
    ) ?>

    <?= $form->field($model, 'num_habitacion')->dropDownList( 
        ArrayHelper::map(Habitaciones::find()->all(), 'num_habitacion', 'num_habitacion'),
        ['prompt' => 'Selecciona un Numero de Habitacion']
    ) ?>

    <?= $form->field($model, 'fecha_entrada')->input('date', [ 'class' => 'form-control', 'placeholder' => 'Selecciona una fecha', ]) ?>

    <?= $form->field($model, 'fecha_salida')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'estado')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
