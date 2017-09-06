<?php

namespace bttree\smyfeedback\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%feedback_category}}".
 *
 * @property integer    $id
 * @property string     $name
 * @property integer    $parent_id
 *
 * @property Feedback[] $feedbacks
 */
class FeedbackCategory extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%feedback_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['parent_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'        => Yii::t('smy.feedback', 'ID'),
            'name'      => Yii::t('smy.feedback', 'Name'),
            'parent_id' => Yii::t('smy.feedback', 'Parent ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery|Feedback[]
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['category_id' => 'id']);
    }


    public function getChilds()
    {
        return $this->hasMany(FeedbackCategory::className(), ['parent_id' => 'id']);
    }

    /**
     * @param integer|null $id
     * @return array
     */
    public static function getAllArrayForSelect($id = null)
    {
        $query = self::find();
        if (!empty($id)) {
            $query->where(['!=', 'id', $id]);
        }

        return ArrayHelper::map($query->orderBy('id')->asArray()->all(), 'id', 'name');
    }
}
