<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<section class="container">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'slug',
            'price',
            'translate.name',
            'translate.description',
            [
                'label' => Yii::t('app', 'Categories'),
                'value' => function ($data) {
                    if (!empty($data->category)) {
                        ob_start();
                        foreach ($data->category as $category) {
                            echo (!empty($category->translate)) ? $category->translate->name . ', ' : '';
                        }
                        return ob_get_clean();
                    }
                    return '';
                },
            ],
            [
                'label' => Yii::t('app', 'Details'),
                'format' => 'raw',
                'value' => function ($data) {
                    $span_view = Html::tag('span', '', ['class' => 'glyphicon glyphicon-eye-open']);
                    $a_view = Html::a($span_view, Url::to(['goods/view', 'id' => $data->id]));
                    return $a_view;
                },
            ]
        ],
    ]) ?>
</section>