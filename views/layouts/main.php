<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => 'My Company',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => [
                ['label' => '首页', 'url' => ['/site/index']],
                ['label' => '所有曲目', 'url' => ['/music/list']],
                ['label' => '联系我们', 'url' => ['/site/contact']],
                Yii::$app->user->isGuest
                    ? (['label' => '登录', 'url' => ['/site/login']])
                    : ('<li>' . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form']) . Html::submitButton(
                        '退出 (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link']
                    ) . Html::endForm() . '</li>'
                )
            ],
        ]);
        echo Html::beginForm(['music/list'], 'get', ['class' => 'navbar-form navbar-right']);
        echo Html::textInput('keywords', Yii::$app->request->get('keywords'), ['class' => 'form-control', 'placeholder' => '请输入曲目关键字']);
        echo Html::endForm();
        NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>