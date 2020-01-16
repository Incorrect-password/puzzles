<?php
function fizzBuzz(){
    $result = [];
    for ($i=1;$i<=100;$i++) {
        if($i%3 === 0 && $i%5 === 0){

            array_push($result, 'fizzbuzz');

        }else{

            if ($i%3 === 0){

                array_push($result, 'fizz');

            }elseif ($i%5 === 0) {

                array_push($result, 'buzz');

            }else

                array_push($result, $i);

        }


    }
    return ($result);
}

var_dump(fizzBuzz());

