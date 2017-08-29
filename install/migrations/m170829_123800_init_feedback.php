<?php

use yii\db\Migration;
use bttree\smyfeedback\models\Feedback;

/**
 * Class m170829_123800_init_feedback
 */
class m170829_123800_init_feedback extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%feedback}}',
                           [
                               'id'          => $this->primaryKey(),
                               'name'        => $this->string()->notNull(),
                               'email'       => $this->string()->null(),
                               'phone'       => $this->string()->null(),
                               'theme'       => $this->string()->null(),
                               'text'        => $this->text()->notNull(),
                               'type'        => $this->integer()->notNull(),
                               'status'      => $this->integer()->notNull()->defaultValue(Feedback::STATUS_NEW),
                               'answer'      => $this->text()->null(),
                               'answer_time' => $this->timestamp()
                                                     ->null()
                                                     ->defaultExpression('NULL'),
                               'create_time' => $this->timestamp()
                                                     ->notNull()
                                                     ->defaultExpression('CURRENT_TIMESTAMP'),
                               'update_time' => $this->timestamp()
                                                     ->notNull()
                                                     ->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')

                           ],
                           $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%feedback}}');
    }

}
