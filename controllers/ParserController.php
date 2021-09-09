<?php

namespace app\controllers;


namespace app\controllers;

use app\models\parsers\Parser;
use Sunra\PhpSimple\HtmlDomParser;
use Yii;
use yii\web\Controller;


class ParserController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        //  $html = Yii::$app->multiparser->init('https://www.rbc.ru/');
        $params = [
            'data' => [
                'classWrapForElments' => 'js_news_feed_banner',
                'url' => 'https://github.com/zabrodskiy/yii2-multiparser',
                'classElement' => 'js_news_feed_banner'
            ]
        ];
        //$params = \Yii::$app->request->post();
        $elements = Parser::getElements($params);

    }

    public function getElements($urls)
    {

    }
}
