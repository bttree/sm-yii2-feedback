<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $otherFields array */
/* @var $url string */
/* @var $formSelector string */
/* @var $feedback \bttree\smyfeedback\models\Feedback */

?>


<div class="gallery-form" id="gallery_image">

    <?php $form = ActiveForm::begin([
                                        'enableClientValidation' => false,
                                        'action'                 => $url,
                                        'options'                => ['class' => trim($formSelector, '.')]
                                    ]); ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($feedback, 'name')->textInput(['maxlength' => true, 'required' => true]) ?>
        </div>
    </div>

    <?php foreach ($otherFields as $label => $field): ?>
        <div class="row">
            <div class="col-sm-12">
                <?php if ($feedback->hasAttribute($field)): ?>
                    <?= $form->field($feedback, $field)->textInput(['maxlength' => true, 'type' => $field]) ?>
                <?php else: ?>
                    <div class="form-group">
                        <?= Html::label($label, "field-$field", ['class' => 'control-label']); ?>
                        <?= Html::textInput("OtherFields[$label]",
                                            '',
                                            ['id' => "field-$field", 'class' => 'form-control', 'type' => $field]); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($feedback, 'text')->textarea(['rows' => 6, 'required' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(
            Yii::t('smy.feedback', 'Send'),
            ['class' => "btn btn-primary"]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>