<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PhpDeveloperSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="php-developer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'emp_id') ?>

    <?= $form->field($model, 'emp_name') ?>

    <?= $form->field($model, 'emp_age') ?>

    <?= $form->field($model, 'no_of_experience') ?>

    <?= $form->field($model, 'language_used') ?>

    <?php // echo $form->field($model, 'framework_used') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
