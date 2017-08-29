<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model bttree\smyfeedback\models\FeedbackCategory */

$this->title                   = Yii::t('smy.feedback', 'Create Feedback Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('smy.feedback', 'Feedback Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form',
                      [
                          'model' => $model,
                      ]) ?>

</div>
