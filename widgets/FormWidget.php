<?php

namespace bttree\smyfeedback\widgets;

use bttree\smyfeedback\models\Feedback;
use bttree\smyfeedback\assets\FeedbackAsset;
use Yii;
use yii\bootstrap\Widget;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/**
 * Class FaqWidget
 * @package bttree\smyfeedback\widgets
 */
class FormWidget extends Widget
{
    /**
     * @var string $view
     */
    public $view = 'form';

    /**
     * @var array $fields
     */
    public $otherFields = [];

    /**
     * @var string $buttonSelector
     */
    public $formSelector = '.feedback-form';

    /**
     * @var string $url
     */
    public $url = '';

    /**
     * @var boolean $ajax
     */
    public $ajax = true;
    
    public $category_id = null;


    /**
     * @inheritdoc
     */
    public function init()
    {
        if (empty($this->url)) {
            $this->url = Url::to(['/smyfeedback/feedback/send-feedback']);
        }

        $view = $this->getView();
        FeedbackAsset::register($view);

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->ajax) {
            $view = $this->getView();
            $js   = 'initFeedbackFormAjax("' . $this->formSelector . '", "' .
                    $this->url
                    . '");';
            $view->registerJs($js, $view::POS_READY);
        }

        $feedback = new Feedback();
        $feedback->category_id = $this->category_id;

        return $this->render($this->view,
                             [
                                 'otherFields'  => $this->otherFields,
                                 'url'          => $this->url,
                                 'formSelector' => $this->formSelector,
                                 'feedback'     => $feedback
                             ]);
    }
}
