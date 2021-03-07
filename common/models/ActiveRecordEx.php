<?php
namespace common\models;

use Yii;

use yii\base\ModelEvent;

/**
 * This is the extension for ActiveRecord.
 */
class ActiveRecordEx extends \yii\db\ActiveRecord
{
    const NOT_DEL = 0;
}