<?php

use yii\db\Migration;

/**
 * Class m180601_064903_add_pack_sizes
 */
class m180601_064903_add_pack_sizes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pack_size', [
            'id' => $this->primaryKey(),
            'title' => $this->string(64)->notNull(),
            'size' => $this->integer()->notNull()
        ]);
        $this->createIndex('size', 'pack_size', 'size', true);
        
        Yii::$app->db->createCommand()->batchInsert('pack_size', ['title', 'size'], [
            ['250', 250],
            ['500', 500],
            ['1000', 1000],
            ['2000', 2000],
            ['5000', 5000],
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180601_064903_add_pack_sizes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180601_064903_add_pack_sizes cannot be reverted.\n";

        return false;
    }
    */
}
