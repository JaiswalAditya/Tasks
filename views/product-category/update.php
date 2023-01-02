<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProductCategory $model */

$this->title = 'Update Product Category: ' . $model->prod_cat_id;
$this->params['breadcrumbs'][] = ['label' => 'Product Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->prod_cat_id, 'url' => ['view', 'prod_cat_id' => $model->prod_cat_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
