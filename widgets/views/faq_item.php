<?php

use yii\widgets\ListView;
use yii\helpers\Html;

/* @var $this \yii\web\View */

/* @var $model   \bttree\smyfeedback\models\Feedback, the data model
 * @var $key     mixed, the key value associated with the data item
 * @var $index   integer, the zero-based index of the data item in the items array returned by $dataProvider.
 * @var $widget  ListView
 */

?>

<div class="faq-item">
    <strong class="faq-item-text"><?= strip_tags($model->text) ?></strong>
    <br>
    <em class="faq-item-answer"><?= strip_tags($model->answer) ?></em>
</div>
<hr>
