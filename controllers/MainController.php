<?php

namespace app\controllers;

use app\models\Goods;
use yii\data\ActiveDataProvider;


class MainController extends AppController
{


    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Goods::find()->with([
                'category' => function ($q) {
                    $q->with([
                        'translate'
                    ]);
                },
                'translate'
            ]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', compact('dataProvider'));
    }


}