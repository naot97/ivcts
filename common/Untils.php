<?php
namespace common;
use yii\helpers\Html;
use yii;
class Untils{
	public static function writeChild($link,$name){
        echo Html::beginTag('li');
        echo Html::beginTag('a',['href' => Yii::$app->request->baseUrl.$link,]);
        echo $name;
        echo Html::endTag('a');
        echo Html::endTag('li');
    }

    public static function writeNoChild($link,$name,$icon){
        echo Html::beginTag('li');
        echo Html::beginTag('a',['href' => Yii::$app->request->baseUrl.$link,'aria-expanded' => 'false']);
        echo Html::tag('i','',['class' => 'fa '.$icon]);
        echo Html::tag('span',$name,['class' => 'hide-menu']);
        echo Html::endTag('a');
        echo Html::endTag('li');
    }

    public static function writeParent($name,$icon){
        echo Html::beginTag('a',['href' => "#", "aria-expanded" => "false",'class' => 'has-arrow has-child']);
        echo Html::tag('i','',['class' => 'fa '.$icon,]);
        echo Html::tag('span',$name,['class' => 'hide-menu']);
        echo Html::endTag('a');
    }

    public static function createList(){
    	echo Html::beginTag('ul',['aria-expanded' => 'false','class' => 'collapse']);
    }
    public static function complexArrayToString($arr){
        $result = '';
        foreach ($arr as $a) {
            foreach ($a as $s) {
                $result .= $s.'<br>';
            }
        }
        return $result;
    }
    public static function handleExceptionOfAngular($ex){
         return[
                'message' => $ex->getTraceAsString(),
                'error' => 1
            ];
    }

    public static function listToStringQuery($list){
        $str = '(';
        $first = true;
        foreach ($list as $element) {
            if ($first === true)
            {
                $str .= $element;
                $first = false;
            }
            else $str .= ','.$element;
        }
        $str .= ')';
        return $str;
    }

    
}
?>
