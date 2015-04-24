<?php
use yii\helpers\Html;
use yii\helpers\Url;

use app\models\Helper;

if(in_array(Yii::$app->controller->id, ['article']) && in_array(Yii::$app->controller->action->id, ['create', 'preview']) ):?>

<?php else:?>
    <?php if(Yii::$app->user->isGuest):?>
        <div class="col-lg-2 col-md-2 right-panel">
            <?php
            echo 'Language: '.$language = \Yii::$app->request->getAcceptableLanguages()[0].'</br>';
            echo 'Locale: '.Yii::$app->language.'</br>';
            echo 'IP: '.Helper::getUserLocation('ip').'</br>';
            echo 'Country: '.Helper::getUserLocation('country_name').'</br>';
            ?>
        </div>
    <?php else:?>
        <div class="col-lg-2 col-md-2 right-panel">
            <?php
            echo 'Language: '.$language = \Yii::$app->request->getAcceptableLanguages()[0].'</br>';
            echo 'Locale: '.Yii::$app->language.'</br>';
            echo 'IP: '.Helper::getUserLocation('ip').'</br>';
            echo 'Country: '.Helper::getUserLocation('country_name').'</br>';
            ?>
        </div>
    <?php endif;?>
<?php endif;?>