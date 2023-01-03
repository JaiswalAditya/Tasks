<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Products $model */
/** @var yii\widgets\ActiveForm $form */
if($model->isNewRecord){
    $uniqueId = uniqid();
}
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
<div class="col-sm-6">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'price')->textInput() ?><br/>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'quantity')->textInput() ?><br>
</div>
<!--<div class="col-sm-12">-->

<!--    --><?php
//    echo FileInput::widget([
//        'model' => $model,
//        'attribute' => 'product_images[]',
//        'name' => 'product_images[]',
//        'options' => ['multiple' => true, 'accept' => 'image/*', 'id' => 'area_guide_id1'],
//        'pluginOptions' => [
////            'initialPreview' => $imagesAr,
////            'initialPreviewConfig' => $imagesListArId,
//            'deleteUrl' => Url::to(['products/delete-image']),
//            'showCaption' => false,
//            'showRemove' => false,
//            'showUpload' => false,
//            'browseClass' => 'btn btn-primary col-lg-6 col-md-8 col-sm-8 col-xs-6',
//            'browseIcon' => '<i class="glyphicon glyphicon-plus-sign"></i> ',
//            'browseLabel' => 'Upload Image',
//            'allowedFileExtensions' => ['jpg', 'png', 'webp'],
//            'previewFileType' => ['jpg', 'png', 'webp'],
//            'initialPreviewAsData' => true,
//            'overwriteInitial' => false,
//            "uploadUrl" => Url::to(['products/upload']),
//            'uploadExtraData' => [
//                'product_id' => $model->product_id,
//                'is_post' => $model->isNewRecord ? 'new' : 'update',
//                'uniqueId' => $uniqueId
//            ],
//            'msgUploadBegin' => Yii::t('app', 'Please wait, system is uploading the files'),
//            'msgFilesTooMany' => 'Maximum 15 area guide Images are allowed to be uploaded.',
//            'dropZoneClickTitle' => '',
//            "uploadAsync" => true,
//            "browseOnZoneClick" => true,
//
//            'fileActionSettings' => [
//                'showZoom' => true,
//                'showRemove' => true,
//                'showUpload' => false,
//            ],
//            'validateInitialCount' => true,
//            'maxFileCount' => 15,
//            'maxFileSize' => 5120, //5mb
//            'msgPlaceholder' => 'Select attachments',
//        ],
//        'pluginEvents' => [
//            'filebatchselected' => 'function(event, files) {
//                            $(this).fileinput("upload");
//
//                            }',
//            'fileuploaded' => 'function(event, data, previewId, index){
//                                console.log(index);
//                        }',
//
//        ],
//    ]);
//     ?>
<!---->
<!---->
<!--</div>-->
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
