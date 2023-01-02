<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "certifications".
 *
 * @property int $certification_id
 * @property string|null $label_en
 * @property string|null $label_ar
 * @property string|null $icon_en
 * @property string|null $icon_ar
 * @property int|null $sort_order
 * @property int|null $is_active
 * @property int $is_deleted
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Certifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $uploadedFile;
    public static function tableName()
    {
        return 'certifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label_en', 'label_ar', 'icon_en_image', 'icon_ar_image'], 'required'],
            [['is_active'], 'integer'],
            [['created_at', 'updated_at', 'icon_en_image', 'icon_ar_image'], 'safe'],
            [['label_en', 'label_ar'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'certification_id' => 'Certification ID',
            'label_en' => 'English',
            'label_ar' => 'Arabic',
            'icon_en_image' => 'English Image',
            'icon_ar_image' => 'Arabic Image',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
