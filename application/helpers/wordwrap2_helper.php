<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('wordwrap2')){

 function wordwrap2($str, $width = '40', $break = '<wbr />'){ 
    if(!$str) 
        return false;     

    $str_array = preg_split('/(<[^>]*>)/', $str, null, PREG_SPLIT_NO_EMPTY+PREG_SPLIT_DELIM_CAPTURE);  

    foreach($str_array  as $key => $value)  
    {  
        if ($value[0] == '<') 
            continue; 
  
        $value_array = explode(' ', $value); 
        $str_array[$key] = ''; 
        foreach($value_array as $key2 => $value2)   
        { 
            $tab = ($key2==0) ? '' : ' '; 
            if(strlen($value2) > $width) 
                $str_array[$key] .= $tab.wordwrap($value2, $width, $break, true); 
            else 
                $str_array[$key] .= $tab.$value2; 
        } 
    }  

    $str_array = implode('', $str_array);  
    $str_array = str_replace('><', '><wbr /><', $str_array); 

    return $str_array; 
  }
}