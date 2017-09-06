<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bttree\smyfeedback\models\FeedbackCategory;

/* @var $this yii\web\View */
/* @var $model bttree\smyfeedback\models\FeedbackCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'parent_id')->dropDownList(FeedbackCategory::find()->select(['name', 'id'])->indexBy('id')->column()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('smy.feedback', 'Create') :
                                   Yii::t('smy.feedback', 'Update'),
                               ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
