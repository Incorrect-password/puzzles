<?php
//make doors
$doorsArr = [];
for ($i = 0; $i < 100; $i++) {
    array_push($doorsArr, 'c');
}
seeDoors($doorsArr);

//toggle doors
for ($i = 1; $i <= 100; $i++){
    for ($j = 0 + $i; $j <= 100; $j += $i) {
        if ($doorsArr[$j-1] == 'c'){
            $doorsArr[$j-1] = 'o';
        } else {
            $doorsArr[$j-1] = 'c';
        }
    }
    echo '<br>' . $i;
    echo '<br>';
    seeDoors($doorsArr);
}

//see doors
function seeDoors($array) {
    foreach ($array as $door) {
        echo $door;
    }
}
