<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Lang Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lang-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_id',
            'lang',
            'name',
            'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
