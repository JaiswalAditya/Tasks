<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $product_id
 * @property string $name
 * @property int $price
 * @property int $quantity
 */
class Products extends \yii\db\ActiveRecord
{
        public $product_images=[];
        public $tmp_product_id;

    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'quantity'], 'required'],
            [['price', 'quantity'], 'integer'],
            [['tmp_product_id'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'name' => 'Name',
            'price' => 'Price',
            'quantity' => 'Quantity',
        ];
    }
    public function getProductImages()
    {
        return $this->hasMany(ProductImages::class, ['product_id' => 'product_id']);
    }
}
