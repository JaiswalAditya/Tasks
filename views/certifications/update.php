<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Certifications $model */

$this->title = 'Update Certifications: ' . $model->certification_id;
$this->params['breadcrumbs'][] = ['label' => 'Certifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->certification_id, 'url' => ['view', 'certification_id' => $model->certification_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="certifications-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
