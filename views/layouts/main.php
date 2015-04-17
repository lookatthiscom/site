<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

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
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 left-panel">
                    <a class="button-list write-article" href="#">
                        <div class="pull-left icon article"></div>
                        <div class="col-md-9 col-lg-9 title">
                            Write my article
                        </div>
                    </a>
                    <a class="button-list earn-money" href="#">
                        <div class="pull-left icon earn"></div>
                        <div class="col-md-9 col-lg-9 title">
                            Зарабатывайте
                        </div>
                    </a>
                    <a class="button-list buy-article" href="#">
                        <div class="pull-left icon buy-article"></div>
                        <div class="col-md-9 col-lg-9 title">
                            Buy article
                        </div>
                    </a>
                    <a class="button-list join" href="#">
                        <div class="pull-left icon join"></div>
                        <div class="col-md-9 col-lg-9 title">
                            Join
                        </div>
                    </a>
                </div>
                <div class="col-lg-7 col-md-7 center-panel">
                    <?= $content ?>
                </div>
                <div class="col-lg-2 col-md-2 right-panel"></div>
            </div>
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
