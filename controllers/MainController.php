<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\db\Expression;

use app\models\User;
use app\models\LoginForm;
use app\models\SignUpForm;
use app\models\SearchForm;
use app\models\Advert;

class MainController extends AppController
{


    public function actionIndex()
    {


        return $this->render('index');
    }


}