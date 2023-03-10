<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth_item".
 *
 * @property int $auth_item_id
 * @property int $auth_module_id
 * @property string $auth_item_url
 * @property string $auth_item_name
 * @property string $auth_item_description
 * @property string $rule_name
 * @property int $is_active
 * @property string $created_at
 */
class AuthItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auth_module_id', 'auth_item_url', 'auth_item_name', 'auth_item_description', 'rule_name', 'is_active', 'created_at'], 'required'],
            [['auth_module_id', 'is_active'], 'integer'],
            [['created_at'], 'safe'],
            [['auth_item_url', 'auth_item_name', 'rule_name'], 'string', 'max' => 45],
            [['auth_item_description'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'auth_item_id' => 'Auth Item ID',
            'auth_module_id' => 'Auth Module ID',
            'auth_item_url' => 'Auth Item Url',
            'auth_item_name' => 'Auth Item Name',
            'auth_item_description' => 'Auth Item Description',
            'rule_name' => 'Rule Name',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
        ];
    }
}
