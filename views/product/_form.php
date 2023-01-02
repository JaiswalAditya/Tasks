<?php

use kartik\file\FileInput;
use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
//js file import
$this->registerJsFile(BaseUrl::home() . 'js/banner.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$category = \app\models\Category::find()->select('*')->all();
$category = \yii\helpers\ArrayHelper::map($category, 'cat_id', 'cat_name');
//print_r($category);exit();
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'p_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <div class="col-md-6"><?= $form->field($model, 'category_id')->dropDownList($category,
            ['prompt' => 'Please Select', 'class' => 'select2 form-control ', 'onchange' => 'banner.getListByType(this.value)']) ?></div>

    <div class="col-md-6"><?= $form->field($model, 'subcategory_id')->dropDownList([],
            ['prompt' => 'Please Select', 'class' => 'select2 form-control ']) ?></div>

<!--    --><?php //echo FileInput::widget([
//        'name' => 'attachment_48[]',
//        'options'=>[
//        ],
//        'pluginOptions' => [
//            'uploadUrl' => Url::to(['/product/upload']),
//            'initialPreviewAsData' => true
//        ]
//    ]);?>
<!--    --><?php //= $form->field($model, 'is_active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
