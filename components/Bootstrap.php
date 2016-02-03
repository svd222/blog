<?php
namespace app\components;

use Yii;
use yii\base\Component;

class Bootstrap extends Component {
    
    public function init() {
        $webroot = Yii::getAlias('@webroot');
        $webroot = substr($webroot, 0, strrpos($webroot, '/'));
        $assetThemePath = $webroot.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.Yii::$app->params['themeName'].DIRECTORY_SEPARATOR.'assets';
        $baseTheme = Yii::$app->assetManager->publish($assetThemePath);        
        Yii::$app->params['baseTheme'] = $baseTheme;
        Yii::setAlias('@baseThemePath', $baseTheme[0]);
        Yii::setAlias('@baseThemeUrl', $baseTheme[1]);
        parent::init();
    }
}
