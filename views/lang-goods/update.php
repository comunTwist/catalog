<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LangGoods */

$this->title = Yii::t('app', 'Update Lang Goods: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lang Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="lang-goods-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model', 'goods_map', 'language')) ?>

</div>
