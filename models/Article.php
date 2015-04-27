<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Expression;

class Article extends ActiveRecord
{
    const STATUS_NOT_APPROVED = 0;
    const STATUS_APPROVED = 1;
    const STATUS_DELETED = 2;
    const STATUS_ARCHIVE = 4;

    public static function tableName(){
        return 'article';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['new'] = ['title', 'part1'];
        return $scenarios;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord){
                $this->public_id = uniqid();
                $this->locale = \Yii::$app->language;
            }
            $this->public_title = Helper::cyrToLat($this->title);
            $this->updated_at = new Expression('NOW()');
            return true;
        } else {
            return false;
        }
    }

    public function findByPublicId($public_id){
        return Article::find()->where(['public_id' => $public_id])->one();
    }

    public function findByPublicTitle($public_title){
        return Article::find()->where(['public_title' => $public_title])->one();
    }

    public function getOverviews(){
        return $this->hasMany(ArticleShow::className(), ['article_id' => 'id']);
    }

    public function getPhotos(){
        return $this->hasMany(ArticlePhoto::className(), ['article_id' => 'id']);
    }

    public function getUser(){
        return $this->hasOne(User::className(), ['user_id' => 'id']);
    }

    public function isNewObserver($user_location = null){
        if(is_null($user_location)){
            return false;
        }
        if($this->getOverviews()->where(['ip_address' => $user_location->ip])->one()){
            return false;
        }else{
            $articleShow = new ArticleShow();
            $articleShow->country = $user_location->country_name;
            $articleShow->ip_address = $user_location->ip;
            $articleShow->article_id = $this->id;
            $articleShow->user_id = (\Yii::$app->user->isGuest)?null:\Yii::$app->user->id;
            $articleShow->save();
            $this->updateCounters(['total_show_count' => 1]);
        }
    }
}