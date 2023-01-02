<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Certifications $model */

$this->title = 'Create Certifications';
$this->params['breadcrumbs'][] = ['label' => 'Certifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certifications-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
