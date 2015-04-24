<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/main.scss',
        'css/articles-list.scss',
        'css/modal.scss',
        'css/jquery.arcticmodal-0.3.css',
        'css/dark.css'
    ];
    public $js = [
        'js/main.js',
        'js/jquery.arcticmodal-0.3.min.js'
    ];
    public $images = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
