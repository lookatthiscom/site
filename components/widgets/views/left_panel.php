<?php
use yii\helpers\Html;
use yii\helpers\Url;

if(in_array(Yii::$app->controller->id, ['article']) && in_array(Yii::$app->controller->action->id, ['create', 'preview']) ):?>
    <div class="col-lg-1 col-md-1 left-panel small">
        <a class="button-list write-article" href="/article/new">
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
<?php else:?>
    <?php if(Yii::$app->user->isGuest):?>
        <div class="col-lg-3 col-md-3 left-panel">
            <a class="button-list write-article" href="<?=Url::to(['article/new']);?>">
                <div class="pull-left icon article"></div>
                <div class="col-md-9 col-lg-9 title">
                    <?=\Yii::t('app','Write my article');?>
                </div>
            </a>
            <a class="button-list earn-money" href="#">
                <div class="pull-left icon earn"></div>
                <div class="col-md-9 col-lg-9 title">
                    <?=\Yii::t('app','Earn money');?>
                </div>
            </a>
            <a class="button-list buy-article" href="#">
                <div class="pull-left icon buy-article"></div>
                <div class="col-md-9 col-lg-9 title">
                    <?=\Yii::t('app','Buy article');?>
                </div>
            </a>
            <a class="button-list join modal-btn" href="<?=Url::to(['modal/show']);?>" data-modal-type="login">
                <div class="pull-left icon join"></div>
                <div class="col-md-9 col-lg-9 title">
                    <?=\Yii::t('app','Join');?>
                </div>
            </a>
        </div>
    <?php else:?>
        <div class="col-lg-3 col-md-3 left-panel">
            <a class="button-list write-article" href="<?=Url::to(['article/new']);?>">
                <div class="pull-left icon article"></div>
                <div class="col-md-9 col-lg-9 title">
                    <?=\Yii::t('app','Write my article');?>
                </div>
            </a>
            Welcome, <?= Yii::$app->user->identity->username;?>
        </div>
    <?php endif;?>
<?php endif;?>