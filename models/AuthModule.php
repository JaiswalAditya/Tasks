<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth_module".
 *
 * @property int $auth_module_id
 * @property string $auth_module_name
 * @property string $auth_module_url
 * @property int $is_active
 * @property int $sort_order
 */
class AuthModule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_module';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auth_module_name', 'auth_module_url', 'is_active', 'sort_order'], 'required'],
            [['is_active', 'sort_order'], 'integer'],
            [['auth_module_name', 'auth_module_url'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'auth_module_id' => 'Auth Module ID',
            'auth_module_name' => 'Auth Module Name',
            'auth_module_url' => 'Auth Module Url',
            'is_active' => 'Is Active',
            'sort_order' => 'Sort Order',
        ];
    }
}
