<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Certifications $model */

$this->title = $model->label_en;
$this->params['breadcrumbs'][] = ['label' => 'Certifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="certifications-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'certification_id' => $model->certification_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'certification_id' => $model->certification_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'certification_id',
            'label_en',
            'label_ar',
            'icon_en_image',
            'icon_ar_image',
            'is_active',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
