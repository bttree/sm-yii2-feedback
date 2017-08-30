<?php

use yii\widgets\ListView;

/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

?>


<?= ListView::widget([
                         'dataProvider' => $dataProvider,
                         'options'      => ['class' => 'faq list-view'],
                         'layout'       => "{items}<br>{pager}",
                         'itemView'     => 'faq_item'
                     ]);
?>