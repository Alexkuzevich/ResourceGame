<?php

$resources = [];
$result = [];

echo "Сколько различных ресурсов в деревне?\n";
$count = (int)readline();

echo "\nВведите количество каждого из ресурсов:\n";
for ($i = 0; $i < $count; $i++) {
    $resources[] = (int)readline();
}

echo "\nКакова грузоподъемность армии?\n";
$army_load = (int)readline();

function plunder($resources) {

    /* передал перменные грузоподъемности и массива
     * с будущим результатом набега, объявленные глобально */
    global $army_load, $result;

    // случай, когда массив оказался нулевой длины или грузоподъемность равна нулю
    if (count($resources) == 0 || $army_load == 0) {
        echo "Одно из значений не может быть нулевым";
        return 0;
    }
    // случай, когда в деревне всего один ресурс
    elseif (count($resources) == 1) {
        if ($resources[0] >= $army_load) {
            array_push($result, $army_load);
        }
        else {
            array_push($result, $resources[0]);
        }
        //return 1;
    }
    else {
        $ratio = $army_load / array_sum($resources); // вычисляем коэффициент
        foreach ($resources as $elem) {
            array_push($result, (int)($elem * $ratio)); // кол-во награбленного = изначальное кол-во * коэф
        }
    }

    // проверяем, что количество награбленных ресурсов не превосходит грузоподъемности и выводим результат
    if (array_sum($result) <= $army_load) {
        echo "[ ";
        for ($i = 0; $i < count($result); $i++) {
            echo $result[$i];
            echo $i == count($result) - 1 ? '' : ', ';
        }
        echo " ]";
    }
}

plunder($resources);
