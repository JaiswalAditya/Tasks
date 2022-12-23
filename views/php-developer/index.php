<?php

use app\models\PhpDeveloper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PhpDeveloperSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Php Developers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="php-developer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Php Developer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'emp_id',
            'emp_name',
            'emp_age',
            'no_of_experience',
            'language_used',
            //'framework_used',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PhpDeveloper $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'emp_id' => $model->emp_id]);
                 }
            ],
        ],
    ]); ?>


</div>
