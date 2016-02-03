<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@baseThemePath';
    public $baseUrl = '@baseThemeUrl';
    
    
    public $css = [
        'css/site.css',
        'css/bootstrap-theme.css',
        'css/fonts/font-awesome/css/font-awesome.css',
        'css/animations.css',
        'css/superfish.css',
        'css/revolution-slider/css/settings.css',
        'css/revolution-slider/css/extralayers.css',
        'css/prettyPhoto.css',
        'css/style.css',
        'css/global.css',
        'css/colors/blue.css',
        'css/theme-responsive.css',
        'css/switcher.css',
        'css/spectrum.css',
//        'css/',
    ];
    public $js = [
        'js/jquery-migrate-1.2.1.min.js',
        'js/jquery-ui.js',
        'js/bootstrap.js',
        'js/jquery.parallax.js',
        'js/jquery.wait.js',
        'js/modernizr-2.6.2.min.js',
        'js/modernizr.custom.js',
        'js/revolution-slider/js/jquery.themepunch.tools.min.js',
        'js/revolution-slider/js/jquery.themepunch.revolution.min.js',
        'js/jquery.nivo.slider.pack.js',
        'js/jquery.prettyPhoto.js',
        'js/superfish.js',
        'js/tweetMachine.js',
        'js/tytabs.js',
        'js/jquery.gmap.min.js',
        'js/circularnav.js',
        'js/jquery.sticky.js',
        'js/jflickrfeed.js',
        'js/imagesloaded.pkgd.min.js',
        'js/waypoints.min.js',
        'js/spectrum.js',
        'js/switcher.js',
        'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
