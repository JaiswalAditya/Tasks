<?php

use yii\helpers\BaseUrl;use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ProductCategory $model */
/** @var yii\widgets\ActiveForm $form */

//<!--js file import-->
$this->registerJsFile(BaseUrl::home() . 'js/banner.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?php
$product_list = \app\models\Product::find()->select('*')->all();
$product_list = \yii\helpers\ArrayHelper::map($product_list,'p_id','p_name');
//print_r($product_list);exit();

$category_list = \app\models\Category::find()->select('*')->all();
$category_list = \yii\helpers\ArrayHelper::map($category_list,'cat_id','cat_name');
//print_r($category_list);exit();
?>

<div class="product-category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="col-md-6"><?= $form->field($model, 'product_id')->dropDownList($product_list,
            ['prompt' => 'Please Select', 'class' => 'select2 form-control ', 'onchange' => 'banner.getListByType(this.value)']) ?></div>

    <div class="col-md-6"><?= $form->field($model, 'category_id')->dropDownList($category_list,
            ['prompt' => 'Please Select', 'class' => 'select2 form-control ', 'onchange' => 'banner.getListByType(this.value)']) ?></div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
