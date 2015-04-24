<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Url;

?>
<div id="article-new" class="article-new col-lg-8 col-md-8">
    <?php $form = ActiveForm::begin([
            'id' => 'create-article-form',
            'options' => ['enctype' => 'multipart/form-data'],
        ]);?>
        <?= $form->field($model, 'title')->input('text',['maxlength' => '40']);?>
        <?= $form->field($model, 'description')->textarea(['class' => 'form-control description', 'maxlength' => '155', 'value' => $article->description]);?>

        <?= $form->field($model, 'part1')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'basic',
            'value' => $article->part1
        ]) ?>

        <?= $form->field($model, 'part2')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'basic',
            'value' => $article->part2
        ]) ?>

        <?//= $form->field($model, 'photo[]')->fileInput(['multiple' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Create article'), ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app','Preview'), Url::to(['article/ajax-preview', 'public_id' => $article->public_id]), ['id' => 'preview-btn', 'class' => 'btn btn-primary']);?>
    </div>
    <?php $form::end();?>
</div>
<div id="preview" class="col-lg-4 col-md-4">
    <div id="preview_title" class="title"></div>
    <div>
        <img src="/images/no_image.jpg" class="img-responsive preview-img">
    </div>
    <div id="preview_description_1" class="description">
        <?=Yii::t('app','Article\'s first part');?>
    </div>
    <div>
        <img src="/images/no_image.jpg" class="img-responsive preview-img">
    </div>
    <div id="preview_description_2" class="description">
        <?=Yii::t('app','Article\'s second part');?>
    </div>
    <div>
        <img src="/images/no_image.jpg" class="img-responsive preview-img">
    </div>
</div>