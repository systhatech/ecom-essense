<?php

namespace App\helpers;

class ArrayHelper
{
    public static function lvl1_formatter(array $data): array
    {
        $formatted=[];
        foreach($data as $key =>$value){
            if(is_array($value)){
                foreach($value as $i=>$v){
                    $formatted[$i][$key]=$v;
                }
            }
        }
        return $formatted;
    }
}
