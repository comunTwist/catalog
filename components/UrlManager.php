<?php

namespace app\components;

use Yii;

class UrlManager extends \yii\web\UrlManager
{
    public function createUrl($params)
    {

        //Получаем сформированную ссылку(без идентификатора языка)
        $url = parent::createUrl($params);

        if (empty($params['lang'])) {
            //Текущий язык приложения
            $currentLang = Yii::$app->language;

            //Добавляем к URL префикс - буквенный идентификатор языка
            if ($url == '/') {
                return '/' . $currentLang;
            } else {
                return '/' . $currentLang . $url;
            }
        };

        return $url;
    }
}