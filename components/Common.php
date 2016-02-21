<?php
namespace app\components;

use \Yii;
use \yii\base\Component;

class Common extends Component {
    
    public static function substrBoundary($str, $length) {
        $str = explode(' ', $str);
        $return = '';
        $i = $len = 0;
        while($len <= $length && isset($str[$i])) {
            $return .= $str[$i].' ';
            $len += strlen($str[$i]) + 1;
            $i++;
        }
        return $return;
    }
}
