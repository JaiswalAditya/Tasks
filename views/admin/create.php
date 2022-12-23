<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Admin $model */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
            'model' => $model,
            'result' => $result,
            'id' => $model->id
    ]) ?>

</div>