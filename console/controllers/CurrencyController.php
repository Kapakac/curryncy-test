<?php
namespace console\controllers;

use yii\console\Controller;
use yii\httpclient\Client;
use yii\httpclient\XmlParser;
use common\models\Currency;
use yii\base\Model;

class CurrencyController extends Controller
{
    const GET_DAILY_CURRENCY = 'http://www.cbr.ru/scripts/XML_daily.asp';

    public function actionUpdate()
    {
        $client = new Client([
            'parsers' => [
                'text/html' => [
                    'class' => 'yii\httpclient\XmlParser',
                ]
            ],
        ]);

        try {
        $request = $client->createRequest()
            ->setFormat(Client::FORMAT_XML)
            ->setMethod('GET')
            ->setUrl(self::GET_DAILY_CURRENCY)
            ->setData([])
            ->send();
        } catch (\yii\httpclient\Exception $e) {
        }

        $response = $request;

        if ($request->isOk) {
            $xmlParser = new XmlParser;
            $arrayCurrency = $xmlParser->parse($response);
            $currencies = [];
            foreach ($arrayCurrency['Valute'] as $model) {
                $currencies[] = new Currency();
            }
            if (Model::loadMultiple($currencies, $arrayCurrency['Valute'], '')) {
                foreach ($currencies as $key => $model) {
                    $model->loaded_at = date("Y-m-d H:i:s");
                    $model->save(false);
                }

                return 'update succes';
            }
        }
    }
}