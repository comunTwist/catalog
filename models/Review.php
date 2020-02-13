<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property int|null $lang_goods_id
 * @property string $time
 * @property string|null $email
 * @property string|null $message
 *
 * @property LangGoods $langGoods
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lang_goods_id'], 'integer'],
            [['time'], 'safe'],
            [['message'], 'string'],
            [['email'], 'string', 'max' => 255],
            [['lang_goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => LangGoods::class, 'targetAttribute' => ['lang_goods_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lang_goods_id' => Yii::t('app', 'Lang Goods ID'),
            'time' => Yii::t('app', 'Time'),
            'email' => Yii::t('app', 'Email'),
            'message' => Yii::t('app', 'Message'),
        ];
    }

    /**
     * Gets query for [[LangGoods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLangGoods()
    {
        return $this->hasOne(LangGoods::class, ['id' => 'lang_goods_id']);
    }
}
