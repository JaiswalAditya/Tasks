<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_images".
 *
 * @property int $product_image_id
 * @property int $product_id
 * @property string $image_created_at
 */
class ProductImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['product_id',], 'required'],
            [['product_id','tmp_product_id','product_image_id',], 'integer'],
            [['image','image_created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_image_id' => 'Product Image ID',
            'product_id' => 'Product ID',
            'tmp_product_id' => 'Temporary Product ID',
            'image' => 'Image',
            'image_created_at' => 'Image Created At',
        ];
    }
}
