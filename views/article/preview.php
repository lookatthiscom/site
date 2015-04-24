<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div>
    <div class="col-md-9 preview-page">
        <div class="tech"><?=Yii::t('app','Preview mode');?></div>
        <div class="article-full">
            <div class="title">
                <span><?=$article->title;?></span>
                <?= Html::activeHiddenInput($article, 'title');?>
                <?= Html::activeHiddenInput($article, 'description');?>
            </div>
            <div class="part1">
                <?=$article->part1;?>
                <?= Html::activeHiddenInput($article, 'part1');?>
            </div>
            <div class="part2">
                <?=$article->part2;?>
                <?= Html::activeHiddenInput($article, 'part2');?>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3">
        <?= Html::a(Yii::t('app','Edit'), Url::to(['article/create', 'public_id' => $article->public_id]), ['class' => 'btn btn-primary col-md-12']);?>
        <?= Html::a(Yii::t('app','Create article'), Url::to(['article/create', 'public_id' => $article->public_id]), [ 'data-method'=>'post', 'class' => 'btn btn-success col-md-12']);?>
    </div>
</div>