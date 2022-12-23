<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PhpDeveloper $model */

$this->title = 'Create Php Developer';
$this->params['breadcrumbs'][] = ['label' => 'Php Developers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="php-developer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
