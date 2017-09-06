<?php

namespace bttree\smyfeedback;

use Yii;

/**
 * page module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'bttree\smyfeedback\controllers';
    public $email_origin = 'info@answer.ru';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (!isset(Yii::$app->i18n->translations['smy.feedback'])) {
            Yii::$app->i18n->translations['smy.feedback'] = [
                'class'          => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'ru',
                'basePath'       => '@bttree/smyfeedback/messages'
            ];
        }
    }
}