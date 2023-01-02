<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Certifications $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="certifications">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'label_en')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'label_ar')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'icon_en_image')->fileInput() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'icon_ar_image')->fileInput() ?>
    </div>
</div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
