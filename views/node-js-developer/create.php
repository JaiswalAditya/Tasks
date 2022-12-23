<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NodeJsDeveloper $model */

$this->title = 'Create Node Js Developer';
$this->params['breadcrumbs'][] = ['label' => 'Node Js Developers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="node-js-developer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
