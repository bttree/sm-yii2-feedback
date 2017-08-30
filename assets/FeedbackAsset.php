<?php

namespace bttree\smyfeedback\assets;

use yii\web\AssetBundle;


class FeedbackAsset extends AssetBundle
{
    public $sourcePath = '@bttree/smyfeedback/assets';

    public $js = [
        'js/feedback.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset'
    ];
}
