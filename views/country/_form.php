<?php

use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
/** @var app\models\Country $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php
$this->registerJsFile(BaseUrl::home() . 'js/banner.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$dataCountry=ArrayHelper::map(\app\models\Country::find()->asArray()->all(),'id', 'country_name');
$dataPost=ArrayHelper::map(\app\models\City::find()->asArray()->all(), 'id', 'city_name');?>
<div class="country-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?php //= $form->field($model, 'country_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'id')->dropDownList($dataCountry,
    ['prompt'=>'-Choose a Country Name-',
    'class'=>'adjust form-control',
    'onchange'=>'
    $.post("'.Yii::$app->urlManager->createUrl('city/lists?id=').
    '"+$(this).val(),function( data ){
    $( "select#city" ).html( data );
    });
    '])->label('country');?>
    <?= $form->field($model, 'id')
                    ->dropDownList(
                        [],
                         ['prompt'=>'-Choose a City Name-',
//                           'disabled'=>'true',

                             'onclick' => 'disabled',
                             'id'=>'city',
                             'onchange'=>'banner.getListByHide(this.value)',
                             'class'=>'adjust form-control'
                             ]
                    )->label('city');?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
