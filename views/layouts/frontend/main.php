<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <base href="<?= Yii::$app->homeUrl ?>">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>
    <header>
    <?php
        if (file_exists(__DIR__ . '/components/header.php')) {
            require_once __DIR__ . '/components/header.php';
        }
    ?>
    <div id="breadcrumbs">
        <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs'])
                    ? $this->params['breadcrumbs']
                    : [],
            ]);
        ?>
    </div>
    </header>
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <div class="notification-block">
                <?=Alert::widget()?>
            </div>
            <div id="content">
                <?=$content?>
            </div>
        </div>
    </main>
    <footer class="footer mt-auto py-3 text-muted">
    <?php
        if (file_exists(__DIR__ . '/components/footer.php')) {
            require_once __DIR__ . '/components/footer.php';
        }
    ?>
    </footer>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
