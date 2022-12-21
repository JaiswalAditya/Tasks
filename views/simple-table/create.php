<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SimpleTable $model */

$this->title = 'Create Simple Table';
$this->params['breadcrumbs'][] = ['label' => 'Simple Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simple-table-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
