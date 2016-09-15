<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<a class="list-group-item" href="<?= Url::to(['/music/show', 'id' => $model->id]) ?>">
    <?= Html::encode($model->original_singer . '-' . $model->name); ?>
    <span class="label label-info"><?= Html::encode($model->key) ?></span>
    <span class="label label-info"><?= Html::encode($model->time) ?></span>
</a>
