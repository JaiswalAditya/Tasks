<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PhpDeveloper $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="php-developer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'emp_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_age')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_of_experience')->textInput() ?>

    <?= $form->field($model, 'language_used')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'framework_used')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
