<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LangGoods */

$this->title = Yii::t('app', 'Create Lang Goods');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lang Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lang-goods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model', 'goods_map')) ?>

</div>
