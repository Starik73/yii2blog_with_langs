<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => [
        ['label' => 'Home', 'url' => ['index']],
        ['label' => 'About', 'url' => ['about']],
        ['label' => 'Contact', 'url' => ['contact']],
        ['label' => 'SignUp', 'url' => ['signup'], 'visible' => Yii::$app->user->isGuest],
        ['label' => 'Blog', 'url' => ['/blog']],
        ['label' => 'AdminPanel', 'url' => ['/adminpanel']],
        Yii::$app->user->isGuest
            ? (['label' => 'Login', 'url' => ['/login']])
            : (
                '<li>'
                . Html::beginForm(['logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
    ],
]);
NavBar::end();
?>
<?=Url::to(['index']);?>