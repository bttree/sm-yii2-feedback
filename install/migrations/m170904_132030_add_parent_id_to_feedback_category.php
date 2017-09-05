<?php

use yii\db\Migration;
use bttree\smyfeedback\models\FeedbackCategory;

/**
 * Class m170904_132030_add_phone_to_profile
 */
class m170904_132030_add_parent_id_to_feedback_category extends Migration
{
    public function safeUp()
    {
        $this->addColumn(FeedbackCategory::tableName(), 'parent_id', $this->integer()->null());
    }

    public function safeDown()
    {
        $this->dropColumn(FeedbackCategory::tableName(), 'parent_id');
    }
}