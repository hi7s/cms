<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $music->original_singer . '-' . $music->name;
$this->params['breadcrumbs'][] = ['label' => '所有曲目', 'url' => ['/music/list']];
$this->params['breadcrumbs'][] = $this->title;

$source_page = yii::$app->session->get('music.show.source.page');
?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <?= $music->original_singer . '-' . $music->name ?>
        </div>
        <div class="panel-body">
            <?= Html::a($music->key, ['/music/list', 'key' => $music->key], ['class' => 'label label-primary']); ?>
            <?= Html::a($music->time, ['/music/list', 'time' => $music->time], ['class' => 'label label-primary']); ?>
            <?php foreach (isset($music->tags) ? $music->tags : [] as $tag): ?>
                <?= Html::a($tag, ['/tag/show', 'tag' => $tag], ['class' => 'label label-info']); ?>
            <?php endforeach; ?>
        </div>
        <div class="panel-footer">
            <?= Html::a('找歌谱', 'http://www.zhaogepu.com/search?wd=' . $music->name, ['class' => 'btn btn-default', 'target' => '_blank']) ?>
            <?= Html::a('曲谱网', 'http://www.qupu123.com/Search?keys=' . $music->name, ['class' => 'btn btn-default', 'target' => '_blank']) ?>
            <?= Html::a('百度一下', 'https://www.baidu.com/s?wd=谱 ' . $music->original_singer . ' ' . $music->name, ['class' => 'btn btn-default', 'target' => '_blank']) ?>
        </div>
    </div>
<?= Html::a('编辑', ['/music/edit', 'id' => $music->id], ['class' => 'btn btn-primary']) ?>&nbsp;
<?= Html::a('返回', !empty($source_page) ? $source_page : ['/music/list'], ['class' => 'btn btn-default']) ?>