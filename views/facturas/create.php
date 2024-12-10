<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Facturas $model */

$this->title = 'Create Facturas';
$this->params['breadcrumbs'][] = ['label' => 'Facturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facturas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
