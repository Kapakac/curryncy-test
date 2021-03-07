<?php
namespace api\modules\v1\models;
use common\models\Currency;

class CurrencyApi extends Currency
{
    public function fields()
    {
        $fields = parent::fields();

        unset($fields['id'], $fields['deleted']);

        return $fields;
    }
}