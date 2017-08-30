<?php

namespace bttree\smyfeedback\widgets;

use bttree\smyfeedback\models\Feedback;
use Yii;
use yii\bootstrap\Widget;
use yii\data\ActiveDataProvider;

/**
 * Class FaqWidget
 * @package bttree\smyfeedback\widgets
 */
class FaqWidget extends Widget
{
    /**
     * @var integer $categoryId
     */
    public $categoryId;

    /**
     * @var string $view
     */
    public $view = 'faq';


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $query        = Feedback::find()
                                ->where(['category_id' => $this->categoryId])
                                ->andWhere(['!=', 'text', ''])
                                ->andWhere(['!=', 'answer', '']);

        $dataProvider = new ActiveDataProvider([
                                                   'query' => $query,
                                               ]);

        return $this->render($this->view, ['dataProvider' => $dataProvider]);
    }
}
