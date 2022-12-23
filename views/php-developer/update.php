<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PhpDeveloper $model */

$this->title = 'Update Php Developer: ' . $model->emp_id;
$this->params['breadcrumbs'][] = ['label' => 'Php Developers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->emp_id, 'url' => ['view', 'emp_id' => $model->emp_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="php-developer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
