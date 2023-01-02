<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $cat_id
 * @property string $cat_name
 * @property int $is_active
 *
 * @property ProductCategory[] $productCategories
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_name', 'is_active'], 'required'],
            [['is_active'], 'integer'],
            [['cat_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'Cat ID',
            'cat_name' => 'Category Name',
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
        return $this->hasMany(ProductCategory::class, ['category_id' => 'cat_id']);
    }
}
