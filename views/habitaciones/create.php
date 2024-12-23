<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Habitaciones $model */

$this->title = 'Create Habitaciones';
$this->params['breadcrumbs'][] = ['label' => 'Habitaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="habitaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
