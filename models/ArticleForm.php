<?php
namespace app\models;
use yii\base\Model;

class ArticleForm extends Model
{
    public $id;
    public $title;
    public $description;
    public $part1;
    public $part2;
    public $tags;
    public $photo1;
    public $photo2;
    public $photo3;

    public function rules(){
        return [
          [['title','part1'], 'required'],
          ['title', 'string', 'max' => 40],
          ['description', 'string', 'max' => 155],
          [['part1','part2'], 'string', 'max' => 1000],
          [['title','part1'], 'required', 'on' => 'preview'],
          //[['photo1','photo2','photo3'],'file']
        ];
    }

    public function attributeLabels(){
        return [
            'title' => \Yii::t('app','Article\'s title'),
            'description' => \Yii::t('app','Article\'s description'),
            'part1' => \Yii::t('app','Article\'s first part'),
            'part2' => \Yii::t('app','Article\'s second part'),
            'photo1' => \Yii::t('app','Photo'),
            'photo2' => \Yii::t('app','Photo'),
            'photo3' => \Yii::t('app','Photo'),
        ];
    }
}