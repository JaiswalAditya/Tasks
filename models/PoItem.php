<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "po_item".
 *
 * @property int $id
 * @property string $po_item_no
 * @property float $quantity
 * @property int $po_id
 *
 * @property Po $po
 */
class PoItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'po_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['po_item_no', 'quantity'], 'required'],
            [['quantity'], 'number'],
            [['po_id'], 'integer'],
            [['po_item_no'], 'string', 'max' => 10],
            [['po_id'], 'exist', 'skipOnError' => true, 'targetClass' => Po::class, 'targetAttribute' => ['po_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'po_item_no' => 'Po Item No',
            'quantity' => 'Quantity',
            'po_id' => 'Po ID',
        ];
    }

    /**
     * Gets query for [[Po]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPo()
    {
        return $this->hasOne(Po::class, ['id' => 'po_id']);
    }
}
