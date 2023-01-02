<?php

use app\assets\AppAsset;
use app\models\PhpDeveloper;
use kartik\editable\Editable;
//use kartik\grid\EditableColumn;
use yii\bootstrap5\Modal;
use yii\bootstrap5\NavBar;
use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use app\components\EditableColumn;


/** @var yii\web\View $this */
/** @var app\models\PhpDeveloperSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

//AppAsset::register($this);
//$this->registerJsFile(BaseUrl::home() . 'js/modal.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = 'Php Developers';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->

<div class="php-developer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?=Html::Button('Create Php Developer', ['value' => Url::to('create'),'class' => 'btn btn-success', 'id' => 'modalbutton']) ?>
    </p>
    <?php
        Modal::begin([
                'title' => '<h4>Create Php Developer</h4>',
                'id' => 'modal',
                'size' => 'modal-lg',
        ]);
        echo "<div id='modalcontent'></div>";
        Modal::end();
    ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'emp_id',
            'emp_name',
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'emp_name',
                'pageSummary' => true,
                'readonly' => false,
                'content' => function($data){return '<div class="text_content">'.htmlentities($data->emp_name).'</div>';},
                'editableOptions' => [
                    'header' => 'Text',
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    'options' => [
                        'editableOptions' => [
                            'asPopover' => false,
                        ]
                    ]
                ],
            ],
            'emp_age',
            'no_of_experience',
            'language_used',
            'framework_used',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PhpDeveloper $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'emp_id' => $model->emp_id]);
                 }
            ],
        ],
    ]); ?>



</div>
<script>

    window.onload = function() {
        $(document).ready(function (){
            $('#modalbutton').click(function (){
                $('#modal').modal('show')
                    .find('#modalcontent')
                    .load($(this).attr('value'));
            });
        });
    };
</script>