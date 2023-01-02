<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sub_category".
 *
 * @property int $sub_cat_id
 * @property int $category_id
 * @property string $category_name
 * @property int $is_active
 *
 * @property Category $category
 */
class SubCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'category_name', 'is_active'], 'required'],
            [['category_id', 'is_active'], 'integer'],
            [['category_name'], 'string', 'max' => 200],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'cat_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sub_cat_id' => 'Sub Cat ID',
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['cat_id' => 'category_id']);
    }
}
