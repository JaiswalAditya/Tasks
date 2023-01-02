<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PoItem $model */

$this->title = 'Create Po Item';
$this->params['breadcrumbs'][] = ['label' => 'Po Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="po-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
