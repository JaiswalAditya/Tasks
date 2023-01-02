<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CertificationsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="certifications-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'certification_id') ?>

    <?= $form->field($model, 'label_en') ?>

    <?= $form->field($model, 'label_ar') ?>

    <?= $form->field($model, 'icon_en') ?>

    <?= $form->field($model, 'icon_ar') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
