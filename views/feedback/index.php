<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('smy.feedback', 'Feedback');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('smy.feedback', 'Create Feedback'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('smy.feedback', 'Feedback Categories'),
            ['/smyfeedback/feedback-category/index'],
            ['class' => 'btn btn-info']) ?>
    </p>
    <?= GridView::widget([
                             'dataProvider' => $dataProvider,
                             'filterModel'  => $searchModel,
                             'columns'      => [
                                 ['class' => 'yii\grid\SerialColumn'],

                                 'id',
                                 'name',
                                 [
                                     'attribute' => 'status',
                                     'value' => function($model){
                                         return isset($model->status) ? $model->getConstArray('status')[$model->status] : '-';
                                     },
                                     'filter'    => Html::activeDropDownList(
                                         $searchModel,
                                         'status',
                                         $searchModel->getConstArray('status'),
                                         ['class' => 'form-control', 'prompt' => '---']
                                     )

                                 ],
                                 'email:email',
                                 'phone',
                                 'theme',

                                 [
                                     'class'    => 'yii\grid\ActionColumn',
                                     'template' => '{update} {delete}'
                                 ],
                             ],
                         ]); ?>
</div>
