<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Products $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'product_id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'product_id' => $model->product_id], [
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
            'name',
            'price',
            'quantity',
            [
                'label' => 'Product Image',
                'value' => function($model) {
                    $images=\app\models\ProductImages::find()->where(['product_id'=>$model->product_id])->all();

                    $product_image = '';
                    if (!empty($images)) {
                        foreach($images as $productImage){

                            $product_image = $product_image.Html::img('/uploads/'.$productImage->image, ['width'=>'100','height'=>'100']).'&nbsp;&nbsp;';

                        }
                        return  $product_image ;

                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
                'filter' => false,
            ],
            ],
    ]) ?>

</div>
