<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SimpleTable $model */

$this->title = 'Update Simple Table: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Simple Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="simple-table-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
