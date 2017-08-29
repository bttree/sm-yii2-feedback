<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bttree\smyfeedback\models\FeedbackCategory;
use bttree\smywidgets\widgets\TextEditorWidget;

/* @var $this yii\web\View */
/* @var $model bttree\smyfeedback\models\Feedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'status')->dropDownList($model->getConstArray('status')) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'category_id')
                     ->dropDownList(FeedbackCategory::getAllArrayForSelect(), ['prompt' => '---']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'theme')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'text')->widget(TextEditorWidget::className(),
                                                     [
                                                         'editor'   => 'imperavi',
                                                         'settings' => [
                                                             'lang'      => 'ru',
                                                             'minHeight' => 200,
                                                         ]
                                                     ]);
            ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'answer')->widget(TextEditorWidget::className(),
                                                       [
                                                           'editor'   => 'imperavi',
                                                           'settings' => [
                                                               'lang'      => 'ru',
                                                               'minHeight' => 200,
                                                           ]
                                                       ]);
            ?>
            <?= $form->field($model, 'answer_time')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('smy.feedback', 'Create') :
                                   Yii::t('smy.feedback', 'Update'),
                               ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
