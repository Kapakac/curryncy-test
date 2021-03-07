<?php

namespace api\modules\v1\controllers;

use yii;
use api\modules\v1\models\CurrencyApi;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

class CurrencyController extends CommonController
{
    public $modelClass = CurrencyApi::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBearerAuth::className();

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['update'], $actions['delete']);

        $actions = ArrayHelper::merge(
            $actions,
            [
                'index' => [
                    'prepareDataProvider' => function ($action) {
                        $modelClass = $action->modelClass;

                        return Yii::createObject([
                            'class' => ActiveDataProvider::className(),
                            'query' => $modelClass::find(),
                            'pagination' => [
                                'pageSize' => 7,
                            ],
                        ]);
                    },
                ],
            ]
        );

        return $actions;
    }
}
