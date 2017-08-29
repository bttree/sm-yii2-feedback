<?php

namespace bttree\smyfeedback\models;

use bttree\smywidgets\behaviors\ConstArrayBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "feedback".
 *
 * @property integer          $id
 * @property string           $name
 * @property string           $email
 * @property string           $phone
 * @property string           $theme
 * @property string           $text
 * @property integer          $category_id
 * @property integer          $status
 * @property string           $answer
 * @property string           $answer_time
 * @property string           $create_time
 * @property string           $update_time
 *
 * @property FeedbackCategory $category
 *
 * @method array  getConstArray(string $attribute)
 * @method string getTitleValue(string $attribute)
 */
class Feedback extends ActiveRecord
{
    const STATUS_NEW         = 0;
    const STATUS_PROCESS     = 1;
    const STATUS_FINISHED    = 2;
    const STATUS_ANSWER_SENT = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{feedback}}';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class'  => ConstArrayBehavior::className(),
                'arrays' => [
                    'status' => [
                        self::STATUS_NEW         => Yii::t('smy.feedback', 'New'),
                        self::STATUS_PROCESS     => Yii::t('smy.feedback', 'Process'),
                        self::STATUS_FINISHED    => Yii::t('smy.feedback', 'Finished'),
                        self::STATUS_ANSWER_SENT => Yii::t('smy.feedback', 'Answer sent'),
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'text', 'status'], 'required'],
            [['status', 'category_id'], 'integer'],
            [['email'], 'email'],
            [['status'], 'default', 'value' => self::STATUS_NEW],
            [['text', 'answer'], 'string'],
            [['name', 'theme', 'phone', 'email'], 'string', 'max' => 255],
            [['create_time', 'update_time', 'answer_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('smy.feedback', 'ID'),
            'name'        => Yii::t('smy.feedback', 'Name'),
            'email'       => Yii::t('smy.feedback', 'E-mail'),
            'phone'       => Yii::t('smy.feedback', 'Phone'),
            'theme'       => Yii::t('smy.feedback', 'Theme'),
            'text'        => Yii::t('smy.feedback', 'Text'),
            'category_id' => Yii::t('smy.feedback', 'Category'),
            'status'      => Yii::t('smy.feedback', 'Status'),
            'answer'      => Yii::t('smy.feedback', 'Answer'),
            'answer_time' => Yii::t('smy.feedback', 'Answer time'),
            'create_time' => Yii::t('smy.feedback', 'Create time'),
            'update_time' => Yii::t('smy.feedback', 'Update time'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeValidate()
    {
        $this->phone = preg_replace('/[^\d]/i', '', $this->phone);

        return parent::beforeValidate();
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (!empty($this->answer) && empty($this->answer_time)) {
            $now               = new \DateTime();
            $this->answer_time = $now->format('Y-m-d H:i:s');
        }

        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery|FeedbackCategory
     */
    public function getCategory()
    {
        return $this->hasOne(FeedbackCategory::className(), ['id' => 'category_id']);
    }
}
