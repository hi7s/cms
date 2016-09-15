<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use app\models\Config;
use app\models\Tag;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = $music->original_singer . '-' . $music->name;
$this->params['breadcrumbs'][] = ['label' => '所有曲目', 'url' => ['/music/list']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['/music/show', 'id' => $music->id]];
$this->params['breadcrumbs'][] = '修改';
?>

    <style>
        #music-key > div[class='radio'], #music-time > div[class='radio'], #music-tempo > div[class='radio'], #music-tags > div[class='checkbox'] {
            float: left;
            margin-right: 15px;
        }
    </style>

<?php $form = ActiveForm::begin([
    'id' => 'edit-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>

<?= $form->field($music, 'original_singer')->textInput([]) ?>
<?= $form->field($music, 'key')->radioList(ArrayHelper::map(Config::keys(), 'key', 'value')) ?>
<?= $form->field($music, 'time')->radioList(ArrayHelper::map(Config::times(), 'key', 'value')) ?>
<?= $form->field($music, 'tempo')->radioList(ArrayHelper::map(Config::tempos(), 'key', 'value')) ?>
<?= $form->field($music, 'text_author')->textInput([]) ?>
<?= $form->field($music, 'song_author')->textInput([]) ?>
<?= $form->field($music, 'tags')->checkboxList(ArrayHelper::map(Config::tags(), 'key', 'value')) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>&nbsp;
            <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>&nbsp;
            <?= Html::a('取消', ['music/show', 'id' => $music->id], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>