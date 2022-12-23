<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AngularDeveloper $model */

$this->title = 'Create Angular Developer';
$this->params['breadcrumbs'][] = ['label' => 'Angular Developers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="angular-developer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
