<?php

use Yii;
use yii\helpers\Html;
use yii\grid\GridView;
use bttree\smyfeedback\models\FeedbackCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('smy.feedback', 'Feedback Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('smy.feedback', 'Create Feedback Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
                             'dataProvider' => $dataProvider,
                             'filterModel' => $searchModel,
                             'columns'      => [
                                 ['class' => 'yii\grid\SerialColumn'],

                                 'id',
                                 'name',
                                 [
                                     'attribute' => 'parent_id',
                                     'value' => function ($data) {
                                         if(isset($data->parent)){
                                             return $data->parent->name;
                                         }
                                         return '-';
                                     },
                                     'filter'    => Html::activeDropDownList(
                                         $searchModel,
                                         'parent_id',
                                         $arrayParents,
                                         ['class' => 'form-control', 'prompt' => Yii::t('smy.feedback', 'All')]
                                     ),
                                 ],

                                 [
                                     'class'    => 'yii\grid\ActionColumn',
                                     'template' => '{update} {delete}',
                                     'buttons'  => [
                                         'list' => function ($url, $model, $key) {
                                             return Html::a(
                                                 Html::tag('span',
                                                     '',
                                                     ['class' => 'glyphicon glyphicon-list']),
                                                 Url::to([
                                                     '/smyfeedback/feedback/index',
                                                     'FeedbackSearch[category_id]' => $model->id
                                                 ]));
                                         }
                                     ],
                                 ],
                             ],
                         ]); ?>
</div>
