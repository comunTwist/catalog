<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $slug
 *
 * @property Goods[] $Goods
 * @property LangCategory[] $langCategories
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug'], 'required'],
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
        ];
    }

    /**
     * Gets query for [[Goods]].
     */
    public function getGoods()
    {
        return $this->hasMany(Goods::class, ['id' => 'goods_id'])->viaTable('category_goods', ['category_id' => 'id']);
    }

    /**
     * Gets query for [[LangCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLangCategories()
    {
        return $this->hasMany(LangCategory::class, ['category_id' => 'id']);
    }

    /**
     * Возвращаем все категории
     */
    public function getCategories()
    {
        return $this->find()->all();
    }
}
