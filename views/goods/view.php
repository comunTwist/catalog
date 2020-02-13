<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="goods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Create Lang Goods'), ['/lang-goods/create', 'goods_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'slug',
            'price',
            'translate.name',
            'translate.description',
            [
                'label' => Yii::t('app', 'Photo'),
                'format' => 'raw',
                'value' => function ($data) {
                    $images = $data->getImages();
                    if (!empty($data->images)) {
                        ob_start();
                        foreach ($images as $img): ?>
                            <div class="inline-img">
                                <?= Html::img($img->getUrl('140x')); ?>
                            </div>
                        <?php endforeach;
                        return ob_get_clean();
                    }
                    return '';
                },
            ],
        ],
    ]) ?>

    <?php if (isset($model_review) && $model_review->lang_goods_id != null) : ?>
        <h2><?= Yii::t('app', 'Review') ?></h2>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'time',
                'email',
                'message',
                [
                    'label' => Yii::t('app', 'Edit'),
                    'format' => 'raw',
                    'value' => function ($data) {
                        $span_edit = Html::tag('span', '', ['class' => 'glyphicon glyphicon-pencil']);
                        $span_delete = Html::tag('span', '', ['class' => 'glyphicon glyphicon-trash']);
                        $a_edit = Html::a($span_edit, Url::to(['review/edit']), ['class' => 'js--edit-message', 'data-id' => $data->id]);
                        $a_delete = Html::a($span_delete, Url::to(['review/delete']), ['class' => 'js--delete-message', 'data-id' => $data->id]);
                        return $a_edit . ' ' . $a_delete;
                    },
                ]
            ],
        ]) ?>
        <?= $this->render('_form_review', ['model' => $model_review, 'goods_id' => $model->id]) ?>
    <?php endif; ?>
</div>
<script>
    $(document).ready(function () {

        $('.js--delete-message').click(function (e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete the message?')) {
                deleteMessage($(this).attr('href'), $(this).data('id'));
            }
        });

        function deleteMessage(url, id) {
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    id: id,
                },
                success: function (data) {
                    if (data === 'success') {
                        location.reload();
                    }
                }
            });
        }
    });
</script>
