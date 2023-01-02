<?php

use app\models\Certifications;
use kartik\switchinput\SwitchInput;
use yii\bootstrap5\BootstrapAsset;
use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var app\models\CertificationsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Certifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->registerCssFile(BaseUrl::home() . 'css/switch.css', ['depends' => [BootstrapAsset::className()]]);
$this->registerJsFile(BaseUrl::home() . 'js/toggle.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="certifications-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Certifications', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'certification_id',
            'label_en',
            'label_ar',
            ['label' => 'English Image',

                'format' => ['image',['width'=>'100']],

                'value'=>function($model){

                    return('@web/'.$model->icon_en_image);

                },

            ],
            ['label' => 'Arabic Image',

                'format' => ['image',['width'=>'100']],

                'value'=>function($model){

                    return('@web/'.$model->icon_ar_image);

                },

            ],
            //'sort_order',
            [
                'label' => 'Status',
                'attribute' => 'is_active',
                'format' => 'raw',
                'value' => function ($model, $url) {
                    $checked = $model->is_active == 1 ? "checked" : "";
                    return '
                            <div class="form-check form-switch">
                            <input  class="form-check-input" type="checkbox" role="switch" id="isActiveCheckbox_' . $model->certification_id . '"
                            onclick="toggle.toggleCertificationStatus(' . $model->certification_id . ',\'a\')"
                            ' . $checked . '>
                            </div>';
                },
                'filter' => Html::activeDropDownList($searchModel, 'is_active', [0 => "InActive", 1 => "Active"], ['class' => 'form-control select2', 'prompt' => 'Filter']),

            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Certifications $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'certification_id' => $model->certification_id]);
                 }
            ],
        ],
    ]); ?>

</div>