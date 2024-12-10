<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Reservas;

use function PHPSTORM_META\type;

/** @var yii\web\View $this */
/** @var app\models\Facturas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="facturas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_reserva')->dropDownList( 
        ArrayHelper::map(Reservas::find()->all(), 'id_reserva', 'id_reserva'),
        ['prompt' => 'Selecciona una ID de reserva']
    ) ?>

    <?= $form->field($model, 'estatus_pago')->dropDownList([ '0' => 'No Pago', '1' => 'Pagó'], ['prompt' => ''])?>

    <?= $form->field($model, 'descripcion')->textInput(['placeholder' => 'Hospedaje Correspondiente al dia xx de xxxxx del xxxx']) ?>

    <?= $form->field($model, 'fecha_factura')->textInput(['type' => 'date']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
