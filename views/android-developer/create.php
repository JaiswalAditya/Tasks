<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AndroidDeveloper $model */

$this->title = 'Create Android Developer';
$this->params['breadcrumbs'][] = ['label' => 'Android Developers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="android-developer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
