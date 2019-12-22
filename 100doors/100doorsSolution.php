<?php
//make doors
$doorsArr = [];
for ($i = 0; $i < 100; $i++) {
    array_push($doorsArr, 'c');
}
//toggle doors
for ($i = 1; $i <= 100; $i++){
    for ($j = 0 + $i; $j <= 100; $j += $i) {
        if ($doorsArr[$j-1] == 'c'){
            $doorsArr[$j-1] = 'o';
        } else {
            $doorsArr[$j-1] = 'c';
        }
    }
}
//show answer
foreach ($doorsArr as $door) {
    echo $door;
}


