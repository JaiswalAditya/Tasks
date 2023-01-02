<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SubCategory $model */

$this->title = 'Update Sub Category: ' . $model->sub_cat_id;
$this->params['breadcrumbs'][] = ['label' => 'Sub Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sub_cat_id, 'url' => ['view', 'sub_cat_id' => $model->sub_cat_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sub-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
