<?php

use app\models\AndroidDeveloper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AndroidDeveloperSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Android Developers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="android-developer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Android Developer', ['create'], ['class' => 'btn btn-success']) ?>
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
            'framework_used',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AndroidDeveloper $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'emp_id' => $model->emp_id]);
                 }
            ],
        ],
    ]); ?>


</div>
