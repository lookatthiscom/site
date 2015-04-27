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
                <div class="col-sm-3">
                    <img src="http://api.hostip.info/flag.php"  class="flag pull-left" data-toggle="tooltip" data-placement="top" title="<?=Yii::t('app','UKRAINE');?>">
                    <span class="info">I am <?= Yii::$app->user->identity->username;?></span>
                </div>
                <div class="col-sm-6">

                </div>
                <div class="col-sm-3">
                    <div class="arrow-footer glyphicon open glyphicon-remove pull-right"></div>
                    <a href="<?=Url::to(['site/logout']);?>" data-method="post" class="btn btn-success log-in pull-right" type="button">
                        <?= Yii::t('app','Log out');?>
                    </a>
                </div>
            </div>
        </div>
    </footer>
<?php endif;?>