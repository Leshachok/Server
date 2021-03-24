<?php
$patterns = [
    'phone' => ['regex' => '/\A((\+?38)?\(?\d{3}\)?[\s\.-]?(\d{7}|\d{3}[\s\.-]\d{2}[\s\.-]\d{2}|\d{3}-\d{4}))\b/', 'callback' => function(array $data){
       $string = $data[0];
       if(!isset($string)) throw new \Exception('REQUEST_INCORRECT', 2);
       $numberscount = preg_match_all( "/[0-9]/", $string);
       if($numberscount == 10){
           $string = '+38'.$string;
       }elseif(substr($string, 0, 1)!='+'){
           $string = '+'.$string;
       }
       return $string;
    }],
    'firstname' => ['regex' => '/\b\w{3,15}\b/'],
    'secondname' => ['regex' => '/\b\w{3,15}\b/'],
    'position' => ['regex' => '/\b\w{3,15}\b/']
];