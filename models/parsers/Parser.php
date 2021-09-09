<?php

namespace app\models\parsers;

use Sunra\PhpSimple\HtmlDomParser;
use Yii;

class Parser extends \yii\base\Model
{
    public static function getElements($params)
    {

        /*
         *    [data] => Array
        (
            [classWrapForElments] => js_news_feed_banner
            [url] => https://www.rbc.ru/
            [classElement] => js_news_feed_banner
        )
         */

        $parserData = self::getContent('https://xdan.ru/uchimsya-parsit-saity-s-bibliotekoi-php-simple-html-dom-parser.html');

        $html = HtmlDomParser::str_get_html($parserData);


        echo "<pre>"; print_r($html);die();
        $data = HtmlDomParser::str_get_html($parserData);

        echo "<pre>";
        print_r($data);
        die();

        print_r($parserData->find('.js-news-feed-list'));
        die();
        foreach ($html->find('.js-news-feed-list') as $element) {
            echo "<pre>";
            print_r($element);
            die();
            echo $element->href . "\n";
        }


    }


    public static function getContent($url)
    {
        $curl_handle = curl_init();

        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);

        return $query;
    }
}