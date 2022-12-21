<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "simple_table".
 *
 * @property int $id
 * @property string $name
 * @property int $age
 * @property string $phone
 */
class SimpleTable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'simple_table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'age', 'phone'], 'required'],
            [['age'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 10],
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
            'age' => 'Age',
            'phone' => 'Phone',
        ];
    }
}
