<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LangCategory */

$this->title = Yii::t('app', 'Update Lang Category: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lang Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="lang-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model', 'categories_map', 'language')) ?>

</div>
