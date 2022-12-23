<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AndroidDeveloper $model */

$this->title = 'Update Android Developer: ' . $model->emp_id;
$this->params['breadcrumbs'][] = ['label' => 'Android Developers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->emp_id, 'url' => ['view', 'emp_id' => $model->emp_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="android-developer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
