<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property int $auth_assignment_id
 * @property int $auth_item_id
 * @property int $user_id
 * @property string $user_type
 * @property string $created_at
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auth_item_id', 'user_id', 'user_type', 'created_at'], 'required'],
            [['auth_item_id', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['user_type'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'auth_assignment_id' => 'Auth Assignment ID',
            'auth_item_id' => 'Auth Item ID',
            'user_id' => 'User ID',
            'user_type' => 'User Type',
            'created_at' => 'Created At',
        ];
    }
}
