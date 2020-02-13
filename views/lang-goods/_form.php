<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LangGoods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lang-goods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'goods_id')->dropDownList($goods_map, [
        'options' => [
            $model->goods_id => ['selected' => true]
        ]
    ]) ?>

    <?= $form->field($model, 'lang')->dropDownList(['ru' => 'Ru', 'en' => 'En',]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
