<?php

use yii\helpers\Html;

?>

<?php
$quest_answers = $model->feedbacks;
$category_childs = $model->childs;
?>


    <div class="feedcategory-name">
        <?= Html::encode($model->name) ?>
    </div>

    <?php if($quest_answers): ?>
        <?php foreach($quest_answers as $qa): ?>
            <div class="feedback-quest">
                <?= Html::encode($qa->text);?>
            </div>
            <div class="feedback-answer">
                <?= Html::encode($qa->answer);?>
            </div>
        <?php endforeach;?>
    <?php endif;?>

    <?php if($category_childs): ?>
        <?php foreach ($category_childs as $child): ?>
            <?= $this->render('child', ['model' => $child]) ;?>
        <?php endforeach;?>
    <?php endif; ?>

