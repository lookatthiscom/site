<?php
namespace app\models;

use yii\db\ActiveRecord;

class ArticlePhoto extends ActiveRecord
{
    public static function tableName(){
        return 'article_photo';
    }

    public function getArticle(){
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }
}