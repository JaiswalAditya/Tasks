<?php

namespace app\models;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $gender
 * @property string $logo
 * @property string $department
 * @property int $is_active
 * @property int $is_deleted
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $file;
    public $products;
//    public $name;
    public $name = 'aditya';
    public static function tableName()
    {
        return 'admin';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','email', 'password', 'gender'], 'required'],
            [['gender','products'], 'string'],
//            [['email'], 'unique'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            [['file'], 'file'],
            [['is_active', 'is_deleted'], 'integer'],
            [['name','logo'], 'string', 'max' => 100],
            [['name', 'email', 'password', 'gender'], 'required'],
            [['gender','products'], 'string'],
            [['email'], 'unique'],
            [['file'], 'file'],
//            [['order_item'], 'safe'],
            [['is_active', 'is_deleted'], 'integer'],
            [['name', 'email','logo'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'gender' => 'Gender',
            'products' => 'Products',
            // 'department' => 'department',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
            'file' => 'logo',
        ];
    }
}
