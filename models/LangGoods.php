<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lang_goods".
 *
 * @property int $id
 * @property int|null $goods_id
 * @property string $lang
 * @property string|null $name
 * @property string|null $description
 *
 * @property Goods $goods
 * @property Review[] $reviews
 */
class LangGoods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lang_goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['goods_id'], 'integer'],
            [['lang', 'description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::class, 'targetAttribute' => ['goods_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'goods_id' => Yii::t('app', 'Goods ID'),
            'lang' => Yii::t('app', 'Lang'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * Gets query for [[Goods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(Goods::class, ['id' => 'goods_id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::class, ['lang_goods_id' => 'id']);
    }
}
