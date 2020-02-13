<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LangCategory */

$this->title = Yii::t('app', 'Create Lang Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lang Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lang-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model', 'categories_map')) ?>

</div>
