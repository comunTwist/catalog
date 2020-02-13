<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property int $id
 * @property string $slug
 * @property float $price
 *
 * @property Category[] $category
 * @property LangGoods[] $langGoods
 * @property Image[] $image
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug'], 'required'],
            [['price'], 'number'],
            [['slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Slug'),
            'price' => Yii::t('app', 'Price'),
        ];
    }

    /**
     * Gets query for [[Category]].
     */
    public function getCategory()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->viaTable('category_goods', ['goods_id' => 'id']);
    }

    /**
     * Gets query for [[LangGoods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLangGoods()
    {
        return $this->hasMany(LangGoods::class, ['goods_id' => 'id']);
    }

    /**
     * Gets query for [[Image]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasMany(Image::class, ['itemId' => 'id'])->onCondition(['modelName' => Goods::class]);
    }
}
