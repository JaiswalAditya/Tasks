<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SubCategory $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php
$category = \app\models\Category::find()->select('*')->all();
$category = \yii\helpers\ArrayHelper::map($category, 'cat_id', 'cat_name');

$subcat_list = \app\models\SubCategory::find()->select('*')->all();
$subcat_list = \yii\helpers\ArrayHelper::map($subcat_list, 'sub_cat_id', 'category_name')

?>

<div class="sub-category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="col-md-6"><?= $form->field($model, 'category_id')->dropDownList($subcat_list,
            ['prompt' => 'Please Select', 'class' => 'select2 form-control ', 'onchange' => 'banner.getListByType(this.value)']) ?></div>

    <div class="col-md-6"><?= $form->field($model, 'category_name')->dropDownList($category,
            ['prompt' => 'Please Select', 'class' => 'select2 form-control ', 'onchange' => 'banner.getListByType(this.value)']) ?></div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
