<?php
//144
$i=1;
while ($i<101) {
    if($i%15==0) {
        echo 'fizzbuzz<br>';
    }else {
        if ($i % 3==0) {
            echo 'fizz<br>';
        } elseif ($i % 5==0) {
            echo 'buzz<br>';
        }else{
            echo $i.'<br>';
        }
    }$i++;
}

//$i=1;
//while ($i<101) {
//    if($i%3==0){
//        echo 'fizz<br>';
//    }
//    if ($i%5==0){
//        echo 'buzz<br>';
//    }
//    $i++;
//}