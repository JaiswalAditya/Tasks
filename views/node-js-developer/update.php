<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NodeJsDeveloper $model */

$this->title = 'Update Node Js Developer: ' . $model->emp_id;
$this->params['breadcrumbs'][] = ['label' => 'Node Js Developers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->emp_id, 'url' => ['view', 'emp_id' => $model->emp_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="node-js-developer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
