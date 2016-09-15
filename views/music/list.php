<?php

/* @var $this yii\web\View */

use yii\widgets\ListView;

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;

yii::$app->session->set('music.show.source.page', yii::$app->request->absoluteUrl);
?>

<?= ListView::widget(['dataProvider' => $dataProvider,
    'options' => ['class' => 'list-group'],
    'itemView' => '_item',
    'itemOptions' => ['tag' => false],
    'pager' => ['maxButtonCount' => '6'],
    'summary' => false]) ?>