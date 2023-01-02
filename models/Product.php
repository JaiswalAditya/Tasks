<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $p_id
 * @property string $p_name
 * @property float $price
 * @property int $quantity
 * @property string $image
 * @property int $is_active
 *
 * @property ProductCategory[] $productCategories
 */
class Product extends \yii\db\ActiveRecord
{
    public $subcategory_id;
    /**
     * {@inheritdoc}
     */
    public $file;
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['p_name', 'price', 'quantity', 'image', 'category_id'], 'required'],
            [['price'], 'number'],
            [['$subcategory_id'], 'safe'],
            [['quantity', 'is_active', 'category_id'], 'integer'],
            [['p_name'], 'string', 'max' => 45],
//            [['image'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'p_id' => 'P ID',
            'p_name' => 'P Name',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'image' => 'Image',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * Gets query for [[ProductCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategories()
    {
        return $this->hasMany(ProductCategory::class, ['product_id' => 'p_id']);
    }
}
