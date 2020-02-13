<?php

use yii\db\Migration;

/**
 * Class m200213_091559_db_structure
 */
class m200213_091559_db_structure extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /*
         +--------------------------------------------------------------------------+
         |                           CREATE TABLES                                  |
         +--------------------------------------------------------------------------+
        */

        $tableOptions = null;
        // Опции для mysql
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        // Таблица категорий
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(255)->notNull()->unique()
        ], $tableOptions);

        // Таблица переводов категорий
        $this->createTable('{{%lang_category}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'lang' => "ENUM('ru', 'en') NOT NULL DEFAULT 'ru'",
            'name' => $this->string(255)->notNull(),
            'description' => $this->text()
        ], $tableOptions);

        // Таблица товаров
        $this->createTable('{{%goods}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(255)->notNull()->unique(),
            'price' => $this->float()->notNull()->defaultValue(0)
        ], $tableOptions);

        // Таблица переводов товаров
        $this->createTable('{{%lang_goods}}', [
            'id' => $this->primaryKey(),
            'goods_id' => $this->integer()->notNull(),
            'lang' => "ENUM('ru', 'en') NOT NULL DEFAULT 'ru'",
            'name' => $this->string(255)->notNull(),
            'description' => $this->text()
        ], $tableOptions);

        // Таблица связи категорий и товаров
        $this->createTable('{{%category_goods}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'goods_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // Таблица отзывов
        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'lang_goods_id' => $this->integer()->notNull(),
            'time' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'email' => $this->string(255)->notNull(),
            'message' => $this->text()->notNull()
        ], $tableOptions);


        /*
         +--------------------------------------------------------------------------+
         |                           ADD FOREIGN KEYS                               |
         +--------------------------------------------------------------------------+
        */

        // Связываем переводы категорий с основной таблицей
        $this->addForeignKey(
            'lang_category_fk_category_id',
            '{{%lang_category}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Связываем переводы товаров с основной таблицей
        $this->addForeignKey(
            'lang_goods_fk_goods_id',
            '{{%lang_goods}}',
            'goods_id',
            '{{%goods}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Связываем промежуточную таблицу с категорией
        $this->addForeignKey(
            'category_goods_fk_category_id',
            '{{%category_goods}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Связываем промежуточную таблицу с товаром
        $this->addForeignKey(
            'category_goods_fk_goods_id',
            '{{%category_goods}}',
            'goods_id',
            '{{%goods}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Связываем отзывы с переводами товаров
        $this->addForeignKey(
            'review_fk_lang_goods_id',
            '{{%review}}',
            'lang_goods_id',
            '{{%lang_goods}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /*
         +--------------------------------------------------------------------------+
         |                          DROP FOREIGN KEYS                               |
         +--------------------------------------------------------------------------+
        */

        // Удаляем связь отзывов и перевода товаров
        $this->dropForeignKey(
            'review_fk_lang_goods_id',
            '{{%review}}'
        );

        // Удаляем связь товаров из промежуточной таблицы
        $this->dropForeignKey(
            'category_goods_fk_goods_id',
            '{{%category_goods}}'
        );

        // Удаляем связь категории из промежуточной таблицы
        $this->dropForeignKey(
            'category_goods_fk_category_id',
            '{{%category_goods}}'
        );

        // Удаляем связь перевода товаров с основной таблицей
        $this->dropForeignKey(
            'lang_goods_fk_goods_id',
            '{{%lang_goods}}'
        );

        // Удаляем связь перевода категории с основной таблицей
        $this->dropForeignKey(
            'lang_category_fk_category_id',
            '{{%lang_category}}'
        );

        /*
        +--------------------------------------------------------------------------+
        |                              DROP TABLES                                 |
        +--------------------------------------------------------------------------+
       */
        $this->dropTable('review');
        $this->dropTable('category_goods');
        $this->dropTable('lang_goods');
        $this->dropTable('goods');
        $this->dropTable('lang_category');
        $this->dropTable('category');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200213_091559_db_structure cannot be reverted.\n";

        return false;
    }
    */
}
