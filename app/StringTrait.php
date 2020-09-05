<?php
namespace App;

trait StringTrait {
    public function NormalizePrice($string) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        
        $string = str_replace(',', '', str_replace($persian, $english, $string));

        return $string;
    }
}
