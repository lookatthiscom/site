<?php
namespace app\models;

use yii\db\ActiveRecord;

class ArticleShow extends ActiveRecord
{
    public static function tableName(){
        return 'article_show';
    }

    public function getArticle(){
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }
}