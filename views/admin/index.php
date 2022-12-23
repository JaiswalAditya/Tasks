<?php

use app\models\Admin;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
// use kartik\grid\Gridview;
use \yii\widgets\LinkPager;
use kartik\export\ExportMenu;

/** @var yii\web\View $this */
/** @var app\models\AdminSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Admin Section';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="admin-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php  $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'name',
                'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => 'Search for Names  ...'
                ]
            ],
            [
                'attribute' => 'email',
                'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => 'Search for Email...'
                 ]
            ],
            // 'password',
            'is_active',
            [
                'attribute' => 'gender',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Search for Gender...'
                 ]
            ],
            // [
            //     'attribute' => 'department',
            //     'filterInputOptions' => [
            //         'class'       => 'form-control',
            //         'placeholder' => 'Search for department     ...'
            //      ]
            // ],
            //'is_deleted',
            // ['header' => 'Action',
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, Admin $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //         echo print_r($index);
            //      }
            // ],
            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="d-flex align-items-center justify-content-center flex-nowrap">
                <span class="mr-1">{view}</span>
                <span class="mr-1">{update}</span>
                <span class="mr-1">{delete}</span>     
                </div>',  // the default buttons + your custom button
                'buttons' => [
                    'view' => function ($url, $model, $key) {     // render your custom butto
                        return Html::a('<i class="fa fa-eye"></i>', Url::toRoute(['admin/view', 'id' => $model->id]), [
                            'title' => 'View admin',
                            'aria-label' => 'View',
                        ]);
                    },
                    'update' => function ($url, $model, $key) {     // render your custom butto
                        return Html::a('<i class="fa fa-pencil"></i>', Url::toRoute(['admin/update', 'id' => $model->id]), [
                            'title' => 'Update Admin',
                            'aria-label' => 'update',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {     // render your custom butto
                        return Html::a('<i class="fa fa-trash"></i>', Url::toRoute(['admin/delete', 'id' => $model->id]), [
                            'title' => 'Delete Admin',
                            'aria-label' => 'delete',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ]
                        ]);
                    }
                ]
            ]         
        ];


  
     // Renders a export dropdown menu
echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'clearBuffers' => true, //optional
]);

// You can choose to render your own GridView separately
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns
]);?> 
    
    
    <?php echo LinkPager::widget([
             'pagination' => $pages, ]);?>


</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />