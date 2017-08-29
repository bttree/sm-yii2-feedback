<?php

use yii\db\Migration;
use bttree\smyfeedback\models\Feedback;

/**
 * Class m170829_154850_feedback_category
 */
class m170829_154850_feedback_category extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%feedback_category}}',
                           [
                               'id'   => $this->primaryKey(),
                               'name' => $this->string()->notNull(),
                           ],
                           $tableOptions);

        $this->dropColumn('{{%feedback}}', 'type');
        $this->addColumn('{{%feedback}}', 'category_id', $this->integer()->null());

        $this->addForeignKey('fk_feedback_category',
                             '{{feedback}}',
                             'category_id',
                             '{{feedback_category}}',
                             'id',
                             'SET NULL',
                             'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_feedback_category', '{{%feedback}}');
        $this->dropColumn('{{%feedback}}', 'category_id');
        $this->addColumn('{{%feedback}}', 'type', $this->integer()->notNull());
        $this->dropTable('{{%feedback_category}}');
    }
}
