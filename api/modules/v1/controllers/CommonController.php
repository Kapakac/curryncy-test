<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

class CommonController extends ActiveController
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
}
