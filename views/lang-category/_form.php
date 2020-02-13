<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LangCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lang-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList($categories_map, [
        'options' => [
            $model->category_id => ['selected' => true]
        ]
    ]) ?>

    <?= $form->field($model, 'lang')->dropDownList(['ru' => 'Ru', 'en' => 'En']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
