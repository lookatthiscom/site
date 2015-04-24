<?php
use yii\helpers\Html;
use yii\helpers\Url;

if(Yii::$app->user->isGuest):?>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="arrow-footer glyphicon glyphicon-chevron-up"></div>
                <a href="<?=Url::to(['modal/show']);?>" class="btn btn-success modal-btn log-in" type="button" data-modal-type="login">
                    <?= Yii::t('app','Log in');?>
                </a>
            </div>
        </div>
    </footer>
<?php else:?>
    <footer class="footer open">
        <div class="container">
            <div class="row">
                <div class="arrow-footer glyphicon open glyphicon-remove pull-right"></div>
                <a href="<?=Url::to(['site/logout']);?>" data-method="post" class="btn btn-success log-in" type="button">
                    <?= Yii::t('app','Log out');?>
                </a>
            </div>
        </div>
    </footer>
<?php endif;?>