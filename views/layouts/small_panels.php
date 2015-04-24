<?php
use yii\helpers\Html;
use yii\helpers\Url;
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
                <div class="col-lg-1 col-md-1 left-panel small">
                    <a class="button-list write-article" href="<?=Url::to(['article/new']);?>">
                        <div class="pull-left icon article"></div>
                    </a>
                    <a class="button-list earn-money" href="#">
                        <div class="pull-left icon earn"></div>
                    </a>
                    <a class="button-list buy-article" href="#">
                        <div class="pull-left icon buy-article"></div>
                    </a>
                    <a class="button-list join" href="#">
                        <div class="pull-left icon join"></div>
                    </a>
                </div>
                <div class="col-lg-11 col-md-11 center-panel big">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>

    <?= app\components\widgets\FooterWidget::widget();?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
