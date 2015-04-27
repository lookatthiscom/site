<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Helper;
use app\components\widgets;

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
                <?= widgets\LeftPanelWidget::widget();?>
                <?php if(in_array(Yii::$app->controller->id, ['article']) && in_array(Yii::$app->controller->action->id, ['create', 'preview']) ):?>
                    <div class="col-lg-11 col-md-11 center-panel big">
                        <?= $content ?>
                    </div>
                <?php else:?>
                    <div class="col-lg-7 col-md-7 center-panel">
                        <?= $content ?>
                    </div>
                <?php endif;?>
                <?= widgets\RightPanelWidget::widget();?>
            </div>
            <div class="row copy">&copy; Lookatthis <?= date('Y') ?></div>
        </div>
    </div>

    <?= widgets\FooterWidget::widget();?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
