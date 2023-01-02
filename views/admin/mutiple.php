<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use yii\helpers\BaseUrl;
use yii\bootstrap4\BootstrapAsset;
use yii\helpers\ArrayHelper;
/* @var yii\web\View $this /    
/* @var app\models\Admin $model /
/* @var yii\widgets\ActiveForm $form /
/** @var yii\web\View $this */
/** @var app\models\Admin $model */
/** @var app\models\Pictures $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($upload, 'image[]')->fileInput(['multiple' => true]) ?>

    <?= $form->field($upload, 'product_id')->dropDownList($products) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Upload', ['class' => 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
