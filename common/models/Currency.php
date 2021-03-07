<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string $NumCode
 * @property string|null $CharCode
 * @property string|null $Name
 * @property float|null $Nominal
 * @property float|null $Value
 * @property int|null $loaded_at
 * @property int $deleted
 */
class Currency extends ActiveRecordEx
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NumCode'], 'required'],
            [['Nominal', 'Value'], 'number'],
            [['loaded_at', 'deleted'], 'integer'],
            [['NumCode', 'CharCode', 'Name'], 'string', 'max' => 250],
            [['NumCode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'NumCode' => 'Num Code',
            'CharCode' => 'Char Code',
            'Name' => 'Name',
            'Nominal' => 'Nominal',
            'Value' => 'Value',
            'loaded_at' => 'Loaded At',
            'deleted' => 'Deleted',
        ];
    }
}
